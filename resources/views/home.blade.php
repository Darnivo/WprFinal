<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    @extends('main')

    @section('content')
    <div class="">
        <div class="row justify-content-center align-items-center mx-auto text-center">
            <div class="col-auto">
                <h1 class="my-4 fw-bolder">Welcome to Microde</h1>
            </div>
            <div class="col-auto">
                <img src="img/logo.png" alt="Logo" width="80" height="60" class="d-inline-block align-text-top">
            </div>
        </div>

        <div class="py-2" style="background-color: var(--bs-dark-bg-subtle);">
            <div class="mx-5 mt-2 mb-3">
                <h2 class="mb-2">A website to train your coding skills</h2>
                <p class="pb-2 fs-5 fw-light">
                    Participate in a series of coding challenges that will test your problem-solving skills and help you learn new programming concepts. Handcrafted puzzles are available ranging from easy to hard, designed to push your limits and expand your knowledge. Whether you've never touched a coding program before or is a pro coder, there's something for everyone. Dive in, have fun, and improve your coding abilities one challenge at a time!
                </p>
                <p></p>
            </div>
        </div>

        <div class="py-2 mt-5" style="background-color: var(--bs-dark-bg-subtle);">
            <div class="mx-5 mt-2 mb-3">
                <h2 class="mb-2 text-center">Where to start</h2>
                <p class="pb-2 fs-5 fw-light">
                    The puzzles themselves are more of a logic puzzle than a coding hurdle, and while it's possible to solve
                    them without any coding knowledge, it's recommended to have some basic programming skills.
                    <br><br>
                    If you're new to coding, start with the easy puzzles and work your way up. If you're a seasoned coder,
                    feel free to jump right in and tackle the harder challenges. The while the questions can technically be
                    solved without any coding, it's recommended that you use a programming language to help you solve the
                    puzzles faster.
                    <br><br>
                    Is your PC made from components released in the prehistoric era and would explode if you open more than
                    3 chrome tabs simultaneously? That wont be a problem! The puzzles are designed to be lightweight and
                    can be solved using any device in 10 seconds max.
                </p>
                <p></p>
            </div>
        </div>

        <div class="py-2 mt-2">
            <h1 class="text-center"> What are you waiting for? Start your journey today!</h2>
                <p class="mt-1 mb-3 lead text-center text-body-secondary"> Although you can read the puzzles without an account, you'll need to sign up to access the input data and track your progress. </p>

                @auth
                <h4 class="text-center my-4">You are already logged in, great!
                    <a href="/problems" class="ms-5">View problems here</a>
                </h4>
                @endauth

                @guest
                <div class="d-grid gap-2 d-md-flex justify-content-center my-4">
                    <a href="{{ route('login') }}" class="btn btn-outline-light px-4 py-2 fs-5 me-5" role="button">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light px-4 py-2 fs-5" role="button">Register</a>
                </div>
                @endguest


        </div>

    </div>



    @endsection
</body>

</html>