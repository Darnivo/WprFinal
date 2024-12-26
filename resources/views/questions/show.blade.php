@extends('main')

@section('content')
<div class="container">
    <div class="card rounded-0 mt-4">
        <div class="card-body">
            {!! $parts['title'] !!}

            <!-- Part 1 content and completion message -->
            <div id="part1-content">
                {!! $parts['part1'] !!}
                @if($solution && $solution->part1_correct)
                <div class="alert alert-secondary mt-3 fs-6">
                    Correct, the answer was <strong class="text-white">{{ $question->part1_answer }}</strong>!
                </div>
                @endif
            </div>

            <!-- Part 2 content and completion message -->
            @if($solution && $solution->part1_correct)
            <div id="part2-content" class="mt-4">
                <hr>
                {!! $parts['part2'] !!}
                @if($solution->part2_correct)
                <div class="alert alert-secondary mt-3 fs-6">
                    Correct, the answer was <strong class="text-white">{{ $question->part2_answer }}</strong></code>!
                </div>
                @endif
            </div>
            @endif

            @auth
            <!-- Input file button -->
            <div class="mt-3">
                <a href="{{ Storage::url($question->input_file_path) }}"
                    class="btn btn-primary" target="_blank">
                    <i class="bi bi-lightbulb"></i> Get Input File
                </a>
                @if($solution && $solution->part1_correct)
                <span class="ms-2 text-muted">(Your input file is still the same)</span>
                @endif
            </div>

            @if(!$solution || !$solution->part1_correct)
            <form id="submit-part1" method="POST" action="{{ route('questions.submit', $question->id) }}" class="mt-4">
                @csrf
                <input type="hidden" name="part" value="1">
                <div class="form-group">
                    <input type="text" name="answer" class="form-control"
                        placeholder="Enter your answer" required>
                </div>
                <button type="submit" class="btn btn-success mt-2">Submit Part 1</button>
            </form>
            @endif

            <!-- Part 2 submission form -->
            @if($solution && $solution->part1_correct && !$solution->part2_correct)
            <form id="submit-part2" method="POST" action="{{ route('questions.submit', $question->id) }}" class="mt-3">
                @csrf
                <input type="hidden" name="part" value="2">
                <div class="form-group">
                    <input type="text" name="answer" class="form-control"
                        placeholder="Enter your answer" required>
                </div>
                <button type="submit" class="btn btn-success mt-2">Submit Part 2</button>
            </form>
            @endif
            @else
            <div class="alert alert-secondary mt-3">
                You need to <a href="{{ route('login') }}" class="fw-bold">Log in</a> to submit solutions and see the input file.
            </div>
            @endauth
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Make sure jQuery is available
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded');
            return;
        }

        // Add AJAX submission handling for both parts
        ['submit-part1', 'submit-part2'].forEach(formId => {
            $(`#${formId}`).on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const submitButton = form.find('button[type="submit"]');

                // Disable the submit button to prevent double submission
                submitButton.prop('disabled', true);

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.correct) {
                            location.reload();
                        } else {
                            alert(response.message || 'Incorrect answer. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                        console.error('Submission error:', xhr);
                    },
                    complete: function() {
                        // Re-enable the submit button
                        submitButton.prop('disabled', false);
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection