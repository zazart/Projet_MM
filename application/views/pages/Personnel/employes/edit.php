<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center"><?php echo $title; ?></h5>

              <form  class="row g-3" id="employesForm"> 
              <input type="hidden" name="id_employe" id="id_employe" value="<?php echo ($employe['id_employe']); ?>">
                <div class="col-12">
                  <label for="embauche" class="form-label">Date d'Embauche :</label>
                  <input type="date" class="form-control" name="embauche" id="embauche" value="<?php echo $employe['embauche']; ?>">
                  <p class="text-danger" id="embaucheError"></p>
                </div>
                <div class="col-12">
                  <label for="debauche" class="form-label">Date de Débauche :</label>
                  <input type="date" class="form-control" name="debauche" id="debauche" value="<?php echo $employe['debauche']; ?>">
                  <p class="text-danger" id="debaucheError"></p>
                </div>
                <div class="col-12">
                  <label for="nom" class="form-label">Nom :</label>
                  <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $employe['nom']; ?>">
                  <p class="text-danger" id="nomError"></p>
                </div>
                <div class="col-12">
                  <label for="email" class="form-label">Email :</label>
                  <input type="email" class="form-control" name="email" id="email" value="<?php echo $employe['email']; ?>">
                  <p class="text-danger" id="emailError"></p>
                </div>
                <div class="col-12">
                  <label for="telephone" class="form-label">Téléphone :</label>
                  <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $employe['telephone']; ?>">
                  <p class="text-danger" id="telephoneError"></p>
                </div>
                <div class="col-12">
                  <label for="adresse" class="form-label">Adresse :</label>
                  <input type="text" class="form-control" name="adresse" id="adresse" value="<?php echo $employe['adresse']; ?>">
                  <p class="text-danger" id="adresseError"></p>
                <p class="text-danger" id="adresseError"></p></div>
                <div class="col-12">
                  <label for="id_genre" class="form-label">Genre :</label>
                  <div class="col-sm-12">
                    <select name="id_genre" class="form-select" aria-label="Default select example">
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo $genre['id_genre']; ?>" <?php echo ($employe['genre_description'] == $genre['description']) ? 'selected' : ''; ?>><?php echo $genre['description']; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <p class="text-danger" id="id_genreError"></p>
                </div>
                <div class="col-12">
                  <label for="id_poste" class="form-label">Poste :</label>
                  <div class="col-sm-12">
                    <select name="id_poste" class="form-select" aria-label="Default select example">
                        <?php foreach ($postes as $poste): ?>
                            <option value="<?php echo $poste['id_poste']; ?>" <?php echo ($employe['poste_nom'] == $poste['nom']) ? 'selected' : ''; ?>><?php echo $poste['nom']; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <p class="text-danger" id="id_posteError"></p>
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Modifier l'employé</button>
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


  employesForm.addEventListener('submit', function(event) {
    event.preventDefault();
    var id_employe = document.getElementById('id_employe').value;
    var formData = new FormData(employesForm);
    var xhr = creeXHR();
    xhr.open('POST', '<?= base_url("Personnel/employes/edit") ?>' + "/" + id_employe, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            swal({
              title: 'Succès',
              text: 'Employé modifié avec succès.',
              icon: 'success',
              buttons: 'OK'
            }).then((isOkay) => {
              if (isOkay) {
                window.location.href ='<?= base_url("Personnel/employes/insert_employes") ?>'
              }
            });
          } else {
            // Gérer les erreurs de validation et afficher les messages d'erreur
            document.getElementById('embaucheError').innerHTML = response.errors.embauche || '';
            document.getElementById('nomError').innerHTML = response.errors.nom || '';
            document.getElementById('emailError').innerHTML = response.errors.email || '';
            document.getElementById('passwordError').innerHTML = response.errors.password || '';
            document.getElementById('telephoneError').innerHTML = response.errors.telephone || '';
            document.getElementById('adresseError').innerHTML = response.errors.adresse || '';
            document.getElementById('id_genreError').innerHTML = response.errors.id_genre || '';
            document.getElementById('id_posteError').innerHTML = response.errors.id_poste || '';
            document.getElementById('type_profilError').innerHTML = response.errors.type_profil || '';
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
