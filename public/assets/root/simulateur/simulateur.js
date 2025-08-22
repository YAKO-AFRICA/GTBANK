document.addEventListener('DOMContentLoaded', function() {
    
    generateTensionOptions(); // met à jour les select de systo et disto

    if (!document.referrer.includes('epret.create')) {
        restoreFormData();
    } else {
        resetSimulationForm();
    }
    
    // Gestion du changement pour le diabète
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
    
    // Gestion de la soumission du formulaire
    document.getElementById("loanSimulatorForm").addEventListener("submit", function(event) {
        event.preventDefault();
        calculatePremium();
    });
});


// Fonction pour générer les options de tension artérielle
function generateTensionOptions() {
    const systoSelect = document.getElementById('tensionSysto');
    const diastoSelect = document.getElementById('tensionDiasto');
    
    const systoValues = [130, 135, 140, 145, 150, 155, 160, 165, 170, 175, 180, 185];
    const diastoValues = [75, 80, 85, 90, 95, 100, 105];
    
    // Remplir systolique
    systoValues.forEach(value => {
        const option = document.createElement('option');
        option.value = value;
        option.textContent = value;
        systoSelect.appendChild(option);
    });
    
    // Remplir diastolique
    diastoValues.forEach(value => {
        const option = document.createElement('option');
        option.value = value;
        option.textContent = value;
        diastoSelect.appendChild(option);
    });
}

