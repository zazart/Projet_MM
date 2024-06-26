<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center"><?php echo $title; ?></h5>

              <form  class="row g-3" id="postesForm"> 
              <input type="hidden" name="id_poste" id="id_poste" value="<?php echo ($poste['id_poste']); ?>">
              <div class="col-12">
                  <label for="nom" class="form-label">Nom :</label>
                  <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $poste['nom']; ?>">
                  <p class="text-danger" id="nomError"></p>
                </div>
                <div class="col-12">
                  <label for="montant_salaire" class="form-label">Salaire :</label>
                  <input type="number" class="form-control" name="montant_salaire" id="montant_salaire" value="<?php echo $poste['montant_salaire']; ?>">
                  <p class="text-danger" id="salaireError"></p>
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Modifier le Poste</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>







    <script>
  function creeXHR(){
    var xhr; 
    try {  
        xhr = new ActiveXObject('Msxml2.XMLHTTP');   
    }
    catch (e) {
        try {   
            xhr = new ActiveXObject('Microsoft.XMLHTTP'); 
        }
        catch (e2) {
            try {  
                xhr = new XMLHttpRequest();  
            }
            catch (e3) {
                xhr = false;   
            }
        }
    }
    return xhr;
  }


  postesForm.addEventListener('submit', function(event) {
    event.preventDefault();
    var id_poste = document.getElementById('id_poste').value;
    var formData = new FormData(postesForm);
    var xhr = creeXHR();
    xhr.open('POST', '<?= base_url("Personnel/postes/edit/") ?>' + "/" + id_poste, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            swal({
              title: 'Succès',
              text: 'Poste modifié avec succès.',
              icon: 'success',
              buttons: 'OK'
            }).then((isOkay) => {
              if (isOkay) {
                window.location.href ='<?= base_url("Personnel/postes/insert_postes") ?>'
              }
            });
          } else {
            // Gérer les erreurs de validation et afficher les messages d'erreur
            document.getElementById('nomError').innerHTML = response.errors.nom || '';
            document.getElementById('salaireError').innerHTML = response.errors.salaire || '';
          }
        } else {
          console.error('Erreur AJAX : ', xhr.status, xhr.statusText);
          alert('Une erreur s\'est produite lors de la requête AJAX.');
        }
      }
    };

    xhr.onerror = function() {
      console.error('Erreur réseau');
      alert('Une erreur s\'est produite lors de la requête AJAX.');
    };

    xhr.send(formData);
  });
</script>
