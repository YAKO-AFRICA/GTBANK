<form method="POST" action="{{ route('prod.contrat.update', $contrat->id)}}" class="submitForm">

    @csrf

    <div class="row">

        <div class="col-sm-12 col-md-6 col-lg-8">

            <div class="card my-3">
                <div class="card-body ">
                    <label for="" class="form-label">Je souhaite payer mes primes par :</label>
                    <div class=" mt-4">
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="VIR" id="Virement_bancaire" 
                                    @if ($contrat->modepaiement === 'VIR')
                                        checked
                                    @endif>
                                <label class="form-check-label" for="Virement_bancaire">Virement bancaire</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="ESP" id="Espece" 
                                    @if ($contrat->modepaiement === 'ESP')
                                        checked
                                    @endif>
                                <label class="form-check-label" for="Espece">Espèce</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="CHK" id="Cheque" 
                                    @if ($contrat->modepaiement === 'CHK')
                                        checked
                                    @endif>
                                <label class="form-check-label" for="Cheque">Chèque</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="Mobile_money" id="Mobile_money" 
                                    @if ($contrat->modepaiement === 'Mobile_money')
                                        checked
                                    @endif>
                                <label class="form-check-label" for="Mobile_money">Mobile money</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="modepaiement" type="radio" value="SOURCE" id="Prelevement_source" 
                                    @if ($contrat->modepaiement === 'SOURCE')
                                        checked
                                    @endif>
                                <label class="form-check-label" for="Prelevement_source">Prélèvement à la source</label>
                            </div>
                        </div>
                        <div class="row mb-3" id="mode_bancaire" style="display: none;">

                            <div class="col-12 mb-3">

                                <label for="banque" class="form-label">Ma banque ou organisme de prélèvement</label>

                                <select class="form-select" id="banque" name="organisme">

                                    <option selected value="{{ $contrat->organisme}}">{{ $contrat->organisme ?? '--'}}</option>

                                    @foreach ($societes as $item)

                                        <option value="{{ $item->MonLibelle }}">{{ $item->MonLibelle ?? ""}}</option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="row col-12 mb-3">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="Agence" class="form-label">Agence</label>
                                    <select class="form-select" id="AgenceEdit" name="agence">
                                        <option data-codebanqueEdit="{{ $contrat->agenceBanque->codeBanque ?? '' }}" selected value="{{ $contrat->agenceBanque->libelle ?? ''}}">{{ $contrat->agenceBanque->libelle ?? '--'}}</option>
                                        @foreach ($agences as $item)
                                            @if ($item->libelle != $contrat->agence)
                                                
                                                <option value="{{ $item->libelle }}" data-codebanqueEdit="{{ $item->codeBanque ?? '' }}">{{ $item->libelle ?? ""}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="codeBanque" class="form-label">Code Banque</label>
                                    <input type="text" class="form-control muted" id="codebanqueEdit" name="codebanque" value="{{ $contrat->codebanque}}" readonly>
                                </div>
                            </div>

                           

                            <div class="row col-12 mb-3 p-0">
                                <div class="col-sm-12 col-md-3">
                                    <div class="">
                                        <label for="codeguichet" class="form-label">Code Guichet</label>
                                        <input type="text" class="form-control" id="codeguichet" name="codeguichet" value ="{{ $contrat->codeguichet}}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 m-0">
                                    <div class="">
                                        <label for="Matricule" class="form-label">Mon N° de compte (Matricule)</label>
                                        <input type="text" class="form-control" id="Matricule" name="numerocompte" value ="{{ $contrat->numerocompte}}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="">
                                        <label for="rib" class="form-label">Cle RIB</label>
                                        <input type="text" class="form-control" id="rib" name="rib" value ="{{ $contrat->rib}}">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3" id="mode_mobile" style="display: none;">

                            <div class="col-12 mb-3">

                                <label for="numMobile" class="form-label">Mon N° Mobile</label>

                                <input type="text" class="form-control" value="{{ $contrat->numerocompte ?? '--'}}" id="numMobile" name="numMobile">

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
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card mx-0">
                <div class="card-body">
                    <label class="form-label">Je souhaite payer mes primes chaque :</label>
                    <div class="">
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="periodicite" type="radio" value="M" id="Mois" 
                                       @if ($contrat->periodicite === 'M')
                                            checked
                                       @endif>
                                <label class="form-check-label" for="Mois">Mois</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="periodicite" type="radio" value="T" id="Trimestre" 
                                       @if ($contrat->periodicite === 'T')
                                            checked
                                       @endif>
                                <label class="form-check-label" for="Trimestre">Trimestre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="periodicite" type="radio" value="S" id="Semestre" 
                                       @if ($contrat->periodicite === 'S')
                                            checked
                                       @endif>
                                <label class="form-check-label" for="Semestre">Semestre</label>

                            </div>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input" name="periodicite" type="radio" value="A" id="Annee" 

                                       @if ($contrat->periodicite === 'A')

                                            checked

                                           

                                       @endif>

                                <label class="form-check-label" for="Annee">Année</label>

                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="periodicite" type="radio" value="U" id="Versement_unique" 
                                      @if ($contrat->periodicite === 'U')
                                            checked
                                      @endif>
                                <label class="form-check-label" for="Versement_unique">Versement unique</label>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12 mb-3">

                                <label for="DateEffet" class="form-label">Mon contrat prendra effet le :</label>

                                <input type="date" class="form-control" value="{{ $contrat->dateeffet ?? '--'}}" id="DateEffet" name="dateEffet">

                            </div>

                            <div class="col-12 mb-3">
                                <label for="primepricipale" class="form-label">Je souhaite payer une prime de :</label>
                                <input type="number" class="form-control" id="primepricipale" name="primepricipale" min="1000" value="{{ $contrat->primepricipale ?? '--'}}"  placeholder="{{ $contrat->primepricipale ?? '--'}}">
                                {{-- <span id="primepricipale-error" class="text-danger" style="display: none;">Le montant de la prime doit être au moins de 1 000 000.</span> --}}
                            </div>

                            <div class="col-12 mb-3">
                                <label for="capital" class="form-label">Capital souscrit :</label>
                                <input type="number" class="form-control" id="capital" name="capital" min="0" value="{{ $contrat->capital ?? '--'}}"  placeholder="{{ $contrat->capital ?? '--'}}">
                            </div>

                            
                            <div class="col-12 mb-3">
                                <label for="fraisadhesion" class="form-label">Fraie d'adhesion :</label>
                                <input type="number" class="form-control" id="fraisadhesion" name="fraisadhesion" min="0" value="{{ $contrat->fraisadhesion ?? '--'}}"  placeholder="{{ $contrat->fraisadhesion ?? '--'}}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cerd-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>

<script>
    document.getElementById("AgenceEdit").addEventListener("change", function() {
        var selectedOptionEdit = this.options[this.selectedIndex];
        var codeBanque = selectedOptionEdit.getAttribute("data-codebanqueEdit") || "";

        document.getElementById("codebanqueEdit").value = codeBanque;

        console.log("Agence sélectionnée :", this.value);
        console.log("Code banque :", codeBanque);
    });
</script>