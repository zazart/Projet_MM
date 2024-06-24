<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Modification collecte</h5>
                    <!-- Vertical Form -->
                    <form class="row g-3" id="collectForm">
                        <input type="hidden" name="id_collects" value="<?php echo ($collect['id_collects']); ?>">
                        <div class="col-12">
                            <label for="collecteur" class="form-label">Liste des Collecteurs :</label>
                            <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" id="collecteur"
                                    name="collecteur">
                                    <?php foreach ($collectors as $collector) : ?>
                                    <option value="<?php echo $collector['id_employe']; ?>">
                                        <?php echo $collector['nom']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger" id="collecteurError"></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="matiere" class="form-label">Matiere premiere :</label>
                            <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="matiere"
                                    id="matiere">
                                    <?php foreach ($matierepremiers as $matierepremier) : ?>
                                    <option value="<?php echo $matierepremier['id_matierepremier']; ?>"
                                        <?php echo ($collect['id_matierepremier'] == $matierepremier['id_matierepremier']) ? 'selected' : ''; ?>>
                                        <?php echo $matierepremier['nom']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger" id="matiereError"></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="qtt" class="form-label">Quantite :</label>
                            <input type="number" class="form-control" name="qtt" id="qtt"
                                value="<?php echo ($collect['qtt']); ?>">
                            <p class="text-danger" id="qttError"></p>
                        </div>
                        <div class="col-12">
                            <label for="date" class="form-label">Date de collect :</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="<?php echo ($collect['datecollect']); ?>">
                            <p class="text-danger" id="dateError"></p>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="boutton boutton-secondary">Modifier</button>
                        </div>
                    </form><!-- Vertical Form -->
                </div>
            </div>
        </div>
    </div>
</section>


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

collectForm.addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(collectForm);
    var xhr = creeXHR();
    xhr.open('POST', '<?= base_url("collecteurs/collectController/storeupdate") ?>', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    swal({
                        title: 'Succès',
                        text: 'Collect modifié avec succès.',
                        icon: 'success',
                        buttons: 'OK'
                    }).then((isOkay) => {
                        if (isOkay) {
                            window.location.href =
                                '<?= base_url("collecteurs/collectController/insert_collect") ?>'
                        }
                    });
                } else {
                    document.getElementById('collecteurError').innerHTML = response.errors
                        .collecteur || '';
                    document.getElementById('matiereError').innerHTML = response.errors
                        .matiere || '';
                    document.getElementById('qttError').innerHTML = response.errors
                        .qtt || '';
                    document.getElementById('dateError').innerHTML = response.errors
                        .date || '';
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
</script>