<div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
    <h5 class="mb-1">Informations de l'assuré(e)</h5>
    <p class="mb-4">Veuillez entrer les informations relatives à l'assuré(e) en tenant compte des champs obligatoire.</p>

    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <label for="" class="form-label">Le souscripteur est-il l'assuré ?</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estAssure" id="Oui" value="Oui" checked>
                <label class="form-check-label" for="Oui">Oui</label>
            </div>
        </div>


        {{-- @if (Auth::user()->codepartenaire == "CORIS")
        <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
            <button type="button" class="btn" data-bs-toggle="modal"
                data-bs-target="#createPropositionModal"><i class="fadeIn animated bx bx-plus"></i>Ajouter un(e) autre
                assuré(e)</button>
        </div>
        @endif --}}
        
        
    </div>

    <div style="overflow-x: auto;">
        <table class="table mb-0 table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Assuré(e)</th>
                    <th scope="col">Garanties</th>
                    {{-- <th scope="col">Garanties complémentaires</th> --}}
                    <th scope="col">Action</th>
                </tr>
            </thead>
            
            <tbody>
            </tbody>
    
            <tfoot>
                <tr id="conditional-tr">
                    <td id="display-nom-prenom"></td>
                    <td>
                        <ul>
                            @foreach ($productGarantie as $item)
                                <li>{{ $item->MonLibelle }}</li>
                            @endforeach
                        </ul>
                    </td>
                    {{-- <td>Pas de garantie</td> --}}
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    
    
    <div class="row g-3 mt-4">
        <div class="col-12 d-flex justify-content-between">
            <button onclick="event.preventDefault(); stepper1.previous()" class="btn border-btn px-4 btn-previous-form">
                <i class='bx bx-left-arrow-alt me-2'></i>Précédent
            </button>
            
            <button onclick="event.preventDefault(); stepper1.next()" class="btn btn-two px-4 btn-next-form">
                Suivant <i class='bx bx-right-arrow-alt ms-2'></i>
            </button>
        </div>
    </div>
    
    <!---end row-->

</div>

