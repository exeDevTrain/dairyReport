<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        html,
        body,
        main {
            height: 100%;
        }
    </style>

    <title>Login Page</title>
</head>

<body>
    <main class="container w-75 d-flex align-items-center justify-content-center">
        <div class="w-75 h-50 p-4 border border-2 border-secondary">
            <form>
                <div class="mb-3">
                    <label for="employee_number" class="form-label fs-3 text-secondary">Employee Number</label>
                    <input type="text" class="form-control" id="employee_number">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fs-3 text-secondary">Password</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="passwordCheck">
                    <label class="form-check-label" for="passwordCheck">Check me out</label>
                </div>
                <div class="container w-75 p-0">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-secondary w-25">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>