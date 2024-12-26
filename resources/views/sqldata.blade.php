@extends('main') 
@section('content') 
<div class="container mt-4">
    <div class="accordion accordion-flush" id="sqlAccordion">
        <!-- Users Table -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#usersCollapse">
                <i class="pe-2 bi bi-people-fill"></i>Users Table
                </button>
            </h2>
            <div id="usersCollapse" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Is Admin</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions Table -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#questionsCollapse">
                <i class="pe-2 bi bi-question-circle-fill"></i>Questions Table
                </button>
            </h2>
            <div id="questionsCollapse" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Difficulty</th>
                                    <th>Part 1 Answer</th>
                                    <th>Part 2 Answer</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $question)
                                <tr>
                                    <td>{{ $question->id }}</td>
                                    <td>{{ $question->Title }}</td>
                                    <td>{{ $question->difficulty }}</td>
                                    <td>{{ $question->part1_answer }}</td>
                                    <td>{{ $question->part2_answer }}</td>
                                    <td>{{ $question->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Solutions Table -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#solutionsCollapse">
                <i class="pe-2 bi bi-lightbulb-fill"></i>Problem submissions Table
                </button>
            </h2>
            <div id="solutionsCollapse" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Question ID</th>
                                    <th>Part 1</th>
                                    <th>Part 2</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solutions as $solution)
                                <tr>
                                    <td>{{ $solution->id }}</td>
                                    <td>{{ $solution->user_id }}</td>
                                    <td>{{ $questions->where('id', $solution->question_id)->first()->Title }} - <span style="color: var(--bs-secondary-color);">{{ $solution->question_id }}</span></td>
                                    <td>{{ $solution->part1_correct ? 'Solved' : 'Unsolved' }}</td>
                                    <td>{{ $solution->part2_correct ? 'Solved' : 'Unsolved' }}</td>
                                    <td>{{ $solution->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
