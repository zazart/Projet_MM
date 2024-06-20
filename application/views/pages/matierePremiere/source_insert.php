<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
            <h5 class="card-title text-center">
                <?php if (isset($source['lieu'])) {
                    echo "Modification d'un source";
                } else{
                    echo "insertion d'un nouvelle source";
                } ?></h5>
<!-- Vertical Form -->
                <form  class="row g-3" id="SourceInsert">
                    <input type="hidden" name="id" value="<?php echo isset($source['id_source']) ? $source['id_source'] : ''; ?>">
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Ajouter le lieu</label>
                         <input   id="lieu" type="text" class="form-control" name="lieu" value="<?php if (isset($source['lieu'])) { echo $source['lieu']; } ?>" required autofocus>								
                        </div>
                    <div class="text-center">
                        <button type="submit" class="boutton boutton-secondary">Inserer</button>
                        <p class="text-danger" id="sourceError"></p>					
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
          var SourceInsert=document.getElementById("SourceInsert");

          SourceInsert.addEventListener('submit',function(event){
            event.preventDefault();
            var formdata=new FormData(SourceInsert);
            var xhr=creerXHR(); //
            xhr.open('POST','<?= site_url("Matiere_premier/create_source")?>',true);
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