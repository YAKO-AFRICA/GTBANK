// Debut js perso prestation


document.addEventListener('DOMContentLoaded', function() {
    // Récupérer les éléments du DOM
    const operateurInputs = document.querySelectorAll('input[name="Operateur"]');
    const telPaiementInput = document.getElementById('TelPaiement');
    const confirmTelPaiementInput = document.getElementById('ConfirmTelPaiement');

    let selectedOperateur = ""; // Variable pour stocker l'opérateur sélectionné

    // Ajouter un écouteur pour chaque input radio
    operateurInputs.forEach(input => {
        input.addEventListener('change', function() {
            let prefix = "";
            selectedOperateur = this.value; // Mettre à jour l'opérateur sélectionné
            switch (this.value) {
                case "Orange_money":
                    prefix = "07";
                    break;
                case "MTN_money":
                    prefix = "05";
                    break;
                case "Moov_money":
                    prefix = "01";
                    break;
            }
            if (prefix) {
                telPaiementInput.value = prefix;
                confirmTelPaiementInput.value = prefix;
            }
        });
    });

    // Fonction pour vérifier le préfixe en fonction de l'opérateur
    const validatePrefix = (input) => {
        const value = input.value;
        let requiredPrefix = "";

        switch (selectedOperateur) {
            case "Orange_money":
                requiredPrefix = "07";
                break;
            case "MTN_money":
                requiredPrefix = "05";
                break;
            case "Moov_money":
                requiredPrefix = "01";
                break;
        }

        if (!value.startsWith(requiredPrefix)) {
            const message = `Le numéro saisi doit commencer par ${requiredPrefix} pour ${selectedOperateur.replace('_', ' ')}.`;
            alert(message);
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    };

    // Ajouter l'événement 'blur' pour valider le préfixe uniquement
    [telPaiementInput, confirmTelPaiementInput].forEach(input => {
        input.addEventListener('blur', function() {
            validatePrefix(this);
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.etaperdv'); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll('.next-btn'); // Boutons "Next"
    const submitdrvButtons = document.querySelectorAll('.submitdrv-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll('.prev-btn'); // Boutons "Prev"
    // const telPaiementField = document.getElementById('TelPaiement');
    // const confirmTelPaiementField = document.getElementById('ConfirmTelPaiement');

    // Fonction pour valider les champs obligatoires dans une étape donnée
    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll('input, textarea, select'); // Tous les champs de l'étape

        allFields.forEach(field => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid'); // Ajouter une classe pour indiquer une erreur
                field.classList.remove('is-valid'); // Retirer la classe valide
            } else {
                field.classList.remove('is-invalid'); // Retirer la classe d'erreur
                field.classList.add('is-valid'); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }

    // Fonction pour valider les champs de téléphone
    // function validateTelFields() {
    //     const telValue = telPaiementField.value.trim();
    //     const confirmTelValue = confirmTelPaiementField.value.trim();

    //     let isValid = true;

    //     // Vérifier que les deux champs ne sont pas vides
    //     if (!telValue || !confirmTelValue) {
    //         isValid = false;
    //     }

    //     // Vérifier que les deux valeurs correspondent
    //     if (telValue !== confirmTelValue) {
    //         isValid = false;
    //         telPaiementField.classList.add('is-invalid');
    //         confirmTelPaiementField.classList.add('is-invalid');
    //     } else {
    //         telPaiementField.classList.remove('is-invalid');
    //         confirmTelPaiementField.classList.remove('is-invalid');
    //     }

    //     // Vérifier le format du numéro (exemple : 10 chiffres)
    //     const phoneRegex = /^[0-9]{10}$/; // Modifier selon le format attendu
    //     if (!phoneRegex.test(telValue)) {
    //         isValid = false;
    //         telPaiementField.classList.add('is-invalid');
    //     } else {
    //         telPaiementField.classList.remove('is-invalid');
    //     }

    //     return isValid;
    // }

    // Gestionnaire pour les boutons "Next"
    nextButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etaperdv'); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

            // // Vérifier si on est sur l'étape contenant les champs de téléphone
            // if (currentContainer.contains(telPaiementField)) {
            //     if (!validateTelFields()) {
            //         alert("Veuillez vérifier que les numéros de téléphone sont conformes.");
            //         return; // Arrêter si les champs ne sont pas valides
            //     }
            // }

            if (validateStep(currentContainer)) {
                // Si les champs sont valides, attendre 1 seconde avant de passer à l'étape suivante
                setTimeout(() => {
                    currentContainer.classList.add('d-none');
                    nextStep.classList.remove('d-none');
                }, 1000); // 1 seconde
            }
        });
    });
    submitdrvButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etaperdv'); // Étape actuelle

            // // Vérifier si on est sur l'étape contenant les champs de téléphone
            // if (currentContainer.contains(telPaiementField)) {
            //     if (!validateTelFields()) {
            //         alert("Veuillez vérifier que les numéros de téléphone sont conformes.");
            //         return; // Arrêter si les champs ne sont pas valides
            //     }
            // }

            if (validateStep(currentContainer)) {
                // Si les champs sont valides, attendre 1 seconde avant de soumettre le formulair
                setTimeout(() => {
					return;
                }, 1000); // 1 seconde
            }
        });
    });

    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etaperdv'); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add('d-none');
            prevStep.classList.remove('d-none');
        });
    });
});

// document.addEventListener('DOMContentLoaded', function () {
//     const steps = document.querySelectorAll('.etape, .etapePrest, .etaperdv'); // Sélectionner toutes les étapes
//     const nextButtons = document.querySelectorAll('.next-btn'); // Boutons "Next"
//     const submitdrvButtons = document.querySelectorAll('.submitdrv-btn'); // Boutons "Next"
//     const prevButtons = document.querySelectorAll('.prev-btn'); // Boutons "Prev"
//     const telPaiementField = document.getElementById('TelPaiement');
//     const confirmTelPaiementField = document.getElementById('ConfirmTelPaiement');

//     // Fonction pour valider les champs obligatoires dans une étape donnée
//     function validateStep(step) {
//         let isValid = true;
//         const allFields = step.querySelectorAll('input, textarea, select'); // Tous les champs de l'étape

//         allFields.forEach(field => {
//             if (field.required && !field.value.trim()) {
//                 isValid = false;
//                 field.classList.add('is-invalid'); // Ajouter une classe pour indiquer une erreur
//                 field.classList.remove('is-valid'); // Retirer la classe valide
//             } else {
//                 field.classList.remove('is-invalid'); // Retirer la classe d'erreur
//                 field.classList.add('is-valid'); // Ajouter une classe pour indiquer la validité
//             }
//         });

//         return isValid;
//     }

//     // Fonction pour valider les champs de téléphone
//     function validateTelFields() {
//         const telValue = telPaiementField.value.trim();
//         const confirmTelValue = confirmTelPaiementField.value.trim();

//         let isValid = true;

//         // Vérifier que les deux champs ne sont pas vides
//         if (!telValue || !confirmTelValue) {
//             isValid = false;
//         }