// Fonction principale de calcul de la prime
function calculatePremium() {
    // Sauvegarder les données du formulaire
    saveFormData();
    
    const birthdayInput = document.getElementById('birthday');
    const birthday = new Date(birthdayInput.value);
    const today = new Date();
    let age = today.getFullYear() - birthday.getFullYear();

    // santé
    const poids = parseFloat(document.getElementById("poids").value);
    const taille = parseFloat(document.getElementById("taille").value);
    const diabete = document.getElementById("diabete").value;
    const diabeteType = diabete === 'oui' ? document.getElementById("diabeteType").value : null;
    const diabeteDuree = diabete === 'oui' ? parseInt(document.getElementById("diabeteDuree").value) : null;
    const tensionSysto = parseInt(document.getElementById("tensionSysto").value);
    const tensionDiasto = parseInt(document.getElementById("tensionDiasto").value);

    // info sur pret 
    const duree = parseInt(document.getElementById("loanDuration").value);
    const montant = parseFloat(document.getElementById("loanMontant").value);
    const genre = document.getElementById("genre").value;

    // Validations de base
    if (montant > 30000000) {
        showError("Veuillez contacter YAKO AFRICA pour les montants supérieurs à 30 000 000.");
        return;
    }
    if (age < 18) {
        showError("Veuillez contacter la YAKO AFRICA. L'âge de l'emprunteur doit être supérieur à 18 ans.");
        return;
    }
    if (age > 64) {
        showError("Veuillez contacter la YAKO AFRICA. L'âge de l'emprunteur doit être inférieur à 65 ans.");
        return;
    }
    if (duree > 60) {
        showError("Veuillez contacter la YAKO AFRICA. La durée de l'emprunt ne doit pas dépasser 60 mois.");
        return;
    }

    // Calcul du poids corrigé (PC)
    let poidsCorrige = poids;
    if (genre === "femme" && age < 25) {
        poidsCorrige += 6;
    } else if (genre === "homme" && age < 25) {
        poidsCorrige += 4;
    }

    // Calcul du rapport poids/taille (RPT)
    const rpt = parseFloat(((poidsCorrige / (taille - 100)) - 1).toFixed(2));

    console.log("RPT:", rpt);

    let indiceSurmortalite = 0;
    if (rpt <= -0.5 || rpt >= 0.8) {
        showError("Veuillez contacter la YAKO AFRICA. Le poids/taille de l'emprunteur est conséquent.");
        return;
    } else if (rpt >= -0.49 && rpt <= -0.25) {
        indiceSurmortalite = 50;
    } else if (rpt >= -0.24 && rpt <= 0.24) {
        indiceSurmortalite = 0;
    } else if (rpt >= 0.25 && rpt <= 0.39) {
        indiceSurmortalite = 25;
    } else if (rpt >= 0.4 && rpt <= 0.49) {
        indiceSurmortalite = 50;
    } else if (rpt >= 0.5 && rpt <= 0.59) {
        indiceSurmortalite = 75;
    } else if (rpt >= 0.6 && rpt <= 0.69) {
        indiceSurmortalite = 100;
    } else if (rpt >= 0.7 && rpt <= 0.79) {
        indiceSurmortalite = 150;
    }

    console.log("Indice de surmortalité:", indiceSurmortalite);

    let tauxConversion = 0;
    if (age < 40) {
        tauxConversion = 30;
    } else if (age >= 40 && age <= 44) {
        tauxConversion = 35;
    } else if (age >= 45 && age <= 49) {
        tauxConversion = 35;
    } else if (age >= 50 && age <= 54) {
        tauxConversion = 40;
    } else if (age >= 55 && age <= 59) {
        tauxConversion = 45;
    } else if (age >= 60 && age <= 64) {
        tauxConversion = 65;
    }

    console.log("Taux de conversion:", tauxConversion);

    let tauxPrime = 0;
    if (duree >= 1 && duree <= 24) {
        tauxPrime = 0.0065; // 0.65%
    } else if (duree >= 25 && duree <= 36) {
        tauxPrime = 0.01; // 1%
    } else if (duree >= 37 && duree <= 48) {
        tauxPrime = 0.0125; // 1.25%
    } else if (duree >= 49 && duree <= 60) {
        tauxPrime = 0.016; // 1.60%
    }

    console.log("Taux de prime:", tauxPrime);

    // taux de surprime IMC
    const tauxSurprimeIMC = (tauxConversion / 100) * (indiceSurmortalite / 100);
    console.log("Taux de surprime:", tauxSurprimeIMC);

    const tensionRate = calculateTensionRate(age, tensionSysto, tensionDiasto);
    if (tensionRate === "Tarif Med") {
        showError("Veuillez contacter la YAKO AFRICA pour une évaluation médicale (tension artérielle).");
        return;
    }
    const tauxTension = (tauxConversion / 100) * (tensionRate / 100);

    console.log("indice de surprime tension %:", tensionRate);
    console.log("Taux de surprime tension:", tauxTension);

    let tauxDiabete = 0;
    if (diabete === 'oui') {
        tauxDiabete = calculateDiabeteRate(age, diabeteType, diabeteDuree);
        if (tauxDiabete === 'CONTACTER LA LLV') {
            showError("Veuillez contacter la YAKO AFRICA pour une évaluation de votre dossier (diabète).");
            return;
        }
    }

    const tauxSurpimeDiabete = (tauxConversion / 100) * (tauxDiabete / 100);

    console.log("Taux de diabete indice %:", tauxDiabete);
    console.log("Taux de surprime diabete:", tauxSurpimeDiabete);

    // calcule des primes 
    const primeObseque = 3500;
    document.getElementById('primeObseque').innerText = primeObseque.toFixed(2);

    // Prime de base
    const primeEmprunteurBase = tauxPrime * montant;
    document.getElementById('primeEmprunteur').innerText = primeEmprunteurBase.toFixed(2);

    console.log("Prime emprunteur:", primeEmprunteurBase);

    // Surprime IMC
    const surprimeIMC = tauxSurprimeIMC * primeEmprunteurBase;
    console.log("Surprime IMC:", surprimeIMC);

    // Surprime tension
    const surprimeTension = tauxTension * primeEmprunteurBase;
    console.log("Surprime tension:", surprimeTension);

    // Surprime diabete
    const surprimeDiabete = tauxSurpimeDiabete * primeEmprunteurBase;
    console.log("Surprime diabete:", surprimeDiabete);

    // cumule des surprimes
    const cumuleSurprime = surprimeIMC + surprimeTension + surprimeDiabete;
    document.getElementById('surprime').innerText = cumuleSurprime.toFixed(2);

    // Prime totale
    const primeTotale = primeEmprunteurBase + surprimeIMC + surprimeTension + surprimeDiabete + primeObseque;
    document.getElementById('totalPremium').innerText = primeTotale.toFixed(2);

    console.log("Prime totale:", primeTotale);

    // Activer le bouton de souscription si le calcul est valide
    document.getElementById("btn-souscription").disabled = primeTotale <= 10;

    // Préparation des données à stocker
    const data = {
        dateNaissance: `${birthday.getDate()}-${birthday.getMonth() + 1}-${birthday.getFullYear()}`,
        age: age,
        duree: duree,
        montant: montant,
        tauxPrime: tauxPrime,
        prime: primeTotale,
        primeEmprunteur: primeEmprunteurBase,
        primeObseque: primeObseque,
        surprimeImc: surprimeIMC,
        surprimeTension: surprimeTension,
        surprimeDiabete: surprimeDiabete,
        totalSurprime: cumuleSurprime,
        primeFinal: primeTotale,
        genre: genre,
        poids: poids,
        taille: taille,
        diabete: diabete,
        diabeteType: diabeteType,
        diabeteDuree: diabeteDuree,
        tensionSysto: tensionSysto,
        tensionDiasto: tensionDiasto,
        rpt: rpt,
        indiceSurmortalite: indiceSurmortalite
    };

    console.log(data);
    storeSimulationData(data);
}

