<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Modification vente</h5>
                    <!-- Vertical Form -->
                    <form class="row g-3" id="venteForm">
                        <input type="hidden" name="id_vente" value="<?php echo ($vente['id_vente']); ?>">
                        <div class="col-12">
                            <label for="livraison" class="form-label">Etat Livraison :</label>
                            <select class="form-select" aria-label="Default select example" name="livraison"
                                id="livraison">
                                <option selected disabled>Choix d'etat livraison</option>
                                <option value="false" <?php echo ($vente['livraison'] == "f") ? 'selected' : ''; ?>>
                                    Non livrer
                                </option>
                                <option value="true" <?php echo ($vente['livraison'] == "t") ? 'selected' : ''; ?>>
                                    Livrer</option>
                            </select>
                            <div class="text-danger" id="livraisonError"></div>
                        </div>
                        <div class="col-12">
                            <label for="date_vente" class="form-label">Date de vente:</label>
                            <input type="date" class="form-control" id="date_vente" name="date_vente"
                                value="<?php echo ($vente['date_vente']); ?>">
                            <div class="text-danger" id="date_venteError"></div>
                        </div>
                        <div class="col-12">
                            <label for="prixtotal" class="form-label">Prix total:</label>
                            <input type="text" class="form-control" id="prixtotal" name="prixtotal"
                                value="<?php echo ($vente['prixtotal']); ?>">
                            <div class="text-danger" id="prixtotalError"></div>
                        </div>
                        <div class="col-12">
                            <label for="commande" class="form-label">Commandes :</label>
                            <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="commande">
                                    <option selected disabled>Choisit les commandes</option>
                                    <?php foreach ($commandes as $commande) : ?>
                                    <option value="<?php echo $commande['id_commande']; ?>"
                                        <?php echo ($vente['id_commande'] == $commande['id_commande']) ? 'selected' : ''; ?>>
                                        Commande <?php echo $commande['id_commande']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-danger" id="commandeError"></div>
                            </div>
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

venteForm.addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(venteForm);
    var xhr = creeXHR();
    xhr.open('POST', '<?= base_url("vente_commande/vente/storeupdate") ?>', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    swal({
                        title: 'Succès',
                        text: 'Vente modifier avec succès.',
                        icon: 'success',
                        buttons: 'OK'
                    }).then((isOkay) => {
                        if (isOkay) {
                            window.location.href =
                                '<?= base_url("vente_commande/vente/insert_vente") ?>'
                        }
                    });
                } else {
                    // Gérer les erreurs de validation et afficher les messages d'erreur
                    document.getElementById('livraisonError').innerHTML = response.errors
                        .livraison || '';
                    document.getElementById('date_venteError').innerHTML = response.errors
                        .date_vente ||
                        '';
                    document.getElementById('prixtotalError').innerHTML = response.errors
                        .prixtotal || '';
                    document.getElementById('commandeError').innerHTML = response.errors
                        .commande || '';
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