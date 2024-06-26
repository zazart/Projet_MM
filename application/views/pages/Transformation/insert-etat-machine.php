<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <?php
                         echo isset($statut) ? 'Modifier statut Machine' : 'Ajouter un statut'; ?>
                    </h5>

                    <!-- Vertical Form -->
                    <form id="insertetatform" class="row g-3">
                    <?php
                    $action_url ='transformation/statut_controller/validation_insert_statut';
                    ?>
                      <input type="hidden" name="id" value="<?php echo (isset($statut) ? $statut["id_stat"] : null)?>">
                    <div class="col-12">
                        <label for="id_machine" class="form-label">Nom machine:</label>
                        <div class="col-sm-12">
                            <select class="form-select" aria-label="Default select example" id="id_machine" name="id_machine">
                                <option selected disabled>Choisis une machine</option>
                                <?php 
                                    foreach ($machines as $machine) {                                      // Si le statut est défini et correspond à l'ID de la machine, on ajoute l'attribut selected
                                      ?>
                                        <option value="<?php echo $machine['id_machine'];?>" <?php  echo (isset($statut) && $statut['id_machine'] == $machine['id_machine'] ? 'selected' : '')?>>
                                                <?php echo $machine["nom_machine"];?>
                                        </option>
                                    <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <p class="text-danger" id="machineError"></p>					

                    </div>

                    <div class="col-12">
                        <label for="date_verification" class="form-label">Date de la verification:</label>
                        <input type="date" class="form-control" name="date_verification" value="<?php echo isset($statut['date_verification']) ? $statut['date_verification'] : ''; ?>">
                        <p class="text-danger" id="dateError"></p>					                        
                    </div>

                    <div class="col-12">
                        <label for="statut" class="form-label">Statut:</label>
                        <input type="number" class="form-control" name="statut" value="<?php echo isset($statut['statut']) ? $statut['statut'] : ''; ?>">
                        <p class="text-danger" id="statutError"></p>					
                    </div>
                    
                    <div class="col-12">
                        <label for="descri" class="form-label">Description:</label>
                        <textarea class="form-control" name="descri" > <?php echo isset($statut['descri']) ? $statut['descri'] : ''; ?></textarea>
                        <p class="text-danger" id="descError"></p>					                    
                    </div>

                    <div class="text-center">
                        <input type="submit" name="submit" class="btn btn-secondary" value="<?php echo isset($statut) ? 'Mettre à Jour' : 'Ajouter'; ?>" /> 
                    </div>
                    
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
        <?php if (!isset($statut)){ ?>
              <div class="col-lg-4">
                    <div class="card" >
                      <img src="<?php echo(base_url("assets/img/news-4.jpg"))?>" class="card-img-top">
                      <div class="card-body d-flex justify-content-center mt-3">
                        <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir l'état des machines</button>
                      </div>
                      <div class="modal fade" id="verticalycentered">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                  <h5 class="card-title">Etat des machines</h5>
                                  <p>Voici les listes des états de machine du <span class="color_secondary">projet MM </span>avec ses informations:</p>
                                  <div id="valiny">
                                  <table id="etatData">
                                    <thead>
                                        <tr>
                                        <th>Nom</th>
                                        <th>Date derniere verification</th>
                                        <th>Statut</th>
                                        <th>Description</th>
                                        <th>Actions</th>
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
        <?php }?>
    </div>
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

        document.addEventListener("DOMContentLoaded",function(){
          var insertetatform=document.getElementById("insertetatform");
          var formdata=new FormData(insertetatform);
            var xhr2=creerXHR(); //
            xhr2.open('POST','<?= site_url("transformation/statut_controller")?>',true);
            xhr2.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr2.onreadystatechange=function(){
              if(xhr2.readyState ===  XMLHttpRequest.DONE){
                  if(xhr2.status === 200){
                    var response=JSON.parse(xhr2.responseText);
                    if(response.success){
                      var var_etat = response.status;
                      const etatArray = var_etat.map(status => Object.values(status));
                      if ($.fn.DataTable.isDataTable('#etatData')) {
                        $('#etatData').DataTable().destroy();
                      }
                      var table = $('#etatData').DataTable({
                        data: etatArray,
                        columns: [
                          { title: 'Nom' },
                          { title: 'Date derniere verification' },
                          { title: 'statut' },
                          { title: 'Description' },
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
                      $('#etatData tbody').on('click', '.img-modifier', function() {
                          var id = $(this).data('id');
                          var url="<?php echo site_url("transformation/statut_controller/edit_etat");?>/"+id;
                          window.location.href=url;
                          console.log('Supprimer client avec ID : ', id);
                          // Ajoutez ici la logique pour supprimer le client
                          // Ajoutez ici la logique pour modifier le client
                      });

                      // Événement click sur les images Supprimer
                      $('#etatData tbody').on('click', '.img-supprimer', function() {
                           // ===============
                          var id = $(this).data('id');
                        swal({
                          title: 'Confirmation de la suppression',
                          text:'Voulez vous vraiment le supprimer? ',
                          icon:'warning',
                          buttons:true,
                          dangerMode:true,
                        }).then((isOkay)=>{
                                if(isOkay) {
                                  var url="<?php echo site_url("transformation/statut_controller/validation_delete_statut/")?>";
                                  $.post( url , {id : id}).done(function(data){
                                    swal({
                                        title: 'Succes',
                                        text:'Etat supprimée avec succès.',
                                        icon:'success',
                                        button:'OK'
                                      }).then((isOkay)=>{
                                        if(isOkay){
                                          window.location.reload();
                                        }
                                      });
                                  });  
                                }
                        });
                          
                       
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


          insertetatform.addEventListener('submit',function(event){
            event.preventDefault();
            var formdata=new FormData(insertetatform);
            var xhr=creerXHR(); //
            xhr.open('POST','<?= site_url($action_url)?>',true);
            xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr.onreadystatechange=function(){
              if(xhr.readyState ===  XMLHttpRequest.DONE){
                  if(xhr.status === 200){
                    var response=JSON.parse(xhr.responseText);
                    if(response.success){
                      swal({
                        title: 'Succes',
                        text:'Etat de la machine ajouté avec succes.',
                        icon:'success',
                        button:'OK'
                      }).then((isOkay)=>{
                        if(isOkay){
                          window.location.href="<?php echo base_url("transformation/statut_controller/view_insertion_statut");?>";
                        }
                      });
                    }
                    else{
                        document.getElementById("descError").innerHTML=response.errors.desc ||'';
                        document.getElementById("machineError").innerHTML=response.errors.machine ||'';
                        document.getElementById("dateError").innerHTML=response.errors.date ||'';
                        document.getElementById("statutError").innerHTML=response.errors.statut ||'';
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
</section>
