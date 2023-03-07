<!doctype html>
<html lang="en" class="minimal-theme">


<!-- Mirrored from codervent.com/skodash/demo/collapsed-menu/ltr/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Jul 2022 17:25:57 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">
    <style>
        .btn-custom-login {
            background-color: #A8005C;
            color: #fff;
            height: 50px;
        }

        .authentication-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            max-width: 30rem;
        }

    </style>
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />

    <title>{{ $page_title ?? '' }} - Login</title>
</head>

<body>

    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div>
                    <div class="authentication-card">
                        <div class="card shadow radius-30 overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="card-body p-4 p-sm-5">
                                        <img src="{{ asset('assets/images/grootech-icon.png') }}" alt="" width="100%">
                                        <h5 class="card-title">Sign In</h5>
                                        <form class="form-body" method="post" action="{{ route('login') }}">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Username / Email</label>
                                                    <div class="ms-auto position-relative">
                                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                            <i class="bi bi-envelope-fill"></i></div>
                                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="inputEmailAddress" placeholder="Username / Email">
                                                        @error('username')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                                    <div class="ms-auto position-relative">
                                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                            <i class="bi bi-lock-fill"></i></div>
                                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputChoosePassword" placeholder="Enter Password">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-5">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-custom-login">Sign In</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <!--end page main-->

    </div>
    <!--end wrapper-->


    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>


</body>


<!-- Mirrored from codervent.com/skodash/demo/collapsed-menu/ltr/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Jul 2022 17:25:58 GMT -->

</html>
