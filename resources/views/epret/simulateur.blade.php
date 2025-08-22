@extends('layouts.main')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Epret</li>
                    <li class="breadcrumb-item active" aria-current="page">Simulateur</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group"></div>
        </div>
    </div>
    <!--end breadcrumb-->
  
    <div class="container mt-5">
        <h3 class="text-center text-uppercase" style="color: #076633;">Simulateur de Prêt</h3>
        <div class="row mt-5">
            <!-- Formulaire -->
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-center py-3" style="background-color: #076633;">
                        <h5 class="text-uppercase text-white mb-0">
                            <i class="bx bx-info-circle me-2"></i>INFORMATIONS SUR LE PRÊT ET SANTÉ
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="loanSimulatorForm" class="row g-3 needs-validation container" novalidate>
                            {{-- Section Information Personnelle --}}
                            <div class="col-12">
                                <h6 class="mb-3" style="color: #076633; border-bottom: 1px solid #076633; padding-bottom: 5px;">
                                    <i class="bx bx-user  me-2"></i>Informations Personnelles
                                </h6>
                            </div>
                            
                            <div class="col-sm-12 col-md-6">
                                <label for="genre" class="form-label">Genre <span class="text-danger">*</span></label>
                                <select id="genre" class="form-select" required>
                                    <option value="" disabled selected>Choisir...</option>
                                    <option value="femme">Femme</option>
                                    <option value="homme">Homme</option>
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner votre genre.</div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <label for="birthday" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                <input type="date" class="form-control border-2 border-primary" id="birthday" required>
                                <div class="invalid-feedback">Veuillez saisir votre date de naissance.</div>
                            </div>
                            
                            {{-- Section Prêt --}}
                            <div class="col-12 mt-3">
                                <h6 class="mb-3" style="color: #076633; border-bottom: 1px solid #076633; padding-bottom: 5px;">
                                    <i class="lni lni-money-location me-2"></i>Informations sur le Prêt
                                </h6>
                            </div>
            
                            <div class="col-sm-12 col-md-6">
                                <label for="loanMontant" class="form-label">Montant du prêt (en FCFA) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control border-2 border-primary" id="loanMontant" placeholder="Entrez le montant" required>
                                <div class="invalid-feedback">Veuillez entrer un montant valide.</div>
                            </div>
            
                            <div class="col-sm-12 col-md-6">
                                <label for="loanDuration" class="form-label">Durée (en mois) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control border-2 border-primary" id="loanDuration" placeholder="Entrez la durée" required>
                                <div class="invalid-feedback">Veuillez entrer une durée valide.</div>
                            </div>
                            
                            {{-- Section Santé --}}
                            <div class="col-12 mt-3">
                                <h6 class="mb-3" style="color: #076633; border-bottom: 1px solid #076633; padding-bottom: 5px;">
                                    <i class="lni lni-heart-monitor me-2"></i>Informations de Santé
                                </h6>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <label for="poids" class="form-label">Poids (kg) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="poids" placeholder="Entrez votre poids" required>
                                <div class="invalid-feedback">Veuillez entrer votre poids.</div>
                            </div>
                            
                            <div class="col-sm-12 col-md-6">
                                <label for="taille" class="form-label">Taille (cm) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="taille" placeholder="Entrez votre taille" required>
                                <div class="invalid-feedback">Veuillez entrer votre taille.</div>
                            </div>
                            
                            {{-- Tension artérielle --}}
                            <div class="col-sm-12 col-md-6">
                                <label for="tensionSysto" class="form-label">Tension systolique (mmHg) <span class="text-danger">*</span></label>
                                <select id="tensionSysto" class="form-control" required>
                                    <option value="" disabled selected>Sélectionner</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="tensionDiasto" class="form-label">Tension diastolique (mmHg) <span class="text-danger">*</span></label>
                                <select id="tensionDiasto" class="form-control" required>
                                    <option value="" disabled selected>Sélectionner</option>
                                </select>
                            </div>
                            
                            {{-- Diabète --}}
                            <div class="col-sm-12 col-md-4">
                                <label for="diabete" class="form-label">Diabète <span class="text-danger">*</span></label>
                                <select id="diabete" class="form-select" required>
                                    <option value="non" selected>Non</option>
                                    <option value="oui">Oui</option>
                                </select>
                            </div>
                            
                            {{-- Détails diabète (masqué par défaut) --}}
                            <div id="diabeteDetails" class="row g-3 mt-2 col-sm-12 col-md-8" style="display: none;">
                                <div class="col-sm-12 col-md-6">
                                    <label for="diabeteType" class="form-label">Type de diabète</label>
                                    <select id="diabeteType" class="form-select">
                                        <option value="" selected disabled>Choisir...</option>
                                        <option value="type1">Type 1</option>
                                        <option value="type2">Type 2</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="diabeteDuree" class="form-label">Durée depuis diagnostic (années)</label>
                                    <input type="number" class="form-control" id="diabeteDuree" placeholder="Nombre d'années">
                                </div>
                            </div>
            
                            <!-- Garantie Yako -->
                            <div class="col-12 form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="disableYako" checked disabled>
                                <label class="form-check-label" for="disableYako">Désactiver la garantie Yako</label>
                            </div>
            
                            <!-- Boutons -->
                            <div class="col-12 d-flex justify-content-between align-items-center mt-4">
                                <button type="button" id="resetFormBtn" class="btn btn-secondary btn-sm">
                                    <i class="bx bx-redo me-2"></i>Réinitialiser
                                </button>
                                <button type="submit" class="btn btn-success text-white text-uppercase btn-sm" style="background-color: #076633;">
                                    <i class="bx bx-calculator me-2"></i>Évaluer la Prime
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Résultats -->
            <div class="col-12 col-md-4 mt-4 mt-md-0">
                <div class="card border-0 shadow-lg">
                    <div class="card-header text-center py-3" style="background-color: #076633;">
                        <h4 class="text-uppercase text-white mb-0">
                            <i class="bx bx-calculator me-2"></i>Résultats du simulateur
                        </h4>
                    </div>

                   
                    
                    <div class="card-body position-relative">
                        <div class="result-container">
                            <!-- Carte Prime Yako Obsèque -->
                            <div class="result-card mb-3 animate__animated animate__fadeInLeft" id="primeObsequeCard">
                                <div class="card-body" style="background-color: #f8f9fa; border-left: 4px solid #076633;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title mb-1" style="color: #076633;">
                                                <i class="lni lni-hospital me-2"></i>Prime Yako Obsèque
                                            </h5>
                                            <small class="text-muted">Couverture décès et obsèques</small>
                                        </div>
                                        <p class="card-text mb-0 fs-5 fw-bold" style="color: #076633;">
                                            <span id="primeObseque">0</span> <small>FCFA</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Carte Prime Vie Emprunteur -->
                            <div class="result-card mb-3 animate__animated animate__fadeInRight" id="primeEmprunteurCard">
                                <div class="card-body" style="background-color: #f8f9fa; border-left: 4px solid #FF7F00;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title mb-1" style="color: #076633;">
                                                <i class="lni lni-consulting me-2"></i>Prime Vie Emprunteur
                                            </h5>
                                            <small class="text-muted">Protection de l'emprunteur</small>
                                        </div>
                                        <p class="card-text mb-0 fs-5 fw-bold" style="color: #076633;">
                                            <span id="primeEmprunteur">0</span> <small>FCFA</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Carte Surprime Santé -->
                            <div class="result-card mb-3 animate__animated animate__fadeInRight" id="surprimeCard">
                                <div class="card-body" style="background-color: #f8f9fa; border-left: 4px solid #ff4800;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title mb-1" style="color: #076633;">
                                                <i class="lni lni-heart-filled me-2"></i>Surprime Santé
                                            </h5>
                                        </div>
                                        <p class="card-text mb-0 fs-5 fw-bold" style="color: #076633;">
                                            <span id="surprime">0</span> <small>FCFA</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Carte Total avec mise en valeur -->
                            <div class="result-card total-card mb-3 animate__animated animate__fadeInUp">
                                <div class="card-body py-3" style="background-color: #f5f7fa; border: 2px solid #076633;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-uppercase" style="color: #076633;">
                                            <i class="bx bx-file-invoice-dollar me-2 fs-5"></i>Total des primes
                                        </h5>
                                        <p class="card-text mb-0 fs-4 fw-bold" style="color: #FF7F00;">
                                            <span id="totalPremium">0</span> <small>FCFA</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Bouton de souscription amélioré -->
                        <div class="d-grid mt-4">
                            <button id="btn-souscription" class="btn btn-primary btn-lg py-3 shadow" style="background-color: #076633; border: none;" disabled>
                                <a href="{{ route('epret.create') }}" class="btn btn-outline-primary text-uppercase border-0">
                                    Démarrer une Souscription
                                </a>
                            </button>
                        </div>
                        
            
                        <!-- Info-bulle discrète -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="bx bx-info-circle fa-info-circle me-1"></i> Ces résultats sont basés sur les informations fournies
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'erreur -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">Attention</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="errorModalBody">
                <!-- Le message d'erreur sera inséré ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK, j'ai compris</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Style du ruban */
    .premium-ribbon {
        position: absolute;
        top: -12px;
        right: 20px;
        color: white;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: bold;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        border-radius: 4px;
        z-index: 1;
        transform: rotate(5deg);
    }
    
    .premium-ribbon:after {
        content: "";
        position: absolute;
        bottom: -10px;
        right: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid #FF7F00;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
    }
    
    /* Styles des cartes de résultat */
    .result-card {
        border-radius: 8px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
        background-color: white;
    }
    
    .result-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .total-card {
        background-color: rgba(7, 102, 51, 0.05) !important;
    }
    
    /* Animation */
    .animate__animated { animation-duration: 0.6s; }
    
    /* Bordure des champs de formulaire */
    .border-primary {
        border-color: #076633 !important;
    }
    
    /* Hover sur les boutons secondaires */
    .btn-outline-success:hover {
        background-color: #076633;
        color: white !important;
    }
    
    /* Style pour les sections du formulaire */
    .form-section-title {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    /* Style pour le groupe de tension artérielle */
    .input-group-text {
        background-color: #f8f9fa;
    }
</style>

<script>
    // Script pour afficher/masquer les détails du diabète
    document.getElementById('diabete').addEventListener('change', function() {
        const diabeteDetails = document.getElementById('diabeteDetails');
        if (this.value === 'oui') {
            diabeteDetails.style.display = 'flex';
            document.getElementById('diabeteType').required = true;
            document.getElementById('diabeteDuree').required = true;
        } else {
            diabeteDetails.style.display = 'none';
            document.getElementById('diabeteType').required = false;
            document.getElementById('diabeteDuree').required = false;
        }
    });
</script>
@endsection