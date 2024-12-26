@extends('main')

@section('content')

<div class="container mt-4" style="max-width: 80vh;">

    <h1 class="text-center">Log in to your account</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Username Input -->
        <div class="">
            <label for="username" class="form-label fs-5">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required value="{{ old('username') }}">
            @error('username')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="">
            <label for="password" class="form-label fs-5">Password:</label>
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

        <div class="mt-2 text-dark-subtle" style="color: var(--bs-secondary-color);">
            Don't have an account yet? <a href="{{ route('register') }}">Register here</a>.
        </div>

        <!-- General Error Message -->
        @if($errors->has('auth'))
        <div class="text-danger mt-2 mb-4">{{ $errors->first('auth') }}</div>
        @endif

        <!-- Submit Button -->
        <div class="text-center mt-2">
            <button type="submit" class="btn btn-primary fw-bold px-4 fs-5 mt-4">Login</button>
        </div>
    </form>
</div>

@endsection
