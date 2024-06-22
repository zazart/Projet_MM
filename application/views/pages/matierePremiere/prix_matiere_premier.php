<section class="section">
      <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
            <h5 class="card-title text-center">Prix des matières premières</h5>
<!-- Vertical Form -->
                <form class="row g-3"   id="prixInsertForm">
                <input type="hidden" name="id" value="<?php echo isset($prix_matiere['id_prixmatierepremier']) ? $prix_matiere['id_prixmatierepremier'] : ''; ?>">
                <div class="col-12">
                <label for="nom" class="form-label">Nom</label>
                        <div class="col-sm-12">
                            <select class="form-select" name="nom" id="nom" aria-label="Default select example" required>
                                    <option value="" selected disabled>Selectionnez le nom</option>
                                    <?php foreach ($matiere_data as $matiere): ?>
                                        <option value="<?php echo $matiere['id_matierepremier']; ?>" 
                                                    <?php echo (isset($prix_matiere['matierpremier']) && $prix_matiere['matierpremier'] == $matiere['id_matierepremier']) ? 'selected' : ''; ?>>
                                                    <?php echo $matiere['nom']; ?>
                                        </option>
                                    <?php endforeach; ?>
                            <p class="text-danger" id="nomError"></p>					

                            </select>
                        </div>
                </div>
                <div class="col-12">
                                <label for="inputNanme4" class="form-label">Prix</label>
                                <input type="number" name="prix" class="form-control" id="prix" value="<?php if (isset($prix_matiere['prix'])) { echo $prix_matiere['prix'];} ?>" required autofocus>
                                <p class="text-danger" id="prixError"></p>					
                </div>
                <div class="col-12">
                                <label for="inputNanme4" class="form-label">Date</label>
                                <input type="Date" class="form-control" id="date"  name="date" value="<?php if (isset($prix_matiere['dateprix'])) { echo $prix_matiere['dateprix']; } ?>" required autofocus>
                                <p class="text-danger" id="dateError"></p>					
                </div>
                <div class="text-center">
                                <button type="submit" class="boutton boutton-secondary">OK</button>
                </div>
                <div class="boite" id="boite">
                  <img src="<?php echo(base_url("assets/img/check.png"))?>">
                </div>
            </form>
<!-- Vertical Form -->
        </div>
        </div>
    </div>
    <div class="col-lg-4">
      <div class="card" >
        <img src="<?php echo(base_url("assets/img/news-4.jpg"))?>" class="card-img-top">
        <div class="card-body d-flex justify-content-center mt-3">
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir la liste des prix des matieres premiere</button>
        </div>
        <div class="modal fade" id="verticalycentered">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-body">
                    <h5 class="card-title">Liste des prix de chaque matiere premiere</h5>
                    <p>Voici les listes de tous prix des  matieres premieres dans le <span class="color_secondary">projet MM </span>avec ses informations:</p>
                    <div id="valiny">
                    <table id="prixdata">
                      <thead>
                          <tr>
                              <th>Nom</th>
                              <th>Prix</th>
                              <th>Date de modification</th>
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
    function creerXHR(){
          var xhr;
          try{
            xhr=new ActiveXObject('Msxml2.XMLHTTP');
          }
          catch(e){
            try{
              xhr=new ActiveXObject('Microsoft.XMLHTTP');
            }
            catch(e2){
              try {
                  xhr=new XMLHttpRequest();
              } catch (e3) {
                  xhr=false;
              }
            }
          }
          return xhr;
        }

        var xhr2=creerXHR(); //
            xhr2.open('POST','<?= site_url("Matiere_premier/list_prix_matiere")?>',true);
            xhr2.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr2.onreadystatechange=function(){
              if(xhr2.readyState ===  XMLHttpRequest.DONE){
                  if(xhr2.status === 200){
                    var response=JSON.parse(xhr2.responseText);
                    if(response.success){
                      var var_prixList = response.prixmatiere;
                      const prixArray = var_prixList.map(prixmatiere => Object.values(prixmatiere));
                      if ($.fn.DataTable.isDataTable('#prixdata')) {
                        $('#prixdata').DataTable().destroy();
                      }
                      var table = $('#prixdata').DataTable({
                        data: prixArray,
                        columns: [
                          { title: 'nom' },
                          {title:'prix'},
                          {title:'dateprix'},
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
                      $('#prixdata tbody').on('click', '.img-modifier', function() {
                          var id = $(this).data('id');
                          console.log('Modifier client avec ID : ', id);
                          var url="<?php echo base_url("Matiere_premier/edit_prix_matier_permier")?>/"+id;
                          window.location.href = url;
                          // Ajoutez ici la logique pour modifier le client
                      });

                      // Événement click sur les images Supprimer
                      $('#prixdata tbody').on('click', '.img-supprimer', function() {
                          var id = $(this).data('id');
                          var url="<?php echo base_url("Matiere_premier/drop_prix_matier_premie")?>";
                          $.post(url,{id:id},function(data){
                            window.locatio.reload();
                          });
                          console.log('Supprimer client avec ID : ', id);
                        
                          // Ajoutez ici la logique pour supprimer le client
                      });
                    }
                  }
                  else {
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

        document.addEventListener("DOMContentLoaded",function(){
          var prixInsertForm=document.getElementById("prixInsertForm");

          prixInsertForm.addEventListener('submit',function(event){
            event.preventDefault();
            var formdata=new FormData(prixInsertForm);
            var xhr=creerXHR(); //
            xhr.open('POST','<?= site_url("Matiere_Premier/create_prix")?>',true);
            xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr.onreadystatechange=function(){
              if(xhr.readyState ===  XMLHttpRequest.DONE){
                  if(xhr.status === 200){
                    var response=JSON.parse(xhr.responseText);
                    if(response.success){
                      document.getElementById('boite').style.display="block";
                      setTimeout(function(){
                        document.getElementById('boite').style.display="none";
                        window.location.reload();
                      },2000);
                    }
                    else{
                      document.getElementById("nomError").innerHTML=response.errors.nom ||'';
                      document.getElementById("prixError").innerHTML=response.errors.prix ||'';
                      document.getElementById("dateError").innerHTML=response.errors.date ||'';                      
                    }
                  }
                  else {
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



