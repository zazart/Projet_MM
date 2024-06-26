window.addEventListener('load', function(){
    // Bouton precedent
    const precedent_btn = this.document.getElementById("saisonPrecedentBtn");
    // Bouton suivant
    const suivant_btn = this.document.getElementById("saisonSuivantBtn");
    // Mois de saison
    const mois_saison = this.document.getElementById("moisSaison");
    // Annee de saison
    const annee_saison = this.document.getElementById("anneeSaison");
    const pdf_btn = this.document.getElementById("pdfBtn");
// FONCTIONS
function creeXHR() {
    var xhr;
    try {
      xhr = new ActiveXObject('Msxml2.XMLHTTP');
    } catch (e) {
      try {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
      } catch (e2) {
        try {
          xhr = new XMLHttpRequest();
        } catch (e3) {
          xhr = false;
        }
      }
    }
    return xhr;
  }
  function viewJournal(journalArray){
    console.log(journalArray);
    if ($.fn.DataTable.isDataTable('#journalData')) {
                $('#journalData').DataTable().destroy();
              }
              var table = $('#journalData').DataTable({
                data: journalArray,
                columns: [{title: 'Date'},{title: 'Numéro de Compte'},{title: 'Libellé'},{title: 'Débit'},{title: 'Crédit'},{title:'Tiers'}
                ]
              });

              // Événement click sur les images Modifier
              $('#journalData tbody').on('click', '.img-modifier', function() {
                var id = $(this).data('id');
                console.log('Modifier journal avec ID : ', id);
                // Ajoutez ici la logique pour modifier le journal
              });

              // Événement click sur les images Supprimer
              $('#journalData tbody').on('click', '.img-supprimer', function() {
                var id = $(this).data('id');
                console.log('Supprimer journal avec ID : ', id);
                // Ajoutez ici la logique pour supprimer le journal
              });
  }
    // Afficher la saison 
    const afficher_saison_actuelle = function(){
        mois_saison.textContent = getMonthNames()[mois_actuelle];
        console.log(annee_actuelle);
        console.log(mois_actuelle);
        annee_saison.textContent = annee_actuelle;
        var xhr = creeXHR();
        // Create GET Request to get the journal in the current time interval
        xhr.open('GET', base_url+'journal/getJournal?month='+(mois_actuelle+1)+'&year='+(annee_actuelle),true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              var response = JSON.parse(xhr.responseText);
              if (response.success) {
                var var_journal = response.journal;
                  const journalArray = var_journal.map(journal => Object.values(journal));
                  viewJournal(journalArray);
              } else {
                alert('Erreur lors de l\'insertion : ' + response.message);
              }
            } else {
              console.error('Erreur AJAX : ', xhr.status, xhr.statusText);
              alert('Une erreur s\'est produite lors de la requête AJAX.');
            }
          }
        };
        xhr.send()
        pdf_btn.setAttribute('href',base_url+'journal/generatePdf?month='+(mois_actuelle+1)+'&year='+(annee_actuelle));
    }

    // Afficher saison suivante
    const saison_suivant = function(){
        change_saison_actuelle(1);
        afficher_saison_actuelle();
    } 
    suivant_btn.addEventListener('click',function(e){
        e.preventDefault();
        saison_suivant();
    });
    // Afficher saison precedent
    const saison_precedent = function(){
        change_saison_actuelle(-1);
        afficher_saison_actuelle();
    }
    precedent_btn.addEventListener('click',function(e){
        e.preventDefault();
        saison_precedent();
    });
// ACTIONS
    afficher_saison_actuelle();
});