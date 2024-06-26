<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Insertion production</h5>
              <!-- Vertical Form -->
              <form action="" class="row g-3" id="productioninsertForm"> 
              <?php 
                $var_url=(isset($machine) ? 'transformation/production_controller/update_machine/'. $machine['id_machine'] : 'transformation/production_controller/validation_insert_production'); ?>
                <div class="col-12">
                  <label for="id_matierep" class="form-label">Matiere premiere :</label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" id="id_matierep" name="id_matierep">
                                <option selected disabled>Choisis une matiere premiere</option>
                                <?php 
                                    foreach ($matierepremiers as $matiere_premier) { 
                                       $selected = isset($matierepremier) && $matierepremier['id_matierepremier'] == $matiere_premier['id_matierepremier'] ? 'selected' : '';
                                      echo '<option value="' . $matiere_premier['id_matierepremier'] . '" ' . $selected . '>' . $matiere_premier['nom'] . '</option>';
                                    }
                                ?>
                            </select>
                  </div>
                  <p class="text-danger" id="matiereError"></p>					

                </div>
                <div class="col-12">
                  <label for="quantitebrut" class="form-label">Quantite Matière première utilisée (kg):</label>
                  <input type="number" class="form-control" name="quantitebrut">
                  <p class="text-danger" id="in_qttError"></p>					

                </div>
                <div class="col-12">
                  <label for="quantite_produite" class="form-label">Quantite produite (L):</label>
                  <input type="number" class="form-control" name="quantite_produite">
                  <p class="text-danger" id="out_qttError"></p>					

                </div>
                <div class="col-12">
                  <label for="date_prod" class="form-label">Date de production:</label>
                  <input type="date" class="form-control" name="date_prod">
                  <p class="text-danger" id="dateError"></p>					

                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Inserer</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
              <div class="col-lg-4">
                    <div class="card" >
                      <img src="<?php echo(base_url("assets/img/production.jpg"))?>" class="card-img-top">
                      <div class="card-body d-flex justify-content-center mt-3">
                        <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir les détails des productions</button>
                      </div>
                      <div class="modal fade" id="verticalycentered">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                  <h5 class="card-title">Liste des Productions</h5>
                                  <p>Voici la liste des productions du<span class="color_secondary">projet MM </span>avec ses informations:</p>
                                  <div id="valiny">
                                  <table id="detailData">
                                    <thead>
                                        <tr>
                                             <th>Matière Première</th>
                                              <th>Nom Matière Première</th>
                                              <th>Quantité Matière Première</th>
                                              <th>Quantité Produit</th>
                                              <th>Date production</th>
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
          var productioninsertForm=document.getElementById("productioninsertForm");
          var formdata=new FormData(productioninsertForm);
            var xhr2=creerXHR(); //
            xhr2.open('POST','<?= site_url("transformation/production_controller")?>',true);
            xhr2.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr2.onreadystatechange=function(){
              if(xhr2.readyState ===  XMLHttpRequest.DONE){
                  if(xhr2.status === 200){
                    var response=JSON.parse(xhr2.responseText);
                    if(response.success){
                      var var_detail = response.detail;
                      const detailArray = var_detail.map(detail => Object.values(detail));
                      if ($.fn.DataTable.isDataTable('#detailData')) {
                        $('#detailData').DataTable().destroy();
                      }
                      var table = $('#detailData').DataTable({
                        data: detailArray,
                        columns: [
                          { title: '#' },
                          { title: 'Matière Premiere' },
                          { title: 'Quantite matière première' },
                          { title: 'Quantite Produit' },
                          { title: 'Date Production' }
                        ]
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


          productioninsertForm.addEventListener('submit',function(event){
            event.preventDefault();
            var formdata=new FormData(productioninsertForm);
            var xhr=creerXHR(); //
            xhr.open('POST','<?= site_url($var_url)?>',true);
            xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr.onreadystatechange=function(){
              if(xhr.readyState ===  XMLHttpRequest.DONE){
                  if(xhr.status === 200){
                    var response=JSON.parse(xhr.responseText);
                    if(response.success){
                      swal({
                        title: 'Succes',
                        text:'Production ajoutée avec succes.',
                        icon:'success',
                        button:'OK'
                      }).then((isOkay)=>{
                        if(isOkay){
                          window.location.href="<?php echo base_url("transformation/production_controller/view_insertion_production");?>";
                        }
                      });
                    }
                    else{
                      document.getElementById("matiereError").innerHTML=response.errors.matiere ||'';
                      document.getElementById("in_qttError").innerHTML=response.errors.in_qtt ||'';
                      document.getElementById("out_qttError").innerHTML=response.errors.out_qtt ||'';
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
    </section>