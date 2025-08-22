document.addEventListener('DOMContentLoaded', function() {
    
    generateTensionOptions();
    
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
    document.getElementById("loanSimulatorForm").addEventListener("submit", function(event) {
        event.preventDefault();
        calculatePremium();
    });
});

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

const birthdayInput = document.getElementById('birthday');
    const birthday = new Date(birthdayInput.value);
    const today = new Date();
    const age = today.getFullYear() - birthday.getFullYear();

function calculatePremium() {
    // Récupérer les valeurs du formulaire
    const birthdayInput = document.getElementById('birthday');
    const birthday = new Date(birthdayInput.value);
    const today = new Date();
    let age = today.getFullYear() - birthday.getFullYear();

    console.log(age)
    
    // // Ajuster l'âge si l'anniversaire n'est pas encore passé cette année
    // const currentMonth = today.getMonth();
    // const currentDay = today.getDate();
    // const birthMonth = birthday.getMonth();
    // const birthDay = birthday.getDate();
    
    // if (currentMonth < birthMonth || (currentMonth === birthMonth && currentDay < birthDay)) {
    //     age--;
    // }

    const duree = parseInt(document.getElementById("loanDuration").value);
    const montant = parseFloat(document.getElementById("loanMontant").value);
    const genre = document.getElementById("genre").value;
    const poids = parseFloat(document.getElementById("poids").value);
    const taille = parseFloat(document.getElementById("taille").value);
    const diabete = document.getElementById("diabete").value;
    const diabeteType = diabete === 'oui' ? document.getElementById("diabeteType").value : null;
    const diabeteDuree = diabete === 'oui' ? parseInt(document.getElementById("diabeteDuree").value) : null;
    const tensionSysto = parseInt(document.getElementById("tensionSysto").value);
    const tensionDiasto = parseInt(document.getElementById("tensionDiasto").value);

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

    // Déduction de l'indice de surmortalité à partir du tableau
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

    // Calcul du taux de diabète si applicable
    let tauxDiabete = 0;
    if (diabete === 'oui') {
        tauxDiabete = calculateDiabeteRate(age, diabeteType, diabeteDuree);
        if (tauxDiabete === 'CONTACTER LA LLV') {
            showError("Veuillez contacter la YAKO AFRICA pour une évaluation de votre dossier (diabète).");
            return;
        }
        // Convertir le pourcentage en décimal (200% -> 2.0)
        tauxDiabete = parseFloat(tauxDiabete) / 100;
    }

    // Calcul du taux de tension
    const tensionRate = calculateTensionRate(age, tensionSysto, tensionDiasto);
    if (tensionRate === "Tarif Med") {
        showError("Veuillez contacter la YAKO AFRICA pour une évaluation médicale (tension artérielle).");
        return;
    }
    const tauxTension = parseFloat(tensionRate) / 100;

    // Déduction du taux de conversion en fonction de l'âge saisi
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

    // Calcul du taux de prime de base
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

    // Prime obseque yako aboseque obligatoire
    const primeObseque = 3500;
    document.getElementById('primeObseque').innerText = primeObseque.toFixed(2);

    // Prime de base
    const primeEmprunteurBase = tauxPrime * montant;
    document.getElementById('primeEmprunteur').innerText = primeEmprunteurBase.toFixed(2);

    // Calcul du taux de surprime
    const tauxSurprime = (tauxConversion / 100) * (indiceSurmortalite / 100);
    console.log("Taux de surprime:", tauxSurprime);

    // Calcul des surprimes
    const surprimeImc = primeEmprunteurBase * (1 + tauxSurprime);
    console.log("Surprime IMC:", surprimeImc);
    const surprimeTension = tauxTension > 0 ? primeEmprunteurBase * tauxTension : 0;
    const surprimeDiabete = tauxDiabete > 0 ? primeEmprunteurBase * tauxDiabete : 0;

    // Total des surprimes
    const totalSurprime = surprimeImc + surprimeTension + surprimeDiabete;
    document.getElementById('surprime').innerText = totalSurprime.toFixed(2);

    // Mise à jour des détails des surprimes
    document.getElementById('surprimeImc').textContent = surprimeImc.toFixed(2) + ' FCFA';
    document.getElementById('surprimeTension').textContent = surprimeTension.toFixed(2) + ' FCFA';
    document.getElementById('surprimeDiabete').textContent = surprimeDiabete.toFixed(2) + ' FCFA';

    // Afficher le détail des surprimes si nécessaire
    if (totalSurprime > 0) {
        document.getElementById('detailSurprimeCard').style.display = 'block';
    } else {
        document.getElementById('detailSurprimeCard').style.display = 'none';
    }

    // Prime totale
    const primeFinal = primeEmprunteurBase + primeObseque + totalSurprime;
    document.getElementById('totalPremium').innerText = primeFinal.toFixed(2);

    // Activer le bouton de souscription si le calcul est valide
    document.getElementById("btn-souscription").disabled = primeFinal <= 10;

    // Préparation des données à stocker
    const data = {
        dateNaissance: `${birthday.getDate()}-${birthday.getMonth() + 1}-${birthday.getFullYear()}`,
        age: age,
        duree: duree,
        montant: montant,
        tauxPrime: tauxPrime,
        primeEmprunteur: primeEmprunteurBase,
        primeObseque: primeObseque,
        surprimeImc: surprimeImc,
        surprimeTension: surprimeTension,
        surprimeDiabete: surprimeDiabete,
        totalSurprime: totalSurprime,
        primeFinal: primeFinal,
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

    // Envoi des données au serveur
    storeSimulationData(data);
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

function showError(message) {
    const resultat = document.getElementById("resultat");
    resultat.style.padding = "20px";
    resultat.style.color = "red";
    resultat.style.fontWeight = "bold";
    resultat.style.backgroundColor = "pink";
    resultat.style.textAlign = "center";
    resultat.style.fontSize = "20px";
    resultat.innerText = message;
    setTimeout(() => {
        window.location.reload();
    }, 5000);
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