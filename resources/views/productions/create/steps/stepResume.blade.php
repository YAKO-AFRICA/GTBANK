<div id="test-l-5" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger6">
    <h5 class="mb-1">Résumé des informations</h5>
    <p class="mb-4">Veuillez relire vos informations pour verifier si elles sont correctes</p>

    <div class="row g-3">
        <div class="col-12">
            <div class="card" style="width: 100%">
                <div class="card-header">
                    <h4>Adhérent</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6  col-xs-12 border-r">
                            <dl class="row">
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Civilité:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayCivility">-- </dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Nom:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayNom">--</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Prénoms:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayPrenom">--</dd>

                                {{-- <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >Sexe:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displaySexe">Null</dd> --}}

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Date de naissance:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayBirthday">--</dd>
                                

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Lieu de naissance:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayLieuNaissance">--</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Lieu de résidence:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayResidence">--</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">N° pièce</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayNumPiece">--</dd>
                            </dl>
                        </div>
                        <div class="col-6 col-xs-12">
                            <dl class="row">
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Profession:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayProfession">--</dd>
                        
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Secteur d'activité:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayEmployeur">--</dd>
                        
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Email:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayEmail">--</dd>
                        
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Téléphone:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayTelephone">--</dd>
                        
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Mobile:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayMobile">--</dd>
                        
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Mobile 2:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayMobile1">--</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card" style="width: 100%">
                <div class="card-header">
                    <h4>Conditions de paiement de la prime & périodicité</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6  col-xs-12 border-r">
                            <dl class="row">
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Produit:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6">{{ $product->MonLibelle ?? "null"}}</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Date Effet:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayDateEffet">-</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Prime principale:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayPrimePrincipale">2500</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Frais d'adhésion:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayFraisAdhesion">--</dd>

                                {{-- <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Echéance paiement:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Lorem, ipsum dolor.</dd> --}}
                                
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Capital désiré:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayCapital"></dd>
                            </dl>
                        </div>
                        <div class="col-6  col-xs-12">
                            <dl class="row">
                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Mode paiement:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayModePaiement">-</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Duree:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayDureePay">-</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Organisme payeur:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayOrganisme">CORIS</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">Agence:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayAgence">-</dd>

                                <dt class="col-xs-12 col-sm-6 col-md-6 col-lg-6">N° Compte:</dt>
                                <dd class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="displayNumeroCompte">-</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card" style="width: 100%">
                <div class="card-header">
                    <h4>Assuré(e)s</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 overflow-auto overflow-scroll">
                            <table class="table mb-0 table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prénoms</th>
                                        <th scope="col">Né(e) le</th>
                                        <th scope="col">Lieu de naissance</th>
                                        <th scope="col">Lieu de résidence</th>
                                        <th scope="col">Filiation</th>
                                        <th scope="col">Garanties</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">N° pièce</th>
                                    </tr>
                                </thead>
                                <tbody id="resumAssur">
                                    
                                </tbody>
                                <tfoot>
                                    <tr id="resume-row">
                                        <td id="display-nom">-</td>
                                        <td id="display-prenom">-</td>
                                        <td id="display-date-naissance">-</td>
                                        <td id="display-lieu-naissance">-</td>
                                        <td id="display-lieu-residence">-</td>
                                        <td id="display-filiation">Moi-même</td>
                                        <td id="display-garanties">
                                            <ul>
                                                @foreach ($productGarantie as $item)
                                                    <li>{{ $item->MonLibelle }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td id="display-telephone">-</td>
                                        <td id="display-email">-</td>
                                        <td id="display-numeropiece">-</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card" style="width: 100%">
                <div class="card-header">
                    <h4>Bénéficiaire(s)</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="card col-lg-6 col-md-6 col-sm-12">
                            <div class="card-header">
                                <p>Au terme du contrat</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r" id="display-beneficiaire-terme">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card col-lg-6 col-md-6 col-sm-12">
                            <div class="card-header">
                                <p>En cas de décès avant le terme</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-7 col-md-6 col-sm-6 border-r" id="display-beneficiaire-deces">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="col-12 d-flex justify-content-between">
                <button class="btn border-btn px-4 btn-previous-form" onclick="event.preventDefault(); stepper1.previous()">
                    <i class='bx bx-left-arrow-alt me-2'></i>Retour
                </button>
                <button id="btn-next" class="btn btn-two px-4 btn-next-for btn-auto-generate" type="button" onclick="stepper1.next()">
                    Enregistrer<i class='bx bx-right-arrow-alt ms-2'></i>
                </button>
            </div>
        </div>
    </div>
    <!---end row-->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const isAssureOui = document.querySelector('input[name="estAssure"]:checked'); 
            const fields = {
                nom: document.getElementById('FisrtName'),
                prenom: document.getElementById('LastName'),
                dateNaissance: document.getElementById('Date_naissance'),
                lieuNaissance: document.getElementById('lieunaissance'),
                lieuResidence: document.getElementById('lieuresidence'),
                telephone: document.querySelector('[name="mobile"]'),
                email: document.getElementById('email'),
                numeroPiece: document.getElementById('numeropiece')
            };
    
            const displayFields = {
                nom: document.getElementById('display-nom'),
                prenom: document.getElementById('display-prenom'),
                dateNaissance: document.getElementById('display-date-naissance'),
                lieuNaissance: document.getElementById('display-lieu-naissance'),
                lieuResidence: document.getElementById('display-lieu-residence'),
                telephone: document.getElementById('display-telephone'),
                email: document.getElementById('display-email'),
                numeroPiece: document.getElementById('display-numeropiece')
            };
    
            // Function to update the table
            function updateTable() {
                if (isAssureOui.checked) {
                    displayFields.nom.textContent = fields.nom.value;
                    displayFields.prenom.textContent = fields.prenom.value;
                    displayFields.dateNaissance.textContent = fields.dateNaissance.value;
                    displayFields.lieuNaissance.textContent = fields.lieuNaissance.value;
                    displayFields.lieuResidence.textContent = fields.lieuResidence.value;
                    displayFields.telephone.textContent = fields.telephone.value;
                    displayFields.email.textContent = fields.email.value;
                    displayFields.numeroPiece.textContent = fields.numeroPiece.value;
                }
            }
    
            // Listen for changes on input fields
            Object.values(fields).forEach(field => {
                field.addEventListener("input", updateTable);
            });
    
            // Listen for changes on "Oui" radio button
            isAssureOui.addEventListener("change", updateTable);
        });
    </script>


    
</div>


<!-- JavaScript pour contrôler l'affichage du tableau en fonction de la sélection -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const isAssureOui = document.getElementById('Oui');
        const isAssureNon = document.getElementById('Non');
        const resumeRow = document.getElementById('resume-row');

        // Function to toggle the display of the resume row
        function toggleResumeRow() {
            if (isAssureOui.checked) {
                resumeRow.style.display = "table-row";
            } else {
                resumeRow.style.display = "none";
            }
        }

        // Event listeners to detect changes in radio button selection
        isAssureOui.addEventListener("change", toggleResumeRow);
        isAssureNon.addEventListener("change", toggleResumeRow);

        // Initialize the row state based on initial selection
        toggleResumeRow();

        const termeContrat = document.querySelector('input[name="addBeneficiary"]:checked');
        const resumeTermeContrat = document.getElementById('display-beneficiaire-terme');

        if (termeContrat) {
            const valeurterme = termeContrat.value;
            console.log(valeurterme);
            
            resumeTermeContrat.textContent = valeurterme;
        }

        const audecesContrat = document.querySelector('input[name="audecesContrat"]:checked');
        const resumeAudecesContrat = document.getElementById('display-beneficiaire-deces');

        if (audecesContrat) {
            const valeur = audecesContrat.value;

            resumeAudecesContrat.textContent = valeur;
        }

        
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Sélection des éléments
    const displayBenefTerme = document.getElementById('display-beneficiaire-terme');
    const displayBenefDeces = document.getElementById('display-beneficiaire-deces');

    // Liste des options de sélection
    const options = [
        { checkboxId: 'addBeneficiary', label: 'Adhérent', target: displayBenefTerme },
        { checkboxId: 'conjoint1', label: 'Le conjoint non divorcé, ni séparé de corps', target: displayBenefTerme },
        { checkboxId: 'enfants', label: 'Les enfants nés et à naître', target: displayBenefTerme },
        { checkboxId: 'Autres1', label: 'Autres, Préciser', target: displayBenefTerme },
        { checkboxId: 'conjoint2', label: 'Le conjoint non divorcé, ni séparé de corps', target: displayBenefDeces },
        { checkboxId: 'enfants2', label: 'Les enfants nés et à naître', target: displayBenefDeces },
        { checkboxId: 'Autres2', label: 'Autres, Préciser (ajouter des bénéficiaires)', target: displayBenefDeces }
    ];

    // Fonction de mise à jour des affichages
    function updateDisplay() {
        // Réinitialiser les affichages
        displayBenefTerme.innerHTML = '';
        displayBenefDeces.innerHTML = '';

        options.forEach(option => {
            const checkbox = document.getElementById(option.checkboxId);
            if (checkbox && checkbox.checked) {
                // Ajouter l'élément sélectionné dans la section appropriée
                const p = document.createElement('p');
                p.textContent = option.label;
                option.target.appendChild(p);
            }
        });
    }

    // Ajouter un event listener pour chaque checkbox
    options.forEach(option => {
        const checkbox = document.getElementById(option.checkboxId);
        if (checkbox) {
            checkbox.addEventListener('change', updateDisplay);
        }
    });

    // Initialiser l'affichage
    updateDisplay();
});
</script>


