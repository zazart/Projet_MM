<!-- application/views/employes/search.php -->
<section class="section">
<div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center color_black_0"><?php echo $title; ?></h5>

            <h2>Recherche des employés</h2>

            <form  class="row g-3" id="employesForm"> 
            <div class="col-12">
                <label for="nom" class="form-label">Nom ou email:</label>
                <input type="text" class="form-control" name="nom" id="nom">
                <p class="text-danger" id="nomError"></p>
            </div>


            <div class="col-12">
                <label for="debut_embauche" class="form-label">Date d'embauche entre :</label>
                <input type="date" class="form-control" name="debut_embauche" id="debut_embauche">
                <label for="debut_embauche" class="form-label">et:</label>
                <input type="date" class="form-control" name="fin_embauche" id="fin_embauche"/>
            </div>

            <div class="col-12">
                <label for="id_genre" class="form-label">Genre :</label>
                <div class="col-sm-12">
                    <select name="id_genre" class="form-select" aria-label="Default select example">
                        <option value="">Tous</option>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo $genre['id_genre']; ?>"><?php echo $genre['description']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <p class="text-danger" id="id_genreError"></p>
            </div>


            <div class="col-12">
                <label for="id_poste" class="form-label">Poste :</label>
                <div class="col-sm-12">
                    <select name="id_poste" class="form-select" aria-label="Default select example">
                    <option value="">Tous</option>3
                    <?php foreach ($postes as $poste): ?>
                        <option value="<?php echo $poste['id_poste']; ?>"><?php echo $poste['nom']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <p class="text-danger" id="id_posteError"></p>
            </div>
            <div class="text-center">
                <button type="submit" data-bs-toggle="modal" data-bs-target="#verticalycentered" class="boutton boutton-secondary">Rechercher</button>
            </div>
            </form>
            </div>
      </div>
    </div>
</div>
</section>


<div class="modal fade" id="verticalycentered">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="card-title">Listes des employés</h5>
                <p>Listes de tous les employés dans le <span class="color_secondary">projet MM </span>avec ses informations:</p>
                <div id="valiny">
                <table id="employesData">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Numéro de Téléphone</th>
                        <th>Poste</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>





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
    var xhr_ = creeXHR();
    xhr_.open('POST', '<?= base_url("Personnel/employes/search") ?>', true);
    xhr_.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr_.onreadystatechange = function() {
        if (xhr_.readyState === XMLHttpRequest.DONE) {
          if (xhr_.status === 200) {
            var response = JSON.parse(xhr_.responseText);
            if (response.success) {
                var var_employes = response.employes;
                const employesArray = var_employes.map(employe => Object.values(employe));
                console.log(employesArray);
                if ($.fn.DataTable.isDataTable('#employesData')) {
                  $('#employesData').DataTable().destroy();
                }
                var table = $('#employesData').DataTable({
                  data: employesArray,
                  columns: [
                    { title: 'Id' },
                    { title: 'Nom' },
                    { title: 'Email' },
                    { title: 'Numéro de Téléphone' },
                    { title: 'Poste' },
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

                $('#employesData tbody').on('click', '.img-modifier', function() {
                  var id = $(this).data('id');
                    window.location.href =
                      '<?= base_url("personnel/employes/edit/") ?>' +
                      "/" + id;
                });

                // Événement click sur les images Supprimer
                $('#employesData tbody').on('click', '.img-supprimer', function() {
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


      
      var employesForm = document.getElementById('employesForm');
      employesForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(employesForm);
      var xhr = creeXHR();
      xhr.open('POST', '<?= base_url("Personnel/employes/create") ?>', true);
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
              document.getElementById('nomError').innerHTML = response.errors.nom;
              document.getElementById('id_genreError').innerHTML = response.errors.id_genre;
              document.getElementById('id_posteError').innerHTML = response.errors.id_poste;
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
