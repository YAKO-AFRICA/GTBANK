<div class="modal fade " id="addAgence" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="margin-top:0; margin-right: 0">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une agence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="btn" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('setting.store.agenceByReseau') }}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body">
                    
                        <!-- Fieldset Réseau -->
                        <fieldset class="border p-3">

                            <legend class="float-none w-auto px-2"><small>Information sur l'agence</small></legend>
                            
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-12 col-lg-12">
                                    <label for="libelle" class="form-label">Libellé</label>
                                    <input type="text" id="libelle" name="libelle" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="codeBanque" class="form-label">Code Banque</label>
                                    <input type="text" id="codeBanque" name="codeBanque" class="form-control" required>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="codePartner" class="form-label">Code Partenaire</label>
                                    <input type="text" value="{{ Auth::user()->codepartenaire }}" id="codePartner" name="codePartner" class="form-control" readonly>
                                </div>
                            </div>
                           
                        </fieldset>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>