<script>
    // step assure js code 
    document.getElementById('FisrtName').addEventListener('input', updateDisplay);
    document.getElementById('LastName').addEventListener('input', updateDisplay);

    function updateDisplay() {
        const nom = document.getElementById('FisrtName').value;
        const prenom = document.getElementById('LastName').value;
        document.getElementById('display-nom-prenom').textContent = nom && prenom ? `${nom} ${prenom}` : ' ';
    }
    
    document.getElementById('Oui').addEventListener('change', toggleRowDisplay);
    document.getElementById('Non').addEventListener('change', toggleRowDisplay);

    function toggleRowDisplay() {
        const isAssureOui = document.getElementById('Oui').checked;
        const row = document.getElementById('conditional-tr');
        row.style.display = isAssureOui ? 'table-row' : 'none';
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM entièrement chargé");

        // Tableau pour stocker temporairement les assurés
        let assures = [];

        const boutonAjouter = document.getElementById('btn-ajouter');
        if (boutonAjouter) {
            console.log("Le bouton 'Ajouter' a été trouvé.");
            boutonAjouter.addEventListener('click', ajouterAssureTemporaire);
        } else {
            console.error("Le bouton 'Ajouter' n'a pas été trouvé.");
        }

        const form = document.getElementById("AssurAddModal");
        const modalElement = document.getElementById("createPropositionModal");

        const bootstrapModalAssur = new bootstrap.Modal(modalElement);



            function ajouterAssureTemporaire() {
                console.log("La fonction ajouterAssureTemporaire a été appelée.");
                
                const nomElement = document.getElementById('nomAssur');
                const prenomElement = document.getElementById('prenomAssur');
                const civiliteElement = document.querySelector('input[name="civiliteAssur"]:checked');
                const dateElement = document.getElementById('datenaissanceAssur');
                const lieuNaissanceElement = document.getElementById('lieunaissanceAssur');
                const naturepieceAssurElement = document.getElementById('naturepieceAssur');
                const lieuresidenceAssurElement = document.getElementById('lieuresidenceAssur');
                const lienParenteElement = document.getElementById('lienParente');
                const mobileAssurElement = document.getElementById('mobileAssur');
                const emailAssurElement = document.getElementById('emailAssur');
                
                const nom = nomElement ? nomElement.value : null;
                const prenom = prenomElement ? prenomElement.value : null;
                const civilite = civiliteElement ? civiliteElement.value : null;
                const datenaissance = dateElement ? dateElement.value : null;
                const lieuNaissance = lieuNaissanceElement ? lieuNaissanceElement.value : null;
                const naturepieceAssur = naturepieceAssurElement ? naturepieceAssurElement.value : null;
                const lieuresidenceAssur = lieuresidenceAssurElement ? lieuresidenceAssurElement.value : null;
                const lienParente = lienParenteElement ? lienParenteElement.value : null;
                const mobileAssur = mobileAssurElement ? mobileAssurElement.value : null;
                const emailAssur = emailAssurElement ? emailAssurElement.value : null;


                if (nom && prenom && civilite) {
                    assures.push({ nom, prenom, civilite,datenaissance, lieuNaissance, naturepieceAssur, lieuresidenceAssur, lienParente, mobileAssur, emailAssur });
                    console.log("Assuré ajouté :", assures);
                    sessionStorage.setItem("assures", JSON.stringify(assures)); 
                    afficherAssures();

                }

                form.reset();

                // Fermer le modal
                bootstrapModalAssur.hide();
            }

            function afficherAssures() {
                const tbody = document.querySelector('#test-l-2 tbody');
                const resumAssur = document.querySelector('#resumAssur');

                if (!tbody) {
                        console.error("Le tbody pour afficher les assurés n'a pas été trouvé.");
                    return;
                }

                tbody.innerHTML = '';

                assures.forEach((assure, index) => {
                    const row = `   
                    <tr>
                        <td>${assure.nom} ${assure.prenom}</td>
                        <td>
                            <ul>
                                @foreach ($productGarantie as $item)
                                    <li>{{ $item->MonLibelle }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>Pas de garantie</td>
                        <td><a href="#" onclick="supprimerAssure(${index})" class="text-danger"><i class="fadeIn animated bx bx-x fs-4"></i></a></td>
                    </tr>
                    `;
                    tbody.innerHTML += row;

                    const rowAssur = `   
                    <tr>
                        <td>${assure.nom}</td>
                        <td>${assure.prenom}</td>
                        <td>${assure.datenaissance}</td>
                        <td>${assure.lieuNaissance}</td>
                        <td>${assure.lieuresidenceAssur}</td>
                        <td>${assure.filiation}</td>
                        <td>
                            <ul>
                                @foreach ($productGarantie as $item)
                                    <li>{{ $item->MonLibelle }}</li>
                                @endforeach
                            </ul>
                        </td>
                         <td>${assure.mobileAssur}</td>
                         <td>${assure.emailAssur}</td>
                         <td>${assure.naturepieceAssur}</td>
                    </tr>
                    `;

                    resumAssur.innerHTML += rowAssur;


                });

                assures.forEach((assure, index) => {
                    const displayNom = document.getElementById('display-nom-assure');
                    const displayPrenom = document.getElementById('display-prenom-assure');
                    const displayDateNaissance = document.getElementById('display-date-naissance-assure');
                    const displayLieuNaissance = document.getElementById('display-lieu-naissance-assure');
                    const displayLieuResidence = document.getElementById('display-lieu-residence-assure');
                    const displayTelephone = document.getElementById('display-telephone-assure');
                    const displayEmail = document.getElementById('display-email-assure');
                    const displayNumeropiece = document.getElementById('display-numeropiece-assure');

                    displayNom.textContent = assure.nom;
                    displayPrenom.textContent = assure.prenom;
                    displayDateNaissance.textContent = assure.datenaissance;
                    displayLieuNaissance.textContent = assure.lieuNaissance || '-';
                    displayLieuResidence.textContent = assure.lieuresidenceAssur;
                    displayTelephone.textContent = assure.mobileAssur || '-';
                    displayEmail.textContent = assure.emailAssur;
                    displayNumeropiece.textContent = assure.naturepieceAssur || '-';

                });

            }


            function supprimerAssure(index) {
                assures.splice(index, 1);
                afficherAssures();
            }
            

            window.ajouterAssureTemporaire = ajouterAssureTemporaire;
            window.supprimerAssure = supprimerAssure;

            // Affichez initialement les assurés
            afficherAssures();

    });
</script>
