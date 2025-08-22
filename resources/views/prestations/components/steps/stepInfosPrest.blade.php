<div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">

    <div class="card">
        <div class="card-header text-center">
            <h5 class="mb-1">Informations liée à la prestation</h5>
            <p class="mb-4">Veuillez renseigner les informations relatives à la prestation</p>
            <p class="mb-4"><span class="form-label star" ><small><i>YAKO AFRICA décline toute responsabilité si les informations communiquées sont incorrectes </i></small></span></p>
        </div>
        <div class="card-body">
            <div class="etapePrest" id="etapePrest1">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6"> 
                        <label for="single-select-field" class="form-label">Pour quel Contrat demandez-vous la prestation ? <span class="star">*</span></label>
                        <select class="form-select" name="idcontrat" id="single-select-field" data-placeholder="Veuillez sélectionner l'ID du contrat" required>
                            <option></option>
                            <option value="{{ $contractDetails['IdProposition'] ?? '' }}" selected>{{ $contractDetails['IdProposition'] ?? '' }}</option>
                          
                        </select>
                        <input type="hidden" id="Capital" name="Capital" value="">
                        <h3 id="CapitalTotal"></h3> 
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="montant" class="form-label">Quel est le montant que vous souhaitez demander ? <span class="star">*</span></label>
                        <input type="number" class="form-control" min="0" name="montantSouhaite" id="montantSouhaite" placeholder="Saisir le montant souhaité" required disabled>
                        <small><i id="msgerror" class="text-danger"></i></small>
                        <small><i id="msgesucces" class="text-success"></i></small>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-6 d-flex justify-content-start gap-3">
                        <button class="btn btn-primary px-4" type="button" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour étape 1</button>
                    </div>
                    <div class="col-6 d-flex justify-content-end gap-3">
                        <button class="btn btn-primary next-btn" type="button" data-next="etapePrest2">Suivant <i
                            class='bx bx-right-arrow-alt fs-4'></i></button>
                    </div>
                </div>
            </div>
            <div class="etapePrest d-none" id="etapePrest2">
                <div class="row g-3 mb-3 text-center">
                    <span class="form-label">Par quel moyen de paiement souhaitez-vous être payé ? <span class="star">*</span></span>
                    <div class="row d-flex justify-content-center align-items-center mt-3 gap-3">
                        <div class="moyenPaiement-option col-lg-3 col-md-4 col-sm-12">
                            <input type="checkbox" name="moyenPaiement" value="Mobile_Money" id="mobileMoney" class="moyenPaiement-input">
                            <label for="mobileMoney" class="moyenPaiement-label d-flex flex-column align-items-center justify-content-center">
                                <span class="moyenPaiement-icon"><i class='bx bx-money'></i></span>
                                <span class="moyenPaiement-text">Mobile Money</span>
                            </label>
                        </div>
                        <div class="moyenPaiement-option col-lg-3 col-md-4 col-sm-12">
                            <input type="checkbox" name="moyenPaiement" value="Virement_Bancaire" id="virementBancaire" class="moyenPaiement-input">
                            <label for="virementBancaire" class="moyenPaiement-label d-flex flex-column align-items-center justify-content-center">
                                <span class="moyenPaiement-icon"><i class='bx bxs-bank'></i></span>
                                <span class="moyenPaiement-text">Virement Bancaire</span>
                            </label>
                        </div>
                    </div>
                    
                </div>
                <div class="row ">
                    <div class="col-6 d-flex justify-content-start gap-3">
                            <button class="btn btn-primary prev-btn" type="button" data-prev="etapePrest1">
                                <i class='bx bx-left-arrow-alt fs-4'></i> Retour
                            </button>
                    </div>
                    <div class="col-6 d-flex justify-content-end gap-3">
                            <button class="btn btn-primary next-btn" type="button" id="next-stepper3" data-next="etapePrest3">
                                Suivant <i class='bx bx-right-arrow-alt fs-4'></i>
                            </button>
                            
                            <button class="btn btn-primary next-btn" type="button" id="next-stepper4" data-next="etapePrest4">
                                Suivant <i class='bx bx-right-arrow-alt fs-4'></i>
                            </button>
                    </div>
                </div>
                
                
            </div> 
            <div class="etapePrest d-none" id="etapePrest3">
                <div class="row g-3 mb-3 text-center" id="Operateur">
                    <span class="form-label">Quel opérateur souhaitez-vous utiliser ?</span>
                    
                    <div class="row d-flex justify-content-center align-items-center mt-3 gap-3">
                        <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                            <input type="radio" name="Operateur" value="Orange_money" id="Orange" class="Operateur-input">
                            <label for="Orange" class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                <span class="Operateur-icon">
                                    <img src="https://seeklogo.com/images/O/orange-money-logo-8F2AED308D-seeklogo.com.png" alt="Orange Money">
                                </span>
                                <span class="Operateur-text">Orange Money</span>
                            </label>
                        </div>
                        <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                            <input type="radio" name="Operateur" value="MTN_money" id="MTN" class="Operateur-input">
                            <label for="MTN" class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                <span class="Operateur-icon">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLJi9U1dG-aKqZeuCTBrHUvMX8IpAcxqpp1A&s" alt="MTN Money">
                                </span>
                                <span class="Operateur-text">MTN Money</span>
                            </label>
                        </div>
                        <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                            <input type="radio" name="Operateur" value="Moov_money" id="Moov" class="Operateur-input">
                            <label for="Moov" class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                <span class="Operateur-icon">
                                    <img src="https://play-lh.googleusercontent.com/P0fu0Qo5Y7JjS6duZRTa8Z5KJCbNDiHo1W714pz9qN9IoX8ufR0L7SE_FkDUWpZZRi_x=w240-h480-rw" alt="Moov Money">
                                </span>
                                <span class="Operateur-text">Moov Money</span>
                            </label>
                        </div>

                    </div>
                    <div class="col-12 d-flex justify-content-center mt-4">
                        <span id="clearChoise" class="">Supprimer mon choix</span>
                    </div>
                </div>
                
                <div class="row" id="Operateur-btn">
                    <div class="col-6 d-flex justify-content-start gap-3">
                        <button class="btn btn-primary prev-btn" type="button" data-prev="etapePrest2">
                            <i class='bx bx-left-arrow-alt fs-4'></i> Retour
                        </button>
                    </div>
                    <div class="col-6 d-flex justify-content-end gap-3">
                        <button class="btn btn-primary next-btn" id="nextPhone" type="button" data-next="etapePrest4">
                          Suivant <i class='bx bx-right-arrow-alt fs-4'></i>
                        </button>
                    </div>   
                </div>
            </div>
            <div class="etapePrest d-none" id="etapePrest4">
                <div class="row g-3 mb-3" id="TelephonePaiement">
                    <div class="col-12 col-lg-6">
                        <label for="TelPaiement" class="form-label">N° de téléphone sur lequel vous souhaitez recevoir le paiement <span class="star">*</span></label>
                        <input type="number" class="form-control" name="TelPaiement" id="TelPaiement" placeholder="Veuillez saisir le N° de téléphone sur lequel vous souhaitez recevoir le paiement">
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="ConfirmTelPaiement" class="form-label">Confirmer le N° de téléphone <span class="star">*</span></label>
                        <input type="number" class="form-control" name="ConfirmTelPaiement" id="ConfirmTelPaiement" placeholder="Veuillez resaisir le N° de téléphone sur lequel vous souhaitez recevoir le paiement">
                    </div>
                    <small><span class="form-label star"><i>Veuillez préciser l'indicatif du pays sans le (<strong>+</strong>) et sans espace (ex: <strong>2250100128271</strong>) </i></span></small>
                </div>
                <div class="row g-3 mb-3" id="IBANPaiement">
                    <div class="col-12 col-lg-6">
                        <label for="IBAN" class="form-label">IBAN sur lequel vous souhaitez recevoir le paiement <span class="star">*</span></label>
                        <input type="text" class="form-control" name="IBAN" id="IBAN" placeholder="Veuillez saisir l'IBAN sur lequel vous souhaitez recevoir le paiement">
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="ConfirmIBAN" class="form-label">Confirmer l'IBAN <span class="star">*</span></label>
                        <input type="text" class="form-control" name="ConfirmIBAN" id="ConfirmIBAN" placeholder="Veuillez resaisir l'IBAN sur lequel vous souhaitez recevoir le paiement">
                    </div> 
                    <small><span class="form-label star"><i>Veuillez saisir l'IBAN de votre compte courant </i></span></small>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label for="AutresInfos" class="form-label">Avez-vous d'autres informations suplementaires a fournir pour votre demande ? (<span class="star">max 400 caractères </span>)</label>
                        <textarea class="form-control" name="msgClient" id="AutresInfos" rows="5" placeholder="Veuillez saisir d'autres informations suplementaires a fournir pour pour votre demande"></textarea>
                        <div style="float: left;">
                            <span id="totalChar" class="fs-6 text-muted"> 400 caractères autorisés :</span>
                            <small><i id="counterror" class="text-danger"></i></small>
                            <small><i id="countesucces" class="text-success"></i></small>
                        </div>
                        <div style="float: right;">
                            <span id="totalMot" class="text-muted">0 mots saisis</span>
                        </div>
                    </div>
                </div>
                
                <div class="row" id="btn-TelephonePaiement">
                    <div class="col-6 d-flex justify-content-start gap-3">
                        <button class="btn btn-primary prev-btn" type="button" data-prev="etapePrest3">
                            <i class='bx bx-left-arrow-alt fs-4'></i> Retour
                        </button>
                    </div>
                    <div class="col-6 d-flex justify-content-end gap-3">
                        <button class="btn btn-primary next-btn" type="button" data-next="etapePrest5">
                          Suivant <i class='bx bx-right-arrow-alt fs-4'></i>
                        </button>
                    </div>   
                </div>
                
                <div class="row" id="btn-IBANPaiement">
                    <div class="col-6 d-flex justify-content-start gap-3">
                        <button class="btn btn-primary prev-btn" type="button" data-prev="etapePrest2">
                            <i class='bx bx-left-arrow-alt fs-4'></i> Retour
                        </button>
                    </div>
                    <div class="col-6 d-flex justify-content-end gap-3">
                        <button class="btn btn-primary next-step-btn1" type="button">
                            étape 3<i class='bx bx-right-arrow-alt ms-2 fs-4'></i>
                        </button>
                    </div>   
                </div>
            </div> 
            <div class="etapePrest d-none" id="etapePrest5">
                <div class="row g-3 mb-3 text-center" id="OTP">
                    <span class="form-label">Un code de confirmation a été envoyé pas SMS, veuillez le rentrer ci-dessous</span>
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <div class="otp-container">
                            <input type="text" class="otp-input" name="otp_1" maxlength="1">
                            <input type="text" class="otp-input" name="otp_2" maxlength="1">
                            <input type="text" class="otp-input" name="otp_3" maxlength="1">
                            <input type="text" class="otp-input" name="otp_4" maxlength="1">
                            <input type="text" class="otp-input" name="otp_5" maxlength="1">
                            <input type="text" class="otp-input" name="otp_6" maxlength="1">
                        </div>
                    </div>
                    

                    <div class="otp-timer" id="otp-timer">
                       {{-- afficher le deconte ici  --}} 
                    </div>
                        <a href="#" class="d-none resend-otp-link">Renvoyer l'OTP</a>
                    </div>
                {{-- <div >
                    <button class="btn2 border-btn2 prev-btn" type="button" data-prev="etapePrest4">
                        <i class='bx bx-left-arrow-alt fs-4'></i>
                    </button>
                    
                </div> --}}
                <div class="row" id="btn-otp">
                    <div class="col-6 d-flex justify-content-start gap-3">
                        
                    </div>
                    <div class="col-6 d-flex justify-content-end gap-3">
                        <button class="btn btn-primary px-4 next-step-btn2" type="button">étape 3<i class='bx bx-right-arrow-alt ms-2 fs-4'></i></button>
                    </div>   
                </div>
            </div>
            
            {{-- <div class="row g-3">
                
                <div class="col-12">
                    <div class="d-flex align-items-center gap-3">
                        
                    </div>
                </div>
            </div> --}}
        </div>
    </div> 
  </div>