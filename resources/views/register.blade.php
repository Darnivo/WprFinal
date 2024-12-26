@extends('main')

@section('content')

<div class="container mt-4" style="max-width: 80vh;">

    <h1 class="text-center mb-2"><i class="bi bi-person-add"></i> User registration</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Username Input -->
        <div class="">
            <label for="username" class="form-label fs-4">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required value="{{ old('username') }}">
            @error('username')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 text-dark-subtle" style="color: var(--bs-secondary-color);">
            Your username must:
            <ul>
                <li>Be unique</li>
                <li>Not be empty</li>
                <li>Must be 3-20 characters long</li>
            </ul>
        </div>

        <!-- Password Input -->
        <div class="">
            <label for="password" class="form-label fs-4">Password:</label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye-slash"></i>
                </button>
            </div>
            @error('password')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        
        <script>
            document.getElementById('togglePassword').addEventListener('click', function() {
                const password = document.getElementById('password');
                const icon = this.querySelector('i');
                
                if (password.type === 'password') {
                    password.type = 'text';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                } else {
                    password.type = 'password';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                }
            });
        </script>

        <div class="mb-4 text-dark-subtle" style="color: var(--bs-secondary-color);">
            Your password must:
            <ul>
                <li>Not be empty</li>
                <li>Must be 6-50 characters long</li>
            </ul>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary fw-bold px-3">Register</button>

        <!-- General Error Message -->
        @if($errors->has('error'))
        <div class="text-danger mt-3">{{ $errors->first('error') }}</div>
        @endif
    </form>
</div>

@endsection