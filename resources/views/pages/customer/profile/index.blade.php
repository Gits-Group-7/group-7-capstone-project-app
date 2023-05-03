<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <center>
        <p>
            Halaman Profil Customer
            {{ Auth::user()->name }}
        </p>

        <div class="d-flex">
            <a href="{{ route('customer.beranda') }}">Beranda</a>
            <a href="{{ route('logout.page') }}">Logout</a>

        </div>
    </center>
</body>

</html>
