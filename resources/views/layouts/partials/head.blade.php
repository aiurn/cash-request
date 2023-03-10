<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="{{asset('assets/images/dev-logo.png')}}" />
<!--plugins-->
<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<!-- Bootstrap CSS -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!-- loader-->
<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />

<!--Theme Styles-->
<link href="{{ asset('assets/css/jquery-confirm.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/light-theme.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/semi-dark.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/header-colors.css') }}" rel="stylesheet" />

{{-- Custom Css --}}
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />

{{-- Select2 Css --}}
<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
<style>
    .disable{
        pointer-events:none;
        user-select:none;
        opacity:0.50;
    }
</style>

@stack('styles')

<title>{{ $page_title ?? '-' }}</title>