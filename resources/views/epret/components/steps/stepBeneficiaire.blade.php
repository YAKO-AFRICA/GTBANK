<div class="card">
    @if ($simulationData && $simulationData['primeObseque'] != 0)
    <div class="card">
        <div class="card-header row">
            <div class="col-6">Garantie Obseque</div>
            <div class="col-6">
                <button class="btn btn-outline-info" id="addBenefBtn" data-bs-toggle="modal" data-bs-target="#addLoanBenefModal">
                    Ajouter un bénéficiaire pour garantie yako
                </button>
            </div>
        </div>
        <div class="card-body overflow-auto">
            <table class="table table-striped" id="loanYakobeneficiariesTable">
                <thead>
                    <tr>
                        <th>Nom & Prénoms</th>
                        <th>Né(e) le</th>
                        <th>Lieu de naissance</th>
                        <th>Lieu de résidence</th>
                        <th>Capital</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>CORIS</th>
                        <th>--</th>
                        <th>--</th>
                        <th>Siege</th>
                        <th>--</th>
                        <th>000000000</th>
                        <th>coris@gmail.ci</th>
                        <th>--</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @endif
</div>

<!-- Modal d'ajout -->
<div class="modal fade" id="addLoanBenefModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un nouveau bénéficiaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="storeBeneficiaryPret">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="nomBenef" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" id="nomBenef" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="prenomBenef" class="form-label">Prénoms <span class="text-danger">*</span></label>
                            <input type="text" id="prenomBenef" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="datenaissanceBenef" class="form-label">Date de naissance</label>
                            <input type="date" id="datenaissanceBenef" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="lieunaissanceBenef" class="form-label">Lieu de naissance</label>
                            <select id="lieunaissanceBenef" class="form-select">
                                <option value="" disabled selected>Sélectionner</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="numPhoneBenef" class="form-label">Téléphone</label>
                            <input type="text" id="numPhoneBenef" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="emailBenef" class="form-label">Email</label>
                            <input type="email" id="emailBenef" class="form-control">
                        </div>
                    </div>

                    <input type="hidden" id="capitalBenef" value="500000">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" id="submitBenefPretBtn" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById("submitBenefPretBtn").addEventListener("click", function () {
        let data = {
            nom: document.getElementById("nomBenef").value,
            prenom: document.getElementById("prenomBenef").value,
            date_naissance: document.getElementById("datenaissanceBenef").value,
            lieu_naissance: document.getElementById("lieunaissanceBenef").value,
            telephone: document.getElementById("numPhoneBenef").value,
            email: document.getElementById("emailBenef").value,
            capital: document.getElementById("capitalBenef").value,
        };

        fetch("/beneficiaires/temp-store", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            let modalElement = document.getElementById("addLoanBenefModal");
            let modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
   

            let tbody = document.querySelector("#loanYakobeneficiariesTable tbody");
            tbody.innerHTML = ""; // Vider le tableau avant d'ajouter les nouvelles données

            // Utilisation de data.beneficiaires au lieu de beneficiaires
            data.beneficiaires.forEach((benef, index) => {
                let row = `<tr>
                    <td>${benef.nom} ${benef.prenom}</td>
                    <td>${benef.date_naissance || "N/A"}</td>
                    <td>${benef.lieu_naissance || "N/A"}</td>
                    <td>${benef.lieu_residence || "N/A"}</td>
                    <td>${benef.capital}</td>
                    <td>${benef.telephone || "N/A"}</td>
                    <td>${benef.email || "N/A"}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="removeBeneficiary(${index})">Supprimer</button>
                    </td>
                </tr>`;
                tbody.innerHTML += row;
            });
        });
    });
</script>