//         // Vérifier que les deux valeurs correspondent
//         if (telValue !== confirmTelValue) {
//             isValid = false;
//             telPaiementField.classList.add('is-invalid');
//             confirmTelPaiementField.classList.add('is-invalid');
//         } else {
//             telPaiementField.classList.remove('is-invalid');
//             confirmTelPaiementField.classList.remove('is-invalid');
//         }

//         // Vérifier le format du numéro (exemple : 10 chiffres)
//         const phoneRegex = /^[0-9]{13}$/; // Modifier selon le format attendu
//         if (!phoneRegex.test(telValue)) {
//             isValid = false;
//             telPaiementField.classList.add('is-invalid');
//         } else {
//             telPaiementField.classList.remove('is-invalid');
//         }

//         return isValid;
//     }

//     // Fonction pour soumettre l'OTP
//     async function sendOtp(phoneNumber) {
//         try {
//             const response = await fetch('/api/send-otp', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                 },
//                 body: JSON.stringify({ TelPaiement: phoneNumber }),
//             });

//             const result = await response.json();

//             if (response.ok) {
//                 alert(`Un message de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
//                 return true;
//             } else {
//                 alert(result.error || "Une erreur s'est produite lors de l'envoi de l'OTP.");
//                 return false;
//             }
//         } catch (error) {
//             alert("Une erreur s'est produite lors de l'envoi de l'OTP.");
//             console.error(error);
//             return false;
//         }
//     }

//     // Gestionnaire pour les boutons "Next"
//     nextButtons.forEach(button => {
//         button.addEventListener('click', async function () {
//             const currentContainer = this.closest('.etape, .etapePrest, .etaperdv'); // Étape actuelle
//             const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante

//             // Vérifier si on est sur l'étape contenant les champs de téléphone
//             if (currentContainer.contains(telPaiementField)) {
//                 if (!validateTelFields()) {
//                     alert("Veuillez vérifier que les numéros de téléphone sont conformes.");
//                     return; // Arrêter si les champs ne sont pas valides
//                 }

//                 // Envoyer l'OTP
//                 const phoneNumber = telPaiementField.value.trim();
//                 const otpSent = await sendOtp(phoneNumber);

//                 if (!otpSent) {
//                     return; // Arrêter si l'OTP n'a pas pu être envoyé
//                 }
//             }

//             if (validateStep(currentContainer)) {
//                 // Si les champs sont valides, attendre 1 seconde avant de passer à l'étape suivante
//                 setTimeout(() => {
//                     currentContainer.classList.add('d-none');
//                     nextStep.classList.remove('d-none');
//                 }, 1000); // 1 seconde
//             }
//         });
//     });

//     // Gestionnaire pour les boutons "Prev"
//     prevButtons.forEach(button => {
//         button.addEventListener('click', function () {
//             const currentContainer = this.closest('.etape, .etapePrest, .etaperdv'); // Étape actuelle
//             const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

