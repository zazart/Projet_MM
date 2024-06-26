<sc class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center"><?php echo isset($machine) ? 'Modifier Machine' : 'Ajouter une Machine'; ?></h5>

              <!-- Vertical Form -->
               <form id="machineinsertform" class="row g-3">
                <input type="hidden" value="<?php echo (isset($machine)) ? $machine['id_machine']:null;?>" name="id">
                <div class="col-12">
                  <label for="nom_machine" class="form-label">Nom:</label>
                  <input type="text" class="form-control" name="machine" value="<?php echo isset($machine) ? $machine['nom_machine'] : ''; ?>"  autofocus>
                  <p class="text-danger" id="MachineError"></p>					
                </div>
                <div class="col-12">
                  <label for="fonction" class="form-label">Fonction de la machine:</label>
                  <input type="text" class="form-control" name="fonction" value="<?php echo isset($machine) ? $machine['fonction'] : ''; ?>"  autofocus>
                  <p class="text-danger" id="FonctionError"></p>					
                </div>
                <div class="col-12">
                  <label for="date_achat" class="form-label">Date Achat:</label>
                  <input type="date" class="form-control" name="date" value="<?php echo isset($machine) ? $machine['date_achat'] : ''; ?>"  autofocus>
                  <p class="text-danger" id="DateError"></p>					
                </div>
                <div class="text-center">
                  <input type="submit" name="submit" class="boutton boutton-secondary" value="<?php echo isset($machine) ? 'Mettre à Jour' : 'Ajouter'; ?>" /> 
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
        <?php if (!isset($machine)){ ?>
              <div class="col-lg-4">
                    <div class="card" >
                      <img src="<?php echo(base_url("assets/img/machine.jpg"))?>" class="card-img-top">
                      <div class="card-body d-flex justify-content-center mt-3">
                        <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des machines</button>
                      </div>
                      <div class="modal fade" id="verticalycentered">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                  <h5 class="card-title">Listes des machines</h5>
                                  <p>Voici les listes de tous les machines du <span class="color_secondary">projet MM </span>avec ses informations:</p>
                                  <div id="valiny">
                                  <table id="machineData">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                            <th>Nom</th>
                                            <th>Fonction</th>
                                            <th>Date achat</th>
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
        // fonction pour instancier xhr
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


// Other javascript function
        
document.addEventListener("DOMContentLoaded",function(){
          var machineinsert=document.getElementById("machineinsertform");
          var formdata=new FormData(machineinsert);
          
          // fonction pour afficher la liste
            var xhr2=creerXHR(); //
            xhr2.open('POST','<?= site_url("transformation/machine_controller")?>',true);
            xhr2.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr2.onreadystatechange=function(){
              if(xhr2.readyState ===  XMLHttpRequest.DONE){
                  if(xhr2.status === 200){
                    var response=JSON.parse(xhr2.responseText);
                    if(response.success){
                      var var_machine = response.machine;
                      const machineArray = var_machine.map(machine => Object.values(machine));
                      if ($.fn.DataTable.isDataTable('#machineData')) {
                        $('#machineData').DataTable().destroy();
                      }
                      var table = $('#machineData').DataTable({
                        data: machineArray,
                        columns: [
                          { title: '#' },
                          { title: 'Nom' },
                          { title: 'Fonction' },
                          { title: 'Date achat' },
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
                      $('#machineData tbody').on('click', '.img-modifier', function() {
                          var id = $(this).data('id');
                          var url="<?php echo base_url("transformation/machine_controller/validation_update_machine");?>/"+id;
                          window.location.href=url;
                          // Ajoutez ici la logique pour supprimer le client
                          // Ajoutez ici la logique pour modifier le client
                      });

                      // Événement click sur les images Supprimer
                      $('#machineData tbody').on('click', '.img-supprimer', function() {
                           // ===============
                          var id = $(this).data('id');
                        swal({
                          title: 'Confirmation de la suppression',
                          text:'Voulez vous vraiment supprimer ce machine?',
                          icon:'warning',
                          buttons:true,
                          dangerMode:true,
                        }).then((isOkay)=>{
                                if(isOkay) {
                                  var url="<?php echo site_url("transformation/machine_controller/validation_delete_machine")?>";
                                  $.post( url , {id : id}).done(function(data){
                                    swal({
                                        title: 'Succes',
                                        text:'Machine supprimée avec succès.',
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


          machineinsert.addEventListener('submit',function(event){
            event.preventDefault();
            var formdata=new FormData(machineinsert);
            var xhr=creerXHR(); //
            xhr.open('POST','<?= site_url("transformation/machine_controller/validation_insert_machine")?>',true);
            xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr.onreadystatechange=function(){
              if(xhr.readyState ===  XMLHttpRequest.DONE){
                  if(xhr.status === 200){
                    var response=JSON.parse(xhr.responseText);
                    if(response.success){
                      swal({
                        title: 'Succes',
                        text:'Machine ajoutée avec succes.',
                        icon:'success',
                        button:'OK'
                      }).then((isOkay)=>{
                        if(isOkay){
                          window.location.href="<?php echo base_url("transformation/machine_controller/view_insertion_machine");?>";
                        }
                      });
                    }
                    else{
                      document.getElementById("MachineError").innerHTML=response.errors.machine ||'';
                      document.getElementById("FonctionError").innerHTML=response.errors.fonction ||'';
                      document.getElementById("DateError").innerHTML=response.errors.date||'';
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