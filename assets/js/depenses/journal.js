window.addEventListener('load', function(){
    // Bouton precedent
    const precedent_btn = this.document.getElementById("saisonPrecedentBtn");
    // Bouton suivant
    const suivant_btn = this.document.getElementById("saisonSuivantBtn");
    // Mois de saison
    const mois_saison = this.document.getElementById("moisSaison");
    // Annee de saison
    const annee_saison = this.document.getElementById("anneeSaison");
  
// FONCTIONS
    // Afficher la saison 
    const afficher_saison_actuelle = function(){
        mois_saison.textContent = getMonthNames()[mois_actuelle];
        annee_saison.textContent = annee_actuelle;
    }

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