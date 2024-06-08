window.addEventListener('load', function(){
// VARIABLES
    const date_actuelle = new Date();
    // Bouton precedent
    const precedent_btn = this.document.getElementById("saisonPrecedentBtn");
    // Bouton suivant
    const suivant_btn = this.document.getElementById("saisonSuivantBtn");
    // Mois de saison
    const mois_saison = this.document.getElementById("moisSaison");
    let mois_actuelle = date_actuelle.getMonth();
    // Annee de saison
    const annee_saison = this.document.getElementById("anneeSaison");
    let annee_actuelle = date_actuelle.getFullYear();

// FONCTIONS
    // Afficher la saison 
    const afficher_saison = function(mois,annee){
        mois_saison.textContent = monthNames[mois] +"("+mois+")";
        annee_saison.textContent = annee;
    };
    const afficher_saison_actuelle = function(){
        afficher_saison(mois_actuelle,annee_actuelle);
    }
    // Changer de saison
    const change_saison_actuelle = function(direction){
        mois_actuelle += direction;
        if (mois_actuelle > 11 || mois_actuelle < 0){
            annee_actuelle += direction;
            if(mois_actuelle < 0){
                console.log(mois_actuelle);
                mois_actuelle = 12 + mois_actuelle;
            }
            mois_actuelle = Math.abs(mois_actuelle)  % 12
        } 
    };
    // Afficher saison suivante
    const saison_suivant = function(){
        change_saison_actuelle(1);
        afficher_saison_actuelle();
    }
    suivant_btn.addEventListener('click',function(e){
        saison_suivant();
    });
    // Afficher saison precedent
    const saison_precedent = function(){
        change_saison_actuelle(-1);
        afficher_saison_actuelle();
    }
    precedent_btn.addEventListener('click',function(e){
        saison_precedent();
    });
// ACTIONS
    afficher_saison_actuelle();
});
const monthNames = [
    'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout',
    'Septembere', 'Octobre', 'Novembre', 'Decembre'
  ];
getLongMonthName =
    function(date) {
    return monthNames[date.getMonth()];
}