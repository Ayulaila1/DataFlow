<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DataFlow Login</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/logos/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">

    @livewireStyles

</head>

<body>

    {{ $slot }}

    @livewireScripts

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>