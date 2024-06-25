<!-- START FORMULAIRE DEPENSE -->
<section class="row">
  <div class="mx-auto col-lg-8 p-2">
    <div class="card ">
      <div class="card-body m-2">
        <!-- Formulaire -->
        <form id="depenseForm"  class="row g-3" enctype="multipart/form-data">
          <input type="hidden" 
          name="id_depense" value="<?php echo ($depense['id_depense']);?>">
          <!-- Description -->
          <div class="col-12">
            <label for="description" class="input-label">Description </label>
            <input 
              type="text"
              class="form-control"
              name="description"id="description" required value="<?= $depense['description']?>">
          </div>
          <!-- Date -->
          <div class="col-12">
            <label for="dateDepense" class="input-label">Date de depense</label>
            <input type="date" class="form-control" id="dateDepense" 
            name="dateDepense" required value="<?= $depense['datedepense']?>">
          </div>
          <!-- Montant -->
          <div class="col-12">
            <label for="montant" class="input-label">Montant</label>
            <input type="number" 
            name="montant" id="montant" class="form-control" min="0" step="0.1" value="<?= $depense['montant']?>">
          </div>
          <!-- PCG -->
          <div class="col-12">
            <label for="id_Pcg" class="input-label">PCG </label>
            <select class="form-select" 
            name="id_Pcg" id="id_Pcg" required>
              <?php foreach ($pcg as $item) : ?>
                <?php if($item['id_pcg'] == $depense['id_pcg']) { ?> 
                  <option value="<?php echo $item['id_pcg']; ?>" selected>
                    <?php echo $item['nom']; ?>
                  </option>
                <?php break; }?>
              <?php endforeach; ?>
              <?php foreach ($pcg as $item) : ?>
                <option value="<?php echo $item['id_pcg']; ?>">
                  <?php echo $item['nom']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Subcompte -->
          <div class="col-12">
            <label for="id_Categorie" class="input-label">Categorie </label>
            <select class="form-select" 
            name="id_Categorie" id="id_Categorie" required>
              <?php foreach ($categories as $item) : ?>
                <?php if($item['id_sub_comptes'] == $depense['id_sub_comptes']){ ?> 
                  <option value="<?php echo $item['id_sub_comptes']; ?>">
                  <?php echo $item['description']; ?>
                  </option>
                <?php break; }?>>
              <?php endforeach; ?>
              <?php foreach ($categories as $item) : ?>
                <option value="<?php echo $item['id_sub_comptes']; ?>"
                <?php if($item['id_sub_comptes'] == $depense['id_sub_comptes']){ echo 'selected' ;}?>>
                  <?php echo $item['description']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            </select>
          </div>
          <!-- Mode de paiement -->
          <div class="col-12">
            <label for="id_ModePaiment" class="input-label">Mode de paiement</label>
            <select class="form-select" 
            name="id_ModePaiment" id="id_ModePaiment" required>
              <?php foreach ($modes_de_paiement as $mode) : ?>
                <?php if($mode['id_modepaiment'] == $depense['id_modepaiment']){ ?> 
                  <option value="<?php echo $mode['id_modepaiment']; ?>">
                    <?php echo $mode['nom']; ?>
                  </option>
                <?php break;}?>>
              <?php endforeach; ?>
              <?php foreach ($modes_de_paiement as $mode) : ?>
                <option value="<?php echo $mode['id_modepaiment']; ?>" 
                <?php if($mode['id_modepaiment'] == $depense['id_modepaiment']){ echo 'selected' ;}?>>
                  <?php echo $mode['nom']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Justificatif -->
          <div class="col-12">
            <label for="justificatif" class="input-label">Justificatif</label>
            <input type="file" 
            name="justificatif" id="justificatif" class="form-control">
          </div>
          <div class="col-12">
            <button type="submit" class="col-2 btn boutton-light">Modifier</button>
          </div>
          <div class="boite" id="boite">
            <img src="<?php echo (base_url("assets/img/check.png")) ?>">
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($errors as $error) : ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
</section>
<script src="<?php echo base_url('assets/js/depenses/depenses.js'); ?>"></script>

<!-- SCRIPT DYNAMYSME FORMULAIRE -->
<script>
  function creeXHR() {
    var xhr;
    try {
      xhr = new ActiveXObject('Msxml2.XMLHTTP');
    } catch (e) {
      try {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
      } catch (e2) {
        try {
          xhr = new XMLHttpRequest();
        } catch (e3) {
          xhr = false;
        }
      }
    }
    return xhr;
  }

  document.addEventListener('DOMContentLoaded', function() {
    var depenseForm = document.getElementById('depenseForm');
    depenseForm.addEventListener('submit', function(event) {
      // Prevent the default action
      event.preventDefault();
      // Get the js data of the formulaire
      var formData = new FormData(depenseForm);
      // Create the XHR variable
      var xhr = creeXHR();
      // Create POST Request to insert
      xhr.open('POST', '<?= base_url("depense/update") ?>', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      // Change control of the request
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              swal({
                title: 'Succès',
                text: 'Dépense modifié avec succès.',
                icon: 'success',
                buttons: 'OK'
              }).then((isOkay) => {
                if (isOkay) {
                  window.location
                  .reload();
                }
              });
            } else {
              alert('Erreur lors de la modification : ' + response.message);
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

      xhr.send(formData);
    });
    // SCRIPT POUR AUTO COMPLETION DE CATEGORIE
    // recuperation des imputs
    var inputPcg = document.getElementById('id_Pcg');
    var inputCategorie = document.getElementById('id_Categorie');

    inputPcg.addEventListener('change', function(event){
      var selectedPcg = inputPcg.value ;
      var xhr = creeXHR();
      // Create POST Request to insert
      xhr.open('GET', '<?= base_url("depense/get_subcomptes") ?>/'+selectedPcg, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              inputCategorie.innerHTML = '';
              var var_categories = response.categories;
              const categories_array = var_categories.map(categorie => Object.values(categorie));
              categories_array.forEach(categorie =>{
                const optionHtml = "<option value=\""+categorie[0]+"\">"+categorie[2]+"</option>";

                inputCategorie.innerHTML+=optionHtml;
              
              })
            }
          } else {
            console.error('Erreur AJAX : ', xhr.status, xhr.statusText);
            alert('Une erreur s\'est produite lors de la requête AJAX.');
          }
        }
      };
      xhr.send();
    });
  });

</script>

<!-- END FORMULAIRE DEPENSE -->