//             currentContainer.classList.add('d-none');
//             prevStep.classList.remove('d-none');
//         });
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.etape, .etapePrest'); // Sélectionner toutes les étapes
    const nextButtons = document.querySelectorAll('.next-btn'); // Boutons "Next"
    const submitdrvButtons = document.querySelectorAll('.submitdrv-btn'); // Boutons "Next"
    const prevButtons = document.querySelectorAll('.prev-btn'); // Boutons "Prev"
    const telPaiementField = document.getElementById('TelPaiement');
    const confirmTelPaiementField = document.getElementById('ConfirmTelPaiement');
    const otpContainer = document.getElementById('OTP');
    const resendOtpLink = document.querySelector('.resend-otp-link');
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpTimer = document.createElement('div'); // Timer pour afficher le compte à rebours
    const montantSouhaite = document.getElementById('montantSouhaite');

    // Fonction pour valider les champs obligatoires dans une étape donnée
    function validateStep(step) {
        let isValid = true;
        const allFields = step.querySelectorAll('input, textarea, select'); // Tous les champs de l'étape

        allFields.forEach(field => {
            if (field.required && !field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid'); // Ajouter une classe pour indiquer une erreur
                field.classList.remove('is-valid'); // Retirer la classe valide
            } else {
                field.classList.remove('is-invalid'); // Retirer la classe d'erreur
                field.classList.add('is-valid'); // Ajouter une classe pour indiquer la validité
            }
        });

        return isValid;
    }

    // Fonction pour valider les champs de téléphone
    function validateTelFields() {
        const telValue = telPaiementField.value.trim();
        const confirmTelValue = confirmTelPaiementField.value.trim();

        let isValid = true;

        // Vérifier que les deux champs ne sont pas vides
        if (!telValue || !confirmTelValue) {
            isValid = false;
        }

        // Vérifier que les deux valeurs correspondent
        if (telValue !== confirmTelValue) {
            isValid = false;
            telPaiementField.classList.add('is-invalid');
            confirmTelPaiementField.classList.add('is-invalid');
        } else {
            telPaiementField.classList.remove('is-invalid');
            confirmTelPaiementField.classList.remove('is-invalid');
        }

        // Vérifier le format du numéro (exemple : 13 chiffres)
        const phoneRegex = /^[0-9]{10}$/; // Modifier selon le format attendu
        if (!phoneRegex.test(telValue)) {
            isValid = false;
            telPaiementField.classList.add('is-invalid');
        } else {
            telPaiementField.classList.remove('is-invalid');
        }

        return isValid;
    }

    // Fonction pour soumettre l'OTP
    async function sendOtp(phone) {
        let phoneNumber = '225' + phone;
        let firstTwoDigits = phone.substring(0, 2); // Extraire les deux premiers chiffres de phone

        if (firstTwoDigits == '07' || firstTwoDigits == '05') {
            try {
                const response = await fetch('/api/send-otpByOrangeAPI', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ TelPaiement: phoneNumber }),
                });
    
                const result = await response.json();
    
                if (response.ok) {
                    alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
                    startOtpTimer(); // Démarrer le décompte après l'envoi de l'OTP
                    return true;
                } else {
                    alert(result.error || "Une erreur s'est produite lors de l'envoi du code de confirmation.");
                    return false;
                }
            } catch (error) {
                alert("Une erreur s'est produite lors de l'envoi du code de confirmation.");
                console.error(error);
                return false;
            }
        }else if (firstTwoDigits == '01') {
            try {
                const response = await fetch('/api/send-otpByInfobipAPI', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ TelPaiement: phoneNumber }),
                });
    
                const result = await response.json();
    
                if (response.ok) {
                    alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
                    startOtpTimer(); // Démarrer le décompte après l'envoi de l'OTP
                    return true;
                } else {
                    alert(result.error || "Une erreur s'est produite lors de l'envoi du code de confirmation.");
                    return false;
                }
            } catch (error) {
                alert("Une erreur s'est produite lors de l'envoi du code de confirmation.");
                console.error(error);
                return false;
            }
        }
    }

    // Fonction pour démarrer le compte à rebours pour l'expiration de l'OTP
    let otpExpirationTime = 3 * 60; // 5 minutes en secondes
    let otpInterval;

    function startOtpTimer() {
        otpTimer.classList.add('otp-timer');
        otpContainer.appendChild(otpTimer); // Ajouter le timer à l'interface
        updateOtpTimer();

        otpInterval = setInterval(() => {
            otpExpirationTime--;
            updateOtpTimer();

            if (otpExpirationTime <= 0) {
                clearInterval(otpInterval);
                otpTimer.textContent = "Le code de confirmation a expiré.";
                resendOtpLink.classList.remove('d-none'); // Afficher le lien pour renvoyer l'OTP
            }
        }, 1000); // Met à jour chaque seconde
    }

    function updateOtpTimer() {
        const minutes = Math.floor(otpExpirationTime / 60);
        const seconds = otpExpirationTime % 60;
        otpTimer.textContent = `Temps restant: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    // Fonction pour renvoyer l'OTP
    resendOtpLink.addEventListener('click', async function () {
        otpExpirationTime = 3 * 60; // Réinitialiser le temps d'expiration
        clearInterval(otpInterval); // Arrêter l'ancien intervalle
        resendOtpLink.classList.add('d-none'); // Cacher le lien pendant l'envoi de l'OTP
        const phoneNumber = telPaiementField.value.trim();
        const otpSent = await sendOtp(phoneNumber);

        if (!otpSent) {
            return; // Arrêter si l'OTP n'a pas pu être envoyé
        }
        // else{
        //     startOtpTimer();
        //     alert(`Un message contenant un code de confirmation a été envoyé sur le numéro ${phoneNumber}.`);
        // }
    });

    const montantSouhaiteField = document.getElementById('montantSouhaite');
    const AutresInfos = document.getElementById('AutresInfos');
    const capitalField = document.getElementById('Capital');
    const msgError = $('#msgerror');
    const msgSuccess = $('#msgesucces');
    const countError = $('#counterror');
    const countSuccess = $('#countesucces');

    montantSouhaiteField.addEventListener('input', function () {
        const montantSouhaite = parseFloat(montantSouhaiteField.value) || 0; // Valeur saisie ou 0 si vide
        const capital = parseFloat(capitalField.value) || 0; // Valeur du capital ou 0 si vide

        // Réinitialiser les messages à chaque changement
        msgError.text('').hide();
        msgSuccess.text('').hide();
        countError.text('').hide();
        countSuccess.text('').hide();
        

        if (montantSouhaite > capital || montantSouhaite < 0) {
            msgError.text('Le montant souhaité doit être supérieur à 0 et inferieur ou égal au capital souscris.').show();
            montantSouhaiteField.classList.add('is-invalid');
            montantSouhaiteField.classList.remove('is-valid');
        } else if (montantSouhaite == null || montantSouhaite == '') {
            montantSouhaiteField.classList.remove('is-invalid');
            montantSouhaiteField.classList.remove('is-valid');
        }else if (montantSouhaite <= capital && montantSouhaite > 0) {
            msgSuccess.text('Le montant définitif sera calculé en fonction de la situation du contrat.').show();
            montantSouhaiteField.classList.remove('is-invalid');
            montantSouhaiteField.classList.add('is-valid');
        }
    });
    AutresInfos.addEventListener('input', function () {
        const charLimit = 400; // Limite en caractères
        // Compter le nombre de mots
        const wordCount = AutresInfos.value.trim().split(/\s+/).filter(word => word.length > 0).length;
        
        $('#totalMot').text(wordCount + ' mots saisis');

        const AutresInfosValue = AutresInfos.value;
        const charCount = AutresInfosValue.length; // Compter les caractères
        const remainingChars = charLimit - charCount; // Calculer les caractères restants

        // Mettre à jour le compteur des caractères restants
        $('#totalChar').text(remainingChars >= 0 ? remainingChars + ' caractères restants :' : 0 + ' caractères restants :');
        // Réinitialiser les messages
        countSuccess.text('').hide();
        countError.text('').hide();

        if (charCount === 0) {
            // Pas de texte
            AutresInfos.classList.remove('is-valid', 'is-invalid');
        } else if (charCount <= charLimit) {
            // Nombre de caractères valide
            AutresInfos.classList.add('is-valid');
            AutresInfos.classList.remove('is-invalid');
            countSuccess.text(`La zone de saisie contient ${charCount} caractères.`).show();
        } else {
            // Bloquer l'entrée de texte si la limite est atteinte
            const truncatedText = AutresInfosValue.substring(0, charLimit); // Tronquer le texte à la limite
            AutresInfos.value = truncatedText;
            AutresInfos.classList.add('is-invalid');
            AutresInfos.classList.remove('is-valid');
            countError.text(`Nombre de caractères maximum atteint (${charLimit}). La saisie est bloquée.`).show();
        }
    });

    nextButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const currentContainer = this.closest('.etape, .etapePrest'); // Étape actuelle
            const nextStep = document.querySelector(`#${this.dataset.next}`); // Étape suivante
    
            // Vérification des champs de téléphone si présents dans l'étape actuelle
            if (currentContainer.contains(telPaiementField)) {
                if (!validateTelFields()) {
                    alert("Veuillez vérifier que les numéros de téléphone sont conformes.");
                    return; // Arrêter si les champs de téléphone ne sont pas valides
                }
            }
    
            // Vérification du montant souhaité par rapport au capital
            const montantSouhaite = parseFloat(montantSouhaiteField.value) || 0;
            const capital = parseFloat(capitalField.value) || 0;
    
            if (montantSouhaite > capital || montantSouhaite < 0) {
                alert("Le montant souhaité doit être supérieur à 0 et inferieur ou égal au capital souscris.");
                msgError.text('Le montant souhaité doit être supérieur à 0 et inferieur ou égal au capital souscris.').show();
                // ajouter une bordure rouge si le montant souhaité est invalide
                montantSouhaiteField.classList.add('is-invalid');
                montantSouhaiteField.classList.remove('is-valid');
                return; // Arrêter si le montant souhaité n'est pas valide
            }
    
            // Vérification et envoi de l'OTP
            if (currentContainer.contains(telPaiementField)) {
                const phoneNumber = telPaiementField.value.trim();
                const otpSent = await sendOtp(phoneNumber);
    
                if (!otpSent) {
                    return; // Arrêter si l'OTP n'a pas pu être envoyé
                }
            }
    
            // Vérification de validation des champs pour l'étape actuelle
            if (validateStep(currentContainer)) {
                // Attendre 1 seconde avant de passer à l'étape suivante si tout est valide
                setTimeout(() => {
                    currentContainer.classList.add('d-none'); // Cacher l'étape actuelle
                    nextStep.classList.remove('d-none'); // Afficher l'étape suivante
                }, 1000); // 1 seconde
            }
        });
    });
    
    // Gestionnaire pour les boutons "Prev"
    prevButtons.forEach(button => {
        button.addEventListener('click', function () {
            const currentContainer = this.closest('.etape, .etapePrest'); // Étape actuelle
            const prevStep = document.querySelector(`#${this.dataset.prev}`); // Étape précédente

            currentContainer.classList.add('d-none');
            prevStep.classList.remove('d-none');
        });
    });
        $(document).ready(function() {
        // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
        $('#single-select-field').trigger('change');
    });
    // Intégration de la gestion du changement pour récupérer les détails du contrat
    $(document).on('change', '#single-select-field', function() {
        var idcontrat = $(this).val(); // Récupérer l'ID du contrat sélectionné
        
        montantSouhaite.disabled = false;
        if (idcontrat) {
            $.ajax({
                url: '/api/fetch-contract-details', // Route Laravel
                type: 'POST',
                data: {
                    idcontrat: idcontrat,
                    _token: '{{ csrf_token() }}'  // Le token CSRF pour sécuriser la requête
                },
                dataType: 'json', // Assurez-vous que la réponse attendue est en JSON
                success: function(response) {
                    if (response.status === 'success') {
                        var details = response.data.details;
                        if (details && details.length > 0) {
                            var CapitalSouscrit = parseInt(details[0].CapitalSouscrit);
                            // var DureeCotisationAns = parseInt(details[0].DureeCotisationAns);
                            $("#Capital").val(CapitalSouscrit);
                            $("#CapitalTotal").text('Capital souscrit : ' + CapitalSouscrit +  ' FCFA');

                        } else {
                            console.error('Aucun détail trouvé pour ce contrat.');
                        }
                    } else {
                        alert('Erreur : ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Erreur lors de la récupération des informations du contrat.');
                }
            });
        }
    });
});

