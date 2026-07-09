<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'DataFlow' }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">

    @livewireStyles

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .page-wrapper {
            min-height: 100vh;
        }

        .body-wrapper {
            min-height: 100vh;
            background: #f6f9fc;
        }

        .container-fluid {
            padding-top: 24px !important;
            padding-left: 24px !important;
            padding-right: 24px !important;
            padding-bottom: 24px !important;
        }

        .app-header {
            position: sticky;
            top: 0;
            z-index: 999;
            background: #fff;
        }

        .left-sidebar {
            z-index: 1000;
        }
    </style>

</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <div class="body-wrapper">

            {{-- Navbar --}}
            @include('layouts.navbar')

            <div class="container-fluid">

                {{ $slot }}

            </div>

        </div>

    </div>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>

    {{-- <script src="{{ asset('assets/js/custom.js') }}"></script> --}}

    @livewireScripts

</body>

</html>