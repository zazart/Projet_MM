<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">
            <?php
            if (isset($source_matiere_premier_data['matierpremier'])) {
              echo "Modification du source de matiere premiere";
            } else {
              echo "insertion d'une source a une matiere premiere";
            }
            ?>
          </h5>
          <form id="sourcematiereform" class="row g-3">
            <input type="hidden" name="id" value="<?php echo isset($source_matiere_premier_data['id_sourcematierepremier']) ? $source_matiere_premier_data['id_sourcematierepremier'] : ''; ?>">
            <div class="col-12">
              <div class="col-sm-12">
                <label for="nom" class="form-label">Nom matière premiere</label>
                <select class="form-select" name="nom" id="nom" aria-label="Default select example">
                  <option value="" selected disabled>Selectionnez le nom</option>
                  <?php foreach ($matiere_data as $matiere) : ?>
                    <option value="<?php echo $matiere['id_matierepremier']; ?>" <?php echo (isset($source_matiere_premier_data['matierpremier']) &&  $source_matiere_premier_data['matierpremier'] == $matiere['id_matierepremier']) ? 'selected' : '' ?>>
                      <?php echo $matiere['nom']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <p class="text-danger" id="nomError"></p>

              </div>
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Date prelevement</label>
                <input type="Date" class="form-control" id="date" name="date" value="<?php if (isset($source_matiere_premier_data['dateprelevement'])) {
                                                                                        echo $source_matiere_premier_data['dateprelevement'];
                                                                                      } ?>" autofocus>
                <p class="text-danger" id="dateError"></p>

              </div>

              <div class="col-sm-12">
                <label for="nom" class="form-label">Source</label>
                <select class="form-select" name="source" id="nom" aria-label="Default select example">
                  <option value="" selected disabled>Selectionnez la source</option>
                  <?php foreach ($source_data as $source) : ?>
                    <option value="<?php echo $source['id_source']; ?>" <?php echo (isset($source_matiere_premier_data['source']) && $source_matiere_premier_data['source'] == $source['id_source']) ? 'selected' : '' ?>>
                      <?php echo $source['lieu']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <p class="text-danger" id="sourceError"></p>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="boutton boutton-secondary">
                <?php if (isset($source_matiere_premier_data['matierpremier'])) {
                  echo "modifier";
                } else {
                  echo "inserer";
                } ?>
              </button>
            </div>
          </form>
          <!-- Vertical Form -->
        </div>
      </div>
    </div>
    <?php if (!isset($source_matiere_premier_data['matierpremier'])) { ?>
      <div class="col-lg-4">
        <div class="card">
          <img src="<?php echo (base_url("assets/img/news-4.jpg")) ?>" class="card-img-top">
          <div class="card-body d-flex justify-content-center mt-3">
            <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des source de matieres premieres</button>
          </div>
          <div class="modal fade" id="verticalycentered">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body">
                  <h5 class="card-title">Listes des source des matieres premieres</h5>
                  <p>Voici les listes de tous les sources des matieres premieres dans le <span class="color_secondary">projet MM </span>avec ses informations:</p>
                  <div id="valiny">
                    <table id="sourcematiereData">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nom</th>
                          <th>lieu</th>
                          <th>date de modification</th>
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
    <?php } ?>

  </div>
</section>
<script>
  function creerXHR() {
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

  var xhr2 = creerXHR(); //
  xhr2.open('POST', '<?= site_url("Matiere_premier/list_source_matiere_premier") ?>', true);
  xhr2.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhr2.onreadystatechange = function() {
    if (xhr2.readyState === XMLHttpRequest.DONE) {
      if (xhr2.status === 200) {
        var response = JSON.parse(xhr2.responseText);
        if (response.success) {
          var var_matiere = response.source_matiere;
          const matiereArray = var_matiere.map(source_matiere => Object.values(source_matiere));
          if ($.fn.DataTable.isDataTable('#sourcematiereData')) {
            $('#sourcematiereData').DataTable().destroy();
          }
          var table = $('#sourcematiereData').DataTable({
            data: matiereArray,
            columns: [{
                title: 'id'
              },
              {
                title: 'dateprelevement'

              },
              {
                title: 'matière premiere'

              },
              {
                title: 'lieu'
              },
              {
                title: 'Actions',
                render: function(data, type, row, meta) {
                  var editImgSrc =
                    '<?php echo base_url('assets/img/modifier.png'); ?>';
                  var deleteImgSrc =
                    '<?php echo base_url('assets/img/corbeille.png'); ?>';
                  return '<img class="img-modifier" style="margin-right:30px;cursor:pointer;" src="' +
                    editImgSrc + '" data-id="' + row[0] + '" alt="Modifier">' +
                    '<img class="img-supprimer" style="margin-right:30px;cursor:pointer;" src="' +
                    deleteImgSrc + '" data-id="' + row[0] + '" alt="Supprimer">';
                }
              }
            ]
          });

          // Événement click sur les images Modifier
          $('#sourcematiereData tbody').on('click', '.img-modifier', function() {
            var id = $(this).data('id');
            var url = "<?php echo base_url("Matiere_premier/edit_source_matier_permier"); ?>/" + id;
            window.location.href = url;
            // Ajoutez ici la logique pour modifier le client
          });

          // Événement click sur les images Supprimer
          $('#sourcematiereData tbody').on('click', '.img-supprimer', function() {
            var id = $(this).data('id');
            swal({
              title: 'Confirmation de la suppression',
              text: 'Voulez vous vraiment le supprimer?',
              icon: 'warning',
              buttons: true,
              dangerMode: true,
            }).then((isOkay) => {
              if (isOkay) {
                var url =
                  "<?php echo base_url("Matiere_premier/drop_source_matier_permier") ?>";
                $.post(url, {
                  id: id
                }, function(data) {
                  swal({
                    title: 'Succes',
                    text: 'Supprimée avec succès.',
                    icon: 'success',
                    button: 'OK'
                  }).then((isOkay) => {
                    if (isOkay) {
                      window.location.reload();
                    }
                  });
                });
              }
            });

            console.log('Supprimer client avec ID : ', id);
            // Ajoutez ici la logique pour supprimer le client
          });
        }
      } else {
        console.error('Erreur AJAX : ', xhr2.status, xhr2.statusText);
        alert('Une erreur s\'est produite lors de la requête AJAX.');
      }
    }
  };
  xhr2.onerror = function() {
    console.error('Erreur réseau');
    alert('Une erreur s\'est produite lors de la requête AJAX.');
  };
  xhr2.send();

  document.addEventListener("DOMContentLoaded", function() {
    var sourcematiereform = document.getElementById("sourcematiereform");

    sourcematiereform.addEventListener('submit', function(event) {
      event.preventDefault();
      var formdata = new FormData(sourcematiereform);
      var xhr = creerXHR(); //
      xhr.open('POST', '<?= site_url("Matiere_premier/create_source_matiere_premier") ?>', true);
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              swal({
                title: 'Succes',
                text: 'Source des matières premières ajouté avec succes.',
                icon: 'success',
                button: 'OK'
              }).then((isOkay) => {
                if (isOkay) {
                  window.location.href =
                    "<?php echo base_url("Matiere_premier/sourcematierepremier"); ?>";
                }
              });
            } else {
              document.getElementById("nomError").innerHTML = response.errors.nom || '';
              document.getElementById("dateError").innerHTML = response.errors.date || '';
              document.getElementById("sourceError").innerHTML = response.errors.source ||
                '';

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
      xhr.send(formdata);
    });
  });
</script>