//     // Ajouter un gestionnaire pour le lien "Renvoyer le code"
// document.addEventListener('DOMContentLoaded', function () {
//     const resendOtpLink = document.querySelector('.resend-otp-link'); // Sélection du lien
//     const telPaiementField = document.getElementById('TelPaiement'); // Champ téléphone principal

//     async function resendOtp(phoneNumber) {
//         try {
//             const response = await fetch('/api/send-otp', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                 },
//                 body: JSON.stringify({ TelPaiement: phoneNumber }),
//             });

//             const result = await response.json();

//             if (response.ok) {
//                 alert(`Le code OTP a été renvoyé sur le numéro ${phoneNumber}.`);
//                 return true;
//             } else {
//                 alert(result.error || "Une erreur s'est produite lors de l'envoi du code OTP.");
//                 return false;
//             }
//         } catch (error) {
//             alert("Une erreur s'est produite lors du renvoi du code OTP.");
//             console.error(error);
//             return false;
//         }
//     }

//     // Écouter l'événement de clic sur le lien "Renvoyer le code"
//     resendOtpLink.addEventListener('click', async function (event) {
//         event.preventDefault(); // Empêcher le comportement par défaut du lien

//         const phoneNumber = telPaiementField.value.trim();

//         // Vérifier que le champ de téléphone n'est pas vide et valide
//         const phoneRegex = /^[0-9]{13}$/; // Modifier selon votre format
//         if (!phoneNumber || !phoneRegex.test(phoneNumber)) {
//             alert("Veuillez vérifier que le numéro de téléphone est valide avant de renvoyer le code.");
//             return;
//         }

//         // Renvoi de l'OTP
//         await resendOtp(phoneNumber);
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
    // const selectLieuRDV = document.getElementById('single-select-optgroup-field');
    const selectLieuRDV = document.getElementById('idTblBureau');
    const inputDateRDV = document.getElementById('daterdv');
    const selectOptionsRdv = document.getElementById('optionsRdv');

	inputDateRDV.disabled = true;
    selectLieuRDV.addEventListener('change', function() {
      if (this.value !== '') {
        inputDateRDV.disabled = false;
        selectOptionsRdv.disabled = false;
      } else {
        inputDateRDV.disabled = true;
        selectOptionsRdv.disabled = true;
      }
    });

   
    $(document).ready(function() { 
        var availableOptions = []; // Un tableau pour stocker les options de RDV disponibles
        var availableOptions = []; // Tableau pour stocker les options de RDV disponibles
       
        $('#idTblBureau').on('change', function() {
            var id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/rdv/optionDate/' + id,
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'success' && data.data.length > 0) {
                        var jmax = '';
                        var lieu = '';
                        var jours = [];
                        availableOptions = []; // Réinitialiser les options disponibles
                        // Boucle à travers les données reçues
                        $.each(data.data, function(index, villeReseau) {
                            lieu = villeReseau.libelleVilleBureau || 'Lieu inconnu'; // Récupérer le nom du lieu
                            $.each(villeReseau.option_rdv, function(index, optionRdv) {
                                // Sauvegarder les options dans un tableau
                                availableOptions.push({
                                    codejour: optionRdv.codejour,
                                    codelieu: optionRdv.codelieu,
                                    nbmax: optionRdv.nbmax
                                });

                                // Générer les options pour l'élément #optionsRdv
                                jmax += '<option value="' + optionRdv.nbmax + '">' + optionRdv.jour + '</option>';
                                jours.push(optionRdv.jour); // Ajouter le jour à la liste des jours disponibles
                            });
                        });

                        // Mettre à jour les champs HTML
                        $('#optionsRdv').html(jmax); // Liste des options
                        $('#lieurdv').text(lieu); // Nom du lieu
                        $('#jourRdv').text(jours.join(' - ')); // Liste des jours disponibles
                    } else {
                        alert('Aucune information disponible pour ce lieu de RDV.');
                        $('#lieurdv').text(''); // Réinitialiser le lieu
                        $('#jourRdv').text(''); // Réinitialiser les jours
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX : ', xhr.responseText);
                    alert('Une erreur est survenue lors de la récupération des données.');
                    $('#lieurdv').text(''); // Réinitialiser le lieu
                    $('#jourRdv').text(''); // Réinitialiser les jours
                }
            });
        });

        $('#daterdv').on('change', function() {
            var idTblBureau = $('#idTblBureau').val();
            var daterdv = $(this).val(); // Exemple : 10/12/2024
            // Réinitialiser les messages à chaque changement
            $('#msgerror').text('').hide(); // Masquer le message d'erreur
            $('#msgesucces').text('').hide(); // Masquer le message de succès

            if (daterdv) {
                // Conversion de la date au format JavaScript
                var parts = daterdv.split('-'); // Supposons que le format est d/m/Y
                var dateObj = new Date(parts[2], parts[1] - 1, parts[0]); // Année, mois (0-indexé), jour

                // Vérification si la date est un samedi (6) ou un dimanche (0)
                var day = dateObj.getDay(); 
                if (day === 0 || day === 6) {
                    alert("Les rendez-vous ne peuvent pas être pris le week-end ou les jours fériés. Veuillez sélectionner un jour en semaine.");
                    $('input[name="daterdv"]').val('');
                    $('#msgerror').text("Les rendez-vous ne peuvent pas être pris le week-end ou les jours fériés. Veuillez sélectionner un jour en semaine.").show();
                    return; // Arrête l'exécution
                }
            }

            if (idTblBureau && daterdv) {
                // Filtrage des options disponibles pour la date sélectionnée
                var availableForDate = availableOptions.filter(function(option) {
                    return option.codelieu == idTblBureau && parseInt(option.codejour) === dateObj.getDay();
                });

                if (availableForDate.length > 0) {
                    // Si des options sont disponibles pour la date et le lieu
                    $.each(availableForDate, function(index, option) {
                        var Nbmax = parseInt(option.nbmax);

                        // Vérification de la disponibilité des places
                        $.ajax({
                            type: 'GET',
                            url: '/rdv/getRdv',
                            data: {
                                idTblBureau: idTblBureau,
                                daterdv: daterdv
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.status === 'success') {
                                    var orderInsert = parseInt(data.data.orderInsert);
                                    if (orderInsert >= Nbmax) {
                                        alert("Plus de places disponibles à cette date.");
                                        $('input[name="daterdv"]').val('');
                                        $('#msgerror').text("Plus de places disponibles à cette date.").show();
                                        return;
                                    } else {
                                        var remainingSlots = Nbmax - orderInsert;
                                        $('#msgesucces').text('Il reste ' + remainingSlots + ' place(s) à cette date.').show();
                                    }
                                } else {
                                    $('#msgesucces').text('Il reste ' + Nbmax + ' place(s) à cette date.').show();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Erreur AJAX : ', xhr.responseText);
                                alert("Erreur lors de la vérification de la disponibilité.");
                                $('input[name="daterdv"]').val('');
                            }
                        });
                    });
                } else {
                    alert("Cette date n'est pas disponible pour ce lieu de RDV. Veuillez choisir une autre.");
                    $('input[name="daterdv"]').val('');
                    $('#msgerror').text("Cette date n'est pas disponible pour ce lieu de RDV. Veuillez choisir une autre.").show();
                }
            }
        });
    });
  
});

