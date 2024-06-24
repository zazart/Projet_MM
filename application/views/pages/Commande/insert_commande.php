<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Insertion commande</h5>

          <!-- Vertical Form -->
          <form class="row g-3" id="commandeForm">
            <div class="col-12">
              <label for="datecommande" class="form-label">Date :</label>
              <input type="date" class="form-control" id="datecommande" name="datecommande">
              <div class="text-danger" id="datecommandeError"></div>
            </div>
            <div class="col-12">
              <label for="client" class="form-label">Client :</label>
              <div class="col-sm-12">
                <select class="form-select" aria-label="Default select example" name="client">
                  <option selected disabled>Choisit ton client</option>
                  <?php foreach ($clients as $client) : ?>
                    <option value="<?php echo $client['id_client']; ?>">
                      <?php echo $client['nomglobal']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="text-danger" id="clientError"></div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="boutton boutton-secondary">Inserer</button>
            </div>
            <div class="boite" id="boite">
              <img src="<?php echo (base_url("assets/img/check.png")) ?>">
            </div>
          </form><!-- Vertical Form -->

        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <img src="<?php echo (base_url("assets/img/news-4.jpg")) ?>" class="card-img-top">
        <div class="card-body d-flex justify-content-center mt-3">
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des commandes</button>
        </div>
        <div class="modal fade" id="verticalycentered">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="card-title">Listes des commandes</h5>
                <p>Voici les listes de tous les commandes dans le <span class="color_secondary">projet
                    MM
                  </span>avec ses informations:</p>
                <div id="valiny">
                  <table id="commandeData">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Date du commande</th>
                        <th>Client</th>
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
    var commandeForm = document.getElementById('commandeForm');
    var xhr2 = creeXHR();
    xhr2.open('POST', '<?= base_url("vente_commande/commande/getliste_commande") ?>', true);
    xhr2.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr2.onreadystatechange = function() {
      if (xhr2.readyState === XMLHttpRequest.DONE) {
        if (xhr2.status === 200) {
          var response = JSON.parse(xhr2.responseText);
          if (response.success) {
            var var_ommandes = response.commandes;
            const commandesArray = var_ommandes.map(commande => Object.values(
              commande));
            if ($.fn.DataTable.isDataTable('#commandeData')) {
              $('#commandeData').DataTable().destroy();
            }
            var table = $('#commandeData').DataTable({
              data: commandesArray,
              columns: [{
                  title: 'ID'
                },
                {
                  title: 'Date de commande'
                },
                {
                  title: 'Client'
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
            $('#commandeData tbody').on('click', '.img-modifier',
              function() {
                var id = $(this).data('id');
                console.log('Modifier commande avec ID : ', id);
                // Ajoutez ici la logique pour modifier le commande
              });

            // Événement click sur les images Supprimer
            $('#commandeData tbody').on('click', '.img-supprimer',
              function() {
                var id = $(this).data('id');
                console.log('Supprimer commande avec ID : ', id);
                // Ajoutez ici la logique pour supprimer le commande
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


    commandeForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(commandeForm);
      var xhr = creeXHR();
      xhr.open('POST', '<?= base_url("vente_commande/commande/store") ?>', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              document.getElementById('boite').style.display = 'block';
              setTimeout(function() {
                document.getElementById('boite').style.display = 'none';
                window.location.reload();
              }, 2000);
            } else {
              // Gérer les erreurs de validation et afficher les messages d'erreur
              document.getElementById('datecommandeError').innerHTML = response.errors
                .datecommande || '';
              document.getElementById('clientError').innerHTML = response.errors.client ||
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

      xhr.send(formData);
    });
  });
</script>