
<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
            <h5 class="card-title text-center">insertion d'une nouvelle matière première</h5>

              <!-- Vertical Form -->

              <form class="row g-3" id="matiereInsertForm">
                <input type="hidden" name="id" value="<?php echo isset($matiere['id_matierepremier']) ? $matiere['id_matierepremier'] : ''; ?>">
               
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nom</label>
                  <input   id="inputName" type="text" class="form-control" name="matierepremier" value="<?php if (isset($matiere['nom'])) { echo $matiere['nom']; } ?>" required autofocus>			
                   <!-- div pour afficher les erreurs -->
                <p class="text-danger" id="nomError"></p>					
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Inserer</button>
                </div>
                <div class="boite" id="boite">
                  <img src="<?php echo(base_url("assets/img/check.png"))?>">
                </div>
              </form><!-- Vertical Form -->

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
          var matiereInsertForm=document.getElementById("matiereInsertForm");

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
                      document.getElementById('boite').style.display="block";
                      setTimeout(function(){
                        document.getElementById('boite').style.display="none";
                      },2000);
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


