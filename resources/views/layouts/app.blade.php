<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name') }}</title>

    {{-- CSS --}}
    <link rel="shortcut icon"
          href="{{ asset('assets/images/logos/favicon.png') }}">

    <link rel="stylesheet"
          href="{{ asset('assets/css/styles.min.css') }}">

    @livewireStyles

</head>

<body>

<div class="page-wrapper"
     id="main-wrapper">

    {{-- Sidebar --}}
    @include('components.sidebar')

    <div class="body-wrapper">

        {{-- Navbar --}}
        @include('components.navbar')

        <div class="body-wrapper-inner">

            <div class="container-fluid">

                {{ $slot }}

            </div>

        </div>

    </div>

</div>

@include('components.footer')

@livewireScripts

</body>

</html>