// Fonction pour sauvegarder les données du formulaire
function saveFormData() {
    const formData = {
        genre: document.getElementById('genre').value,
        birthday: document.getElementById('birthday').value,
        loanMontant: document.getElementById('loanMontant').value,
        loanDuration: document.getElementById('loanDuration').value,
        poids: document.getElementById('poids').value,
        taille: document.getElementById('taille').value,
        tensionSysto: document.getElementById('tensionSysto').value,
        tensionDiasto: document.getElementById('tensionDiasto').value,
        diabete: document.getElementById('diabete').value,
        diabeteType: document.getElementById('diabeteType')?.value || '',
        diabeteDuree: document.getElementById('diabeteDuree')?.value || ''
    };
    sessionStorage.setItem('formData', JSON.stringify(formData));
}

// Fonction pour restaurer les données du formulaire
function restoreFormData() {
    const savedData = sessionStorage.getItem('formData');
    if (savedData) {
        const formData = JSON.parse(savedData);
        for (const key in formData) {
            if (formData[key] !== null && document.getElementById(key)) {
                document.getElementById(key).value = formData[key];
            }
        }
        // Déclencher les événements change si nécessaire
        if (formData.diabete === 'oui') {
            document.getElementById('diabeteDetails').style.display = 'flex';
        }
    }
}

// Fonction pour afficher les erreurs dans un modal
function showError(message) {
    // Afficher le modal
    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    document.getElementById('errorModalBody').innerText = message;
    errorModal.show();
    
    // Mettre en évidence la zone d'erreur dans le formulaire
    const resultat = document.getElementById("resultat");
    resultat.style.padding = "20px";
    resultat.style.color = "red";
    resultat.style.fontWeight = "bold";
    resultat.style.backgroundColor = "pink";
    resultat.style.textAlign = "center";
    resultat.style.fontSize = "20px";
    resultat.innerText = message;
}

