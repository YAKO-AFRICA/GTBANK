<div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
    <h5 class="mb-1">Informations relatives aux modes de paiement et la periodicité</h5>
    <p class="mb-4">Veuillez entrer les informations relatives aux modes de paiement et la periodicité en tenant compte
        des champs obligatoire.</p>

        <style>
            .form-group {
                display: flex;
                align-items: start;
                gap: 5px;
            }
            .input-container {
                display: flex;
                justify-content: start;
                align-items: center;
                gap: 5px;
                /* padding: 10px; */
                background: #f8f9fa;
                border-radius: 10px;
                /* box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); */
            }
           /*  .input-box {
                width: 35px;
                height: 45px;
                text-align: center;
                font-size: 18px;
                border: 2px solid #ced4da;
                border-radius: 5px;
                transition: all 0.2s ease-in-out;
            } */
            .input-box:focus {
                border-color: #14b406;
                box-shadow: 0px 0px 5px #14b406;
            }
        </style>

    <div class="row g-3">
        <div class="col-12 col-lg-8">
            <div class="card mx-0">
                <div class="card-body">
                    <label for="" class="form-label">Je souhaite payer mes primes par :</label>
                    <div class="mb-3">
                        {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="Virement_bancaire" id="Virement_bancaire">
                            <label class="form-check-label" for="Virement_bancaire">
                                Virement bancaire
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="Espece" id="Espece">
                            <label class="form-check-label" for="Espece">
                                Espèce
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="Cheque" id="Cheque">
                            <label class="form-check-label" for="Cheque">
                                Chèque
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="Mobile_money" id="Mobile_money">
                            <label class="form-check-label" for="Mobile_money">
                                Mobile money
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="SOURCE" id="Prelevement_source" checked/>
                            <label class="form-check-label" for="Prelevement_source">
                                Prélèvement à la source
                            </label>
                        </div> --}}

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="modepaiement" type="radio" value="SOURCE" id="Prelevement_bancaire" checked/>
                            <label class="form-check-label" for="Prelevement_bancaire">
                                Prélèvement Bancaire
                            </label>
                        </div>

                    </div>

                    <div class="row mb-3" id="mode_bancaire" style="display: none;">
                        <div class="col-12 mb-3">
                            <label for="banque" class="form-label">Ma banque ou organisme de prélèvement</label>
                            <input type="text" class="form-control" id="banque" name="organisme" value="GT BANK" readonly>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="Agence" class="form-label">Agence</label>
                                <select class="form-select" id="Agence" name="agence" >
                                    <option value="" selected>Selectionnez l'agence</option>
                                    @foreach ($agences as $item)
                                        <option value="{{ $item->libelle }}" data-codebanque="{{ $item->codeBanque }}">{{ $item->libelle ?? ""}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="Agence" class="form-label">Code Banque</label>
                                <input type="text" class="form-control muted" id="codebanque" name="codebanque" value="" readonly >
                            </div>
                        </div>
                        
                        <div class="form-group row mx-0 px-0">
                            {{-- <div class="col-sm-12 col-md-8 px-0 mx-0">
                                <div class="mb-4 px-0 mx-0">
                                    <label for="Matricule" class="form-label">Mon N° de compte (Matricule)</label>
                                    <div id="matricule-container" class="input-container">
                                        <!-- Zones de saisie générées par JavaScript -->
                                    </div>
                                    <input type="hidden" id="Matricule" name="numerocompte">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="mb-4">
                                    <label for="rib" class="form-label">Clé RIB</label>
                                    <div id="rib-container" class="input-container">
                                        <!-- Zones de saisie générées par JavaScript -->
                                    </div>
                                    <input type="hidden" id="rib" name="rib">
                                </div>
                            </div> --}}

                            <div class="col-3">
                                <label for="codeguichet" class="form-label">Code Guichet</label>
                                <input type="text" class="form-control" id="codeguichet" name="codeguichet" minlength="5" maxlength="5">
                            </div>
                            <div class="col-6 ">
                                <label for="Matricule" class="form-label">N° de compte</label>
                                <input type="text" class="form-control" id="Matricule" name="numerocompte" minlength="12" maxlength="12">
                            </div>
                            <div class="col-2 ">
                                <label for="rib" class="form-label">Clé Rib</label>
                                <input type="text" class="form-control" id="rib" name="rib" minlength="2" maxlength="2">
                            </div>
                        </div>
                        
                    </div>
                    

                    <div class="mb-3" id="mode_mobile" style="display: none;">
                        <div class="col-12 mb-3">
                            <label for="numMobile" class="form-label">Mon N° Mobile</label>
                            <input type="text" class="form-control" id="numMobile" name="numMobile">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-8">
                            <label for="Conseiller" class="form-label">Votre conseiller client</label>
                            <input type="text" class="form-control" id="Conseiller" name="Conseiller" disabled value="{{ Auth::user()->membre->nom ?? ""}} {{ Auth::user()->membre->prenom ?? ""}}">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="CodeConseiller" class="form-label">Code</label>
                            <input type="text" class="form-control" id="CodeConseiller" name="codeConseiller" disabled value="{{ Auth::user()->membre->codeagent ?? ""}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">

            <div class="card mx-0">
                <div class="card-body">
                    <label for="" class="form-label">Je souhaite payer mes primes chaque :</label>
                    <div class="mb-3">
                        {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="M"
                                id="Mois">
                            <label class="form-check-label" for="Mois">
                                Mois
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="T"
                                id="Trimestre">
                            <label class="form-check-label" for="Trimestre">
                                Trimestre
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="S"
                                id="Semestre">
                            <label class="form-check-label" for="Semestre">
                                Semestre
                            </label>
                        </div> --}}
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="A"
                                id="Annee" checked>
                            <label class="form-check-label" for="Annee">
                                Année
                            </label>
                        </div>
                        {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input" name="periodicite" type="radio" value="U"
                                id="Versement_unique">
                            <label class="form-check-label" for="Versement_unique">
                                Versement unique
                            </label>
                        </div> --}}
                    </div>
                    @if ($product->CodeProduit == 'SUPMIXTE')
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le :</label>
                                <input type="date" class="form-control" id="DateEffet" name="dateEffet">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de cotisation :</label>
                                <input type="number" class="form-control bg-gray" id="duree" name="duree">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de :</label>
                                <input type="number" class="form-control" id="primepricipale" name="primepricipale" value="0" readonly>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="capital" class="form-label">Capital souscrit :</label>
                                <input type="number" class="form-control" id="capital" name="capital" value="1000000" readonly>
                            </div>

                            
                            <div class="col-12 mb-3 muted" disabled>
                                <label for="fraisadhesion" class="form-label muted">Fraie d'adhesion :</label>
                                <input type="number" class="form-control" id="fraisadhesion" name="fraisadhesion" value="0" readonly disabled>
                            </div>

                        </div>
                    @else
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le :</label>
                                <input type="date" class="form-control" id="DateEffet" name="dateEffet">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de :</label>
                                <input type="number" class="form-control" id="primepricipale" name="primepricipale" value="5000" required readonly>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="capital" class="form-label">Capital souscrit :</label>
                                <input type="number" class="form-control" id="capital" name="capital" value="1000000" required readonly>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="duree" class="form-label">Durée de cotisation :</label>
                                <input type="number" class="form-control bg-gray" id="duree" name="duree" value="1" readonly>
                            </div>
                            <div class="col-12 mb-3 muted" disabled>
                                <label for="fraisadhesion" class="form-label muted">Frais d'adhesion :</label>
                                <input type="number" class="form-control" id="fraisadhesion" name="fraisadhesion" value="0" readonly disabled>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
        

        <div class="col-12">
            <div class="col-12 d-flex justify-content-between">
                <button onclick="event.preventDefault(); stepper1.previous()"
                    class="btn border-btn px-4 btn-previous-form"><i
                        class='bx bx-left-arrow-alt me-2'></i>Retour</button>
                <button onclick="event.preventDefault(); stepper1.next()"
                    class="btn btn-two px-4 btn-next-form">Suivant<i
                        class='bx bx-right-arrow-alt ms-2'></i></button>
            </div>
        </div>
    </div><!---end row-->

    {{-- <script>
        document.getElementById("primepricipale").addEventListener("input", function() {
            const primeInput = document.getElementById("primepricipale");
            const primeError = document.getElementById("primepricipale-error");
    
            // Vérifiez si la valeur est inférieure au minimum autorisé
            if (parseInt(primeInput.value) < parseInt(primeInput.min)) {
                primeError.style.display = "block";
            } else {
                primeError.style.display = "none";
            }
        });
    </script> --}}

    <script>
        const CodeProduit = "{{ $product->CodeProduit }}";
        const dureeInput = document.getElementById("duree");
        const primeInput = document.getElementById("primepricipale");

        dureeInput.addEventListener("change", function() {
            console.log("Valeur de la durée changée :", CodeProduit);
            
            primeInput.value = dureeInput.value * 6000;
            
        })
    </script>



