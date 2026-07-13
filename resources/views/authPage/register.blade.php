<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('storage/image/adminpage/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ URL::asset('storage/image/adminpage/meta-icon2.png') }}">
    <title>
        Create Account
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Nucleo Icons -->
    <style>
        @font-face {
            font-family: 'NucleoIcons';
            src: url('{{ URL::asset('/font/adminpage/nucleo-icons.eot') }}');
            src: url('{{ URL::asset('/font/adminpage/nucleo-icons.eot') }}') format('embedded-opentype'), url('{{ URL::asset('/font/adminpage/nucleo-icons.woff2') }}') format('woff2'), url('{{ URL::asset('/font/adminpage/nucleo-icons.woff') }}') format('woff'), url('{{ URL::asset('/font/adminpage/nucleo-icons.ttf') }}') format('truetype'), url('{{ URL::asset('/font/adminpage/nucleo-icons.svg') }}') format('svg');
            font-weight: normal;
            font-style: normal;
        }
    </style>
    <link href="{{ URL::asset('css/adminpage/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/adminpage/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ URL::asset('css/adminpage/adnucleo-svg.css') }}/" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ URL::asset('css/adminpage/soft-ui-dashboard.css?v=1.0.6') }}" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-5">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-dark text-gradient">Create your account</h3>
                                    <p class="mb-0">Join the world's largerst metaverse collection!</p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="/register" id="registered">
                                        @csrf
                                        <label>Username</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Username"
                                                aria-label="Name" aria-describedby="name-addon" name="username">
                                        </div>
                                        <label>Name</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Name"
                                                aria-label="Name" aria-describedby="name-addon" name="name">
                                        </div>
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" placeholder="Email"
                                                aria-label="Email" aria-describedby="email-addon" name="email">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="Password"
                                                aria-label="Password" aria-describedby="password-addon" name="password">
                                        </div>
                                        <div class="form-check form-check-info text-left">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault" onclick="myFunction()" > <!-- checked> -->
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I agree the <a href="javascript:;"
                                                    class="text-dark font-weight-bolder">Terms and Conditions</a>
                                            </label>
                                        </div>
                                        <!-- <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div> -->
                                        <div class="text-center">
                                            <button id="button_submit" type="button"
                                                class="btn bg-gradient-dark w-100 mt-4 mb-0" disabled onclick="$('#registered').submit()">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Already have an account?
                                        <a href="/login" class="text-dark text-gradient font-weight-bold">Sign in</a>
                                        <!-- <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a> -->
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url({{ URL::asset('img/Register.jpg') }}); margin-left: -6rem !important;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ URL::asset('js/adminpage/core/popper.min.js') }}"></script>
    <script src="{{ URL::asset('js/adminpage/core/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/adminpage/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ URL::asset('js/adminpage/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ URL::asset('js/adminpage/plugins/chartjs.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        function myFunction() {
            var checkBox = document.getElementById("flexCheckDefault");
            if (checkBox.checked == true) {
                $('#button_submit').prop('disabled', false);
            } else {
                $('#button_submit').prop('disabled', true);
            }
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ URL::asset('js/adminpage/soft-ui-dashboard.min.js?v=1.0.6') }}"></script>
    {{-- ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>

</html>
