@extends('main')

@section('content')
<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload New Question</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('questions.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="difficulty">Difficulty</label>
                            <div class="position-relative">
                                <select class="form-control @error('difficulty') is-invalid @enderror" 
                                        id="difficulty" name="difficulty" required>
                                    <option value="">Select Difficulty</option>
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                            </div>
                            @error('difficulty')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="markdown_file">Question File (.md)</label>
                            <input type="file" class="form-control @error('markdown_file') is-invalid @enderror" 
                                   id="markdown_file" name="markdown_file" accept=".md" required>
                            <p class="text-muted">Please use the template provided <a href="https://github.com/Darnivo/ProblemsMaster/blob/main/template.md" target="_blank" rel="noopener noreferrer">here</a> (open the raw file)</p>
                            @error('markdown_file')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="input_file">Input File (.txt)</label>
                            <input type="file" class="form-control @error('input_file') is-invalid @enderror" 
                                   id="input_file" name="input_file" accept=".txt" required>
                            @error('input_file')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="part1_answer">Part 1 Answer</label>
                            <input type="text" class="form-control @error('part1_answer') is-invalid @enderror" 
                                   id="part1_answer" name="part1_answer" required>
                            @error('part1_answer')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="part2_answer">Part 2 Answer</label>
                            <input type="text" class="form-control @error('part2_answer') is-invalid @enderror" 
                                   id="part2_answer" name="part2_answer" required>
                            @error('part2_answer')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Upload Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection