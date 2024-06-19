<!-- START FORMULAIRE DEPENSE -->
<section class="row"> 
    <div class="mx-auto col-10 p-2">
        <div class="card ">
            <div class="card-body m-2">
                <!-- Formulaire -->
                <form id="depenseForm" class="row g-3" enctype="multipart/form-data">
                    <!-- Description -->
                    <div class="col-12">
                        <label for="description" class="input-label">Description </label>
                        <input type="text" class="form-control" name="description" id="description" 
                        
                        >
                    </div>
                    <!-- Date -->
                    <div class="col-12">
                        <label for="dateDepense" class="input-label">Date de depense</label>
                        <input type="date" class="form-control" id="dateDepense" name="dateDepense" 
                        
                        >
                    </div>
                    <!-- Montant -->
                    <div class="col-12">
                        <label for="montant" class="input-label">Montant</label>
                        <input type="number" name="montant" id="montant" class="form-control" min="0" step="0.1">
                    </div>
                    <!-- PCG -->
                    <div class="col-12">
                        <label for="id_Pcg" class="input-label">PCG </label>
                        <select class="form-select" name="id_Pcg" id="id_Pcg" 
                        
                        >
                            <option value=""></option>
                            <?php foreach ($pcg as $item): ?>
                                <option value="<?php echo $item['id_pcg']; ?>"><?php echo $item['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Subcompte -->
                    <div class="col-12">
                        <label for="id_Categorie" class="input-label">Categorie </label>
                        <select class="form-select" name="id_Categorie" id="id_Categorie" 
                        
                        >
                            <option value=""></option>
                        </select>
                    </div>
                    <!-- Mode de paiement -->
                    <div class="col-12">
                        <label for="id_ModePaiment" class="input-label">Mode de paiement</label>
                        <select class="form-select" name="id_ModePaiment" id="id_ModePaiment" 
                        
                        >
                            <option value=""></option>
                            <?php foreach ($modes_de_paiement as $mode): ?>
                                <option value="<?php echo $mode['id_modepaiment']; ?>"><?php echo $mode['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Justificatif -->
                    <div class="col-12">
                        <label for="justificatif" class="input-label">Justificatif</label>
                        <input type="file" name="justificatif" id="justificatif" class="form-control">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="col-2 btn boutton-light">Inserer</button>
                    </div>
                    <div  class="boite" id="boite">
                        <img src="<?php echo(base_url("assets/img/check.png"))?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
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
                    <table id="depenseData">
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
<script src="<?php echo base_url('assets/js/depenses/depenses.js'); ?>"></script>

<!-- SCRIPT DYNAMYSME FORMULAIRE -->
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
    var depenseForm = document.getElementById('depenseForm');

    depenseForm.addEventListener('submit', function(event) {
        // Prevent the default action
        event.preventDefault();
        // Get the js data of the formulaire
        var formData = new FormData(depenseForm);
        // Create the XHR variable
        var xhr = creeXHR();
        // Create POST Request to insert
        xhr.open('POST', '<?= base_url("depense/create")?>', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        // Change control of the request
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
                if ($.fn.DataTable.isDataTable('#depenseData')) {
                  $('#depenseData').DataTable().destroy();
                }
                var table = $('#depenseData').DataTable({
                  data: clientsArray,
                  columns: [
                    { title: 'ID' },
                    { title: 'Description'},
                    { title: 'Montant' },
                    { title: 'Date de depense'},
                    { title: 'Justificatif'},
                    { title: 'Mode de paiement'},
                    { title: 'Sub comptes'},
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
                $('#depenseData tbody').on('click', '.img-modifier', function() {
                    var id = $(this).data('id');
                    console.log('Modifier client avec ID : ', id);
                    // Ajoutez ici la logique pour modifier le client
                });

                // Événement click sur les images Supprimer
                $('#depenseData tbody').on('click', '.img-supprimer', function() {
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
<!-- END FORMULAIRE DEPENSE -->