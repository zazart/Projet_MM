<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Modification client</h5>
                    <!-- Vertical Form -->
                    <form class="row g-3" id="clientForm">
                        <input type="hidden" name="id_client" value="<?php echo ($client['id_client']); ?>">
                        <div class="col-12">
                            <label for="nomGlobal" class="form-label">Username :</label>
                            <input type="text" class="form-control" id="nomGlobal" name="nomGlobal" value="<?php echo ($client['nomglobal']); ?>">
                            <div class="text-danger" id="nomGlobalError"></div>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email :</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo ($client['email']); ?>">
                            <div class="text-danger" id="emailError"></div>
                        </div>
                        <div class="col-12">
                            <label for="adresse" class="form-label">Adresse :</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo ($client['adresse']); ?>">
                            <div class="text-danger" id="adresseError"></div>
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

    document.addEventListener('DOMContentLoaded', function() {
        var clientForm = document.getElementById('clientForm');
        clientForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(clientForm);
            var xhr = creeXHR();
            xhr.open('POST', '<?= base_url("vente_commande/client/storeupdate") ?>', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            swal({
                                title: 'Succès',
                                text: 'Client modifié avec succès.',
                                icon: 'success',
                                buttons: 'OK'
                            }).then((isOkay) => {
                                if (isOkay) {
                                    window.location.href =
                                        '<?= base_url("vente_commande/client/insert_client") ?>'
                                }
                            });
                        } else {
                            // Gérer les erreurs de validation et afficher les messages d'erreur
                            document.getElementById('nomGlobalError').innerHTML = response.errors
                                .nomGlobal || '';
                            document.getElementById('emailError').innerHTML = response.errors.email ||
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
    });
</script>