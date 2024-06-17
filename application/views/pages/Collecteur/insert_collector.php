<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Insertion collecteur</h5>
            <!-- Vertical Form -->
            <form class="row g-3" id="collecteurForm">
                <div class="col-12">
                  <label for="nom" class="form-label">Nom :</label>
                  <input type="text" class="form-control" id="nom" name="nom">
                  <div class="text-danger" id="nomError"></div>
                </div>
                <div class="col-12">
                  <label for="genre" class="form-label">Genre :</label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="genre" id="genre">
                      <option selected disabled>Liste genre</option>
                      <option value="1">Femme</option>
                      <option value="2">Homme</option>
                    </select>
                    <p class="text-danger" id="genreError"></p>
                  </div>
                </div>
                <div class="col-12">
                  <label for="contact" class="form-label">Contact (phone) :</label>
                  <input type="text" class="form-control" id="contact" name="contact">
                  <p class="text-danger" id="contactError"></p>
                </div>
                <div class="col-12">
                  <label for="adresse" class="form-label">Adresse :</label>
                  <input type="text" class="form-control" id="adresse" name="adresse">
                  <p class="text-danger" id="adresseError"></p>
                </div>
                <div class="col-12">
                  <label for="date" class="form-label">Début :</label>
                  <input type="date" class="form-control" id="date" name="date" value="<?= date('Y-m-d') ; ?>">
                  <p class="text-danger" id="dateError"></p>
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Inserer</button>
                </div>
                <div class="boite" id="boite">
                  <img src="<?php echo(base_url("assets/img/check.png"))?>">
                </div>
              </form><!-- Vertical Form -->
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-4">
      <div class="card" id="cache">
        <img src="<?php echo(base_url("assets/img/news-4.jpg"))?>" class="card-img-top">
        <div class="card-body d-flex justify-content-center mt-3">
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des collecteurs</button>
        </div>
        <div class="modal fade" id="verticalycentered">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="card-title">Listes des collecteurs</h5>
                <p>Voici les listes de tous les collecteurs dans le <span class="color_secondary">projet MM </span>avec ses informations:</p>
                <div id="valiny">
                  <table id="collecteurData">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Contacte</th>
                            <th>Adresse</th>
                            <th>Date d'embuche</th>
                            <th>Genre</th>
                        </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Script -->
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

  document.addEventListener('DOMContentLoaded', function() {
    var collecteurForm = document.getElementById('collecteurForm');

    collecteurForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(collecteurForm);
      var xhr = creeXHR();
      xhr.open('POST', '<?= base_url("collecteurs/collecteurController/save") ?>', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              document.getElementById('boite').style.display = 'block';
              setTimeout(function() {
                document.getElementById('boite').style.display = 'none';
                document.getElementById('cache').style.display = 'block'; 
                var var_collecteur = response.collecteurs;
                const collecteurArray = var_collecteur.map(collecteur => Object.values(collecteur));
                if ($.fn.DataTable.isDataTable('#collecteurData')) {
                  $('#collecteurData').DataTable().destroy();
                }
                var table = $('#collecteurData').DataTable({
                  data: collecteurArray,
                  columns: [
                    { title: 'ID' },
                    { title: 'Nom' },
                    { title: 'Contacte' },
                    { title: 'Adresse' },
                    { title: 'Date d\'embuche' },
                    { title: 'Genre' },
                    {
                      title: 'Actions',
                      render: function(data, type, row, meta) {
                          var editImgSrc = '<?php echo base_url('assets/img/modifier.png'); ?>';
                          return '<img class="img-modifier" style="margin-right:30px;cursor:pointer;" src="' + editImgSrc + '" data-id="' + row[0] + '" alt="Modifier">';
                      }
                    }
                  ]
                });

                // Événement click sur les images Modifier
                $('#collecteurData tbody').on('click', '.img-modifier', function() {
                    var id = $(this).data('id');
                    console.log('Modifier collecteur avec ID : ', id);
                });
              }, 2000);
            } else {
              // Gérer les erreurs de validation et afficher les messages d'erreur
              document.getElementById('nomError').innerHTML = response.errors.nom || '';
              document.getElementById('genreError').innerHTML = response.errors.genre || '';
              document.getElementById('contactError').innerHTML = response.errors.contact || '';
              document.getElementById('adresseError').innerHTML = response.errors.adresse || '';
              document.getElementById('dateError').innerHTML = response.errors.date || '';
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
  });
</script>