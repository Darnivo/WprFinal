<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    // StatisticsController.php
    public function index()
    {
        $questions = Question::with(['userSolutions' => function ($query) {
            $query->select('question_id', 'part1_correct', 'part2_correct');
        }])->get()
            ->groupBy('difficulty');

        $completionists = DB::table('users')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('user_solutions')
                    ->whereColumn('user_solutions.user_id', 'users.id')
                    ->groupBy('user_solutions.user_id')
                    ->havingRaw('COUNT(*) = (SELECT COUNT(*) FROM questions)')
                    ->havingRaw('SUM(CASE WHEN part1_correct = 1 AND part2_correct = 1 THEN 1 ELSE 0 END) = COUNT(*)');
            })
            ->get();

        return view('statistics', compact('questions','completionists'));
    }
    // StatisticsController.php
    public function showSqlData()
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $users = DB::table('users')->get();
        $questions = DB::table('questions')->get();
        $solutions = DB::table('user_solutions')->get();

        return view('sqldata', compact('users', 'questions', 'solutions'));
    }
}
