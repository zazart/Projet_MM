<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center"><?php echo $title; ?></h5>
          
            <form class="row g-3" id="posteForm"> 
            <div class="col-12">
              <label for="nom" class="form-label">Nom :</label>
              <input type="text" class="form-control" name="nom" id="nom">
              <p class="text-danger" id="nomError"></p>
            </div>
            <div class="col-12">
              <label for="montant_salaire" class="form-label">Salaire :</label>
              <input type="number" class="form-control" name="montant_salaire" id="montant_salaire">
              <p class="text-danger" id="salaireError"></p>
            </div>

            <div class="text-center">
              <button type="submit" class="boutton boutton-secondary">Créer le Poste</button>
            </div>
            </form>

        </div>
      </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <img src="<?php echo(base_url("assets/img/news-4.jpg"))?>" class="card-img-top">
            <div class="card-body d-flex justify-content-center mt-3">
              <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des postes</button>
            </div>
            <div class="modal fade" id="verticalycentered">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-body">
                        <h5 class="card-title">Listes de toutes les postes</h5>
                        <p>Listes de toutes les postes dans le <span class="color_secondary">projet MM </span></p>
                        <div id="valiny">
                        <table id="postesData">
                          <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Salaire</th>
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

  document.addEventListener('DOMContentLoaded', function() {
    var posteForm = document.getElementById('posteForm');
    var xhr_ = creeXHR();
    xhr_.open('POST', '<?= base_url("Personnel/postes/get_liste") ?>', true);
    xhr_.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr_.onreadystatechange = function() {
        if (xhr_.readyState === XMLHttpRequest.DONE) {
          if (xhr_.status === 200) {
            var response = JSON.parse(xhr_.responseText);
            if (response.success) {
                var var_employes = response.employes;
                const postesArray = var_employes.map(poste => Object.values(poste));
                console.log(postesArray);
                if ($.fn.DataTable.isDataTable('#postesData')) {
                  $('#postesData').DataTable().destroy();
                }
                var table = $('#postesData').DataTable({
                  data: postesArray,
                  columns: [
                    { title: 'Id' },
                    { title: 'Nom' },
                    { title: 'Salaire' },
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

                $('#postesData tbody').on('click', '.img-modifier', function() {
                  var id = $(this).data('id');
                    window.location.href =
                      '<?= base_url("personnel/postes/edit/") ?>' +
                      "/" + id;
                });

                // Événement click sur les images Supprimer
                $('#postesData tbody').on('click', '.img-supprimer', function() {
                  var id = $(this).data('id');
                    window.location.href =
                      '<?= base_url("personnel/employes/view/") ?>' +
                      "/" + id;
                });
            }
          } else {
            console.error('Erreur AJAX : ', xhr_.status, xhr_.statusText);
            alert('Une erreur s\'est produite lors de la requête AJAX.');
          }
        }
      };

      xhr_.onerror = function() {
        console.error('Erreur réseau');
        alert('Une erreur s\'est produite lors de la requête AJAX.');
      };

      xhr_.send();


  
      posteForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(posteForm);
      var xhr = creeXHR();
      xhr.open('POST', '<?= base_url("Personnel/postes/create") ?>', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              swal({
                title: 'Succès',
                text: 'Employé ajouté avec succès.',
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
  });
</script>
