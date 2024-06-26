<!-- START FORMULAIRE DEPENSE -->
<section class="row">
  <div class="mx-auto col-lg-8 p-2">
    <div class="card ">
      <div class="card-body m-2">
        <!-- Formulaire -->
        <form id="depenseForm" class="row g-3" enctype="multipart/form-data">
          <!-- Description -->
          <div class="col-12">
            <label for="description" class="input-label">Description </label>
            <input type="text" class="form-control" name="description" id="description" required>
          </div>
          <!-- Date -->
          <div class="col-12">
            <label for="dateDepense" class="input-label">Date de depense</label>
            <input type="date" class="form-control" id="dateDepense" name="dateDepense" required>
          </div>
          <!-- Montant -->
          <div class="col-12">
            <label for="montant" class="input-label">Montant</label>
            <input type="number" name="montant" id="montant" class="form-control" min="0" step="0.1">
          </div>
          <!-- PCG -->
          <div class="col-12">
            <label for="id_Pcg" class="input-label">PCG </label>
            <select class="form-select" name="id_Pcg" id="id_Pcg" required>
              <option value=""></option>
              <?php foreach ($pcg as $item) : ?>
                <option value="<?php echo $item['id_pcg']; ?>"><?php echo $item['nom']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Subcompte -->
          <div class="col-12">
            <label for="id_Categorie" class="input-label">Categorie </label>
            <select class="form-select" name="id_Categorie" id="id_Categorie" required>
              <option value=""></option>
              <?php foreach ($categories as $item) : ?>
                <option value="<?php echo $item['id_sub_comptes']; ?>"><?php echo $item['description']; ?></option>
              <?php endforeach; ?>
            </select>
            </select>
          </div>
          <!-- Mode de paiement -->
          <div class="col-12">
            <label for="id_ModePaiment" class="input-label">Mode de paiement</label>
            <select class="form-select" name="id_ModePaiment" id="id_ModePaiment" required>
              <option value=""></option>
              <?php foreach ($modes_de_paiement as $mode) : ?>
                <option value="<?php echo $mode['id_modepaiment']; ?>"><?php echo $mode['nom']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Justificatif -->
          <div class="col-12">
            <label for="justificatif" class="input-label">Justificatif</label>
            <input type="file" name="justificatif" id="justificatif" class="form-control">
          </div>
          <div class="col-12">
            <button type="submit" class="col-2 btn boutton-light">Inserer</button>
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
  <div class="col-lg-4">
    <div class="card" id="">
      <img src="<?php echo (base_url("assets/img/expenses.jpg")) ?>" class="card-img-top">
      <div class="card-body d-flex justify-content-center mt-3">
        <button id="viewBtn" class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des depenses</button>
      </div>
      <div class="modal fade" id="verticalycentered">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <h5 class="card-title">Listes des depenses</h5>
              <p>Voici les listes de tous les depenses dans le <span class="color_secondary">projet MM </span>avec ses informations:</p>
              <div id="valiny">
                <table id="depenseData" class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Description</th>
                      <th>Montant</th>
                      <th>Date de depense</th>
                      <th>Justificatif</th>
                      <th>Mode de paiement</th>
                      <th>Sub comptes</th>
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
</section>
<script src="<?php echo base_url('assets/js/depenses/depenses.js'); ?>"></script>

<!-- SCRIPT DYNAMYSME FORMULAIRE -->
<script>
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
      xhr.open('POST', '<?= base_url("depense/create") ?>', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      // Change control of the request
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              swal({
                title: 'Succès',
                text: 'Dépense ajouté avec succès.',
                icon: 'success',
                buttons: 'OK'
              }).then((isOkay) => {
                if (isOkay) {
                  window.location
                    .reload();
                }
              });
            } else {
              alert('Erreur lors de l\'insertion : ' + response.message);
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

    inputPcg.addEventListener('change', function(event) {
      var selectedPcg = inputPcg.value;
      var xhr = creeXHR();
      // Create POST Request to insert
      xhr.open('GET', '<?= base_url("depense/get_subcomptes") ?>/' + selectedPcg, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              inputCategorie.innerHTML = '';
              var var_categories = response.categories;
              const categories_array = var_categories.map(categorie => Object.values(categorie));
              categories_array.forEach(categorie => {
                const optionHtml = "<option value=\"" + categorie[0] + "\">" + categorie[2] + "</option>";

                inputCategorie.innerHTML += optionHtml;

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
    // SCRIPT POUR AFFICHER LA LISTE DES DEPENSES
    document.getElementById('viewBtn').addEventListener('click', function(e) {
      var xhr = creeXHR();
      // Create POST Request to insert
      xhr.open('GET', '<?= base_url("depense/getListDepenses") ?>', true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              var var_depenses = response.depenses;
              const depensesArray = var_depenses.map(depense => Object.values(depense));
              viewTableData(
                'depenseData',
                [{title: 'Id'},{title: 'Description'},{title: 'Montant'},{title: 'Date de depense'},{title: 'Justificatif'},{title: 'Mode de paiement'},{title: 'Categories'}],
                depensesArray,
                "depense/update_depense",
                "depense/delete_depense"
              );
            } else {
              alert('Erreur lors de l\'insertion : ' + response.message);
            }
          } else {
            console.error('Erreur AJAX : ', xhr.status, xhr.statusText);
            alert('Une erreur s\'est produite lors de la requête AJAX.');
          }
        }
      };
      xhr.send()
    })
  });
</script>

<!-- END FORMULAIRE DEPENSE -->