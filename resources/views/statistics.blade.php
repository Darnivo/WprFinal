@extends('main')
@section('content')
<div class="container mt-4" style="max-width: 1000px; margin: 0 auto;">
    @foreach(['easy', 'medium', 'hard'] as $difficulty)
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="mb-0">{{ ucfirst($difficulty) }} Problems</h2>
            </div>
            <div class="card-body">
                @if(isset($questions[$difficulty]))
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 70%">Question</th>
                                <th style="width: 15%" class="text-center">Part 1 Solved</th>
                                <th style="width: 15%" class="text-center">Part 2 Solved</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions[$difficulty] as $question)
                                <tr>
                                    <td>
                                        <a href="{{ route('questions.show', $question->id) }}" class="fw-bold link-underline link-underline-opacity-0">
                                            {{ $question->Title }}
                                        </a>
                                    </td>
                                    @php
                                        $part1_solved = $question->userSolutions->where('part1_correct', true)->count();
                                        $part2_solved = $question->userSolutions->where('part2_correct', true)->count();
                                    @endphp
                                    <td class="text-center">
                                        <span class="badge bg-danger fs-6">{{ $part1_solved }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success fs-6">{{ $part2_solved }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No {{ $difficulty }} problems available.</p>
                @endif
            </div>
        </div>
    @endforeach
    
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0 text-center"><i class="bi bi-star-fill"></i>  Hall of Fame  <i class="bi bi-star-fill"></i></h2>
            <p class="mt-0 text-center mb-0">A list of Users who've completed all the problems </p>
        </div>
        <div class="card-body">
            @if(count($completionists) > 0)
                <div class="row mt-2">
                    @foreach ($completionists as $completionist)
                        <div class="col-md-6 mb-3">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="text-center w-100">
                                        <strong>{{ $completionist->username }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-body-secondary mb-0 text-center">No users have completed all the problems,<strong class="text-white"> for now.</strong></p>
                <a class="mb-0 text-center d-block link-underline-white text-white" href="/problems">Why not be the first?</a>
            @endif
        </div>
    </div>



@endsection

