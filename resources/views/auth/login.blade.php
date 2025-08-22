<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <link rel="icon" href="{{ asset('root/images/logo-icon.png')}}" type="image/png"/>
        <!--plugins-->
        <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
        {{-- <!-- loader-->
        <link href="{{ asset('assets/css/pace.min.css')}}" rel="stylesheet" />
        <script src="{{ asset('assets/js/pace.min.js')}}"></script> --}}
        <!-- Bootstrap CSS -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/app.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet">
        <title>YNOV - Authentification</title>
    </head>

    <body class="">

        <style>
            .btn-primary {
                background-color: #076633 !important;
                color: #fff;
                border: none;
            }
            .btn-primary:hover {
                background-color: #edb440 !important;
                color: #fff;
                border: none;
            }

            .content-img {
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center center;
            }
        </style>
        <!--wrapper-->
        <div class="wrapper">
            <div class="section-authentication-cover">
                <div class="">
                    <div class="row g-0">

                        <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex content-img" style="background-image: url({{ asset('root/images/login-images/login-cover.jpg')}})">

                            {{-- <img src="{{ asset('root/images/login-images/login-cover.jpg')}}" alt="" class="img-fluid"> --}}
                            
                        </div>

                        <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                            <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                                <div class="card-body p-sm-5">
                                    <div class="">
                                        <div class="mb-3 text-center " >
                                            <img src="{{ asset('root/images/logo-ynov.png')}}" width="250" alt="">
                                        </div>
                                        <div class="text-center mb-4">
                                            <p class="mb-0">Veuillez vous connecter à votre compte</p>
                                        </div>
                                        <div class="form-body">
                                            <form class="row g-3" action="{{ route('login')}}" method="POST">
                                                @csrf
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="inputEmailAddress" placeholder="jhon@example.com" value="{{ old('email')}}" name="email" required>
                                                    <span>
                                                        @error('email')
                                                            <span class="text-danger">Veuillez remplir un email valable</span>
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Mot de passe</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" class="form-control border-end-0" id="inputChoosePassword" value="{{ old('password')}}" name="password" placeholder="Entrez votre mot de passe" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                                                    </div>
                                                    <span>
                                                        @error('password')
                                                            <span class="text-danger">Email ou mot de passe incorrect</span>
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-12 text-end">
                                                    <div class="form-check form-switch">
                                                        @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ __('Mot de passe oublié?') }}
                                                        </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Souviens-toi de moi</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary">Se connecter</button>
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <!--end wrapper-->
        <!-- Bootstrap JS -->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <!--plugins-->
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
        <!--Password show & hide js -->
        <script>
            $(document).ready(function () {
                $("#show_hide_password a").on('click', function (event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass("bx-hide");
                        $('#show_hide_password i').removeClass("bx-show");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass("bx-hide");
                        $('#show_hide_password i').addClass("bx-show");
                    }
                });
            });
        </script>
        <!--app JS-->
        <script src="{{ asset('assets/js/app.js')}}"></script>
    </body>
</html>