<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-3">
      <div class="card">
        <img src="<?php echo(base_url("assets/img/news-4.jpg"))?>" class="card-img-top">
        <div class="card-body d-flex justify-content-center mt-3">
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered" onclick="btnClick(1)">Voir liste des collecteurs</button>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card">
        <img src="<?php echo(base_url("assets/img/news-4.jpg"))?>" class="card-img-top">
        <div class="card-body d-flex justify-content-center mt-3">
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered" onclick="btnClick(2)">Voir liste des collects</button>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card">
        <img src="<?php echo(base_url("assets/img/news-4.jpg"))?>" class="card-img-top">
        <div class="card-body d-flex justify-content-center mt-3">
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered" onclick="btnClick(3)">Voir liste des salaires</button>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card">
        <img src="<?php echo(base_url("assets/img/news-4.jpg"))?>" class="card-img-top">
        <div class="card-body d-flex justify-content-center mt-3">
          <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered" onclick="btnClick(4)">Voir liste des bonus</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card" id="cache">
        <div class="card-body d-flex justify-content-center mt-3">
            <h5 class="card-title">Listes des xxx</h5>
            <p>Voici les listes de tous les xxx dans le <span class="color_secondary">projet MM </span>avec ses informations:</p>
            <div id="valiny">
                <table id="listeData">
                <thead>
                </thead>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Script -->
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

  function btnClick(num){
    var xhr = creeXHR();
    xhr.open('POST', '<?= base_url("collecteurs/collectController/save") ?>', true);

    xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
            document.getElementById('cache').style.display = 'block'; 
            var var_data = response.data;
            const dataArray = var_data.map(collect => Object.values(collect));
            if ($.fn.DataTable.isDataTable('#listeData')) {
                $('#listeData').DataTable().destroy();
            }
            var table = $('#listeData').DataTable({
                data: dataArray,
                columns: [
                { title: 'ID' },
                { title: 'Quantite' },
                { title: 'Collecteur' },
                { title: 'Matiere Premier' },
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
            $('#listeData tbody').on('click', '.img-modifier', function() {
                var id = $(this).data('id');
                console.log('Modifier collect avec ID : ', id);
                // Ajoutez ici la logique pour modifier le client
            });

            // Événement click sur les images Supprimer
            $('#listeData tbody').on('click', '.img-supprimer', function() {
                var id = $(this).data('id');
                console.log('Supprimer collect avec ID : ', id);
                // Ajoutez ici la logique pour supprimer le client
            });
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
    xhr.send();
  }

</script>