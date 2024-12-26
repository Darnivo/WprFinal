@extends('main')

@section('content')

<div class="py-2 mt-4 mb-2">
    <h1 class="text-center"> Start playing!</h2>
        @auth
            <p class="mt-1 mb-3 lead text-center" style="color: var(--bs-secondary-color);"> Now that you are logged in, you can submit answers & see the input files. </p>    
        @endauth
        @guest
        <p class="mt-1 mb-3 lead text-center" style="color: var(--bs-secondary-color);"> Although you can read the puzzles without an account, you'll need to sign up to access the input data and track your progress. </p>
        <div class="d-grid gap-2 d-md-flex justify-content-center my-4">
            <a href="{{ route('login') }}" class="btn btn-outline-light px-4 py-2 fs-5 me-5" role="button">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light px-4 py-2 fs-5" role="button">Register</a>
        </div>
        @endguest
</div>

<div class="container" style="max-width: 1000px; margin: 0 auto;">
    @foreach(['easy', 'medium', 'hard'] as $difficulty)
    <div class="card mb-4">
        <div class="card-header">
            <h2 class="mb-0">{{ ucfirst($difficulty) }} Problems</h2>
        </div>
        <div class="card-body">
            @if(isset($questions[$difficulty]))
            <div class="list-group">
                @foreach($questions[$difficulty] as $question)
                <div class="list-group-item d-flex justify-content-between align-items-center" >
                    <div>
                        <a href="{{ route('questions.show', $question->id) }}" class="fw-bold link-underline link-underline-opacity-0">
                            {{ $question->Title }}
                        </a>
                    </div>
                    <div>
                        @auth
                        @php
                        $solution = $question->userSolutions->first();
                        @endphp

                        @if(!$solution)
                        <span class="badge bg-secondary">Unsolved</span>
                        @elseif($solution->part1_correct && !$solution->part2_correct)
                        <span class="badge bg-danger">Part 1 Complete</span>
                        @elseif($solution->part1_correct && $solution->part2_correct)
                        <span class="badge bg-success">Complete</span>
                        @endif
                        @endauth
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p style="color: var(--bs-secondary-color);">No {{ $difficulty }} problems available.</p>
            @endif
        </div>
    </div>
    @endforeach
</div>

@endsection