// Tableaux de taux de tension par âge
const tensionRates = {
    // Âge <= 30
    "30": {
        systolique: [130, 135, 140, 145, 150, 155, 160, 165, 170, 175, 180, 186],
        diastolique: [75, 80, 85, 90, 95, 100, 105, 106],
        rates: [
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 50, 0, 0, 0],
            [0, 0, 0, 25, 50, 100, 0, 0],
            [0, 0, 0, 25, 50, 100, 150, "Tarif Med"],
            [0, 0, 0, 25, 50, 100, 150, "Tarif Med"],
            [25, 25, 25, 50, 75, 100, 175, "Tarif Med"],
            [25, 25, 50, 75, 100, 125, 175, "Tarif Med"],
            [50, 50, 75, 100, 125, 150, 200, "Tarif Med"],
            [75, 75, 100, 125, 150, 175, 225, "Tarif Med"],
            [100, 100, 125, 150, 175, 200, 250, "Tarif Med"],
            ["Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med"]
        ]
    },
    // Âge 30-44
    "44": {
        systolique: [130, 135, 140, 145, 150, 155, 160, 165, 170, 175, 180, 186],
        diastolique: [75, 80, 85, 90, 95, 100, 105, 106],
        rates: [
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 50, 0, 0, 0],
            [0, 0, 0, 0, 50, 75, 0, 0],
            [0, 0, 0, 0, 50, 75, 125, 0],
            [0, 0, 0, 0, 50, 75, 125, 0],
            [25, 25, 25, 25, 50, 75, 150, "Tarif Med"],
            [25, 25, 25, 50, 75, 100, 150, "Tarif Med"],
            [50, 50, 50, 75, 100, 125, 175, "Tarif Med"],
            [75, 75, 75, 100, 125, 150, 200, "Tarif Med"],
            [100, 100, 100, 125, 150, 175, 225, "Tarif Med"],
            ["Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med"]
        ]
    },
    // Âge 45-59
    "59": {
        systolique: [130, 135, 140, 145, 150, 155, 160, 165, 170, 175, 180, 186],
        diastolique: [75, 80, 85, 90, 95, 100, 105, 106],
        rates: [
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 25, 0, 0, 0],
            [0, 0, 0, 0, 25, 50, 0, 0],
            [0, 0, 0, 0, 25, 50, 75, 0],
            [0, 0, 0, 0, 25, 50, 100, "Tarif Med"],
            [0, 0, 0, 0, 25, 50, 100, "Tarif Med"],
            [0, 0, 0, 0, 50, 75, 125, "Tarif Med"],
            [25, 25, 25, 25, 50, 75, 125, "Tarif Med"],
            [50, 50, 50, 50, 75, 100, 150, "Tarif Med"],
            [75, 75, 75, 75, 100, 125, 175, "Tarif Med"],
            [100, 100, 100, 100, 125, 150, 200, "Tarif Med"],
            ["Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med"]
        ]
    },
    // Âge >= 60
    "60": {
        systolique: [130, 135, 140, 145, 150, 155, 160, 165, 170, 175, 180, 185, 186],
        diastolique: [75, 80, 85, 90, 95, 100, 105, 106],
        rates: [
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 25, 0, 0],
            [0, 0, 0, 0, 0, 25, 50, 0],
            [0, 0, 0, 0, 0, 25, 50, "Tarif Med"],
            [0, 0, 0, 0, 0, 25, 50, "Tarif Med"],
            [0, 0, 0, 0, 0, 25, 50, "Tarif Med"],
            [0, 0, 0, 0, 25, 50, 75, "Tarif Med"],
            [25, 25, 25, 25, 25, 50, 75, "Tarif Med"],
            [25, 25, 25, 25, 50, 75, 100, "Tarif Med"],
            [50, 50, 50, 50, 75, 100, 125, "Tarif Med"],
            [50, 50, 50, 50, 75, 125, 150, "Tarif Med"],
            ["Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med", "Tarif Med"]
        ]
    }
};

function calculateTensionRate(age, systo, diasto) {
    // Déterminer la tranche d'âge
    let ageGroup;
    if (age <= 30) ageGroup = "30";
    else if (age <= 44) ageGroup = "44";
    else if (age <= 59) ageGroup = "59";
    else ageGroup = "60";
    
    const group = tensionRates[ageGroup];
    
    // Trouver l'index systolique
    let systoIndex = -1;
    for (let i = 0; i < group.systolique.length; i++) {
        if (systo <= group.systolique[i]) {
            systoIndex = i;
            break;
        }
    }
    if (systoIndex === -1) return "Tarif Med";
    
    // Trouver l'index diastolique
    let diastoIndex = -1;
    for (let i = 0; i < group.diastolique.length; i++) {
        if (diasto <= group.diastolique[i]) {
            diastoIndex = i;
            break;
        }
    }
    if (diastoIndex === -1) return "Tarif Med";
    
    // Récupérer le taux
    const rate = group.rates[systoIndex][diastoIndex];
    console.log(systoIndex, diastoIndex, rate);
    console.log("systoIndex", systoIndex, "diastoIndex", diastoIndex, "rate", rate);

    return rate;
}

