<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="container py-5">
        @foreach ($extraraport as $raport_ekstrakulikuler)
            <div>
                <p>
                    {{$raport_ekstrakulikuler->predikat}}
                </p>
            </div>
        @endforeach
    </div>
</body>
</html>