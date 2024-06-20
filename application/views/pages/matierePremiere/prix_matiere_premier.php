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



