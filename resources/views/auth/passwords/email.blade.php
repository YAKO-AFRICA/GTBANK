
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <!-- Lien vers le fichier CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .wrapper {
            /* background-image: url('https://mdbootstrap.com/img/new/fluid/city/008.jpg'); */
            background-image: url('{{ asset('root/images/login-images/login.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 99vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }

        .reset-container {
            background-size: cover;
            background-position: center;
            /* background-color: rgba(255, 255, 255, 0.8); */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px; /* Vous pouvez ajuster cette largeur si nécessaire */
        }
    </style>
</head>
<body>

    <div class="wrapper">
		<div class="authentication-forgot d-flex align-items-center justify-content-center">
			<div class="card forgot-box">
				<div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="p-3">
                            <div class="text-center">
                                <img src="{{asset('assets/images/icons/forgot-2.png')}}" width="100" alt="" />
                            </div>
                            <h4 class="mt-5 font-weight-bold">Vous avez oubliez votre mot de passe?</h4>
                            <p class="text-muted">Entrez votre adresse email et nous vous enverrons un lien de réinitialisation</p>
                            <div class="my-4">
                                <label class="form-label">Email Adresse</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-outline-success">{{ __('Envoyer le lien de réinitialisation') }}</button>
                                <a href="{{ route('login') }}" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Retour a la page de connexion</a>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

    <!-- Lien vers les fichiers JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>



