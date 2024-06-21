<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Insertion collecte</h5>

          <!-- Vertical Form -->
          <form class="row g-3" id="collectForm">
            <div class="col-12">
              <label for="collecteur" class="form-label">Liste des Collecteurs :</label>
              <div class="col-sm-12">
                <select class="form-select" aria-label="Default select example" id="collecteur" name="collecteur">
                  <?php foreach($collectors as $collector): ?>
                      <option value="<?php echo $collector['id_collecteur']; ?>"><?php echo $collector['nom']; ?></option>
                  <?php endforeach; ?>
                  </select>
                <p class="text-danger" id="collecteurError"></p>
              </div>
            </div>
            <div class="col-12">
              <label for="matiere" class="form-label">Matiere premiere :</label>
              <div class="col-sm-12">
                <select class="form-select" aria-label="Default select example" name="matiere" id="matiere">
                  <option value="1">Ricin</option>
                  <option value="2">Jojoba</option>
                  <option value="3">Figue</option>
                </select>
                <p class="text-danger" id="matiereError"></p>
              </div>
            </div>
            <div class="col-12">
              <label for="qtt" class="form-label">Quantite :</label>
              <input type="number" class="form-control" name="qtt" id="qtt">
              <p class="text-danger" id="qttError"></p>
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
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des collects</button>
        </div>
        <div class="modal fade" id="verticalycentered">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="card-title">Listes des collects</h5>
                <p>Voici les listes de tous les collects dans le <span class="color_secondary">projet MM </span>avec ses informations:</p>
                <div id="valiny">
                  <table id="collectData">
                    <thead>
                        <tr>
                          <th>Id</th>
                          <th>Quantité</th>
                          <th>Collecteur</th>
                          <th>Matiere Premier</th>
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
    var collectForm = document.getElementById('collectForm');

    collectForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(collectForm);
      var xhr = creeXHR();
      xhr.open('POST', '<?= base_url("collecteurs/collectController/save") ?>', true);
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
                var var_collect = response.collects;
                const collectArray = var_collect.map(collect => Object.values(collect));
                if ($.fn.DataTable.isDataTable('#collectData')) {
                  $('#collectData').DataTable().destroy();
                }
                var table = $('#collectData').DataTable({
                  data: collectArray,
                  columns: [
                    { title: 'ID' },
                    { title: 'Quantite' },
                    { title: 'Collecteur' },
                    { title: 'Matiere Premier' },
                    {
                      title: 'Actions',
                      render: function(data, type, row, meta) {
                          var editImgSrc = '<?php echo base_url('assets/img/modifier.png'); ?>';
                          var deleteImgSrc = '<?php echo base_url('assets/img/corbeille.png'); ?>';
                          return '<img class="img-modifier" style="margin-right:30px;cursor:pointer;" src="' + editImgSrc + '" data-id="' + row[0] + '" alt="Modifier">' +
                                '<img class="img-supprimer" style="margin-right:30px;cursor:pointer;" src="' + deleteImgSrc + '" data-id="' + row[0] + '" alt="Supprimer">';
                      }
                    }
                  ]
                });

                // Événement click sur les images Modifier
                $('#collectData tbody').on('click', '.img-modifier', function() {
                    var id = $(this).data('id');
                    console.log('Modifier collect avec ID : ', id);
                    // Ajoutez ici la logique pour modifier le client
                });

                // Événement click sur les images Supprimer
                $('#collectData tbody').on('click', '.img-supprimer', function() {
                    var id = $(this).data('id');
                    console.log('Supprimer collect avec ID : ', id);
                    // Ajoutez ici la logique pour supprimer le client
                });
              }, 2000);
            } else {
              // Gérer les erreurs de validation et afficher les messages d'erreur
              document.getElementById('collecteurError').innerHTML = response.errors.collecteur || '';
              document.getElementById('matiereError').innerHTML = response.errors.matiere || '';
              document.getElementById('qttError').innerHTML = response.errors.qtt || '';
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