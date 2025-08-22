<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulletin individuel d'adhesion</title>
</head>
<body>
    <style>
        input {
            font-size: 20px;
            color: #000;
        }
        td {
            padding: 3px !important;
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
    </style>

    @php
        $dateNow = now();
        $formattedDate = $dateNow->format('m/Y');

        $primeTotal = ($pret->primeobseque ?? 0) + ($pret->prime ?? 0);
    @endphp


    <div class="a4-container" style=" width: 100%; margin: 0 auto">
        <section>
            <div class="container1_1 row" style="width: 100%; align-items: center">

             <div style="width: 25%; float: left; justify-content: start">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/logo.png'))) }}" alt="Logo" style="width: 100px">
             </div>
             <div style="width: 50%; float: center; margin-left: 170px">
                <center>
                    <h2>BULLETIN INDIVIDUEL D'ADHESION</h2>
                    <H3 style="margin-top: 5px">DEMANDE INDIVIDUEL D'AFILIATION AU PRET</H3>

                    <div style="border: 1px solid black; text-align: center; padding: 5px; margin-top: 5px">
                        N° : YAAV-{{ $formattedDate }}-{{ $pret->id ?? 0 }}
                    </div>
                </center>
             </div>
             <div style="width: 25%; float: right; margin-right: -60px">
                {{-- <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('logos/CORIS.png'))) }}" alt="Logo" style="width: 100px"> --}}
                <img src="data:image/jpeg;base64,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" alt="" width="100px">
             </div>
    
            </div>
        </section>

        <section style="margin-top: 70px ">
            <div>
                Je soussigné {{ $pret->adherent->nom }} {{ $pret->adherent->prenom }} demande mon affiliation à l'assurance en référence et désigne comme bénéficiaire de ladite Assurance la CONTRACTANTE ci-après désigné : {{ Auth::user()->membre->nom }} {{ Auth::user()->membre->prenom}}
            </div>
             <div style="float: right; margin-top: -5px ">
                <strong>Conseiller :</strong> <span>{{ Auth::user()->membre->nom }} {{ Auth::user()->membre->prenom}}</span>
             </div>
        </section>

        <section>
            <div class="container">

                <div class="aderent" style="margin-top: 18px; border: 1px solid #ccc; background-color: #7471716e; height: 18px">
    
                    <h4 style="color: #000000; font-size: 13px; margin-left: 5px">1. ADHERENT / ASSURE(E) :</h4>
    
                </div>
    
                <div class="adherent" style="margin-top: 5px; width: 100%">

                    <div style="width: 50%; float: left;">
                        <div class="civilite" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Civilité :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->civilite }}</span>
                        </div>

                        <div class="name" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Nom et Prénoms :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->nom }} {{ $pret->adherent->prenom }}</span>
                        </div>

                        <div class="bithday" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Né(e) le :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->datenaissance }}</span>
                        </div>

                        <div class="lieu" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>A :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->lieunaissance }}</span>
                        </div>
                        <div class="cni" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>N° CNI :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->numeropiece }}</span>
                        </div>
                    </div>

                    <div style="width: 50%; float: right;">
                        <div class="profession" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Profession :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->profession }}</span>
                        </div>

                        <div class="Mobile" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Mobile :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->mobile }}</span>
                        </div>

                        <div class="telephone" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Téléphone :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->telephone }}</span>
                        </div>

                        <div class="email" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Email :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->email }}</span>
                        </div>

                        <div class="adresse" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Adresse :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->adherent->lieuresidence }}</span>
                        </div>

                    </div>
                
                </div>
                
    
            </div>
        </section>
        <hr style="display:flex;margin-top: 105px; margin-bottom: -110px">

        <section style="margin-top: 120px">
            <div style="width: 100%">
                <div style="width: 40%; float: left;">
                    <div class="civilite" style="position: relatie; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolte; left: 0;"><strong>Type de pret :</strong></label>
                        <span style="position: absoute; right: 60;">{{ $pret->typepret }}</span>
                    </div>
                </div>
                <div style="width: 30%; float: left;">
                    <div class="civilite" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolute; left: 0;"><strong>Durée du pret (mois) :</strong></label>
                        <span style="position: absolute; right: 60;">{{ $pret->duree }}</span>
                    </div>
                </div>
                <div style="width: 30%; float: right;">
                    <div class="civilite" style="position: reltive; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absoute; left: 0;"><strong>Montant du pret (Fcfa) :</strong></label>
                        <span style="position: absolute;">{{ $pret->montantpret }}</span>
                    </div>
                </div>

            </div>
            <div style="width: 100%; margin-top: 25px;">
                <div style="width: 40%; float: left;">
                    <div class="civilite" style="position: relatie; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolte; left: 0;"><strong>Mise en place prévue le :</strong></label>
                        <span style="position: absoute; right: 60;">{{ $pret->effetgarantie }}</span>
                    </div>
                </div>
                <div style="width: 30%; float: left;">
                    <div class="civilite" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absolute; left: 0;"><strong>Mise en effective :</strong></label>
                        <span style="position: absolute; right: 60;">----</span>
                    </div>
                </div>
                <div style="width: 30%; float: right;">
                    <div class="civilite" style="position: reltive; font-size: 12px; margin-bottom: 10px; height: 12px;">
                        <label for="" style="position: absoute; left: 0;"><strong>Ref :</strong></label>
                        <span style="position: absolute;">------</span>
                    </div>
                </div>

            </div>
        </section>

        <div class="prime" style="margin-top: 22px; border: 1px solid #ccc; background-color: #7471716e; height: 18px">
    
            <h4 style="color: #000000; font-size: 13px; margin-left: 5px">2. PRIMES :</h4>

        </div>

        <section style="border: 1px solid #000; min-height: 30px; padding: 3px">
            
            <div class="prime" style="margin-top: 5px; width: 100%">

                <div style="width: 40%; float: left;">
                    <div class="name" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 10px;">
                        <label for="" style="position: absolute; left: 0;"><strong>Prime principale :</strong></label>
                        <span style="position: absolute; right: 60;">{{ number_format($pret->prime, 2, ',', '.') }}</span>
                    </div>

                    
                </div>

                <div style="width: 60%; float: right;">
                   @if ($pret->primeobseque != null)
                   <div class="lieu" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px; width: 50%; float: left">
                        <label for="" style="position: absolute; left: 0;"><strong>Prime YAKO :</strong></label>
                        <span style="position: absolute; right: 60;">{{ number_format($pret->primeobseque, 2, ',', '.') }}</span>
                    </div>
                   @endif
                    <div class="cni" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px; width: 50%; float: right">
                        <label for="" style="position: absolute; left: 0;"><strong style="margin-right: 10px">PRIME TOTAL :</strong></label>
                        <span style="position: absolute; right: 60;">{{ number_format($primeTotal, 2, ',', '.') }}</span>
                    </div>

                    
                </div>
            </div>
        </section>
        <div class="benificiaire" style=" border: 1px solid #ccc; background-color: #7471716e; height: 18px">
    
            <h4 style="color: #000000; font-size: 13px; margin-left: 5px">3. BENEFICIAIRE :</h4>

        </div>
        <table border="1" class="table" style="width: 100%; font-size: 12px; text-align: left;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Nom & Prénoms</th>
                    <th>Né(e) le</th>
                    <th>Lieu de naissance</th>
                    <th>Lieu de résidence</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pret->beneficiaires->where('nom' , '!=', "Difin") as $benef)
                    <tr>
                        <td>{{ $benef->nom }} {{ $benef->prenom }}</td>
                        <td>{{ $benef->datenaissance ?? 'Non précisé' }}</td>
                        <td>{{ $benef->lieunaissance ?? 'Non précisé' }}</td>
                        <td>{{ $benef->lieuresidence ?? 'Non précisé' }}</td>
                        <td>{{ $benef->telephone ?? 'Non précisé' }}</td>
                        <td>{{ $benef->email ?? 'Non précisé' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

        <div class="questionnaire" style="margin-top: 10px; border: 1px solid #ccc; background-color: #7471716e; height: 18px">
    
            <h4 style="color: #000000; font-size: 13px; margin-left: 5px; text-transform: uppercase;">4. Questionnaire relatif à l'état de santé du proposant :</h4>

        </div>

        <section>
            <div class="container">
                <div class="question" style="margin-top: 5px; width: 100%">

                    <div style="width: 50%; float: left;">
                        <div class="civilite" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Taile (Cm) :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->sante->taille ?? '----' }}</span>
                        </div>

                        <div class="name" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Fumez-vous ? :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->sante->smoking ?? '----' }} </span>
                        </div>

                        <div class="bithday" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Vos distractions :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->distraction  ?? '----' }}</span>
                        </div>

                        <div class="lieu" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Pratiquez-vous une activité sportive ? :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->sante->sport ?? '----' }}</span>
                        </div>
                    </div>

                    <div style="width: 50%; float: right;">
                        <div class="profession" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Etes-vous en arret de travail :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->estenarrettravail ?? '----' }}</span>
                        </div>

                        <div class="Mobile" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Poids :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->sante->poids ?? '----' }}</span>
                        </div>

                        <div class="telephone" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Buvez-vous l'alcool :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->sante->alcohol ?? '----' }}</span>
                        </div>

                        <div class="email" style="position: relative; font-size: 12px; margin-bottom: 10px; height: 12px;">
                            <label for="" style="position: absolute; left: 0;"><strong>Tension arterielle :</strong></label>
                            <span style="position: absolute; right: 60;">{{ $pret->sante->tensionMin ?? '----' }}</span>
                        </div>


                    </div>
                    
                    
                
                </div>
                
    
            </div>
        </section>

        <section style="margin-top: 90px">
            <table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border-collapse: collapse; font-size: 14px; text-align: left;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="width: 10%;">#</th>
                        <th style="width: 70%;">Nature</th>
                        <th style="width: 20%;">Réponse</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 2px">1</td>
                        <td style="padding: 2px">Avez-vous déjà été victime d'un accident</td>
                        <td style="padding: 2px">{{ $pret->sante->accident ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Suivez-vous ou avez-vous suivi un traitement médical ces 6(six) derniers mois ?</td>
                        <td>{{ $pret->sante->treatment ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Avez-vous déjà subi une transfusion de sang ?</td>
                        <td>{{ $pret->sante->transSang ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Avez-vous déjà subi des interventions chirugicales ?</td>
                        <td>{{ $pret->sante->interChirugiale ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Devez-vous déjà subi des interventions chirugicales ?</td>
                        <td>{{ $pret->sante->prochaineInterChirugiale ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Diabète</td>
                        <td>{{ $pret->sante->diabetes ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Hypertension artérielle</td>
                        <td>{{ $pret->sante->hypertension ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Drépanocytose</td>
                        <td>{{ $pret->sante->sickleCell ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Cirrhose de foie</td>
                        <td>{{ $pret->sante->liverCirrhosis ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Affectations pulmonaires</td>
                        <td>{{ $pret->sante->lungDisease ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Cancer</td>
                        <td>{{ $pret->sante->cancer ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Anémie</td>
                        <td>{{ $pret->sante->anemia ?? '----' }}</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>Avez-vous déjà été victime d'un AVC ?</td>
                        <td>{{ $pret->sante->kidneyFailure ?? '----' }}</td>
                    </tr>
                </tbody>
            </table>
            
        </section>

        <section style="margin-top: 10px">
            <div>
                Je certifie, avoir répondu avec exatitude et sincérité aux questions ci-dessus,n'avoir rien déclaré ou omis qui puisse induire en erreur YAKO AFRICA et reconnait etre informé des dispositions de l'article 18 du code des assurances CIMA sanctionnant toute réticence ou fausse déclaration. je déclare avoir pris connaissance des garanties offertes par le contrat souscrit par la contractante
            </div>
        </section>
        
        <section style="margin-top: 10px">
            <div class="identiteee" style="width: 100%">
                <div style="width: 48%; float: left; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">
                    <p>Fait à ............................................... le {{ $dateNow }}</p>
                    <div class="sign-yako" style="margin-top: 8px">

                        <span>Reservé à YAKO AFRICA Assurances Vie</span>
                        <div>
                            <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('root/images/Signature_Dta.jpg'))) }}" alt="Logo" style="width: 160px">
                        </div>
                    </div>

                </div>

                <div style="width: 48%; height: 125px; float: right; border: 1px solid #000; padding: 5px; display: flex; justify-content: space-between; align-items: center;">

                    <div class="nom">

                        <label for="nom">BON POUR AUTORISATION A L'ASSURANCE ADHERENT (signature précédée de la mention LU et APPROUVE)</label>

                    </div>

                </div>
            </div>
        </section>
        
        
    </div>


</body>
</html>