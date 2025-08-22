document.addEventListener("DOMContentLoaded", function () {
    // Références aux champs de saisie et aux éléments d'affichage
    const civiliteInputs = document.querySelectorAll('input[name="civilite"]');
    const nomInput = document.querySelector('input[name="nom"]');
    const prenomInput = document.querySelector('input[name="prenom"]');
    const birthdayInput = document.querySelector('input[name="datenaissance"]');



    $('#lieunaissance').on("select2:select", function(e) {
        let selectedValue = e.params.data.text;
        console.log("Lieu de naissance sélectionné :", selectedValue);
        $("#displayLieuNaissance").text(selectedValue);
    });

    $('#lieuresidence').on("select2:select", function(e) {
        let selectedValue = e.params.data.text;
        console.log("Lieu de résidence sélectionné :", selectedValue);
        $("#displayResidence").text(selectedValue);
    });
    $('#profession').on("select2:select", function(e) {
        let selectedValue = e.params.data.text;
        $("#displayProfession").text(selectedValue);
    });
    $('#employeur').on("select2:select", function(e) {
        let selectedValue = e.params.data.text;
        $("#displayEmployeur").text(selectedValue);
    });


    const naturepieceInputs = document.querySelectorAll('input[name="naturepiece"]');
    const numeropieceInput = document.querySelector('input[name="numeropiece"]');
    const sexeInput = document.querySelector('input[name="sexe"]');

    const emailInput = document.querySelector('input[name="email"]');

    const mobileInput = document.querySelector('input[name="mobile"]');

    const mobile1Input = document.getElementById('mobile1');
    const telephoneInput = document.getElementById('telephone');
    const displayTelephone = document.getElementById('displayTelephone');
    const displayMobile1 = document.getElementById('displayMobile1');

    if (mobile1Input) {
        mobile1Input.addEventListener('input', () => {
            displayMobile1.textContent = mobile1Input.value.trim() || '--';
        });
    }

    if (telephoneInput) {
        telephoneInput.addEventListener('input', () => {
            displayTelephone.textContent = telephoneInput.value.trim() || '--';
        });
    }

   

   
    const dureePayInput = document.querySelectorAll('input[name="duree"]');

    const periodiciteRadios = document.querySelectorAll('input[name="periodicite"]');
    const dateEffetInput = document.querySelector('input[name="dateEffet"]');
    const primeInput = document.querySelector('input[name="primepricipale"]');
    const fraisAdhesionInput = document.querySelector('input[name="fraisadhesion"]');
    const capitalInput = document.querySelector('input[name="capital"]');
    const banqueSelect = document.querySelector('select[name="organisme"]');

    // const agenceSelect = document.querySelector('select[name="agence"]');

    $('#Agence').on("change", function(e) {
        $("#displayAgence").text(this.value);
    });

    const numeroCompteInput = document.getElementById('Matricule');

    if (numeroCompteInput) {
        numeroCompteInput.addEventListener('input', () => {
            displayNumeroCompte.textContent = numeroCompteInput.value.trim() || '--';
        });
    }


    const numMobileInput = document.querySelector('input[name="numMobile"]');



    // Références aux éléments d'affichage
    const displayCivility = document.getElementById('displayCivility');
    const displayNom = document.getElementById('displayNom');
    const displayPrenom = document.getElementById('displayPrenom');
    const displayBirthday = document.getElementById('displayBirthday');
    
    const displayNaturepiece = document.getElementById('displayNaturepiece');
    const displayNumPiece = document.getElementById('displayNumPiece');
    
    const displaySexe = document.getElementById('displaySexe');
    const displayEmail = document.getElementById('displayEmail');
    const displayMobile = document.getElementById('displayMobile');

    
    // const displayDureePay = document.getElementById('displayDureePay');
    const displayOrganisme = document.getElementById('displayOrganisme');
    const displayAgence = document.getElementById('displayAgence');
    const displayDateEffet = document.getElementById('displayDateEffet');
    const displayPrimePrincipale = document.getElementById('displayPrimePrincipale');
    const displayFraisAdhesion = document.getElementById('displayFraisAdhesion');
    const displayCapital = document.getElementById('displayCapital');
    const displayPeriodicite = document.getElementById('displayPeriodicite');
    const displayNumMobile = document.getElementById('displayNumMobile');

    // Mise à jour dynamique des valeurs affichées
    civiliteInputs.forEach(input => {
        input.addEventListener('change', () => {
            displayCivility.textContent = input.checked ? input.value : 'null';
        });
    });

    if (nomInput) {
        nomInput.addEventListener('input', () => {
            displayNom.textContent = nomInput.value || 'Null';
        });
    }

    if (prenomInput) {
        prenomInput.addEventListener('input', () => {
            displayPrenom.textContent = prenomInput.value || 'Null';
        });
    }

    if (birthdayInput) {
        birthdayInput.addEventListener('input', () => {
            displayBirthday.textContent = birthdayInput.value || 'Null';
        });
    }

    naturepieceInputs.forEach(input => {
        input.addEventListener('change', () => {
            displayNaturepiece.textContent = input.checked ? input.value : 'null';
        });
    });

    if (numeropieceInput) {
        numeropieceInput.addEventListener('input', () => {
            displayNumPiece.textContent = numeropieceInput.value || 'Null';
        });
    }

    


    if (sexeInput) {
        sexeInput.addEventListener('input', () => {
            displaySexe.textContent = sexeInput.value || 'Null';
        });
    }

    // if (professionSelect) {
    //     professionSelect.addEventListener('change', () => {
    //         displayProfession.textContent = professionSelect.value || 'Null';
    //     });
    // }

    // if (employeurSelect) {
    //     employeurSelect.addEventListener('change', () => {
    //         displayEmployeur.textContent = employeurSelect.value || 'Null';
    //     });
    // }

    if (emailInput) {
        emailInput.addEventListener('input', () => {
            displayEmail.textContent = emailInput.value || 'Null';
        });
    }

    if (mobileInput) {
        mobileInput.addEventListener('input', () => {
            displayMobile.textContent = mobileInput.value || 'Null';
        });
    }

    // if (mobile1Input) {
    //     mobile1Input.addEventListener('input', () => {
    //         displayMobile1.textContent = mobile1Input.value || 'Null';
    //     });
    // }

    // if (telephoneInput) {
    //     telephoneInput.addEventListener('input', () => {
    //         displayTelephone.textContent = telephoneInput.value || 'Null';
    //     });
    // }

  
 // Assure-toi que cet élément existe

    const modePaiementRadios = document.querySelectorAll('input[name="modepaiement"]');
    const displayModePaiement = document.getElementById('displayModePaiement');

    modePaiementRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            const selectedRadio = document.querySelector('input[name="modepaiement"]:checked'); // Trouve le radio sélectionné
            displayModePaiement.textContent = selectedRadio ? selectedRadio.value : 'Null';
        });
    });


    banqueSelect.addEventListener('change', () => {
        displayOrganisme.textContent = banqueSelect.value || 'Null';
    });

    // Mise à jour de l'agence
    agenceSelect.addEventListener('change', () => {
        displayAgence.textContent = agenceSelect.value || 'Null';
    });

  

    // Mise à jour de la date d'effet
    dateEffetInput.addEventListener('input', () => {
        displayDateEffet.textContent = dateEffetInput.value || 'Null';
    });

    // Mise à jour de la prime principale
    primeInput.addEventListener('input', () => {
        displayPrimePrincipale.textContent = primeInput.value || 'Null';
    });

    // Mise à jour des frais d'adhésion
    fraisAdhesionInput.addEventListener('input', () => {
        displayFraisAdhesion.textContent = fraisAdhesionInput.value || 'Null';
    });

    // Mise à jour du capital
    capitalInput.addEventListener('input', () => {
        displayCapital.textContent = capitalInput.value || 'Null';
    });

    // Mise à jour de la périodicité
    periodiciteRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            displayPeriodicite.textContent = radio.value || 'Null';
        });
    });

    numMobileInput.addEventListener('input', () => {
        displayNumMobile.textContent = numMobileInput.value || 'Null';
    });



    
});