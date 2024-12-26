<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
</head>

<body>
    @extends('main')

    @section('content')

    <div>
        <div class="row justify-content-center align-items-center mx-auto text-center">
            <div class="col-auto">
                <img src="img/logo.png" alt="Logo" width="80" height="60" class="d-inline-block align-text-top">
            </div>
            <div class="col-auto">
                <h1 class="my-4 fw-bolder">Microde</h1>
            </div>
        </div>
        <p class="text-center mx-auto text-body-secondary">A Web Programming project</p>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <h3 class="text-center">Made by:</h3>
                    <table class="table w-50 mx-auto text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Name</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <tr>
                                <th scope="row">1</th>
                                <td>2602079590</td>
                                <td>Darren Ivano</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>2602070622</td>
                                <td>Devin Jonathan</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>2602076222</td>
                                <td>Johanes Lie</td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="mt-4 w-75 mx-auto mb-4">

                        <hr class="border-2 opacity-100">
                        <div class="mt-4 fs-5">
                            <h2 class="text-center">What does this website do?</h2>
                            <li>This website allows users to answer coding questions from the questions that are listed</li>
                            <li>As the Admin, you can upload the questions</li>
                            <li>Each problem has 2 parts, Users can submit their answer for part 1 to progress and get access to the modified challenge problem in part2</li>
                        </div>

                        <div class="mt-4 fs-5">
                            <h3 class="text-center">SDG / Sustainable Development Goals</h3>
                            <p>As of currently, our website strives to tackle problem number 4: <span class="text-danger fw-bold">Quality Education</span>. However, this website can easily be modified to share awareness of various other problems.</p>
                            <p>For example, we can change the theming and the problemsets easily to fit topics like <span class="fw-bold" style="color: #198754;">Climate Action</span>, <span class="fw-bold text-info">Life below water</span>,and <span class="fw-bold" style="color: #20C74AFF;">Good Health and Well-being</span>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-items-center mx-auto text-center mt-2 mb-4">
        <h3> Examine the website code</h3>
        <p class="text-center mx-auto text-body-secondary">A link to the git repository for the project & the problemsets</p>
        <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
            <a href="https://github.com/Darnivo/WprFinal" target="_blank" rel="noopener noreferrer" class="btn btn-light px-3 py-3 fs-5 fw-bold me-5" role="button"><i class="bi bi-github"></i> Project Repository</a>
            <a href="https://github.com/Darnivo/ProblemsMaster" target="_blank" rel="noopener noreferrer" class="btn btn-light px-3 py-3 fs-5 fw-bold" role="button"><i class="bi bi-github"></i> Problemsets Repository</a>
        </div>
    </div>



    @endsection
</body>

</html>