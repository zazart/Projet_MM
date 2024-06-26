<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center color_black_0"><?php echo $title; ?></h5>
            
            <form  class="row g-3" id="paiementForm"> 
            <div class="col-12">
              <label for="libelle" class="form-label">Libellé :</label>
              <input type="text" class="form-control" name="libelle" id="libelle">
              <p class="text-danger" id="libelleError"></p>
            </div>

            <div class="col-12">
              <label for="id_employe" class="form-label">Employé :</label>
              <div class="col-sm-12">
                <select name="id_employe" class="form-select" aria-label="Default select example">
                <option value="">Sélectionnez</option>
                    <?php foreach ($employes as $employe): ?>
                        <option value="<?php echo $employe['id_employe']; ?>"><?php echo $employe['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <p class="text-danger" id="id_employeError"></p>
            </div>


            <div class="text-center">
              <button type="submit" class="boutton boutton-secondary">Valider le paiement</button>
            </div>
            </form><!-- Vertical Form -->
        </div>
      </div>
    </div>
</div>




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

      paiementForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(paiementForm);
      var xhr = creeXHR();
      xhr.open('POST', '<?= base_url("Personnel/paiementEmployes/create") ?>', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              swal({
                title: 'Succès',
                text: 'Paiement effectué avec succès.',
                icon: 'success',
                buttons: 'OK'
              }).then((isOkay) => {
                if (isOkay) {
                    window.location
                        .reload();
                }
              });
            } else {
              // Gérer les erreurs de validation et afficher les messages d'erreur
              document.getElementById('libelleError').innerHTML = response.errors.libelle || '';
              document.getElementById('id_employeError').innerHTML = response.errors.id_employe || '';
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
