<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <?php
                            if (isset($source_matiere_premier_data['matierpremier'])){
                                echo "Modification du source de matiere premiere";
                            }
                            else{
                                echo "insertion d'une source a une matiere premiere";
                            }
                        ?>
                    </h5>
                        <form id="sourcematiereform" class="row g-3">
                            <input type="hidden" name="id" value="<?php echo isset($source_matiere_premier_data['id_sourcematierepremier']) ? $source_matiere_premier_data['id_sourcematierepremier'] : ''; ?>">	
                            <div class="col-12">
                                            <div class="col-sm-12">
                                                <label for="nom" class="form-label">Nom matière premiere</label>
                                                <select class="form-select" name="nom" id="nom" aria-label="Default select example" required>
                                                        <option value="" selected disabled>Selectionnez le nom</option>
                                                        <?php foreach ($matiere_data as $matiere): ?>
                                                            <option value="<?php echo $matiere['id_matierepremier']; ?>" 
                                                                    <?php echo (isset($source_matiere_premier_data['matierpremier']) && $source_matiere_premier_data['matierpremier'] == $matiere['id_matierepremier']) ? 'selected' : ''; ?>>
                                                                    <?php echo $matiere['nom']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                </select>
                                                    <p class="text-danger" id="nomError"></p>					

                                            </div>
                                            <div class="col-12">
                                                <label for="inputNanme4" class="form-label">Date prelevement</label>
                                                <input type="Date" class="form-control" id="date"  name="date" value="<?php if (isset($source_matiere_premier_data['dateprelevement'])) { echo $source_matiere_premier_data['dateprelevement']; } ?>" required autofocus>
                                                <p class="text-danger" id="dateError"></p>					
                                                
                                            </div>  

                                            <div class="col-sm-12">
                                                <label for="nom" class="form-label">Source</label>
                                                <select class="form-select" name="source" id="nom" aria-label="Default select example" required>
                                                        <option value="" selected disabled>Selectionnez la source</option>
                                                        <?php foreach ($source_data as $source): ?>
											                <option value="<?php echo $source['id_source']; ?>" 
											                    <?php echo (isset($source_matiere_premier_data['source']) && $source_matiere_premier_data['source'] == $source['id_source']) ? 'selected' : ''; ?>>
											                    <?php echo $source['lieu']; ?>
											                </option>
                                                        <?php endforeach; ?>
                                                </select>
                                                <p class="text-danger" id="sourceError"></p>					
                                            </div>
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
          var sourcematiereform=document.getElementById("sourcematiereform");

          sourcematiereform.addEventListener('submit',function(event){
            event.preventDefault();
            var formdata=new FormData(sourcematiereform);
            var xhr=creerXHR(); //
            xhr.open('POST','<?= site_url("Matiere_premier/create_source_matiere_premier")?>',true);
            xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");
            xhr.onreadystatechange=function(){
              if(xhr.readyState ===  XMLHttpRequest.DONE){
                  if(xhr.status === 200){
                    var response=JSON.parse(xhr.responseText);
                    if(response.success){
                      document.getElementById('boite').style.display="block";
                      setTimeout(function(){
                        document.getElementById('boite').style.display="none";
                      },2000);
                    }
                    else{
                      document.getElementById("nomError").innerHTML=response.errors.nom ||'';
                      document.getElementById("dateError").innerHTML=response.errors.date ||'';
                      document.getElementById("sourceError").innerHTML=response.errors.source ||'';

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