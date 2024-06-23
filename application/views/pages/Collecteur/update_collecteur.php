<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Modification collecteur</h5>

                    <form class="row g-3" id="collecteurForm">
                        <input type="hidden" name="id_employe" value="<?php echo ($collecteur['id_employe']); ?>">
                        <div class="col-12">
                            <label for="nom" class="form-label">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo ($collecteur['nom']); ?>">
                            <div class="text-danger" id="nomError"></div>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email :</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo ($collecteur['email']); ?>">
                            <div class="text-danger" id="emailError"></div>
                        </div>
                        <div class="col-12">
                            <label for="contact" class="form-label">Contact (phone) :</label>
                            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo ($collecteur['telephone']); ?>">
                            <p class="text-danger" id="contactError"></p>
                        </div>
                        <div class="col-12">
                            <label for="adresse" class="form-label">Adresse :</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo ($collecteur['adresse']); ?>">
                            <p class="text-danger" id="adresseError"></p>
                        </div>
                        <div class="col-12">
                            <label for="genre" class="form-label">Genre :</label>
                            <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="genre" id="genre">
                                    <option selected disabled>Liste genre</option>
                                    <option value="1" <?php echo ("1" == $collecteur['id_genre']) ? 'selected' : ''; ?>>
                                        Homme</option>
                                    <option value="2" <?php echo ("2" == $collecteur['id_genre']) ? 'selected' : ''; ?>>
                                        Femme</option>
                                </select>
                                <p class="text-danger" id="genreError"></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="date" class="form-label">Début :</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo ($collecteur['embauche']); ?>">
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

    collecteurForm.addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(collecteurForm);
        var xhr = creeXHR();
        xhr.open('POST', '<?= base_url("collecteurs/collecteurController/storeupdate") ?>', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        swal({
                            title: 'Succès',
                            text: 'Collecteur modifier avec succès.',
                            icon: 'success',
                            buttons: 'OK'
                        }).then((isOkay) => {
                            if (isOkay) {
                                window.location.href =
                                    '<?= base_url("collecteurs/collecteurController/insert_collector") ?>'
                            }
                        });
                    } else {
                        document.getElementById('nomError').innerHTML = response.errors
                            .nom || '';
                        document.getElementById('emailError').innerHTML = response.errors
                            .email || '';
                        document.getElementById('genreError').innerHTML = response.errors
                            .genre || '';
                        document.getElementById('contactError').innerHTML = response.errors
                            .contact || '';
                        document.getElementById('dateError').innerHTML = response.errors.date ||
                            '';
                        document.getElementById('adresseError').innerHTML = response.errors
                            .adresse || '';
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