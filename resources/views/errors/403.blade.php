<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Forbidden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="p-5 m-5 text-center">
            <div class="card p-5 rounded-5">
                <h1 class="display-1 fw-bold">403</h1>
                <h4 class="display-6">Forbidden</h4>

                <hr>
                <p class="lead fw-normal">You don`t have permission to access this resource.</p>

                <div>
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary rounded-5 px-5">Go to home</a>
                </div>

            </div>
        </div>
    </div>

</body>
</html>