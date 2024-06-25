<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Insertion vente</h5>
                    <!-- Vertical Form -->
                    <form class="row g-3" id="venteForm">
                        <div class="col-12">
                            <label for="livraison" class="form-label">Etat Livraison :</label>
                            <select class="form-select" aria-label="Default select example" name="livraison" id="livraison">
                                <option selected disabled>Choix d'etat livraison</option>
                                <option value="false">Non livrer</option>
                                <option value="true">livrer</option>
                            </select>
                            <div class="text-danger" id="livraisonError"></div>
                        </div>
                        <div class="col-12">
                            <label for="date_vente" class="form-label">Date de vente:</label>
                            <input type="date" class="form-control" id="date_vente" name="date_vente">
                            <div class="text-danger" id="date_venteError"></div>
                        </div>
                        <div class="col-12">
                            <label for="prixtotal" class="form-label">Prix total:</label>
                            <input type="text" class="form-control" id="prixtotal" name="prixtotal">
                            <div class="text-danger" id="prixtotalError"></div>
                        </div>
                        <div class="col-12">
                            <label for="commande" class="form-label">Commandes :</label>
                            <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="commande">
                                    <option selected disabled>Choisit les commandes</option>
                                    <?php foreach ($commandes as $commande) : ?>
                                        <option value="<?php echo $commande['id_commande']; ?>">
                                            Commande <?php echo $commande['id_commande']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-danger" id="commandeError"></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="boutton boutton-secondary">Inserer</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <img src="<?php echo (base_url("assets/img/news-4.jpg")) ?>" class="card-img-top">
                <div class="card-body d-flex justify-content-center mt-3">
                    <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des ventes</button>
                </div>
                <div class="modal fade" id="verticalycentered">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="card-title">Listes des ventes</h5>
                                <p>Voici les listes de tous les ventes dans le <span class="color_secondary">projet MM
                                    </span>avec ses informations:</p>
                                <div id="valiny">
                                    <table id="ventesData">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Livraison</th>
                                                <th>Date de vente</th>
                                                <th>Prix total</th>
                                                <th>Commande</th>
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
        var venteForm = document.getElementById('venteForm');
        var xhr2 = creeXHR();
        xhr2.open('POST', '<?= base_url("vente_commande/vente/getliste_vente") ?>', true);
        xhr2.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState === XMLHttpRequest.DONE) {
                if (xhr2.status === 200) {
                    var response = JSON.parse(xhr2.responseText);
                    if (response.success) {
                        var var_ventes = response.ventes;
                        // Convert 't' and 'f' to 'Livrer' and 'Non livrer'
                        var ventesArray = var_ventes.map(vente => {
                            return Object.fromEntries(
                                Object.entries(vente).map(([key, value]) => {
                                    if (key === 'livraison') {
                                        value = (value === 't') ? 'Livrer' : (value === 'f') ?
                                            'Non livrer' : value;
                                    }
                                    return [key, value];
                                })
                            );
                        }).map(vente => Object.values(vente));
                        if ($.fn.DataTable.isDataTable('#ventesData')) {
                            $('#ventesData').DataTable().destroy();
                        }
                        var table = $('#ventesData').DataTable({
                            data: ventesArray,
                            columns: [{
                                    title: 'ID'
                                },
                                {
                                    title: 'Livraison'
                                },
                                {
                                    title: 'Date de vente'
                                },
                                {
                                    title: 'Prix total'
                                },
                                {
                                    title: 'Commande'
                                },
                                {
                                    title: 'Actions',
                                    render: function(data, type, row,
                                        meta) {
                                        var editImgSrc =
                                            '<?php echo base_url('assets/img/modifier.png'); ?>';
                                        var deleteImgSrc =
                                            '<?php echo base_url('assets/img/corbeille.png'); ?>';
                                        return '<img class="img-modifier" style="margin-right:30px;cursor:pointer;" src="' +
                                            editImgSrc + '" data-id="' +
                                            row[0] +
                                            '" alt="Modifier">' +
                                            '<img class="img-supprimer" style="margin-right:30px;cursor:pointer;" src="' +
                                            deleteImgSrc +
                                            '" data-id="' + row[0] +
                                            '" alt="Supprimer">';
                                    }
                                }
                            ]
                        });

                        // Événement click sur les images Modifier
                        $('#ventesData tbody').on('click', '.img-modifier',
                            function() {
                                var id = $(this).data('id');
                                window.location.href =
                                    '<?= base_url("vente_commande/vente/update_vente") ?>' + "/" + id;
                                // Ajoutez ici la logique pour modifier le client
                            });

                        // Événement click sur les images Supprimer
                        $('#ventesData tbody').on('click', '.img-supprimer',
                            function() {
                                var id = $(this).data('id');
                                // Ajoutez ici la logique pour supprimer le client
                                swal({
                                    title: 'Confirmation de la suppression',
                                    text: 'Voulez vous vraiment supprimer ce vente',
                                    icon: 'warning',
                                    buttons: true,
                                    dangerMode: true,
                                }).then((isOkay) => {
                                    if (isOkay) {
                                        var xhrSupprimer = new XMLHttpRequest();

                                        xhrSupprimer.open('POST',
                                            '<?= base_url("vente_commande/vente/delete") ?>',
                                            true);
                                        xhrSupprimer.setRequestHeader('X-Requested-With',
                                            'XMLHttpRequest');
                                        xhrSupprimer.setRequestHeader('Content-Type',
                                            'application/x-www-form-urlencoded');

                                        xhrSupprimer.onreadystatechange = function() {
                                            if (xhrSupprimer.readyState == 4 && xhrSupprimer
                                                .status == 200) {
                                                var response = JSON.parse(xhrSupprimer
                                                    .responseText);
                                                if (response.success) {
                                                    swal({
                                                        title: 'Succès',
                                                        text: 'Vente supprimé avec succès.',
                                                        icon: 'success',
                                                        buttons: 'OK'
                                                    }).then((isOkay) => {
                                                        if (isOkay) {
                                                            window.location
                                                                .reload(); // Actualise la page après la confirmation
                                                        }
                                                    });
                                                }
                                            }
                                            if (xhrSupprimer
                                                .status == 500) {
                                                swal({
                                                    title: 'Erreur',
                                                    text: 'Ce vente ne peut pas etre supprimer',
                                                    icon: 'error',
                                                    buttons: 'OK'
                                                }).then((isOkay) => {
                                                    if (isOkay) {
                                                        window.location
                                                            .reload(); // Actualise la page après la confirmation
                                                    }
                                                });
                                            }
                                        };

                                        xhrSupprimer.send('id=' + encodeURIComponent(
                                            id
                                        )); // Envoie l'ID du client en tant que paramètre POST
                                    }
                                });
                            });
                    } else {
                        alert('Erreur lors de l\'insertion : ' + response.message);
                    }
                } else {
                    console.error('Erreur AJAX : ', xhr2.status, xhr2.statusText);
                    alert('Une erreur s\'est produite lors de la requête AJAX.');
                }
            }
        };

        xhr2.onerror = function() {
            console.error('Erreur réseau');
            alert('Une erreur s\'est produite lors de la requête AJAX.');
        };

        xhr2.send();


        venteForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(venteForm);
            var xhr = creeXHR();
            xhr.open('POST', '<?= base_url("vente_commande/vente/store") ?>', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            swal({
                                title: 'Succès',
                                text: 'Vente ajouté avec succès.',
                                icon: 'success',
                                buttons: 'OK'
                            }).then((isOkay) => {
                                if (isOkay) {
                                    window.location
                                        .reload(); // Actualise la page après la confirmation
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
    });
</script>