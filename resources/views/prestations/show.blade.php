@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="fm-menu">
                        <div class="list-group list-group-flush">
                            <a href="javascript:;" class="list-group-item py-1" data-target="info-contrat">
                                <i class='bx bx-folder me-2'></i><span>Detail sur la prestation</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-0 text-primary font-weight-bold">Documents joint </h5>
                    </p>
                    <div class="mt-3"></div>
                        @forelse ($prestation->docPrestation->where('idPrestation', $prestation->id) as $doc)
                            <div class="d-flex align-items-center mt-3">
                                <div class="fm-file-box text-success"><i
                                        class='bx bxs-file-doc'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0" style="font-size: 10px">
                                        {{ 
                                            $doc->type == 'Police' ? "Police du contrat d'assurance" : 
                                            ($doc->type == 'bulletin' ? "Bulletin du contrat d'assurance" : 
                                            ($doc->type == 'RIB' ? 'RIB du compte courant' : 
                                            ($doc->type == 'CNI' ? 'CNI' : 
                                            ($doc->type == 'FicheIDNum' ? 'Fiche ID numéro' : 
                                            ($doc->type == 'AttestationPerteContrat' ? 'Attestation de perte de contrat' : '')))))
                                        }}
                                    </h6> 
                                    <p class="mb-0 text-secondary" style="font-size: 0.6em">
                                        {{ $doc->created_at ?? ''}}
                                    </p>
                                </div>
                                <h6 class="text-primary mb-0 text-center"> 
                                    <a class="btn btn-primary px-2" data-bs-target="#view-bulletin{{$doc->id}}" data-bs-toggle="modal" title="Preview"> 
                                        <i class="bx bx-show"></i>
                                    </a>
                                </h6>
                                <div class="modal fade" id="view-bulletin{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Preview 
                                                    {{ 
                                                        $doc->type == 'Police' ? 'Police du contrat d\'assurance' : 
                                                        ($doc->type == 'bulletin' ? 'Bulletin du contrat d\'assurance' : 
                                                        ($doc->type == 'RIB' ? 'RIB du compte courant' : 
                                                        ($doc->type == 'CNI' ? 'CNI' : 
                                                        ($doc->type == 'FicheIDNum' ? 'Fiche ID numéro' : 
                                                        ($doc->type == 'AttestationPerteContrat' ? 'Attestation de perte de contrat' : '')))))
                                                    }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="width: 100%; height: 80vh">
                                                    <iframe style="width: 100%; height: 100%" src="{{ asset('documents/docsPrestation/'.$doc->libelle) }}" frameborder="0"></iframe>
                                                </div>
                                            <div class="modal-footer">
                                                
                                                <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                                                    <a class="text-white" href="{{ asset('documents/docsPrestation/'.$doc->libelle) }}"
                                                    
                                                    id="download-bulletin"
                                                    title="Preview"
                                                    download>Telecharger
                                                    <i class="bx bx-download"></i>
                                                </a></button>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-secondary">Aucun document joint</p>
                        @endforelse
                    
                    
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <section id="info-contrat" class="section-content">
                        @if ($prestation->membre !== null && $prestation->membre->typ_membre !==3 )
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mt-4 row">
                                                <dl class="row col-md-6">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Saisie par :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7"> {{ $prestation->membre->prenom ?? ''}} {{ $prestation->membre->nom ?? ''}} </dd>
                                                </dl>
                                                <dl class="row col-md-6">
                                                    
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card" style="width: 90%">
                                    <div class="card-body">
                                        <h3>Prestation</h3>
                                        <div class="mt-4">
                                            <dl class="row">
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Type de prestation:</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5"> {{ $prestation->typeprestation ?? 'Non renseigné'}} </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">ID du contrat :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5"> {{ $prestation->idcontrat ?? 'Non renseigné'}} </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Montant souhaité :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5"> {{ $prestation->montantSouhaite ?? 'Non renseigné'}} FCFA</dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Moyen de paiement :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5"> {{ $prestation->moyenPaiement == "Virement_Bancaire" ? "Virement Bancaire" : "Mobile Money" ?? 'Non renseigné'}} </dd>
                                                @if ($prestation->moyenPaiement == "Mobile_Money")
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Opérateur :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5"> 
                                                        {{ $prestation->Operateur == "Orange_money" ? "Orange Money" : 
                                                        ($prestation->Operateur == "MTN_Money" ? "MTN Money" : 
                                                        ($prestation->Operateur == "Moov_Money" ? "Moov Money" : 'Non renseigné')) ?? 'Non renseigné'}} 
                                                    </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Numéro de paiement :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5"> {{ $prestation->telPaiement ?? 'Non renseigné'}} </dd>
                                                @elseif($prestation->moyenPaiement == "Virement_Bancaire")
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">IBAN du compte :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5"> {{ $prestation->IBAN ?? 'Non renseigné'}} </dd>
                                                @endif
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date de demande :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5"> {{ $prestation->created_at->format('d-m-Y à H:i') ?? 'Non renseigné'}}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Client</h3>
                                        <div class="mt-4">
                                            <dl class="row">
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Nom :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7"> {{ $prestation->membreClient->nom ?? $prestation->nom ?? 'Non renseigné'}} </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Prénom :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7"> {{ $prestation->membreClient->prenom ?? $prestation->prenom ?? 'Non renseigné'}}</dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Date de naissance:</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7"> {{ $prestation->membreClient->datenaissance ?? $prestation->datenaissance ?? 'Non renseigné'}}</dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Sexe :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7"> {{ $prestation->membreClient->sexe ?? $prestation->sexe ?? 'Non renseigné'}} </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Teléphone :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7"> {{ $prestation->membreClient->cel ?? $prestation->cel ?? 'Non renseigné'}} </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Email :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7"> {{ $prestation->membreClient->email ?? $prestation->email ?? 'Non renseigné'}} </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Lieu de residence:</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7"> {{ $prestation->membreClient->lieuresidence ?? $prestation->lieuresidence ?? 'Non renseigné'}} </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>	
    </div>
@endsection