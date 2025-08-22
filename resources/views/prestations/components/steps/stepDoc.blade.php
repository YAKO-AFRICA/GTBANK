<div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
    <div class="card">
        <div class="card-header text-center">
            <h5 class="mb-1">Documents requis (en PDF, PNG ou JPEG)</h5>
            <p class="mb-4">Vueillez joindre les documents demander ci-dessous pour finaliser votre demande </p>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <label class="form-label">Joindre la Police du contrat </label>
                            </div>
                            <div class="card-body">
                                <input id="Police-file-uploa" type="file" class="form-control" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png, .pdf">
                                <input type="hidden" name="type[]" value="Police">
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <label class="form-label">Joindre le Bulletin de souscription </label>
                            </div>
                            <div class="card-body">
                                <input id="bulletin-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png, .pdf">
                                <input type="hidden" name="type[]" value="bulletin">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <label class="form-label">Joindre le RIB <strong>(Compte courant)</strong></label>
                            </div>
                            <div class="card-body">
                                <input id="RIB-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png, .pdf">
                                <input type="hidden" name="type[]" value="RIB">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <label class="form-label">Joindre votre CNI <strong><small>(Recto)</small></strong> </label>
                            </div>
                            <div class="card-body">
                                <input id="CNIrecto-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png" required>
                                <input type="hidden" name="type[]" value="CNIrecto">
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <label class="form-label">Joindre le CNI <strong><small>(Verso)</small></strong> </label>
                            </div>
                            <div class="card-body">
                                <input id="CNIverso-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png" required>
                                <input type="hidden" name="type[]" value="CNIverso" required>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <label class="form-label">Fiche d'identification du n° de telephone<small> <strong>(Ou joindre la capture d'écran de la vérification)</strong></small> </label>
                            </div>
                            <div class="card-body">
                                <input id="FicheID-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png, .pdf">
                                <input type="hidden" name="type[]" value="FicheIDNum" required>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <label class="form-label">Attestation de déclaration de perte du contrat <small><strong>(Si vous avez perdu le contrat)</strong></small> </label>
                            </div>
                            <div class="card-body">
                                <input id="AttestationPerte-file-uploa" class="form-control" type="file" name="libelle[]" accept=".jpg, .png, image/jpeg, image/png, .pdf">
                                <input type="hidden" name="type[]" value="AttestationPerteContrat">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            {{-- Boutton de validation --}}
            <div class="row">
                <div class="col-12 d-flex justify-content-end gap-3">
                    {{-- <button class="btn2 border-btn2 px-4" type="button" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2 fs-4'></i>étape prédédente</button> --}}
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
            </div>
        </div>
    </div>
</div>