<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de souscription securicompte</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <style>
        input {
            font-size: 20px;
            color: #000;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
        }

        body {
            font-family: Arial, sans-serif;
            padding-left: 35px;
            padding-right: 35px;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .chechbox {
            border: 1px solid black;
            color: #fff;
            max-width: 3px !important;
            max-height: 3px !important;
            font-size: 9px;
            margin-right: 5px;
        }
        .underline {
            text-decoration: underline;
        }
    </style>

    @php
        $productGaranti = App\Models\ProduitGarantie::where('CodeProduit',$contrat->codeproduit)->get();
    @endphp

    <div class="a4-container">
        <section>
            <div class="container1_1 row" style="width: 100%; align-items: center">
        
                <div style="width: 25%; float: left; justify-content: start">
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}" alt="Logo" style="width: 100px">
                </div>
                <div style="width: 50%; float: center; margin-left: 170px; border: 1px solid black; padding: 5px">
                    <center>
                        <h2>BULLETIN D'ADHESION SECURICOMPTE</h2>
                    </center>
                </div>
                <div style="width: 25%; float: right; margin-top: -20px; margin-right: -50px">
                    <img src="https://yop.l-frii.com/wp-content/uploads/2022/07/Guaranty-Trust-Bank-recrute-pour-ce-poste-20-Juillet-2022.png" alt="Logo" style="width: 130px">
                </div>
            </div>
        </section>
        
        <section style="margin-top: 50px">
            <div class="container1_1 row underline" style="width: 100%; align-items: center;">
                <h3>CONDITIONS PARTICULIERES CONVENTION N° 000-00</h3>
            </div>
        </section>

        <div style="width: 100%; margin-top: 30px">
            <div class="col" style="width: 50%; float: left">Agence : {{ $contrat->agence ?? '.................' }}</div>
            <div class="col" style="width: 50%; float: right; text-align: right; margin-right: 0px">Bulletin N° : {{ $contrat->numBullettin ?? '' }}</div>
        </div>

        <section style="margin-top: 20px; padding-bottom: 20px; border: 1px solid #ccc; ">
            <div class="container-fluid" style="margin-left: -10px; ">
                <div class="aderent" style="border: 1px solid #ccc; background-color: #747171; height: 18px; margin-left: 10px">
                    <h4 style="color: #fff; font-size: 13px; ">ADHERENT :</h4>
                </div>
    
                <div class="content1" style="margin-top: 10px; padding: 5px; margin-left: 10px">

                    <div class="identite" style="width: 100%">
                        <div class="civilite" style="float: left; width: 49%">
                            <label for="civilite"><strong>Genre :</strong> {{ $contrat->adherent->civilite ?? '' }}</label>
                        </div>
    
                        <div class="telephone" style="float: right; width: 49%">
                            <div class="telephone">
                                <label for="telephone"><strong>Situation Matrimoniale :</strong> 
                                    <span>
                                        <span>Céliba <span class="chechbox">aa</span></span>
                                        <span>Marié (e) <span class="chechbox">aa</span></span>
                                        <span>Veuve <span class="chechbox">aa</span></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="identite" style="width: 100%; margin-top: 25px">
                        <div class="nom" style="float: left; width: 49%">
                            <label for="nom"><strong>Nom :</strong> {{{ $contrat->adherent->nom ?? ''}}}</label>
                        </div>
    
                        <div class="prenom" style="float: right; width: 49%;">
                            <label for="prenom"><strong>Prenom :</strong> {{ $contrat->adherent->prenom ?? '' }}</label>
                        </div>
                    </div>
                    

                    <div class="identite" style="margin-top: 25px;">
    
                        <div class="bithday" style="float: left; width: 49%;">
                            <label for="bithday"><strong>Date de naissance :</strong>{{{ $contrat->adherent->datenaissance ?? ''}}}</label>
                        </div>

                        <div class="lieunaissance" style="float: right; width: 49%;">
                            <label for="lieunaissance"><strong>lieu de naissance :</strong> {{ $contrat->adherent->lieunaissance ?? '' }}</label>
                        </div>
    
                    </div>
                    <div class="identite" style="margin-top: 25px">
                        <div class="domicile" style="float: left ;width: 49%">
                            <label for="domicile"><strong>Domicile :</strong> {{ $contrat->adherent->lieuresidence ?? '' }}</label>
                        </div>
                        <div class="postal" style="float: right; width: 49%">
                            <div class="postal">
                                <label for="postal"><strong>Boite Postale :</strong> ------------</label>
                            </div>
                        </div>
                    </div>
                    <div class="identite" style="margin-top: 25px">
                        <div class="profession" style="float: left ;width: 49%">
                            <label for="profession"><strong>Profession :</strong> {{ $contrat->adherent->profession ?? '' }}</label>
                        </div>
                        <div class="employeur" style="float: right; width: 49%">
                            <div class="employeur">
                                <label for="employeur"><strong>Employeur :</strong> <span>{{ $contrat->adherent->employeur ?? '' }}</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="identite" style="margin-top: 25px">
                        <div class="numeropiece" style="float: left ;width: 49%">
                            <label for="numeropiece"><strong>CNI/Passport/Attestation d'identité :</strong> {{ $contrat->adherent->numeropiece ?? '' }}</label>
                        </div>
                        <div class="telephone" style="float: right; width: 49%">
                            <div class="telephone">
                                <label for="telephone"><strong>Téléphone / Cell :</strong> <span>{{ $contrat->adherent->telephone ?: $contrat->adherent->mobile }}</span></label>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </section>


        <fieldset class="" style="border: 1px solid #ccc; padding: 1rem; margin-top: 30px">
            <legend class="float-none w-auto px-2" style="float: none; width: auto; font-size: 0.875rem; border: 1px solid #ccc; padding: 5px">
                <small style="">GARANTIES SOUSCRITES ET PRIMES D'ASSURANCE</small>
            </legend>

            <div class="garantie " style="margin-top: 20px">
                <strong class="underline">
                    Garanties
                </strong>

                <div style="margin-left: 65px; margin-top: -10px">
                    @foreach ($productGaranti as $item)
                        <span>{{ $item->MonLibelle }}</span>
                    @endforeach
                </div>
            </div>
            <div class="prime " style="margin-top: 10px">
                <div>
                    <strong class="underline">
                        Prime annuelle d'assurance :
                    </strong>
                </div>
                <div style="margin-left: 170px; margin-top: -28px">
                    {{ number_format($contrat->prime, 2, ',', ' ') }} <span>F CFA</span> <span>({{ nombreEnLettre($contrat->prime) }} Franc cfa) </span>
                </div>
                <div style="margin-top: 15px">
                    Cette prime sera prélévée mensuellement sur le compte d'épargne du client à raison de  
                    <span class="underline">{{ number_format($contrat->prime, 2, ',', ' ') }}FCFA par mois</span>
                </div>
            </div>

            <div style="margin-top: 20px">
                <strong style="margin-right: 10px">N° du compte de prélevement</strong>  

                
                <div style="width: 100%; margin-top: -8px; margin-left: 200px; margin-bottom: 30px">
                    <div style="width : 20%; float: left; justify-content: space-between">
                        <div class="underline">{{ $contrat->codeguichet ?? "-----------------------"}}</div>
                        <div>(Code guichet)</div>
                    </div>
                    <div style="width : 60%">
                        <div style="float: left; width: 60%; justify-content: space-between">
                            <div class="underline">{{ $contrat->numerocompte ?? "----------------------------------------"}}</div>
                            <div >(N° Compte)</div>
                        </div>
                        <div style="width : 30%; float: right; margin-right: -80px">
                            <div class="underline">{{ $contrat->rib ?? "----------------------"}}</div>
                            <div>(Clé RIB)</div>
                        </div>
                    </div>
                    
                </div>
            </div>

        </fieldset>


        <fieldset class="" style="border: 1px solid #ccc; padding: 1rem; margin-top: 30px">
            <legend class="float-none w-auto px-2" style="float: none; width: auto; font-size: 0.875rem; border: 1px solid #ccc; padding: 5px">
                <small style="">INFORMATIONS GENERALES DU CLIENT</small>
            </legend>
        
            <div style="margin-top: 20px">
                Après avoir pris connaissance  du résumé des conditions générale de <strong>SECURICOMPTE</strong> au verso de la présente, <br>
                je déclare adherer à ce contrat suivant les caractéristiques indiquées ci-dessus. <br>
                Je déclare avoir reçu un exemplaire du présent document résumant les conditions générales du contrat SECURICOMPTE.
            </div>
        </fieldset>

        <section>
            <div class="fait" style="width: 100%; margin-top: 10px">

                <label for="fait">Fait à : ......................................................................le...........................................................................</label>

            </div>
        </section>

        <section style="margin-top: 30px">
            <div class="identiteee row" style="width: 100%">
                <div class="col-4" style="width: 30%; float: left;  justify-content: center">

                    <div class="nom">
                        <label for="nom"><strong class="underline">L'ADHERENT </strong></label> <br>
                        <span>(signature précedée de la mention <br>
                        "Lu et Approuvé")</span>
                    </div>

                </div>

                <div class="col-4"  style="margin-left: 280px;float: center;">

                    <div class="nom">

                        <label for="nom"><strong class="underline">POUR GT BANK </strong></label>


                    </div>

                </div>
                <div class="col-4"  style="width: 30%; float: right;">

                    <div class="sign-yako">

                        <strong class="underline">POUR L'ASSUREUR</strong>
                        <div>
                            <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/Signature_Dta.jpg'))) }}" alt="Logo" style="width: 200px">
                        </div>
                    </div>

                </div>
            </div>
        </section>

       

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>



</html>

