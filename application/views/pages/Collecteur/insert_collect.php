<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Insertion collecte</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" id="collectForm">
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
                                    <option value="<?php echo $matierepremier['id_matierepremier']; ?>">
                                        <?php echo $matierepremier['nom']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger" id="matiereError"></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="qtt" class="form-label">Quantite :</label>
                            <input type="number" class="form-control" name="qtt" id="qtt">
                            <p class="text-danger" id="qttError"></p>
                        </div>
                        <div class="col-12">
                            <label for="date" class="form-label">Date de collect :</label>
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
                <img src="<?php echo (base_url("assets/img/collecte.jpg")) ?>" class="card-img-top">
                <div class="card-body d-flex justify-content-center mt-3">
                    <button class="boutton boutton-primary" data-bs-toggle="modal"
                        data-bs-target="#verticalycentered">Voir liste des collectes</button>
                </div>
                <div class="modal fade" id="verticalycentered">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="card-title">Listes des collects</h5>
                                <p>Voici la liste de toutes les collectes dans le <span class="color_secondary">projet MM
                                    </span>avec ses informations:</p>
                                <div id="valiny">
                                    <table id="collectData">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Date de collect</th>
                                                <th>Quantité</th>
                                                <th>Collecteur</th>
                                                <th>Matiere Premier</th>
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
    var collectForm = document.getElementById('collectForm');
    var xhr2 = creeXHR();
    xhr2.open('POST', '<?= base_url("collecteurs/collectController/getliste_collect") ?>', true);
    xhr2.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr2.onreadystatechange = function() {
        if (xhr2.readyState === XMLHttpRequest.DONE) {
            if (xhr2.status === 200) {
                var response = JSON.parse(xhr2.responseText);
                if (response.success) {
                    var var_collects = response.collects;
                    const collectsArray = var_collects.map(collect => Object.values(
                        collect));
                    if ($.fn.DataTable.isDataTable('#collectData')) {
                        $('#collectData').DataTable().destroy();
                    }
                    var table = $('#collectData').DataTable({
                        data: collectsArray,
                        columns: [{
                                title: 'ID'
                            },
                            {
                                title: 'Date de collect'
                            },
                            {
                                title: 'Quantite'
                            },
                            {
                                title: 'Collecteur'
                            },
                            {
                                title: 'Matiere Premier'
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
                    $('#collectData tbody').on('click', '.img-modifier',
                        function() {
                            var id = $(this).data('id');
                            window.location.href =
                                '<?= base_url("collecteurs/collectController/update_collect") ?>' +
                                "/" + id;
                        });

                    // Événement click sur les images Supprimer
                    $('#collectData tbody').on('click', '.img-supprimer',
                        function() {
                            var id = $(this).data('id');
                            swal({
                                title: 'Confirmation de la suppression',
                                text: 'Voulez vous vraiment supprimer ce collect',
                                icon: 'warning',
                                buttons: true,
                                dangerMode: true,
                            }).then((isOkay) => {
                                if (isOkay) {
                                    var xhrSupprimer = new XMLHttpRequest();

                                    xhrSupprimer.open('POST',
                                        '<?= base_url("collecteurs/collectController/delete") ?>',
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
                                                    text: 'Collect supprimé avec succès.',
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
                                                text: 'Ce collect ne peut pas etre supprimer',
                                                icon: 'error',
                                                buttons: 'OK'
                                            }).then((isOkay) => {
                                                if (isOkay) {
                                                    window.location
                                                        .reload();
                                                }
                                            });
                                        }
                                    };

                                    xhrSupprimer.send('id=' + encodeURIComponent(
                                        id
                                    ));
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


    collectForm.addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(collectForm);
        var xhr = creeXHR();
        xhr.open('POST', '<?= base_url("collecteurs/collectController/store") ?>', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        swal({
                            title: 'Succès',
                            text: 'Collect ajouté avec succès.',
                            icon: 'success',
                            buttons: 'OK'
                        }).then((isOkay) => {
                            if (isOkay) {
                                window.location
                                    .reload();
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
});
</script>