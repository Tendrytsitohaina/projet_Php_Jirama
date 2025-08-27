window.onload = function(){
    function updateTimeDate(){
        let now = new Date();
        let dateTimeString = now.toLocaleString();
    
        document.getElementById("datetime").textContent = dateTimeString;
    }
    
    updateTimeDate();
    
    setInterval(updateTimeDate, 1000);
    
}

function verifyDate(event){
    const moisDonnee = parseInt(document.getElementById("mois").value);
    const annee = document.getElementById("annee").value;
    const moisActuel = new Date().getMonth() + 1;
    const daty = new Date().getFullYear();
    console.log(moisActuel);
    console.log(moisDonnee);
    const moisNoms = [
       '','janvier', 'février','mars','avril','mai', 'juin',
         'juillet',  'aout','septembre', 'octobre','novembre', 'décembre'
    ];
    const moisActuelNom = moisNoms[moisActuel];
    if(annee === ""){
        alert(" Veuillez remplir l' année!");
        event.preventDefault();
        return false;
    }
    if(isNaN(parseInt(annee)) || annee.length !== 4 ){
        alert(" Veuillez entre une année valide!");
        event.preventDefault();
        return false;
    }
    
    if(annee != daty){
        document.getElementById("errorRes").innerHTML = 'on remplit le facture en 2025';
        event.preventDefault();
        return false;
    }

    if (moisActuel != moisDonnee) {
        alert( "On remplit le rélévé mois de "+ moisActuelNom+"!");
        event.preventDefault();
        return false;
    }else{
        return true;
    }
}

function verifyDate2(event){
    const moisDonnee = parseInt(document.getElementById("mois").value);
    const annee = document.getElementById("annee").value;
    const moisActuel = new Date().getMonth() + 1;
    const daty = new Date().getFullYear();
    console.log(moisActuel);
    console.log(moisDonnee);
    const moisNoms = [
    '','janvier', 'février','mars','avril','mai', 'juin',
        'juillet',  'aout','septembre', 'octobre','novembre', 'décembre'
    ];
    const moisActuelNom = moisNoms[moisActuel];
    if(annee === ""){
        alert(" Veuillez remplir l' année!");
        event.preventDefault();
        return false;
    }
    if(isNaN(annee) || annee.length !== 4 ){
        alert(" Veuillez entre une année valide!");
        event.preventDefault();
        return false;
    }
    
    if((annee > daty) == true){
        document.getElementById("errorRes").innerHTML = 'Pas de résultat pour ce date en avance du actuelle';
        alert(" Veuillez entre une année valide!");
        event.preventDefault();
        return false;
    }

    if (moisActuel < moisDonnee) {
        document.getElementById("errorRes").innerHTML = "On remplit pas le mois supérieur de l' actuelle "+ moisActuelNom+"!";
        event.preventDefault();
        return false;
    }else{
        return true;
    }
}