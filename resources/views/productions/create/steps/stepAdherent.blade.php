<div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
    <h5 class="mb-1">Informations personnelles de l'adhérent</h5>
    <p class="mb-4">Veuillez entrer vos informations personnelles pour commencer l'adhésion en tenant compte des champs
        obligatoire (<span class="star">*</span>).</p>
    <div class="row g-3 mb-3">
        <div class="col-12">
            <label class="form-label">Civilité <span class="star">*</span></label> <br>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1" value="Madame" autocomplete="on" required data-invalid-message="Veuillez cocher la civilité">
                <label class="form-check-label" for="inlineRadio1">Madame</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2" value="Mademoiselle" autocomplete="on" required>
                <label class="form-check-label" for="inlineRadio2">Mademoiselle</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="civilite" id="inlineRadio3" value="Monsieur" autocomplete="on" required>
                <label class="form-check-label" for="inlineRadio3">Monsieur</label>
            </div>
            @error('civilite')
                <span class="text-danger"> Veuillez cocher la civilité </span>
            @enderror
        </div>
    </div>
    <!---end row-->
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="FisrtName" class="form-label">Nom <span class="text-danger">*</span></label>
            <input type="text" name="nom" class="form-control" id="FisrtName" placeholder="Nom" autocomplete="on" required>
            @error('nom')
                <span class="text-danger">Veuillez remplir le champ nom</span>
            @enderror
        </div>
        <div class="col-12 col-lg-6">
            <label for="LastName" class="form-label">Prénoms <span class="text-danger">*</span></label>
            <input type="text" name="prenom" class="form-control" id="LastName" placeholder="Prénoms" autocomplete="on" required>
            @error('prenom')
                <span class="text-danger">Veuillez remplir le champ prenom</span>
            @enderror
        </div>
    </div>
    <!---end row-->
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="Date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
            <input type="date" name="datenaissance" class="form-control" id="Date_naissance"
                placeholder="Date de naissance" autocomplete="on" required>

                <span class="text-danger date-error"></span>

            @error('datenaissance')
                <span class="text-danger"> Veuillez remplir la date de naissance </span>
            @enderror
        </div>
        
        <div class="col-12 col-lg-6">
            <label for="lieunaissanc-{{ $product->CodeProduit }}" class="form-label">Lieu de naissance</label>
            <select class="form-select selection" name="lieunaissance" id="lieunaissance"
                data-codeproduit="{{ $product->CodeProduit }}" data-placeholder="Sélectionner le lieu" autocomplete="on">
                <option value="" disabled selected>Sélectionner le lieu</option>

                @foreach($villes as $ville)
                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- <div>
        <strong id="displayLieuNaissance">--</strong>
        <strong id="displayResidence">--</strong>
    </div> --}}
    <!---end row-->
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-4">
            <label for="" class="form-label">Nature de la pièce <span class="text-danger">*</span></label>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="naturepiece" id="CNI" value="CNI" autocomplete="on" required>
                <label class="form-check-label" for="CNI">CNI</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="naturepiece" id="Atestation" value="AT" autocomplete="on" required>
                <label class="form-check-label" for="Atestation">Atestation</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="naturepiece" id="Passport" value="Passport" autocomplete="on" required>
                <label class="form-check-label" for="Passport">Passport</label>
            </div>

            @error('naturepiece')
                <span class="text-danger"> Veuillez cocher la nature de la pièce </span>
            @enderror
        </div>
        <div class="col-12 col-lg-4">
            <label for="numeropiece" class="form-label">numéro de la pièce<span class="text-danger">*</span></label>
            <input type="text" name="numeropiece" class="form-control" id="numeropiece"
                placeholder="Nature de la pièce d'identité" autocomplete="on" required>

            @error('numeropiece')
                <span class="text-danger"> Veuillez remplir le numéro de la pièce </span>

            @enderror
        </div>
        <div class="col-12 col-lg-4">
            <label for="lieuresidence" class="form-label">Lieu de residence <span class="text-danger">*</span></label>
            <select class="form-select selection" name="lieuresidence" id="lieuresidence" autocomplete="on" required>
                <option value="" disabled selected>Sélectionner le lieu</option>

                @foreach($villes as $ville)
                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!---end row-->
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="profession" class="form-label">Profession</label>
            <select class="form-select selection" name="profession" id="profession" autocomplete="on">
                <option value="" disabled selected>Sélectionner la profession</option>

                @foreach($professions as $profession)
                    <option value="{{ $profession->MonLibelle }}">{{ $profession->MonLibelle }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-lg-6">
            <label for="employeur" class="form-label">Secteur d'activites</label>
            <select class="form-select selection" name="employeur" id="employeur" autocomplete="on">
                <option value="" disabled selected>Sélectionner le secteur d'activites</option>

                @foreach($secteurActivites as $secteurActivite)
                    <option value="{{ $secteurActivite->MonLibelle }}">{{ $secteurActivite->MonLibelle }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="row g-3 mb-3">
        <div class="col-12">
            <label for="email" class="form-label">Email </label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="on">

            @error('email')

                <span class="text-danger"> Veuillez remplir votre email </span>

            @enderror
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-4">
            <label class="form-label">Mobile <span class="text-danger">*</span></label><br>
            <div class="input-group mb-3">
                <input type="text" name="mobile" class="form-control" autocomplete="on" required maxlength="10">
            </div>

            @error('mobile')
                <span class="text-danger"> Veuillez remplir votre numéro de mobile </span>
            @enderror


        </div>
        <div class="col-12 col-lg-4">
            <label class="form-label">Mobile 2</label><br>
            <div class="input-group mb-3">
                <input type="text" id="mobile1" name="mobile1" class="form-control" autocomplete="on" maxlength="10">
            </div>
        </div>
        <div class="col-12 col-lg-4">

            <label class="form-label">Telephone</label><br>
            <div class="input-group mb-3">
                <input type="text" id="telephone" name="telephone" class="form-control" autocomplete="on" maxlength="10">
            </div>
        </div>
    </div>
    <!---end row-->
    <fieldset class="border p-3">
        <legend class="float-none w-auto px-2"><small>Personnes à contacter en cas de besoins</small></legend>

        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-8">
                <label for="contact_nom" class="form-label">Nom et Prénoms <span class="text-danger">*</span></label>
                <input type="text" name="personneressource" class="form-control" id="contact_nom" placeholder="Nom et Prénoms" required>
            </div>
            <div class="col-12 col-lg-4">
                <label class="form-label">Contact <span class="text-danger">*</span></label><br>
                <div class="input-group mb-3">
                    <input type="text" name="contactpersonneressource" class="form-control" aria-label="Text input with select" required maxlength="10">
                </div>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-8">
                <label for="contact_nom" class="form-label">Nom et Prénoms </label>
                <input type="text" name="personneressource2" class="form-control" id="contact_nom" placeholder="Nom et Prénoms" >
            </div>
            <div class="col-12 col-lg-4">
                <label class="form-label">Contact </label><br>
                <div class="input-group mb-3">
                    <input type="text" name="contactpersonneressource2" class="form-control" aria-label="Text input with select" maxlength="10">
                </div>
            </div>
        </div>
    </fieldset>


    <div class="d-flex justify-content-between">
        <div class="">
            <button onclick="event.preventDefault(); stepper1.previous()" class="btn border-btn btn-previous-form"><i
                class='bx bx-left-arrow-alt'></i>Precedent</button>
        </div>

        <div class="">
            <button onclick="event.preventDefault(); stepper1.next()" class="btn btn-two btn-next-form">Suivant<i class='bx bx-right-arrow-alt'></i></button>
        </div>
    </div>

    <script>
        // Ajout d'un événement onclick sur le bouton "Suivant"
        document.querySelector('.btn-next-form').addEventListener('click', function(event) {
        event.preventDefault();
        // Validez les champs obligatoires de l'étape actuelle
        if (validateStep1()) {
            // Si les champs sont valides, passez à l'étape suivante
            stepper1.next();
        }
        });

        // Fonction pour valider les champs de l'étape 1
        function validateStep1() {
            var civilite = document.querySelector('input[name="civilite"]:checked');
            var nom = document.querySelector('input[name="nom"]').value;
            var prenom = document.querySelector('input[name="prenom"]').value;
            if (!civilite) {
                document.querySelector('.error-message').innerHTML = 'Veuillez cocher la civilité';
                return false;
            }
            if(!nom){
                document.querySelector('.error-message').innerHTML = 'Veuillez saisir le nom';
                return false;
            }
        return true;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementById('Date_naissance');
            const ageMin = {{ $product->AgeMiniAdh ?? '0' }};
            const ageMax = {{ $product->AgeMaxiAdh ?? '0' }};
            const today = new Date();

            dateInput.addEventListener('input', function () {
                const dateValue = new Date(dateInput.value);
                const userAge = today.getFullYear() - dateValue.getFullYear();
                const monthDifference = today.getMonth() - dateValue.getMonth();

                // Ajuster l'âge si l'anniversaire n'est pas encore passé cette année
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dateValue.getDate())) {
                    userAge--;
                }

                // Supprimer les messages d'erreur précédents
                const errorElement = document.querySelector('.date-error');
                if (errorElement) {
                    errorElement.remove();
                }

                // Vérifier si l'âge est hors des limites
                if (!dateInput.value || userAge < ageMin || userAge > ageMax) {
                    // Ajouter un message d'erreur
                    const errorSpan = document.createElement('span');
                    errorSpan.classList.add('text-danger', 'date-error');
                    errorSpan.textContent = `Veuillez entrer une date de naissance valide. L'âge doit être compris entre ${ageMin} et ${ageMax} ans.`;
                    dateInput.parentNode.appendChild(errorSpan);
                    dateInput.classList.add('is-invalid');
                } else {
                    // Retirer les styles et messages d'erreur si la date est valide
                    dateInput.classList.remove('is-invalid');
                }
            });
        });
    </script>



</div>