<script>
    //: scrip pour la creation du numero de compte
    document.addEventListener("DOMContentLoaded", function () {
        function createInputFields(containerId, hiddenInputId, length) {
            const container = document.getElementById(containerId);
            const hiddenInput = document.getElementById(hiddenInputId);

            for (let i = 0; i < length; i++) {
                let input = document.createElement("input");
                input.type = "text";
                input.maxLength = 1;
                input.style.fontSize = "8px"; 
                input.className = "form-control text-center px-0 mx-0";
                input.style.width = "20px";
                input.style.margin = "0px";
                input.style.padding = "0px";
                input.style.height = "25px";
                input.dataset.index = i; 

                 
                
                
                
                input.addEventListener("input", function (e) {
                    let val = e.target.value;
                    if (val.length === 1 && e.target.dataset.index < length - 1) {
                        container.children[parseInt(e.target.dataset.index) + 1].focus();
                    }
                    updateHiddenInput();
                });

                input.addEventListener("keydown", function (e) {
                    if (e.key === "Backspace" && e.target.dataset.index > 0 && e.target.value === "") {
                        container.children[parseInt(e.target.dataset.index) - 1].focus();
                    }
                });

                container.appendChild(input);
            }

            function updateHiddenInput() {
                hiddenInput.value = Array.from(container.children).map(input => input.value).join("");
            }
        }

        createInputFields("matricule-container", "Matricule", 12);
        createInputFields("rib-container", "rib", 2);
    });
</script>



</div>