// $(document).ready(function() {
//     // Déclencher l'événement "change" sur le champ de sélection pour le premier contrat
//     $('#idcontrat').trigger('change');
// });

// $(document).on('change', '#idcontrat', function() {
//     var idcontrat = $(this).val(); // Récupérer l'ID du contrat sélectionné

    
//     // Vérifier si un contrat est sélectionné
//     if (idcontrat) {
//         $.ajax({
//             url: '/api/fetch-contract-details', // Route Laravel
//             type: 'POST',
//             data: {
//                 idcontrat: idcontrat,
//                 _token: '{{ csrf_token() }}'  // Le token CSRF pour sécuriser la requête
//             },
//             dataType: 'json', // Assurez-vous que la réponse attendue est en JSON
//             success: function(response) {
//                 if (response.status === 'success') {
//                     var details = response.data.details;
//                     var TotalPrime = parseInt(details[0].TotalPrime);
//                     if (details && details.length > 0) {
//                         $("#adherent").text(details[0].nomSous + ' ' + details[0].PrenomSous);
//                         $("#idProposition").text(details[0].IdProposition);
//                         $("#CodeProposition").text(details[0].CodeProposition);
//                         $("#CodepropositionForm").text(details[0].CodepropositionForm);
//                         $("#CodeConseiller").text(details[0].CodeConseiller + ' - ' + details[0].NomAgent);
//                         $("#produit").text(details[0].produit);
//                         $("#totalPrime").text(TotalPrime+' FCFA');
//                         $("#DateEffetReel").text(details[0].DateEffetReel);
//                         $("#FinAdhesion").text(details[0].FinAdhesion);
                        
//                         // Définir le statut
//                         if (details[0].OnStdbyOff == 0) {
//                             $("#status").text("Inconnu");
//                         } else if (details[0].OnStdbyOff == 1) {
//                             $("#status").text("En cours");
//                         } else if (details[0].OnStdbyOff == 2) {
//                             $("#status").text("En veille");
//                         } else if (details[0].OnStdbyOff == 3) {
//                             $("#status").text("Arrêté");
//                         }

//                         // D'autres propriétés de details[0]
//                         var CapitalSouscrit = parseInt(details[0].CapitalSouscrit);
//                         $("#Capital").val(CapitalSouscrit);
//                         $("#CapitalSouscrit").text(CapitalSouscrit + ' FCFA');
//                         $("#DureeCotisationAns").text(details[0].DureeCotisationAns+' ans');
//                         $("#TotalPrime").text(TotalPrime + ' FCFA /mois');
//                         $("#NbreEncaissment").text(details[0].NbreEncaissment);
//                         $("#NbreImpayes").text(details[0].NbreImpayes);
                        
//                     } else {
//                         console.error('Aucun détail trouvé pour ce contrat.');
//                     }
//                 } else {
//                     alert('Erreur : ' + response.message);
//                 }
//             },
//             error: function(xhr) {
//                 console.error(xhr.responseText);
//                 alert('Erreur lors de la récupération des informations du contrat.');
//             }
//         });
//     } else {
//         alert('Veuillez sélectionner un contrat.');
//     }
// });


