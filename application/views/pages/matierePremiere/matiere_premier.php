
<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
            <?php if (isset($matiere['id_matierepremier'])) { ?>
                <h5 class="card-title text-center">Modification de la matière première</h5>
            <?php } 
            else{?>
                <h5 class="card-title text-center">insertion d'une nouvelle matière première</h5>
            <?php }
            ?>
              <!-- Vertical Form -->

              <form class="row g-3" id="matiereInsertForm">
                <input type="hidden" name="id" value="<?php echo isset($matiere['id_matierepremier']) ? $matiere['id_matierepremier'] : ''; ?>">
               
                <div class="col-12">
                  <label for="matierepremier" class="form-label">Nom</label>
                  <input   id="inputName" type="text" class="form-control" name="matierepremier" value="<?php if (isset($matiere['nom'])) { echo $matiere['nom']; } ?>" required autofocus>			
                   <!-- div pour afficher les erreurs -->
                <p class="text-danger" id="nomError"></p>					
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">
                    
                    <?php if(isset($matiere['id_matierepremier'])){
                        echo "modifier";
                    } else{
                        echo "inserer";
                     } ?>
                  </button>
                </div>
                
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
        <?php if (!isset($matiere['id_matierepremier'])){ ?>
              <div class="col-lg-4">
                    <div class="card" >
                      <img src="<?php echo(base_url("assets/img/news-4.jpg"))?>" class="card-img-top">
                      <div class="card-body d-flex justify-content-center mt-3">
                        <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des matieres premiers</button>
                      </div>
                      <div class="modal fade" id="verticalycentered">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                  <h5 class="card-title">Listes des matieres premieres</h5>
                                  <p>Voici les listes de tous les matieres premieres dans le <span class="color_secondary">projet MM </span>avec ses informations:</p>
                                  <div id="valiny">
                                  <table id="matiereData">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nom</th>
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

        document.addEventListener("DOMContentLoaded",function(){
          var matiereInsertForm=document.getElementById("matiereInsertForm");
          var formdata=new FormData(matiereInsertForm);


            var xhr2=creerXHR(); //
            xhr2.open('POST','<?= site_url("Matiere_premier/list_matiere")?>',true);
            xhr2.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr2.onreadystatechange=function(){
              if(xhr2.readyState ===  XMLHttpRequest.DONE){
                  if(xhr2.status === 200){
                    var response=JSON.parse(xhr2.responseText);
                    if(response.success){
                      var var_matiere = response.matiere;
                      const matiereArray = var_matiere.map(matiere => Object.values(matiere));
                      if ($.fn.DataTable.isDataTable('#matiereData')) {
                        $('#matiereData').DataTable().destroy();
                      }
                      var table = $('#matiereData').DataTable({
                        data: matiereArray,
                        columns: [
                          { title: 'ID' },
                          { title: 'Nom' },
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
                      $('#matiereData tbody').on('click', '.img-modifier', function() {
                          var id = $(this).data('id');
                          var url="<?php echo base_url("Matiere_premier/edit_matier_permier");?>/"+id;
                          window.location.href=url;

                          console.log('Supprimer client avec ID : ', id);
                          // Ajoutez ici la logique pour supprimer le client
                          // Ajoutez ici la logique pour modifier le client
                      });

                      // Événement click sur les images Supprimer
                      $('#matiereData tbody').on('click', '.img-supprimer', function() {
                           // ===============
                          var id = $(this).data('id');
                        swal({
                          title: 'Confirmation de la suppression',
                          text:'Voulez vous vraiment la matière premières?',
                          icon:'warning',
                          buttons:true,
                          dangerMode:true,
                        }).then((isOkay)=>{
                                if(isOkay) {
                                  var url="<?php echo site_url("Matiere_premier/drop_matier_permier")?>";
                                  $.post( url , {id : id}).done(function(data){
                                    swal({
                                        title: 'Succes',
                                        text:'Matière première supprimée avec succès.',
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


          matiereInsertForm.addEventListener('submit',function(event){
            event.preventDefault();
            var formdata=new FormData(matiereInsertForm);
            var xhr=creerXHR(); //
            xhr.open('POST','<?= site_url("Matiere_premier/create")?>',true);
            xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr.onreadystatechange=function(){
              if(xhr.readyState ===  XMLHttpRequest.DONE){
                  if(xhr.status === 200){
                    var response=JSON.parse(xhr.responseText);
                    if(response.success){
                      swal({
                        title: 'Succes',
                        text:'Matière première ajouté avec succes.',
                        icon:'success',
                        button:'OK'
                      }).then((isOkay)=>{
                        if(isOkay){
                          window.location.href="<?php echo base_url("Matiere_premier/matiere_premier_insert");?>";
                        }
                      });
                    }
                    else{
                      document.getElementById("nomError").innerHTML=response.errors.nom ||'';
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
<?php 
?>


