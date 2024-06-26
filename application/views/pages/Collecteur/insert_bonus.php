<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Insertion bonus</h5>
          <!-- Vertical Form -->
          <form class="row g-3" id="bonusForm">
            <div class="col-12">
              <label for="date" class="form-label">Date:</label>
              <input type="date" class="form-control" id="date" name="date" value="<?= date('Y-m-d'); ?>">
              <p class="text-danger" id="dateError"></p>
            </div>
            <div class="col-12">
              <label for="inputPassword4" class="form-label">Montant :</label>
              <input type="number" class="form-control" name="amount">
              <p class="text-danger" id="amountError"></p>
            </div>
            <div class="text-center">
              <button type="submit" class="boutton boutton-secondary">Inserer</button>
            </div>
          </form><!-- Vertical Form -->
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card">
        <img src="<?php echo (base_url("assets/img/bonus.jpg")) ?>" class="card-img-top">
        <div class="card-body d-flex justify-content-center mt-3">
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des bonus</button>
        </div>
        <div class="modal fade" id="verticalycentered">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="card-title">Listes des bonus</h5>
                <p>Voici les listes de tous les bonus dans le <span class="color_secondary">projet MM
                  </span>avec ses informations:</p>
                <div id="valiny">
                  <table id="bonusData">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Montant</th>
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

<script>
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

  document.addEventListener('DOMContentLoaded', function() {
    var bonusForm = document.getElementById('bonusForm');
    var xhr2 = creeXHR();
    xhr2.open('POST', '<?= base_url("collecteurs/bonusController/getliste_bonus") ?>', true);
    xhr2.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr2.onreadystatechange = function() {
      if (xhr2.readyState === XMLHttpRequest.DONE) {
        if (xhr2.status === 200) {
          var response = JSON.parse(xhr2.responseText);
          if (response.success) {
            var var_bonus = response.bonus;
            const bonusArray = var_bonus.map(bonus => Object.values(
              bonus));
            if ($.fn.DataTable.isDataTable('#bonusData')) {
              $('#bonusData').DataTable().destroy();
            }
            var table = $('#bonusData').DataTable({
              data: bonusArray,
              columns: [{
                  title: 'ID'
                },
                {
                  title: 'Date'
                },
                {
                  title: 'Montant'
                },
                {
                  title: 'Actions',
                  render: function(data, type, row,
                    meta) {
                    var editImgSrc =
                      '<?php echo base_url('assets/img/modifier.png'); ?>';
                    var deleteImgSrc =
                      '<?php echo base_url('assets/img/corbeille.png'); ?>';
                    return '<img class="img-modifier" style="margin-right:30px;cursor:pointer;" src="' +
                      editImgSrc + '" data-id="' +
                      row[0] +
                      '" alt="Modifier">' +
                      '<img class="img-supprimer" style="margin-right:30px;cursor:pointer;" src="' +
                      deleteImgSrc +
                      '" data-id="' + row[0] +
                      '" alt="Supprimer">';
                  }
                }
              ]
            });

            // Événement click sur les images Modifier
            $('#bonusData tbody').on('click', '.img-modifier',
              function() {
                var id = $(this).data('id');
                window.location.href =
                  '<?= base_url("collecteurs/bonusController/update_bonus") ?>' +
                  "/" + id;
              });

            // Événement click sur les images Supprimer
            $('#bonusData tbody').on('click', '.img-supprimer',
              function() {
                var id = $(this).data('id');
                swal({
                  title: 'Confirmation de la suppression',
                  text: 'Voulez vous vraiment supprimer ce bonus',
                  icon: 'warning',
                  buttons: true,
                  dangerMode: true,
                }).then((isOkay) => {
                  if (isOkay) {
                    var xhrSupprimer = new XMLHttpRequest();

                    xhrSupprimer.open('POST',
                      '<?= base_url("collecteurs/bonusController/delete") ?>',
                      true);
                    xhrSupprimer.setRequestHeader('X-Requested-With',
                      'XMLHttpRequest');
                    xhrSupprimer.setRequestHeader('Content-Type',
                      'application/x-www-form-urlencoded');

                    xhrSupprimer.onreadystatechange = function() {
                      if (xhrSupprimer.readyState == 4 && xhrSupprimer
                        .status == 200) {
                        var response = JSON.parse(xhrSupprimer
                          .responseText);
                        if (response.success) {
                          swal({
                            title: 'Succès',
                            text: 'Bonus supprimé avec succès.',
                            icon: 'success',
                            buttons: 'OK'
                          }).then((isOkay) => {
                            if (isOkay) {
                              window.location
                                .reload();
                            }
                          });
                        }
                      }
                      if (xhrSupprimer
                        .status == 500) {
                        swal({
                          title: 'Erreur',
                          text: 'Ce bonus ne peut pas etre supprimer',
                          icon: 'error',
                          buttons: 'OK'
                        }).then((isOkay) => {
                          if (isOkay) {
                            window.location
                              .reload();
                          }
                        });
                      }
                    };

                    xhrSupprimer.send('id=' + encodeURIComponent(
                      id
                    ));
                  }
                });
              });
          } else {
            alert('Erreur lors de l\'insertion : ' + response.message);
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


    bonusForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(bonusForm);
      var xhr = creeXHR();
      xhr.open('POST', '<?= base_url("collecteurs/bonusController/store") ?>', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              swal({
                title: 'Succès',
                text: 'Bonus ajouté avec succès.',
                icon: 'success',
                buttons: 'OK'
              }).then((isOkay) => {
                if (isOkay) {
                  window.location
                    .reload();
                }
              });
            } else {
              document.getElementById('amountError').innerHTML = response.errors
                .amount || '';
              document.getElementById('dateError').innerHTML = response.errors
                .date || '';
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