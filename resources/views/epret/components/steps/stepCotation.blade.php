<div class="container-fluid">
   

    <fieldset>
        <legend class="float-none w-auto px-2"><small>Informations sur le pret</small></legend>

        <div class="row">
            <h6>Nature du prêt</h6>
            <div class="col">
                <input type="radio" id="newPret" name="naturePret" class="form-check-input" value="Nouveau pret" required>
                <label for="naturePret" for="newPret" class="form-check-label">Nouveau pret</label>
            </div>
            <div class="col">
                <input type="radio" id="rachatInterne" name="naturePret" value="Rachat interne" class="form-check-input" required>
                <label for="naturePret" for="rachatInterne" class="form-check-label">Rachat interne</label>
            </div>
            <div class="col">
                <input type="radio" id="rachatExterne" name="naturePret" value="Rachat externe" class="form-check-input" required>
                <label for="naturePret" for="rachatExterne" class="form-check-label">Rachat externe</label>
            </div>
        </div>

        <div class="row my-4">
            <div class="col">
                <Label class="form-label">Montant du pret</Label>
                <input class="form-control" type="number" value="{{ $simulationData['montant'] ?? 0 }}" readonly> 
                <input class="form-control" type="hidden" name="montant" value="{{ $simulationData['montant'] ?? '-' }}"> 
            </div>
            <div class="col">
                <Label class="form-label">Duree du pret (Mois)</Label>
                <input class="form-control" type="number"  value="{{ $simulationData['duree'] ?? 0 }}" readonly>
                <input class="form-control" type="hidden" id="dureeCotationPret" name="duree" value="{{ $simulationData['duree'] ?? 0 }}">
            </div>
        </div>

        <input class="form-control" type="hidden" name="prime" value="{{ $simulationData['prime'] ?? 0 }}">
        <input class="form-control" type="hidden" name="primeObseque" value="{{ $simulationData['primeObseque'] ?? '0'  }}">
        <input class="form-control" type="hidden" name="primeEmprunteur" value="{{ $simulationData['primeEmprunteur'] ?? '0'  }}">
        <input class="form-control" type="hidden" name="montantsurprime" value="{{ $simulationData['totalSurprime'] ?? '0'  }}">

        <div class="row">
            <h6>Type de prêt</h6>
            <div class="col-6">
                <input type="radio" name="typPret" id="pretConsommation" class="form-check-input" value="Prêt à la consommation" required>
                <label class="form-check-label" for="pretConsommation">Prêt à la consommation</label>
            </div>
            <div class="col-6">
                <input type="radio" name="typPret" id="pretImmo" value="Prêt immobilier" class="form-check-input" required>
                <label class="form-check-label" for="pretImmo">Prêt immobilier</label>
            </div>
            <div class="col-6">
                <input type="radio" name="typPret" id="fondRoulement" value="Fond de roulement" class="form-check-input" required>
                <label class="form-check-label" for="fondRoulement">Fond de roulement</label>
            </div>
            <div class="col-6">
                <input type="radio" name="typPret" id="autrePret" class="form-check-input" value="">
                <label class="form-check-label" for="autrePret">Autre</label>
                <input type="text" name="typPretAutre" id="typPretAutre" class="form-control" placeholder="Précisez..." disabled>
            </div>
        </div>
        
        {{-- <script>
        document.querySelectorAll('input[name="typPret"]').forEach((radio) => {
            radio.addEventListener('change', function() {
                let autreInput = document.getElementById('typPretAutre');
                autreInput.disabled = !document.getElementById('autrePret').checked;
                document.getElementById('autrePret').value = autreInput.value;
                console.log(autreInput.value);
                if (!autreInput.disabled) {
                    autreInput.focus();
                } else {
                    autreInput.value = ""; // Réinitialise la valeur si désactivé
                }
            });
        });
        </script> --}}

        <script>
            document.querySelectorAll('input[name="typPret"]').forEach((radio) => {
                radio.addEventListener('change', function() {
                    let autreInput = document.getElementById('typPretAutre');
                    let autrePret = document.getElementById('autrePret');
            
                    if (autrePret.checked) {
                        autreInput.disabled = false;
                        autreInput.focus();
                    } else {
                        autreInput.disabled = true;
                        autreInput.value = ""; // Réinitialise si désactivé
                    }
                });
            });
            
            // Met à jour la valeur de "autrePret" avec le texte saisi
            document.getElementById('typPretAutre').addEventListener('input', function() {
                document.getElementById('autrePret').value = this.value;
            });
        </script>
    


        
        

        

        <div class="row my-4">
            <fieldset class="col">
                <legend class="float-none w-auto px-2"><small>Date de la mise en place prévue</small></legend>
                <input id="loanDateMiseEnPlace" type="date" class="form-control" value="" name="loanDateMiseEnPlace" oninput="updateDisplay()">
            </fieldset>
        
            <fieldset class="col mx-2">
                <legend class="float-none w-auto px-2"><small>Première échéance de remboursement prévue <span class="text-danger">*</span></small></legend>
                <input id="firstDateEcheance" type="date" class="form-control" name="firstDateEcheance" required oninput="updateDisplay()">
            </fieldset>
        
            <fieldset class="col">
                <legend class="float-none w-auto px-2"><small>Dernière échéance de remboursement prévue <span class="text-danger">*</span></small></legend>
                <input id="lasLoanDateRembour" type="date" class="form-control" name="lasLoanDateRembour" oninput="updateDisplay()" readonly>
            </fieldset>
        </div>  

        <div class="row mt-4">
            <div class="col-6">
                <fieldset>
                    <legend class="float-none w-auto px-2"><small>Périodicite de remboursement <span class="text-danger">*</span></small></legend>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" id="periodiciterMensuelle" name="periodiciterRembou" class="form-check-input" value="M" required onclick="updateDisplay()">
                                <label class="form-check-label" for="periodiciterMensuelle">Mensuelle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterRembou" id="periodiciterTrimestrielle" class="form-check-input" value="T" required onclick="updateDisplay()">
                                <label class="form-check-label" for="periodiciterTrimestrielle">Trimestrielle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterRembou" id="periodiciterSemestrielle" class="form-check-input" value="S" required onclick="updateDisplay()">
                                <label class="form-check-label" for="periodiciterSemestrielle">Semestrielle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterRembou" id="periodiciterAnnuelle" class="form-check-input" value="A" required onclick="updateDisplay()">
                                <label class="form-check-label" for="periodiciterAnnuelle">Annuelle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterRembou" id="periodiciterUnique" class="form-check-input" value="U" required onclick="updateDisplay()"     >
                                <label class="form-check-label" for="periodiciterUnique">Versement Unique</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset>
                    <legend class="float-none w-auto px-2"><small>Périodicité de paiement de la prime <span class="text-danger">*</span></small></legend>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" class="form-check-input" id="Mensuelle" value="M" required onclick="updateDisplay()">
                                <label class="form-check-label" for="Mensuelle">Mensuelle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" id="Trimestrielle" class="form-check-input" value="T" required onclick="updateDisplay()">
                                <label class="form-check-label" for="Trimestrielle">Trimestrielle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" id="Semestrielle" class="form-check-input" value="S" required onclick="updateDisplay()">
                                <label class="form-check-label" for="Semestrielle">Semestrielle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" id="Annuelle" class="form-check-input" value="A" required onclick="updateDisplay()">
                                <label class="form-check-label" for="Annuelle">Annuelle</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" name="periodiciterPrime" id="Unique" class="form-check-input" value="U" required onclick="updateDisplay()">
                                <label class="form-check-label" for="Unique">Versement Unique</label>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>
    </fieldset>

    <div class="col-12">
        <fieldset>
            <legend class="float-none w-auto px-2"><small>N° Client/ Compte </small></legend>
            
            <div class="row">
               
                <div class="col-sm-12">
                    <label for="numClient">N° Client <span class="text-danger">*</span></label>
                    <input id="numClient" type="text" class="form-control" name="numeroclient" required >
                </div>
                <div class="col-sm-6 mt-3">
                    <label for="numerocompte">N° Compte <span class="text-danger">*</span></label>
                    <input id="numerocompte" type="text" class="form-control" name="numerocompte" required>
                </div>
                <div class="col-sm-6 mt-3">
                    <label for="cNumCompte">Confirmation du N° Compte <span class="text-danger">*</span></label>
                    <input id="cNumCompte" type="text" class="form-control" name="cNumerocompte" required>
                    <span id="error-message" class="text-danger" style="display: none;">Les numéros de compte ne correspondent pas.</span>
                </div>                

            </div>

        </fieldset>
    </div>
    
    <script>
        const dateInput = document.getElementById('loanDateMiseEnPlace');
        const today = new Date();
        const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, 1);
        dateInput.value = nextMonth.toISOString().split('T')[0];
    </script>

    <script>
        document.querySelectorAll('input[name="naturePret"]').forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked) {
                    const naturePret = radio.value;

                    document.getElementById('naturePret').innerText = naturePret;
                }
            });
        })
    </script>

<script>
    const firstDateEcheance = document.getElementById("firstDateEcheance");
    const duree = document.getElementById("dureeCotationPret");

    firstDateEcheance.addEventListener("blur", function() {
        const dateSaisie = new Date(firstDateEcheance.value);

        // const dureeTemp = parseInt({{ $simulationData['duree'] ?? '-' }});
        // console.log("Duree temporaire",dureeTemp)
 
        const moisAjoutes = parseInt({{ $simulationData['duree'] ?? '-' }});
        console.log("Mois ajoutes:", moisAjoutes);
        const nouvelleDate = new Date(dateSaisie.setMonth(dateSaisie.getMonth() + moisAjoutes));
        const lasLoanDateRembour = document.getElementById("lasLoanDateRembour");
        lasLoanDateRembour.value = nouvelleDate.toISOString().split('T')[0];
    });
</script>




</div>


