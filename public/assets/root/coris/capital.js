
function getCapitalGaranti() {

 
     const birthdayInput = document.getElementById('Date_naissance');
     const birthday = new Date(birthdayInput.value);
 
     // Récupérer la date actuelle
     const today = new Date();
 
     // Calculer l'âge en années
     let age = today.getFullYear() - birthday.getFullYear();

 
     console.log(age)

    let capitalGaranti = 0;

    // Calcul du capital garanti selon l'âge
    if (age >= 18 && age <= 35) {
        capitalGaranti = 350000;
    } else if (age >= 36 && age <= 45) {
        capitalGaranti = 250000;
    } else if (age >= 46 && age <= 55) {
        capitalGaranti = 145000;
    } else if (age >= 56 && age <= 60) {
        capitalGaranti = 100000;
    } else if (age >= 61 && age <= 65) {
        capitalGaranti = 75000;
    } else {
        alert("Âge hors des limites prises en charge.");
    }

    

    document.getElementById("capital").value = capitalGaranti;
    document.getElementById("displayCapital").innerHTML = capitalGaranti.toLocaleString('fr-FR', { style: 'currency', currency: 'XAF' });


    // calcule de la duree de la garantie
    const dureCalculate = 65 - age;
    const duree = document.querySelector('input[name="duree"]');

    duree.value = dureCalculate;

    const displayDureePay = document.getElementById('displayDureePay').innerHTML = dureCalculate;
    

    const numerocompte = document.querySelector('input[name="numerocompte"]');
    // const duree = document.querySelector('input[name="duree"]');
    const agence = document.querySelector('select[name="agence"]');

    

    // agence.addEventListener('change', () => {
    //     document.getElementById('displayAgence').textContent = agence.value;
   
    //     console.log("Agence :", agence.value);
    // });

 
    
    // duree.addEventListener('input', () => {
    //     document.getElementById('displayDureePay').textContent = dureCalculate;
    //     console.log("Duree de la garantie :", dureCalculate);
    // });

    numerocompte.addEventListener('input', () => {
        document.getElementById('displayNumeroCompte').textContent = numerocompte.value;
        console.log("numerocompte :", numerocompte.value);
    });

    console.log("Capital garanti :", capitalGaranti);

      // Remplir les valeurs dans le modal
      document.getElementById("modalAge").textContent = age + " ans";
      document.getElementById("modalDateNaissance").textContent = birthdayInput.value;
      document.getElementById("modalCapital").textContent = capitalGaranti.toLocaleString('fr-FR', { style: 'currency', currency: 'XAF' });
  
      // Afficher le modal
      $("#resulSimul").modal("show");

    return capitalGaranti;

    
}

// Exemple d'utilisation après saisie de la date
document.getElementById('Date_naissance').addEventListener('blur', () => {
    const capital = getCapitalGaranti();
    console.log(`Le capital garanti est de ${capital} F CFA.`);
});

document.getElementById("Agence").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    var codeBanque = selectedOption.getAttribute("data-codebanque") || "";

    document.getElementById("codebanque").value = codeBanque;

    console.log("Agence sélectionnée :", this.value);
    console.log("Code banque :", codeBanque);
});