document.addEventListener('DOMContentLoaded', function () {
    // Bouton pour passer à l'étape suivante
    document.querySelector('.next-step-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Empêche l'action par défaut du bouton

        // Valider tous les champs de l'étape actuelle
        if (validateStep1()) {
            // Si les champs sont valides, attendre 2 secondes avant de passer à l'étape suivante
            setTimeout(() => {
                stepper1.next();
            }, 1000); // 1 seconde
        }
    });

    // Fonction pour valider tous les champs de l'étape
    function validateStep1() {
        const inputs = document.querySelectorAll('.etape input'); // Sélectionner tous les champs dans l'étape actuelle
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                // Si le champ est requis et vide, afficher le message d'erreur et la bordure rouge
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
                isValid = false;
            } else {
                // Si le champ est valide (ou non requis mais rempli), ajouter une bordure verte
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });

        return isValid;
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner le lien "Supprimer mon choix"
    const clearChoiceLink = document.getElementById('clearChoise');

    // Boutons à masquer après réinitialisation
    const nextButtons = [
        // document.getElementById('next-stepper3'),
        document.getElementById('nextPhone')
    ];

    // Ajouter un gestionnaire d'événements au clic
    clearChoiceLink.addEventListener('click', function () {
        // Sélectionner tous les boutons radio avec le nom "Operateur"
        const Operateur = document.querySelectorAll('input[name="Operateur"]');
        const moyenPaiement = document.querySelectorAll('input[name="moyenPaiement"]');

        // Parcourir les boutons radio et les désélectionner
        Operateur.forEach(radio => {
            radio.checked = false;
        });
        moyenPaiement.forEach(checkedbox => {
            checkedbox.checked = false;
        });

        // Masquer les boutons concernés
        nextButtons.forEach(button => {
            button.style.display = 'none'; // Masquer le bouton
        });

        // Optionnel : Ajouter un effet visuel ou un message si nécessaire
        console.log("Choix réinitialisé, boutons masqués.");
    });

    // Afficher les boutons si une option est sélectionnée
    const OperateurInputs = document.querySelectorAll('input[name="Operateur"]');
    OperateurInputs.forEach(input => {
        input.addEventListener('change', function () {
            // Vérifier si un opérateur est sélectionné
            const selected = Array.from(OperateurInputs).some(radio => radio.checked);

            // Afficher ou masquer les boutons en conséquence
            nextButtons.forEach(button => {
                button.style.display = selected ? 'inline-block' : 'none';
            });
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    // Bouton pour passer à l'étape suivante
    document.querySelector('.next-step-btn1').addEventListener('click', function (event) {
        event.preventDefault(); // Empêche l'action par défaut du bouton

        // Valider les champs de l'étape actuelle
        if (validateIBANFields()) {
            // Si les champs sont valides, attendre 1 seconde avant de passer à l'étape suivante
            setTimeout(() => {
                stepper1.next();
            }, 1000); // 1 seconde
        }
    });

    // Fonction pour valider les champs IBAN et ConfirmIBAN
    function validateIBANFields() {
        const ibanField = document.getElementById('IBAN');
        const confirmIbanField = document.getElementById('ConfirmIBAN');
        const ibanValue = ibanField.value.trim();
        const confirmIbanValue = confirmIbanField.value.trim();

        let isValid = true;

        // Vérifier que les champs ne sont pas vides
        if (!ibanValue) {
            isValid = false;
            ibanField.classList.add('is-invalid');
            ibanField.classList.remove('is-valid');
        } else {
            ibanField.classList.remove('is-invalid');
            ibanField.classList.add('is-valid');
        }

        if (!confirmIbanValue) {
            isValid = false;
            confirmIbanField.classList.add('is-invalid');
            confirmIbanField.classList.remove('is-valid');
        } else {
            confirmIbanField.classList.remove('is-invalid');
            confirmIbanField.classList.add('is-valid');
        }

        // Vérifier que les deux champs correspondent
        if (ibanValue && confirmIbanValue && ibanValue !== confirmIbanValue) {
            isValid = false;
            confirmIbanField.classList.add('is-invalid');
            confirmIbanField.classList.remove('is-valid');
            alert("Les deux IBAN ne correspondent pas.");
        }

        // // Vérifier le format de l'IBAN
        // const ibanRegex = /^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/; // Exemple de regex pour l'IBAN
        // if (ibanValue && !ibanRegex.test(ibanValue)) {
        //     isValid = false;
        //     ibanField.classList.add('is-invalid');
        //     ibanField.classList.remove('is-valid');
        //     alert("L'IBAN saisi est invalide. Veuillez vérifier le format.");
        // }

        return isValid;
    }
});


// document.addEventListener('DOMContentLoaded', function () {
//     // Bouton pour passer à l'étape suivante
//     document.querySelector('.next-step-btn2').addEventListener('click', function (event) {
//         event.preventDefault(); // Empêche l'action par défaut du bouton

//         // Valider tous les champs de l'étape actuelle
//         if (validateStep3()) {
//             // Si les champs sont valides, attendre 2 secondes avant de passer à l'étape suivante
//             setTimeout(() => {
//                 stepper1.next();
//             }, 1000); // 1 seconde
//         }
//     });

//     // Fonction pour valider tous les champs de l'étape
//     function validateStep3() {
//         const inputs = document.querySelectorAll('.etapePrest input'); // Sélectionner tous les champs dans l'étape actuelle
//         let isValid = true;

//         inputs.forEach(input => {
//             if (input.hasAttribute('required') && !input.value.trim()) {
//                 // Si le champ est requis et vide, afficher le message d'erreur et la bordure rouge
//                 input.classList.add('is-invalid');
//                 input.classList.remove('is-valid');
//                 isValid = false;
//             } else {
//                 // Si le champ est valide (ou non requis mais rempli), ajouter une bordure verte
//                 input.classList.remove('is-invalid');
//                 input.classList.add('is-valid');
//             }
//         });

//         return isValid;
//     }
// });

document.addEventListener('DOMContentLoaded', function () {
    // Initialisation du timer
    // let otpTimer = document.getElementById('otp-timer');
    // let timeLeft = 5 * 60; // 5 minutes en secondes
    let otpInputs = document.querySelectorAll('.otp-input');
    // let resendOtpLink = document.querySelector('.resend-otp-link');
    let nextStepBtn = document.querySelector('.next-step-btn2');

    // Fonction pour démarrer le compte à rebours
    // function startOtpTimer() {
    //     let interval = setInterval(function () {
    //         let minutes = Math.floor(timeLeft / 60);
    //         let seconds = timeLeft % 60;
    //         otpTimer.textContent = `Temps restant: ${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

    //         // Si le temps est écoulé, désactiver le bouton et afficher le lien de renvoi de l'OTP
    //         if (timeLeft <= 0) {
    //             clearInterval(interval);
    //             otpTimer.textContent = "Temps écoulé";
    //             nextStepBtn.disabled = true;
    //             resendOtpLink.classList.remove('d-none');
    //         }

    //         timeLeft--;
    //     }, 1000);
    // }

    // Lancer le timer quand l'OTP est affiché
    // startOtpTimer();

    // Écouter les entrées OTP
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function () {
            if (this.value.length === this.maxLength) {
                // Passer à l'entrée suivante
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            }
        });
    });

    // Fonction pour envoyer l'OTP au serveur pour validation
    function sendOtpVerification() {
        let otp = Array.from(otpInputs).map(input => input.value).join('');
        let phone = document.getElementById('TelPaiement').value;
        let phoneNumber = '225' + phone;

        fetch('/api/verify-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                TelPaiement: phoneNumber,
                otp: otp
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Votre numéro de téléphone a été vérifié avec succès.') {
                // L'OTP est valide, on passe à l'étape suivante
                nextStepBtn.disabled = false; // Activer le bouton "Suivant"
                otpInputs.forEach(input => {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid'); // Ajouter une bordure verte
                });
                alert('Votre numéro de téléphone a été vérifié avec succès.');

                // Passer à l'étape suivante après un délai d'une seconde
                setTimeout(() => {
                    stepper1.next();
                }, 1000);
            } else {
                // L'OTP est invalide
                // nextStepBtn.disabled = true; // Désactiver le bouton "Suivant"
                otpInputs.forEach(input => {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid'); // Ajouter une bordure rouge
                    input.value = '';
                });
                alert('Le code de vérification est invalide ou a expiré.');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la vérification de l\'OTP:', error);
        });
    }

    // Gestion du clic sur "Suivant" pour vérifier l'OTP
    nextStepBtn.addEventListener('click', function () {
        sendOtpVerification();
    });

    // Gestion du clic pour renvoyer l'OTP
    // resendOtpLink.addEventListener('click', function (event) {
    //     event.preventDefault();

    //     // Réinitialiser le timer et renvoyer l'OTP
    //     timeLeft = 5 * 60; // Réinitialiser le timer à 5 minutes
    //     startOtpTimer();
    //     resendOtpLink.classList.add('d-none'); // Masquer le lien de renvoi après l'avoir utilisé

    //     // Appel pour renvoyer l'OTP
    //     let phoneNumber = document.getElementById('TelPaiement').value;
    //     fetch('/api/send-otp', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         body: JSON.stringify({
    //             TelPaiement: phoneNumber
    //         })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if (data.message === 'OTP envoyé avec succès.') {
    //             alert('Un nouveau code de confirmation a été envoyé sur le numéro ' + phoneNumber + '.');
    //             otpInputs.forEach(input => {
    //                 input.classList.remove('is-valid', 'is-invalid'); // Réinitialiser les styles
    //             });
    //         } else {
    //             alert('Erreur lors de l\'envoi du code de confirmation.');
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Erreur lors de l\'envoi du code de confirmation:', error);
    //     });
    // });
});


