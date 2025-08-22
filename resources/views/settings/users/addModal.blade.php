<div class="modal fade" id="addUsers" tabindex="-1" aria-labelledby="membreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <style>
            .steps-banner {
                position: relative;
                border-bottom: 1px solid #ddd;
                margin-bottom: 20px;
            }

            .step-indicators {
                display: flex;
                justify-content: space-between;
            }

            .step-indicator {
                text-align: center;
                flex-grow: 1;
                font-size: 0.9rem;
                padding: 10px;
                background: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin: 0 5px;
                color: #555;
                transition: background 0.3s, color 0.3s;
            }

            .step-indicator.active {
                background: #007bff;
                color: #fff;
                font-weight: bold;
            }

        </style>
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="membreModalLabel">Ajouter un nouveau Membre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('setting.user.store') }}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body">

                    <div class="steps-banner mb-4">
                        <ul class="step-indicators d-flex justify-content-between list-unstyled p-0">
                            <li id="step-indicator-1" class="step-indicator active">1. Réseau</li>
                            <li id="step-indicator-2" class="step-indicator">2. Informations</li>
                            <li id="step-indicator-3" class="step-indicator">3. Comptes</li>
                            <li id="step-indicator-4" class="step-indicator">4. Contacts</li>
                        </ul>
                    </div>

                    <div id="step-1" class="step">
                        <fieldset class="border p-3 w-100 row">

                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 1 : Reseau</h5></small></legend>
                        
                            <div class="mb-3 form-group col-12">
                                <label for="codeagent" class="form-label">Code Agent <span class="text-danger">*</span></label>
                                <input type="text" name="codeagent" id="codeagent" class="form-control" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="codereseau" class="form-label">Réseau de commercialisation</label>
                                <select name="codereseau" id="codereseau" class="form-select">
                                    <option value="" disabled>-- Choisir une option --</option>
                                    @foreach ($reseaux as $item)
                                        <option class="form-control" value="{{ $item->id }}">{{ $item->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="codezone" class="form-label">Zone/Departement</label>
                                <select name="codezone" id="codezone" class="form-select" id="">
                                    <option value="" disabled>-- Choisir une zone --</option>
                                    @foreach ($zones as $zone)
                                        <option class="form-control" value="{{ $zone->id }}">{{ $zone->libellezone }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="codeequipe" class="form-label">Equipe/Agence</label>
                                <select name="codeequipe" id="codeequipe" class="form-select" id="">
                                    <option value="">-- Choisir une equipe --</option>
                                    @foreach ($equipes as $equipe)
                                        <option class="form-control" value="{{ $equipe->id }}">{{ $equipe->libelleequipe }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                          
                            
                            <div class="mb-3 col-6">
                                <label for="codePart" class="form-label">Partenaire</label>
                                {{-- <select class="form-select" name="codePart" id="codePart">
                                    <option value="">-- Choisir une partenaire --</option>
                                    @foreach ($partners as $item)
                                        <option class="form-control" value="{{ $item->code }}">{{ $item->designation }}</option>
                                    @endforeach
                                </select> --}}
                                <input type="text" name="codePart" id="codePart" class="form-control muted" value="CORIS" readonly muted>
                               
                            </div>

                        </fieldset>
                    </div>

                    <div id="step-2" class="step d-none">
                        <fieldset class="border p-3 row">

                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 2 : Informations personnelles</h5></small></legend>
                            
                            <div class="mb-3 col-12">
                                <label class="form-label d-block">Sexe</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="sexeF" name="sexe" value="F" class="form-check-input">
                                    <label class="form-check-label" for="sexeF">Féminin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="sexeM" name="sexe" value="M" class="form-check-input">
                                    <label class="form-check-label" for="sexeM">Masculin</label>
                                </div>
                            </div>
                            
                            <div class="row col-12">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" name="nom" id="nom" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom" class="form-label">Prenoms</label>
                                        <input type="text" name="prenom" id="prenom" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="datenaissance" class="form-label">Date de naissance</label>
                                        <input type="date" name="datenaissance" id="datenaissance" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="profession" class="form-label">Profession</label>
                                        <input type="text" name="profession" id="profession" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div id="step-3" class="step d-none">
                        <fieldset class="border p-3 row">

                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 3 : Comptes</h5></small></legend>
                            <div class="mb-3 col-12">
                                <label for="login" class="form-label">Nom d'utilisateur (Login) <span class="text-danger">*</span></label>
                                <input type="text" name="login" id="login" class="form-control" required>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="mb-3 form-group">
                                    <label for="role" class="form-label">Profile <span class="text-danger">*</span></label>
                                    <select name="role" id="" class="form-control" required>
                                        <option value="">-- Choisir une option --</option>
                                        <option class="form-option"  value="ADMINISTRATEUR">ADMINISTRATEUR</option>
                                        <option class="form-option"  value="SUPERVISEUR">SUPERVISEUR</option>
                                        <option class="form-option"  value="RESPONSABLE">RESPONSABLE</option>
                                        <option class="form-option"  value="MANAGER">MANAGER</option>
                                        <option class="form-option"  value="CONSEILLER">CONSEILLER</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row col-12">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pass" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                        <input type="password" name="pass" id="pass" class="form-control" value="123456" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cpass" class="form-label">Confirmation Mot de passe</label>
                                        <input type="password" name="cpass" id="cpass" class="form-control" value="123456" readonly>
                                    </div>
                                </div>
                            </div>
                            

                        </fieldset>
                    </div>
                    <div id="step-4" class="step d-none">
                        <fieldset class="border p-3 row">

                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 4 : Contacts</h5></small></legend>
                            <div class="mb-3 col-12">
                                <label for="login" class="form-label">Email  <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="row col-12">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cel" class="form-label">Mobile 1</label>
                                        <input type="text" name="cel" id="cel" class="form-control" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tel" class="form-label">Mobile 2</label>
                                        <input type="tel" name="tel" id="tel" class="form-control" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            

                        </fieldset>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary prev-stepUser d-none">Précédent</button>
                    <button type="button" class="btn btn-primary next-stepUser">Suivant</button>
                    <button type="submit" class="btn btn-success d-none finish-stepUser">Terminer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentStep = 1;

    const showStep = (step) => {
        // Show the correct step
        document.querySelectorAll('.step').forEach(el => el.classList.add('d-none'));
        document.querySelector(`#step-${step}`).classList.remove('d-none');
        
        // Update buttons
        document.querySelector('.prev-stepUser').classList.toggle('d-none', step === 1);
        document.querySelector('.next-stepUser').classList.toggle('d-none', step === 4);
        document.querySelector('.finish-stepUser').classList.toggle('d-none', step !== 4);

        // Update the step indicator
        document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
            indicator.classList.toggle('active', index + 1 === step);
        });
    };

    document.querySelector('.next-stepUser').addEventListener('click', () => {
        // alert("test")
        if (currentStep < 4) {
            currentStep++;
            showStep(currentStep);
        }
    });

    document.querySelector('.prev-stepUser').addEventListener('click', () => {
        // alert("test")
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Initialize with the first step
    showStep(currentStep);
</script>