function calculateDiabeteRate(age, type, duree) {
    if (type === 'type1') {
        // DIABETE INSULINO DEPENDANT (TYPE 1)
        if (age <= 19) {
            if (duree <= 5) return 250;
            if (duree <= 10) return 300;
            return 'CONTACTER LA LLV';
        } else if (age <= 24) {
            if (duree <= 5) return 200;
            if (duree <= 10) return 250;
            if (duree <= 15) return 300;
            return 'CONTACTER LA LLV';
        } else if (age <= 29) {
            if (duree <= 5) return 175;
            if (duree <= 10) return 200;
            if (duree <= 15) return 250;
            if (duree <= 20) return 300;
            return 'CONTACTER LA LLV';
        } else if (age <= 34) {
            if (duree <= 5) return 125;
            if (duree <= 10) return 150;
            if (duree <= 15) return 175;
            if (duree <= 20) return 225;
            return 300;
        } else if (age <= 39) {
            if (duree <= 5) return 100;
            if (duree <= 10) return 125;
            if (duree <= 15) return 150;
            if (duree <= 20) return 175;
            return 225;
        } else {
            if (duree <= 5) return 75;
            if (duree <= 10) return 100;
            if (duree <= 15) return 125;
            if (duree <= 20) return 150;
            return 200;
        }
    } else {
        // DIABETE NON INSULINO DEPENDANT (TYPE 2)
        if (age <= 29) {
            if (duree <= 10) return 200;
            return 300;
        } else if (age <= 34) {
            if (duree <= 10) return 100;
            return 125;
        } else if (age <= 39) {
            if (duree <= 10) return 75;
            return 100;
        } else {
            if (duree <= 10) return 50;
            return 75;
        }
    }
}

function storeSimulationData(data) {
    fetch('/epret/store-simulation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(data),
    })
    .then(response => {
        if (response.ok) {
            console.log('Simulation data stored successfully');
        } else {
            console.error('Failed to store simulation data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Fonction pour réinitialiser complètement le formulaire
function resetSimulationForm() {
    // Réinitialiser les champs du formulaire
    document.getElementById('loanSimulatorForm').reset();
    
    // Masquer les détails du diabète si visible
    document.getElementById('diabeteDetails').style.display = 'none';
    
    // Réinitialiser les résultats affichés
    document.getElementById('primeObseque').innerText = '0';
    document.getElementById('primeEmprunteur').innerText = '0';
    document.getElementById('surprime').innerText = '0';
    document.getElementById('totalPremium').innerText = '0';
    
    // Désactiver le bouton de souscription
    document.getElementById("btn-souscription").disabled = true;
    
    // Nettoyer le stockage session
    sessionStorage.removeItem('formData');
    
    // Réinitialiser l'affichage des erreurs
    const resultat = document.getElementById("resultat");
    resultat.style = "";
    resultat.innerText = "";
}

// Écouteur d'événement pour le bouton de réinitialisation
document.getElementById('resetFormBtn').addEventListener('click', resetSimulationForm);

// Modifier la fonction restoreFormData pour ne restaurer que si besoin
function restoreFormData() {
    // Ne pas restaurer si l'utilisateur vient de la page de souscription
    if (performance.navigation.type === 1) { // 1 = reload
        const wantsRestore = confirm("Voulez-vous restaurer les données de votre dernière simulation ?");
        if (!wantsRestore) {
            resetSimulationForm();
            return;
        }
    }
    
    const savedData = sessionStorage.getItem('formData');
    if (savedData) {
        const formData = JSON.parse(savedData);
        for (const key in formData) {
            if (formData[key] !== null && document.getElementById(key)) {
                document.getElementById(key).value = formData[key];
            }
        }
        // Déclencher les événements change si nécessaire
        if (formData.diabete === 'oui') {
            document.getElementById('diabeteDetails').style.display = 'flex';
        }
    }
}