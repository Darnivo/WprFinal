@extends('main')

@section('content')

    <div class="m-4 jumbotron text-center">
        <h1>Account Registration Successful!</h1>
        <p>Your account has been successfully created. You can now <a href="{{ route('login') }}">log in</a>.</p>
    </div>
@endsection