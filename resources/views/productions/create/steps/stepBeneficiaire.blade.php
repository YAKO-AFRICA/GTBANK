<div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
    <h5 class="mb-1">Informations du ou des bénéficiaire(s)</h5>
    <p class="mb-4">Veuillez entrer les informations relatives au(x) bénéficiaire(s) en tenant compte des champs
        obligatoire.</p>

    <div class="row g-3">

        <div class="col-12 col-lg-6">
            <label for="" class="form-label">En cas d'invalidité Absolue et Définitif</label>
            <div class="card" style="width: 80%">
                <div class="card-body">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="addBeneficiary" value="adherent" name="addBeneficiary">

                        <label class="form-check-label" for="addBeneficiary" >Adherent</label>

                    </div>
                    {{-- <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Conjoint" id="conjoint1">
                        <label class="form-check-label" for="conjoint1">
                            Le conjoint non divorcé, ni séparé de corps
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Enfants nés et à naissance" id="enfants">
                        <label class="form-check-label" for="enfants1">
                            Les enfants nés et à naître
                        </label>
                    </div>
                    <div class="form-check" data-bs-toggle="modal" data-bs-target="#addBenefModal">
                        <input class="form-check-input" type="checkbox" value="" id="Autres1" data-situation="terme-contrat">
                        <label class="form-check-label" for="Autres1">
                            Autres, Préciser
                        </label>
                    </div> --}}
                </div>
            </div>
        </div>


        <div class="col-12 col-lg-6">
            <label for="" class="form-label">En cas de décès avant le terme</label>
            <div class="card" style="width: 80%">
                <div class="card-body">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="conjoint" id="conjoint2" name="audecesContrat">
                        <label class="form-check-label" for="conjoint2">
                            Le conjoint non divorcé, ni séparé de corps
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="enfant" id="enfants2" name="audecesContrat">
                        <label class="form-check-label" for="enfants2">
                            Les enfants nés et à naître
                        </label>
                    </div>
                    <div class="form-check" data-bs-toggle="modal" data-bs-target="#addBenefModal">
                        <input class="form-check-input" type="checkbox" value="autre" id="Autres2" name="audecesContrat">
                        <label class="form-check-label" for="Autres2"> 
                            Autres, Préciser (ajouter des bénéficiaires)
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="card">
            <div class="card-body overflow-auto overflow-scroll">
                <table class="table mb-0 table-striped" id="beneficiariesTable">
                    <thead>
                        <tr>
                            <th scope="col">Nom & Prénoms</th>
                            <th scope="col">Né(e) le</th>
                            <th scope="col">Lieu de naissance</th>
                            <th scope="col">Lieu de residence</th>
                            <th scope="col">Filiation</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Email</th>
                            {{-- <th scope="col">Taux (%)</th> --}}
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Beneficiary rows will be appended here -->
                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
    <div class="row g-3">
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
    </div>

    



    <script>
        let beneficiaries = [];
         // beneficiaire 
         const beneficiaryRowId = "beneficiary-row";

         

        document.addEventListener('DOMContentLoaded', function () {
            const addBeneficiary = document.getElementById('addBeneficiary');

            // Event sur changement du checkbox
            addBeneficiary.addEventListener('change', function () {
                if (this.checked) {
                    addBeneficiaryRow();
                } else {
                    removeBeneficiaryRow();
                }
            });
        });



        

        function addBeneficiaryRow() {
            // Vérifiez si la ligne existe déjà pour éviter les doublons
            if (document.getElementById(beneficiaryRowId)) return;

            // Obtenez les valeurs d'entrée de l'adhérent
            const nom = document.getElementById('FisrtName') ? document.getElementById('FisrtName').value : 'Nom';
            const prenom = document.getElementById('LastName') ? document.getElementById('LastName').value : 'Prénom';
            const dateNaissance = document.getElementById('Date_naissance') ? document.getElementById('Date_naissance').value : 'Date';
            const lieuNaissance = document.getElementById('lieunaissanc-{{ $product->CodeProduit }}') ? document.getElementById('lieunaissanc-{{ $product->CodeProduit }}').value : 'Lieu';
            const lieuResidence = document.getElementById('lieuresidence') ? document.getElementById('lieuresidence').value : 'Résidence';
            const telephone = document.querySelector('input[name="mobile"]') ? document.querySelector('input[name="mobile"]').value : 'Téléphone';
            const email = document.getElementById('email') ? document.getElementById('email').value : 'Email';
            
            // Créez une nouvelle ligne et remplissez-la avec les données
            const table = document.getElementById('beneficiariesTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.id = beneficiaryRowId; // Définir un ID unique à la ligne
            
            newRow.innerHTML = `
                <td>${nom} ${prenom}</td>
                <td>${dateNaissance}</td>
                <td>${lieuNaissance}</td>
                <td>${lieuResidence}</td>
                <td>Adhérent</td>
                <td>${telephone}</td>
                <td>${email}</td>
                <td><a href="#" class="text-danger" onclick="removeBeneficiaryRow()"><i class="fadeIn animated bx bx-x fs-4"></i></a></td>
            `;
        }

        function removeBeneficiaryRow() {
            const row = document.getElementById(beneficiaryRowId);
            if (row) {
                row.remove();
            }
        }


        // Temporary storage for beneficiaries
        

        // Function to add a beneficiary from the modal form
        function addBeneficiary() {
            // Get form values
            const beneficiary = {
                nom: document.getElementById('nomBenef').value,
                prenom: document.getElementById('prenomBenef').value,
                dateNaissance: document.getElementById('datenaissanceBenef').value,
                lieuNaissance: document.getElementById('lieunaissanceBenef').value,
                lieuResidence: document.getElementById('lieuresidenceBenef').value,
                lienParente: document.getElementById('lienParenteBenef').value,
                telephone: document.getElementById('mobileBenef').value,
                email: document.getElementById('emailBenef').value,
            };

            // Check if beneficiary already exists
            if (beneficiaries.some(b => b.nom === beneficiary.nom && b.prenom === beneficiary.prenom)) {
                swal.fire("Attention", "Le bénéficiaire existe d\'ja", "warning");
                return;
            }

            console.log(beneficiary);

            // Add to beneficiaries array
            beneficiaries.push(beneficiary);

            document.getElementById('beneficiariesInput').value = JSON.stringify(beneficiaries);

            // Add row to the table
            const table = document.getElementById('beneficiariesTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <td>${beneficiary.nom} ${beneficiary.prenom}</td>
                <td>${beneficiary.dateNaissance}</td>
                <td>${beneficiary.lieuNaissance}</td>
                <td>${beneficiary.lieuResidence}</td>
                <td>${beneficiary.lienParente}</td>
                <td>${beneficiary.telephone}</td>
                <td>${beneficiary.email}</td>
                <td><a href="#" class="text-danger" onclick="removeBeneficiary(${beneficiaries.length - 1})"><i class="fadeIn animated bx bx-x fs-4"></i></a></td>
            `;

            // Réinitialiser le formulaire modal
            document.getElementById('beneficiaryForm').reset();

            // Close modal
            const modal = document.getElementById('addBenefModal');
            const bootstrapModal = bootstrap.Modal.getInstance(modal);
            document.getElementById('beneficiaryForm').reset();
            bootstrapModal.hide();
        }

        // Function to remove a beneficiary from both the array and the table
        function removeBeneficiary(index) {
            beneficiaries.splice(index, 1);
            document.getElementById('beneficiariesInput').value = JSON.stringify(beneficiaries);
            document.getElementById('beneficiariesTable').getElementsByTagName('tbody')[0].deleteRow(index);
        }
    </script>

</div>
