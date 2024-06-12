window.addEventListener('load' , function(e){
    // Bouton precedent
    const precedent_btn = this.document.getElementById("saisonPrecedentBtn");
    // Bouton suivant
    const suivant_btn = this.document.getElementById("saisonSuivantBtn");
    // Annee de saison
    const annee_saison = this.document.getElementById("anneeSaison");
// FONCTIONS
    // Afficher la saison 
    const afficher_saison_actuelle = function(){
        annee_saison.textContent = annee_actuelle;
    }
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
