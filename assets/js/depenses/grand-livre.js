window.addEventListener('load' , function(e){
    // VARIABLES
    const date_actuelle = new Date();
    var annee_actuelle = date_actuelle.getFullYear();
    var mois_actuelle = date_actuelle.getMonth();
    // Bouton precedent
    const precedent_btn = this.document.getElementById("saisonPrecedentBtn");
    // Bouton suivant
    const suivant_btn = this.document.getElementById("saisonSuivantBtn");
    // Mois de saison
    // const mois_saison = this.document.getElementById("moisSaison");
    // Annee de saison
    const annee_saison = this.document.getElementById("anneeSaison");
// FONCTIONS
    // Afficher la saison 
    const afficher_saison_actuelle = function(){
        // mois_saison.textContent = getMonthNames()[mois_actuelle] +"("+mois_actuelle+")";
        annee_saison.textContent = annee_actuelle;
    }
    // Changer de saison
    function change_saison_actuelle(direction){
        mois_actuelle += direction;
        if (mois_actuelle > 11 || mois_actuelle < 0){
            annee_actuelle += (Math.abs(direction) / direction);
            if(mois_actuelle < 0){
                mois_actuelle = 12 + mois_actuelle;
            }
            mois_actuelle = Math.abs(mois_actuelle)  % 12
        } 
    };
    // Afficher saison suivante
    const saison_suivant = function(){
        change_saison_actuelle(12);
        afficher_saison_actuelle();
    }
    suivant_btn.addEventListener('click',function(e){
        saison_suivant();
    });
    // Afficher saison precedent
    const saison_precedent = function(){
        change_saison_actuelle(-12);
        afficher_saison_actuelle();
    }
    precedent_btn.addEventListener('click',function(e){
        saison_precedent();
    });
// ACTIONS
    afficher_saison_actuelle();
});
