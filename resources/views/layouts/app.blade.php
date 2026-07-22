<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'DataFlow' }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">

    @livewireStyles

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        html,
        body{
            width:100%;
            min-height:100%;
            overflow-x:hidden;
            background:#f6f9fc;
        }

        #main-wrapper{
            display:flex;
            width:100%;
            min-height:100vh;
        }

        /* Sidebar */
        .left-sidebar{
            width:270px;
            min-width:270px;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            z-index:1000;
            background:#fff;
            border-right:1px solid #ececec;
        }

        /* Content */
        .body-wrapper{
            margin-left:270px !important;
            width:calc(100% - 270px);
            min-height:100vh;
            background:#f6f9fc;

            /* Hapus style bawaan template */
            left:unset !important;
            right:unset !important;
        }

        .page-wrapper{
            width:100%;
            min-height:100vh;
        }

        .container-fluid{
            padding:25px;
        }

        .app-header{
            position:sticky;
            top:0;
            z-index:999;
            background:#fff;
        }

        /* Hilangkan margin bawaan Flexy */
        @media (min-width:1200px){

            .page-wrapper{
                margin-left:0 !important;
            }

            .body-wrapper{
                margin-left:270px !important;
            }

        }

        @media (max-width:1199px){

            .left-sidebar{
                transform:translateX(-100%);
            }

            .body-wrapper{
                margin-left:0 !important;
                width:100%;
            }

        }

    </style>

</head>

<body>

<div id="main-wrapper">

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

<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>

@livewireScripts

</body>
</html>