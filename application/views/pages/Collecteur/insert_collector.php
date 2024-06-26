<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Insertion collecteur</h5>
                    <!-- Vertical Form -->
                    <form class="row g-3" id="collecteurForm">
                        <div class="col-12">
                            <label for="nom" class="form-label">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom">
                            <div class="text-danger" id="nomError"></div>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email :</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <div class="text-danger" id="emailError"></div>
                        </div>
                        <div class="col-12">
                            <label for="contact" class="form-label">Contact (phone) :</label>
                            <input type="text" class="form-control" id="contact" name="contact">
                            <p class="text-danger" id="contactError"></p>
                        </div>
                        <div class="col-12">
                            <label for="adresse" class="form-label">Adresse :</label>
                            <input type="text" class="form-control" id="adresse" name="adresse">
                            <p class="text-danger" id="adresseError"></p>
                        </div>
                        <div class="col-12">
                            <label for="genre" class="form-label">Genre :</label>
                            <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="genre" id="genre">
                                    <option selected disabled>Liste genre</option>
                                    <option value="1">Homme</option>
                                    <option value="2">Femme</option>
                                </select>
                                <p class="text-danger" id="genreError"></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="date" class="form-label">Début :</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?= date('Y-m-d'); ?>">
                            <p class="text-danger" id="dateError"></p>
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
                <img src="<?php echo (base_url("assets/img/collecteur.jpg")) ?>" class="card-img-top">
                <div class="card-body d-flex justify-content-center mt-3">
                    <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des collecteurs</button>
                </div>
                <div class="modal fade" id="verticalycentered">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="card-title">Listes des collecteurs</h5>
                                <p>Voici les listes de tous les collecteurs dans le <span class="color_secondary">projet
                                        MM
                                    </span>avec ses informations:</p>
                                <div id="valiny">
                                    <table id="collecteurData">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nom</th>
                                                <th>Genre</th>
                                                <th>Email</th>
                                                <th>Telephone</th>
                                                <th>Adresse</th>
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
        var collecteurForm = document.getElementById('collecteurForm');
        var xhr2 = creeXHR();
        xhr2.open('POST', '<?= base_url("collecteurs/collecteurController/getliste_collecteurs") ?>', true);
        xhr2.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState === XMLHttpRequest.DONE) {
                if (xhr2.status === 200) {
                    var response = JSON.parse(xhr2.responseText);
                    if (response.success) {
                        var var_collecteurs = response.collecteurs;
                        const collecteursArray = var_collecteurs.map(collecteur => Object.values(
                            collecteur));
                        if ($.fn.DataTable.isDataTable('#collecteurData')) {
                            $('#collecteurData').DataTable().destroy();
                        }
                        var table = $('#collecteurData').DataTable({
                            data: collecteursArray,
                            columns: [{
                                    title: 'ID'
                                },
                                {
                                    title: 'Nom'
                                },
                                {
                                    title: 'Genre'
                                },
                                {
                                    title: 'Email'
                                },
                                {
                                    title: 'Telephone'
                                },
                                {
                                    title: 'Adresse'
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
                        $('#collecteurData tbody').on('click', '.img-modifier',
                            function() {
                                var id = $(this).data('id');
                                window.location.href =
                                    '<?= base_url("collecteurs/collecteurController/update_collecteur") ?>' +
                                    "/" + id;
                            });

                        // Événement click sur les images Supprimer
                        $('#collecteurData tbody').on('click', '.img-supprimer',
                            function() {
                                var id = $(this).data('id');
                                swal({
                                    title: 'Confirmation de la suppression',
                                    text: 'Voulez vous vraiment supprimer ce collecteur',
                                    icon: 'warning',
                                    buttons: true,
                                    dangerMode: true,
                                }).then((isOkay) => {
                                    if (isOkay) {
                                        var xhrSupprimer = new XMLHttpRequest();

                                        xhrSupprimer.open('POST',
                                            '<?= base_url("collecteurs/collecteurController/delete") ?>',
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
                                                        text: 'Collecteur supprimé avec succès.',
                                                        icon: 'success',
                                                        buttons: 'OK'
                                                    }).then((isOkay) => {
                                                        if (isOkay) {
                                                            window.location
                                                                .reload();
                                                        }
                                                    });
                                                }
                                            }
                                            if (xhrSupprimer
                                                .status == 500) {
                                                swal({
                                                    title: 'Erreur',
                                                    text: 'Ce collecteur ne peut pas etre supprimer',
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
                            }
                        );
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


        collecteurForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(collecteurForm);
            var xhr = creeXHR();
            xhr.open('POST', '<?= base_url("collecteurs/collecteurController/store") ?>', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            swal({
                                title: 'Succès',
                                text: 'Collecteur ajouté avec succès.',
                                icon: 'success',
                                buttons: 'OK'
                            }).then((isOkay) => {
                                if (isOkay) {
                                    window.location
                                        .reload();
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
    });
</script>