// marquage de certain champs comme requis
document.addEventListener('DOMContentLoaded', function () {
    const moyenPaiementInputs = document.querySelectorAll('input[name="moyenPaiement"]');
    const operateurSection = document.getElementById('Operateur');
    const telPaiementSection = document.getElementById('TelephonePaiement');
    const otpSection = document.querySelector('.otp-container');
    const ibanPaiementSection = document.getElementById('IBANPaiement');
    const nextBtn = document.querySelector('#nextPhone'); // Bouton "next" spécifique pour Mobile Money
    const operateurInputs = document.querySelectorAll('input[name="Operateur"]');

    moyenPaiementInputs.forEach(input => {
        input.addEventListener('change', function () {
            if (input.value === "Mobile_Money") {
                // Afficher les sections Mobile Money
                operateurSection.classList.remove('d-none');
                telPaiementSection.classList.remove('d-none');
                otpSection.parentElement.classList.remove('d-none');
                ibanPaiementSection.classList.add('d-none'); // Cacher IBAN

                // Ajouter les attributs requis
                setRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement', 'FicheID-file-uploa']);
                setRequired(['otp_1', 'otp_2', 'otp_3', 'otp_4', 'otp_5', 'otp_6']);
                removeRequired(['IBAN', 'ConfirmIBAN', 'RIB-file-uploa']);

                // Vérifier la sélection d'un opérateur
                toggleNextBtn();
            } else if (input.value === "Virement_Bancaire") {
                // Afficher la section IBAN
                ibanPaiementSection.classList.remove('d-none');
                operateurSection.classList.add('d-none'); // Cacher opérateur
                telPaiementSection.classList.add('d-none'); // Cacher téléphone
                otpSection.parentElement.classList.add('d-none'); // Cacher OTP

                // Ajouter les attributs requis
                setRequired(['IBAN', 'ConfirmIBAN', 'RIB-file-uploa']);
                removeRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement']);
                removeRequired(['otp_1', 'otp_2', 'otp_3', 'otp_4', 'otp_5', 'otp_6']);

                // Masquer le bouton "next" pour Mobile Money
                nextBtn.classList.add('d-none');
            }
        });
    });

    // Vérifier si un opérateur est sélectionné pour afficher/masquer le bouton
    operateurInputs.forEach(input => {
        input.addEventListener('change', toggleNextBtn);
    });

    function toggleNextBtn() {
        const isSelected = Array.from(operateurInputs).some(input => input.checked);
        if (isSelected) {
            nextBtn.classList.remove('d-none');
        } else {
            nextBtn.classList.add('d-none');
        }
    }

    // Fonctions pour gérer les champs requis
    function setRequired(fields) {
        fields.forEach(id => {
            const field = document.getElementById(id) || document.querySelector(`input[name="${id}"]`);
            if (field) field.setAttribute('required', true);
        });
    }

    function removeRequired(fields) {
        fields.forEach(id => {
            const field = document.getElementById(id) || document.querySelector(`input[name="${id}"]`);
            if (field) field.removeAttribute('required');
        });
    }
});

// affichage des éléments en fonction du moyen de paiement coché
document.addEventListener('DOMContentLoaded', function () {
    const mobileMoneyCheckbox = document.getElementById('mobileMoney');
    const virementBancaireCheckbox = document.getElementById('virementBancaire');
    // IDs des éléments à afficher ou masquer
    const elementsMobileMoney = ['Operateur', 'Operateur-btn', 'TelephonePaiement', 'btn-TelephonePaiement', 'OTP', 'btn-otp', 'next-stepper3'];
    const elementsVirementBancaire = ['next-stepper4', 'IBANPaiement', 'btn-IBANPaiement'];

    function toggleElements() {
        // Vérifie les cases cochées
        const isMobileMoneyChecked = mobileMoneyCheckbox.checked;
        const isVirementBancaireChecked = virementBancaireCheckbox.checked;
		
        // Logique d'affichage et masquage
        if (isMobileMoneyChecked && isVirementBancaireChecked) {
            // Afficher les éléments pour les deux options
            showElements(elementsMobileMoney.concat(['IBANPaiement']));
            hideElements(['next-stepper4', 'btn-IBANPaiement']);
        } else if (isMobileMoneyChecked) {
            // Afficher uniquement pour Mobile Money
            showElements(elementsMobileMoney);
            hideElements(elementsVirementBancaire);
        } else if (isVirementBancaireChecked) {
            // Afficher uniquement pour Virement Bancaire
            showElements(elementsVirementBancaire);
            hideElements(elementsMobileMoney);
        } else {
            // Si aucune option n'est cochée, tout est masqué
            hideElements(elementsMobileMoney.concat(elementsVirementBancaire));
        }
    }

    // Fonction pour afficher des éléments
    function showElements(ids) {
        ids.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.classList.remove('d-none');
            }
        });
    }

    // Fonction pour masquer des éléments
    function hideElements(ids) {
        ids.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.classList.add('d-none');
            }
        });
    }

    // Ajoute les écouteurs d'événements
    mobileMoneyCheckbox.addEventListener('change', toggleElements);
    virementBancaireCheckbox.addEventListener('change', toggleElements);

    // Appelle la fonction une première fois pour gérer l'état initial
    toggleElements();
});

// document.addEventListener('DOMContentLoaded', function () {
//     const selectContrat = document.getElementById('idcontratPrest');
//     const tablePrestationBody = document.querySelector('#example3 tbody');
//     const getPrestationsUrl = "/api/getPrestations";
//     let dataTableInstance = null;

//     const formatDate = (dateString) => {
//         if (!dateString) return '-';
//         const date = new Date(dateString);
//         return date.toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' });
//     };

//     const clearTable = () => {
//         if (dataTableInstance) {
//             dataTableInstance.clear().destroy(); // Détruire l'ancienne instance DataTables
//             dataTableInstance = null; // Réinitialiser l'instance
//         }
//         tablePrestationBody.innerHTML = ''; // Vider le contenu de la table
//     };

//     selectContrat.addEventListener('change', function () {
//         const idcontrat = selectContrat.value;

//         if (idcontrat === 'Veuillez sélectionner un contrat') {
//             clearTable();
//             tablePrestationBody.innerHTML = `
//                 <tr>
//                     <td colspan="9" class="text-center">Veuillez sélectionner un contrat pour voir les prestations.</td>
//                 </tr>`;
//             return;
//         }

//         fetch(getPrestationsUrl, {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//             },
//             body: JSON.stringify({ idcontratPrest: idcontrat }),
//         })
//             .then(response => response.json())
//             .then(data => {
//                 clearTable(); // Toujours nettoyer la table avant de réinitialiser
//                 if (data.status === 'success') {
//                     const prestations = data.data;

