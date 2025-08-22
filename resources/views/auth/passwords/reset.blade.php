<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YNOV - Réinitialisation de mot de passe</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="justify-content-center">

    <div class="wrapper">
        <div class="authentication-reset-password d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card shadow-lg rounded-lg">
                            <div class="text-center mt-4">
                                <img src="{{ asset('root/images/logo.png') }}" width="80" alt="Logo" class="mb-3" />
                                <h5 class="fw-bold">Générer un nouveau mot de passe</h5>
                                <p class="text-muted">Veuillez saisir votre nouveau mot de passe pour continuer.</p>
                            </div>
    
                            <div class="card-body px-4">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
    
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Adresse e-mail</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="mb-4">
                                        <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
    
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-outline-success btn-lg shadow-sm">Modifier le mot de passe</button>
                                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Retour à la connexion</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Optional custom styles for better presentation -->
    <style>
        .card {
            border-radius: 15px;
            background-color: #f8f9fa;
        }
        .card-body {
            padding: 2rem;
        }
        .form-label {
            font-size: 1rem;
            color: #495057;
        }
        .invalid-feedback {
            font-size: 0.875rem;
            color: #dc3545;
        }
        .d-grid > .btn {
            font-size: 1.1rem;
            font-weight: 500;
            padding: 12px;
        }
        .shadow-sm {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
