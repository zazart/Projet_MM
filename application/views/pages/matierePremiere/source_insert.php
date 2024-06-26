<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">
            <?php if (isset($source['lieu'])) {
              echo "Modification d'un source";
            } else {
              echo "insertion d'un nouvelle source";
            } ?></h5>
          <!-- Vertical Form -->
          <form class="row g-3" id="SourceInsert">
            <input type="hidden" name="id" value="<?php echo isset($source['id_source']) ? $source['id_source'] : ''; ?>">
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Ajouter le lieu</label>
              <input id="lieu" type="text" class="form-control" name="lieu" value="<?php if (isset($source['lieu'])) {
                                                                                      echo $source['lieu'];
                                                                                    } ?>">
              <p class="text-danger" id="sourceError"></p>
            </div>
            <div class="text-center">
              <button type="submit" class="boutton boutton-secondary">
                <?php if (isset($source['lieu'])) {
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
    <?php if (!isset($source['lieu'])) { ?>
      <div class="col-lg-4">
        <div class="card">
          <img src="<?php echo (base_url("assets/img/source.jpeg")) ?>" class="card-img-top">
          <div class="card-body d-flex justify-content-center mt-3">
            <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des sources</button>
          </div>
          <div class="modal fade" id="verticalycentered">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body">
                  <h5 class="card-title">Listes des sources</h5>
                  <p>Voici les listes de tous les sources dans le <span class="color_secondary">projet MM
                    </span>avec ses informations:</p>
                  <div id="valiny">
                    <table id="sourceData">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>lieu</th>
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
  xhr2.open('POST', '<?= site_url("Matiere_premier/list_source") ?>', true);
  xhr2.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhr2.onreadystatechange = function() {
    if (xhr2.readyState === XMLHttpRequest.DONE) {
      if (xhr2.status === 200) {
        var response = JSON.parse(xhr2.responseText);
        if (response.success) {
          var var_source = response.source;
          const sourceArray = var_source.map(source => Object.values(source));
          if ($.fn.DataTable.isDataTable('#sourceData')) {
            $('#sourceData').DataTable().destroy();
          }
          var table = $('#sourceData').DataTable({
            data: sourceArray,
            columns: [{
                title: 'id_source'
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
          $('#sourceData tbody').on('click', '.img-modifier', function() {
            var id = $(this).data('id');
            // Ajoutez ici la logique pour modifier le client
            var url = "<?php echo base_url('Matiere_premier/edit_source') ?>/" + id;
            window.location.href = url;
          });

          // Événement click sur les images Supprimer
          $('#sourceData tbody').on('click', '.img-supprimer', function() {

            var id = $(this).data('id');
            swal({
              title: 'Confirmation de la suppression',
              text: 'Voulez vous vraiment le supprimer?',
              icon: 'warning',
              buttons: true,
              dangerMode: true,
            }).then((isOkay) => {
              if (isOkay) {
                var url = "<?php echo base_url('Matiere_premier/drop_source') ?>";
                $.post(url, {
                  id: id
                }, function(data) {
                  swal({
                    title: 'Succes',
                    text: 'source supprimée avec succès.',
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
    var SourceInsert = document.getElementById("SourceInsert");

    SourceInsert.addEventListener('submit', function(event) {
      event.preventDefault();
      console.log("SourceInsertldhfishk");
      var formdata = new FormData(SourceInsert);
      var xhr = creerXHR(); //
      xhr.open('POST', '<?= site_url("Matiere_premier/create_source") ?>', true);
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              swal({
                title: 'Succes',
                text: 'source ajouté avec succes.',
                icon: 'success',
                button: 'OK'
              }).then((isOkay) => {
                if (isOkay) {
                  window.location.href =
                    "<?php echo base_url("Matiere_premier/source"); ?>";
                }
              });
            } else {
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