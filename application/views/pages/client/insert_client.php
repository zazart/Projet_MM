<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Insertion client</h5>

          <!-- Vertical Form -->
          <form  class="row g-3" id="clientForm">
            <div class="col-12">
              <label for="nomGlobal" class="form-label">Username :</label>
              <input type="text" class="form-control" id="nomGlobal" name="nomGlobal">
            </div>
            <div class="col-12">
              <label for="email" class="form-label">Email :</label>
              <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="col-12">
              <label for="adresse" class="form-label">Adresse :</label>
              <input type="text" class="form-control" id="adresse" name="adresse">
            </div>

            <div class="text-center">
              <button type="submit" class="boutton boutton-secondary">Inserer</button>
            </div>
            <div  class="boite" id="boite">
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
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des clients</button>
        </div>
        <div class="modal fade" id="verticalycentered">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-body">
                    <h5 class="card-title">Listes des clients</h5>
                    <p>Voici les listes de tous les clients dans le <span class="color_secondary">projet MM </span>avec ses informations:</p>
                    <div id="valiny">
                    <table id="clientsData">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Nom</th>
                              <th>Email</th>
                              <th>Adresse</th>
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
    var clientForm = document.getElementById('clientForm');

    clientForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(clientForm);
      var xhr = creeXHR();
      xhr.open('POST', '<?= base_url("vente_commande/client/store") ?>', true);
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
                var var_clients = response.clients;
                const clientsArray = var_clients.map(client => Object.values(client));
                if ($.fn.DataTable.isDataTable('#clientsData')) {
                  $('#clientsData').DataTable().destroy();
                }
                var table = $('#clientsData').DataTable({
                  data: clientsArray,
                  columns: [
                    { title: 'ID' },
                    { title: 'Nom' },
                    { title: 'Email' },
                    { title: 'Adresse' },
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
                $('#clientsData tbody').on('click', '.img-modifier', function() {
                    var id = $(this).data('id');
                    console.log('Modifier client avec ID : ', id);
                    // Ajoutez ici la logique pour modifier le client
                });

                // Événement click sur les images Supprimer
                $('#clientsData tbody').on('click', '.img-supprimer', function() {
                    var id = $(this).data('id');
                    console.log('Supprimer client avec ID : ', id);
                    // Ajoutez ici la logique pour supprimer le client
                });
              }, 2000);
            } else {
              alert('Erreur lors de l\'insertion : ' + response.message);
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
