<div class="modal fade" id="EditUsers{{ $item->idmembre }}" tabindex="-1" aria-labelledby="mreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifié le Membre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('setting.user.update', $item->idmembre) }}" method="POST" class="submitForm">
                    @csrf
                    <div>
                        <fieldset class="border p-3">
    
                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 1 : Reseau</h5></small></legend>
                        
                            <div class="mb-3">
                                <label for="codeagent" class="form-label">Code Agent <span class="text-danger">*</span></label>
                                <input type="text" name="codeagent" id="codeagent" class="form-control" value="{{ $item->codeagent }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="codereseau" class="form-label">Réseau de commercialisation</label>
                                <select name="codereseau" id="codereseau" class="form-select">
                                    <option value="{{ $item->codereseau }}">{{ $item->reseau->libelle ?? '' }}</option>
                                    @foreach ($reseaux as $reseau)
                                        @if ($reseau->codereseau != $item->id)
                                            <option class="form-control" value="{{ $reseau->id }}">{{ $reseau->libelle }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="codezone" class="form-label">Zone/Departement</label>
                                <select name="codezone" id="codezone" class="form-select" id="">
                                    <option value="{{ $item->codezone }}">{{ $item->zone->libellezone ?? '' }}</option>
                                    @foreach ($zones as $zone)
                                        @if ($item->codezone != $zone->id)
                                            
                                            <option class="form-control" value="{{ $zone->id }}">{{ $zone->libellezone }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="codeequipe" class="form-label">Equipe/Agence</label>
                                <select name="codeequipe" id="codeequipe" class="form-select" id="">
                                    <option value="{{ $item->codeequipe ?? '' }}">{{ $item->equipe->libelleequipe ?? '' }}</option>
                                    @foreach ($equipes as $equipe)
                                        @if ($item->codeequipe != $equipe->id)
                                            <option class="form-control" value="{{ $equipe->id }}">{{ $equipe->libelleequipe }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            {{-- @dd($partners) --}}

                            <div class="mb-3">
                                <label for="codePart" class="form-label">Partenaire</label>
                                <select name="codePart" id="codePart" class="form-select" id="">
                                    <option value="{{ $item->codepartenaire }}">{{ $item->partner->designation }}</option>
                                    @foreach ($partners as $partner)
                                        @if ($item->codepartenaire != $partner->code)
                                            <option class="form-control" value="{{ $partner->code }}">{{ $partner->designation }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                        </fieldset>
    
                        <div>
                            <fieldset class="border p-3">
    
                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 2 : Informations personnelles</h5></small></legend>
                                
                                <div class="mb-3">
                                    <label class="form-label d-block">Sexe</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="sexeF" @checked($item->sexe == 'F') name="sexe" value="F" class="form-check-input">
                                        <label class="form-check-label" for="sexeF">Féminin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="sexeM" @checked($item->sexe == 'M') name="sexe" value="M" class="form-check-input">
                                        <label class="form-check-label" for="sexeM">Masculin</label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom</label>
                                            <input type="text" name="nom" id="nom" class="form-control" value="{{ $item->nom }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="prenom" class="form-label">Prenoms</label>
                                            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $item->prenom }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="datenaissance" class="form-label">Date de naissance</label>
                                            <input type="date" name="datenaissance" id="datenaissance" class="form-control" value="{{ date('Y-m-d', strtotime($item->datenaissance)) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profession" class="form-label">Profession</label>
                                            <input type="text" name="profession" id="profession" class="form-control" value="{{ $item->profession }}">
                                        </div>
                                    </div>
                                </div>
    
                            </fieldset>
                        </div>
                        <div>
                            <fieldset class="border p-3">
    
                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 3 : Comptes</h5></small></legend>
                                <div class="mb-3">
                                    <label for="login" class="form-label">Nom d'utilisateur (Login) <span class="text-danger">*</span></label>
                                    <input type="text" name="login" id="login" class="form-control" required value="{{ $item->login }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3 form-group">
                                            <label for="role" class="form-label">Profile <span class="text-danger">*</span></label>
                                            <select name="role" id="" class="form-control" required>
                                                <option value="{{ $item->role }}">{{ $item->role }}</option>
                                                <option class="form-option"  value="ADMINISTRATEUR">ADMINISTRATEUR</option>
                                                <option class="form-option"  value="SUPERVISEUR">SUPERVISEUR</option>
                                                <option class="form-option"  value="RESPONSABLE">RESPONSABLE</option>
                                                <option class="form-option"  value="MANAGER">MANAGER</option>
                                                <option class="form-option"  value="CONSEILLER">CONSEILLER</option>
                                            </select>
    
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="pass" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                            <input type="password" name="pass" id="pass" class="form-control" value="{{ $item->pass }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cpass" class="form-label">Confirmation Mot de passe</label>
                                            <input type="password" name="cpass" id="cpass" class="form-control">
                                        </div>
                                    </div>
                                </div> --}}
                                
                            </fieldset>
                        </div>
                        <div>
                            <fieldset class="border p-3">
    
                                <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Étape 4 : Contacts</h5></small></legend>
                                <div class="mb-3">
                                    <label for="login" class="form-label">Email  <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" required value="{{ $item->email }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cel" class="form-label">Mobile 1</label>
                                            <input type="text" name="cel" id="cel" class="form-control" value="{{ $item->cel }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tel" class="form-label">Mobile 2</label>
                                            <input type="tel" name="tel" id="tel" class="form-control" value="{{ $item->tel }}">
                                        </div>
                                    </div>
                                </div>
                                
    
                            </fieldset>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary">Précédent</button> --}}
                        <button type="submit" class="btn btn-success ">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