//                     if (prestations.length > 0) {
//                         tablePrestationBody.innerHTML = prestations.map(prestation => `
//                             <tr>
//                                 <td>${prestation.code || '-'}</td>
//                                 <td>${prestation.idcontrat}</td>
//                                 <td>${prestation.typeprestation || '-'}</td>
//                                 <td>${prestation.cel || '-'}</td>
//                                 <td>${prestation.email || '-'}</td>
//                                 <td>${prestation.montantSouhaite || '-'}</td>
//                                 <td>
//                                     ${prestation.etape == 1 ? 
//                                         '<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En attente</div>' :
//                                     prestation.etape == 2 ? 
//                                         '<div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En cours</div>' :
//                                     prestation.etape == 3 ? 
//                                         '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Terminé</div>' :
//                                         '-'}
//                                 </td>
//                                 <td>${formatDate(prestation.created_at)}</td>
//                                 <td>
//                                     <div class="d-flex order-actions">
//                                         <a href="" class="mx-3"><i class='bx bxs-show'></i></a>
//                                     </div>
//                                 </td>
//                             </tr>`).join('');
//                     } else {
//                         tablePrestationBody.innerHTML = `
//                             <tr>
//                                 <td colspan="9" class="text-center">Aucune prestation trouvée pour ce contrat.</td>
//                             </tr>`;
//                     }

//                     // Réinitialiser DataTables
//                     dataTableInstance = $('#example3').DataTable({
//                         lengthChange: true,
//                         language: {
//                             search: "Recherche :",
//                         },
//                     });
//                 } else {
//                     tablePrestationBody.innerHTML = `
//                         <tr>
//                             <td colspan="9" class="text-center text-danger">Une erreur est survenue : ${data.message}</td>
//                         </tr>`;
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 clearTable();
//                 tablePrestationBody.innerHTML = `
//                     <tr>
//                         <td colspan="9" class="text-center text-danger">Une erreur est survenue lors de la récupération des données.</td>
//                     </tr>`;
//             });
//     });
// });





// Debut upload doc

document.addEventListener('DOMContentLoaded', function () {
    const selectContrat = document.getElementById('idcontratPrest');
    const tablePrestation = document.getElementById('example3'); // Table complète
    const tablePrestationBody = tablePrestation.querySelector('tbody');
    const getPrestationsUrl = "/api/getPrestations";
    let dataTableInstance = null;

    const formatDate = (dateString) => {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' });
    };

    const clearTable = () => {
        if (dataTableInstance) {
            dataTableInstance.destroy(); // Détruire DataTables
            dataTableInstance = null;
        }
        tablePrestationBody.innerHTML = ''; // Nettoyer le contenu du tableau
    };

    selectContrat.addEventListener('change', function () {
        const idcontrat = selectContrat.value;

        if (idcontrat === 'Veuillez sélectionner un contrat') {
            clearTable();
            tablePrestationBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center">Veuillez sélectionner un contrat pour voir les prestations.</td>
                </tr>`;
            return;
        }

        fetch(getPrestationsUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ idcontratPrest: idcontrat }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la récupération des données');
                }
                return response.json();
            })
            .then(data => {
                clearTable(); // Toujours nettoyer la table avant de réinitialiser
                if (data.status === 'success') {
                    const prestations = data.data;
                    if (prestations.length > 0) {
                        tablePrestationBody.innerHTML = prestations.map(prestation => `
                            <tr>
                                <td>${prestation.code || '-'}</td>
                                <td>${prestation.idcontrat || '-'}</td>
                                <td>${prestation.typeprestation || '-'}</td>
                                <td>${prestation.cel || '-'}</td>
                                <td>${prestation.email || '-'}</td>
                                <td>${prestation.montantSouhaite || '-'}</td>
                                <td>
                                    ${prestation.etape == 1 ? 
                                        '<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En attente</div>' :
                                    prestation.etape == 2 ? 
                                        '<div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En cours</div>' :
                                    prestation.etape == 3 ? 
                                        '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Terminé</div>' :
                                        '-'}
                                </td>
                                <td>${formatDate(prestation.created_at) || '-'}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="" class="mx-3"><i class='bx bxs-show'></i></a>
                                    </div>
                                </td>
                            </tr>`).join('');
                    } else {
                        tablePrestationBody.innerHTML = `
                            <tr>
                                <td colspan="9" class="text-center">Aucune prestation trouvée pour ce contrat.</td>
                            </tr>`;
                    }

                    // Réinitialiser DataTables si des lignes existent
                    if (tablePrestationBody.querySelectorAll('tr').length > 0) {
                        // Initialiser DataTables après l'ajout des lignes
                        dataTableInstance = $(tablePrestation).DataTable({
                            lengthChange: true,
                            language: {
                                search: "Recherche :",
                                lengthMenu: "Afficher _MENU_ lignes",
                                zeroRecords: "Aucun enregistrement trouvé",
                                info: "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                                infoEmpty: "Aucun enregistrement disponible",
                                infoFiltered: "(filtré à partir de _MAX_ enregistrements)",
                                paginate: {
                                    first: "Premier",
                                    last: "Dernier",
                                    next: "Suivant",
                                    previous: "Précédent",
                                },
                            },
                        });
                    }
                } else {
                    tablePrestationBody.innerHTML = `
                        <tr>
                            <td colspan="9" class="text-center text-danger">Une erreur est survenue : ${data.message}</td>
                        </tr>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                clearTable();
                tablePrestationBody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-danger">Une erreur est survenue lors de la récupération des données.</td>
                    </tr>`;
            });
    });
});




$('#Police-file-upload').FancyFileUpload({
	params: {
		action: 'fileuploader'
	},
	// maxfilesize: 1000000
});
$('#bulletin-file-upload').FancyFileUpload({
	params: {
		action: 'fileuploader'
	},
	// maxfilesize: 1000000
});
$('#RIB-file-upload').FancyFileUpload({
	params: {
		action: 'fileuploader'
	},
	// maxfilesize: 1000000
});
$('#CNIrecto-file-upload').FancyFileUpload({
	params: {
		action: 'fileuploader'
	},
	// maxfilesize: 1000000
});
$('#CNIverso-file-upload').FancyFileUpload({
	params: {
		action: 'fileuploader'
	},
	// maxfilesize: 1000000
});
$('#FicheID-file-upload').FancyFileUpload({
	params: {
		action: 'fileuploader'
	},
	// maxfilesize: 1000000
});
$('#AttestationPerte-file-upload').FancyFileUpload({
	params: {
		action: 'fileuploader'
	},
	// maxfilesize: 1000000
});


// Fin upload doc

// Debut OTP input 
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-input');

    otpInputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && index > 0 && input.value === '') {
                otpInputs[index - 1].focus();
            }
        });
    });
    // document.querySelector('.resend-otp-link').addEventListener('click', function(event) {
    //     event.preventDefault(); // Empêche le comportement par défaut du lien
    //     alert('Un nouveau code OTP a été envoyé sur votre numéro de paiement.');
    //     // Ajoutez ici la logique pour envoyer une requête au serveur pour renvoyer l'OTP
    // });
});

// Fin OTP input

// Fin js perso prestation