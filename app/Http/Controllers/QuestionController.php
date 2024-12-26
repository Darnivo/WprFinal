<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\CommonMarkConverter;
use App\Models\User_solutions;

class QuestionController extends Controller
{
    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,medium,hard',
            'markdown_file' => 'required|file|mimes:md,txt',
            'input_file' => 'required|file|mimes:txt',
            'part1_answer' => 'required|string',
            'part2_answer' => 'required|string'
        ]);

        // Generate UUID
        $uuid = Str::uuid();

        // Store files with UUID names
        $markdownPath = $request->file('markdown_file')->storeAs(
            'problems/markdown',
            $uuid . '.md',
            'public'
        );

        $inputPath = $request->file('input_file')->storeAs(
            'problems/inputs',
            $uuid . '.txt',
            'public'
        );

        // Create question
        Question::create([
            'id' => $uuid,
            'Title' => $request->title,
            'difficulty' => $request->difficulty,
            'markdown_file_path' => $markdownPath,
            'input_file_path' => $inputPath,
            'part1_answer' => $request->part1_answer,
            'part2_answer' => $request->part2_answer
        ]);

        return redirect()->route('questions.create')
            ->with('success', 'Question created successfully! UUID: ' . $uuid);
    }

    public function listProblems()
    {
        $questions = Question::when(auth()->check(), function ($query) {
            return $query->with(['userSolutions' => function ($query) {
                $query->where('user_id', auth()->id());
            }]);
        })->get()->groupBy('difficulty');

        return view('questions.problems', compact('questions'));
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        $solution = null;
        
        if (auth()->check()) {
            $solution = User_solutions::where('user_id', auth()->id())
                ->where('question_id', $id)
                ->first();
        }
    
        $markdown = Storage::disk('public')->get($question->markdown_file_path);
        $parts = $this->parseMarkdown($markdown);
    
        return view('questions.show', compact('question', 'solution', 'parts'));
    }

    private function parseMarkdown($content)
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        // Split the content into sections
        $lines = explode("\n", $content);

        $parts = [
            'title' => '',
            'part1' => '',
            'part2' => ''
        ];

        // Extract title (first line)
        $parts['title'] = $converter->convert($lines[0])->getContent();

        // Extract Parts
        $currentPart = null;
        $part1Content = [];
        $part2Content = [];

        foreach (array_slice($lines, 1) as $line) {
            if (str_contains($line, '## Part 1')) {
                $currentPart = 'part1';
                continue;
            }
            if (str_contains($line, '## Part 2')) {
                $currentPart = 'part2';
                continue;
            }

            // Skip lines containing specific phrases
            if (str_contains($line, 'Get your input') || str_contains($line, 'Please enter')) {
                continue;
            }

            // Add line to appropriate part
            if ($currentPart === 'part1') {
                $part1Content[] = $line;
            } elseif ($currentPart === 'part2') {
                $part2Content[] = $line;
            }
        }

        // Convert markdown to HTML for each part
        $parts['part1'] = $converter->convert(implode("\n", $part1Content))->getContent();
        $parts['part2'] = $converter->convert(implode("\n", $part2Content))->getContent();

        return $parts;
    }

    public function submitAnswer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|string',
            'part' => 'required|in:1,2'
        ]);

        $question = Question::findOrFail($id);
        $correctAnswer = $request->part == 1 ? $question->part1_answer : $question->part2_answer;
        $isCorrect = $request->answer === $correctAnswer;

        if ($isCorrect) {
            User_solutions::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'question_id' => $id
                ],
                [
                    'part' . $request->part . '_correct' => true
                ]
            );
        }

        // If the request is AJAX, return JSON response
        if ($request->ajax()) {
            return response()->json([
                'correct' => $isCorrect,
                'message' => $isCorrect ? 'Correct answer!' : 'Incorrect answer. Try again!'
            ]);
        }

        // For non-AJAX requests, return the answer view
        return view('questions.answer', [
            'isCorrect' => $isCorrect,
            'part' => $request->part,
            'questionId' => $id,
            'inputPath' => $question->input_file_path
        ]);
    }
}
