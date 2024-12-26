@extends('main')

@section('content')
<div class="container">
    <div class="mt-4" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body">
            @if($isCorrect)
                <div class="alert alert-success">
                    <h4 class="alert-heading"><i class="bi bi-check2"></i> Correct answer!</h4>
                    @if($part == 2)
                        <p>Congratulations! You've completed both parts of this problem!</p>
                        <hr>
                        <p class="mb-0">
                            <a href="{{ route('questions.problems') }}" class="alert-link">Go back to problem list</a> 
                            to solve more problems!
                        </p>
                    @else
                        <p>Great job! You've completed Part 1. Ready to tackle Part 2?</p>
                        <hr>
                        <p class="mb-0">
                            <a href="{{ route('questions.show', $questionId) }}" class="alert-link">Continue to Part 2</a>
                        </p>
                    @endif
                </div>
            @else
                <div class="alert alert-danger">
                    <h4 class="alert-heading"><i class="bi bi-x-lg"></i> Incorrect answer!</h4>
                    <p>Don't give up! Try checking your solution with a different test case.</p>
                    <hr>
                    <p class="mb-0">
                        Your input file is available <a href="{{ Storage::url($inputPath) }}" class="alert-link">here</a>.
                        <br>
                        <a href="{{ route('questions.show', $questionId) }}" class="alert-link">Go back to the problem</a> 
                        and try again!
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection