<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Insertion commande</h5>
                    <!-- Vertical Form -->
                    <form class="row g-3" id="commandeForm">
                        <div class="col-12">
                            <label for="datecommande" class="form-label">Date :</label>
                            <input type="date" class="form-control" id="datecommande" name="datecommande">
                            <div class="text-danger" id="datecommandeError"></div>
                        </div>
                        <div class="col-12">
                            <label for="client" class="form-label">Client :</label>
                            <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="client">
                                    <option selected disabled>Choisit ton client</option>
                                    <?php foreach ($clients as $client) : ?>
                                        <option value="<?php echo $client['id_client']; ?>">
                                            <?php echo $client['nomglobal']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-danger" id="clientError"></div>
                            </div>
                        </div>
                        <div class="card custom-card-bg">
                            <div class="card-body">
                                <div class="card-title">Panier</div>
                                <div class="col-12">
                                    <label for="ajoutProduit" class="form-label text-black">Ajouter des Produits :</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="ajoutProduit" id="ajoutProduit">
                                            <option selected disabled>Choisir une produit</option>
                                            <?php foreach ($produits as $produit) : ?>
                                                <option value="<?php echo $produit['id_produit']; ?>">
                                                    <?php echo $produit['nom_produit']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="text-danger" id="ajoutProduitError"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="qtt" class="form-label text-black">Quantite :</label>
                                    <input type="number" id="quantity" name="qtt" class="form-control">
                                    <div class="text-danger" id="qttError"></div>
                                    <button type="button" id="add-product" class="btn btn-success my-3 ">Ajouter dans le
                                        panier</button><br>
                                </div>
                                <table id="product-table" class="table table-light">
                                    <thead>
                                        <tr>
                                            <th>ID du Produit</th>
                                            <th>Nom du Produit</th>
                                            <th>Quantité</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Les produits ajoutés apparaîtront ici -->
                                    </tbody>
                                </table>
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
                <img src="<?php echo (base_url("assets/img/commande.jpg")) ?>" class="card-img-top">
                <div class="card-body d-flex justify-content-center mt-3">
                    <button class="boutton boutton-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Voir liste des commandes</button>
                </div>
                <div class="modal fade" id="verticalycentered">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="card-title">Listes des commandes</h5>
                                <p>Voici les listes de tous les commandes dans le <span class="color_secondary">projet
                                        MM
                                    </span>avec ses informations:</p>
                                <div id="valiny">
                                    <table id="commandeData">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Date du commande</th>
                                                <th>Client</th>
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

    document.getElementById('add-product').addEventListener('click', function() {
        // Récupérer les valeurs des champs de saisie
        var productSelect = document.getElementById('ajoutProduit');
        var productId = productSelect.value;
        var productName = productSelect.options[productSelect.selectedIndex].text;
        var quantity = document.getElementById('quantity').value;

        // Valider les entrées
        if (!productId || !quantity || quantity <= 0) {
            swal({
                title: 'Erreur',
                text: 'Veuillez sélectionner un produit et saisir une quantité valide.',
                icon: 'error',
                buttons: 'OK'
            }).then((isOkay) => {
                if (isOkay) {}
            });
            return;
        }

        // Ajouter une nouvelle ligne à la table
        var tableBody = document.querySelector('#product-table tbody');
        var newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td><input type="hidden" name="produits[]" value="${productId}">${productId}</td>
            <td>${productName}</td>
            <td><input type="hidden" name="quantites[]" value="${quantity}">${quantity}</td>
            <td><button class="btn btn-danger btn-sm remove-product">Supprimer</button></td>
        `;

        tableBody.appendChild(newRow);

        // Réinitialiser les champs de saisie
        productSelect.selectedIndex = 0;
        document.getElementById('quantity').value = '';

        // Ajouter un écouteur d'événement pour les boutons de suppression
        newRow.querySelector('.remove-product').addEventListener('click', function() {
            tableBody.removeChild(newRow);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var commandeForm = document.getElementById('commandeForm');
        var xhr2 = creeXHR();
        xhr2.open('POST', '<?= base_url("vente_commande/commande/getliste_commande") ?>', true);
        xhr2.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState === XMLHttpRequest.DONE) {
                if (xhr2.status === 200) {
                    var response = JSON.parse(xhr2.responseText);
                    if (response.success) {
                        var var_commandes = response.commandes;
                        const commandeArray = var_commandes.map(commande => Object.values(
                            commande));
                        if ($.fn.DataTable.isDataTable('#commandeData')) {
                            $('#commandeData').DataTable().destroy();
                        }
                        var table = $('#commandeData').DataTable({
                            data: commandeArray,
                            columns: [{
                                    title: 'ID'
                                },
                                {
                                    title: 'Date de commande'
                                },
                                {
                                    title: 'Client'
                                },
                                {
                                    title: 'Actions',
                                    render: function(data, type, row,
                                        meta) {
                                        var panierImgSrc =
                                            '<?php echo base_url('assets/img/panier.png'); ?>';
                                        var editImgSrc =
                                            '<?php echo base_url('assets/img/modifier.png'); ?>';
                                        var deleteImgSrc =
                                            '<?php echo base_url('assets/img/corbeille.png'); ?>';
                                        return '<img class="img-panier" style="margin-right:30px;cursor:pointer;" src="' +
                                            panierImgSrc + '" data-id="' +
                                            row[0] +
                                            '" alt="Panier">' +
                                            '<img class="img-modifier" style="margin-right:30px;cursor:pointer;" src="' +
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
                        $('#commandeData tbody').on('click', '.img-panier',
                            function() {
                                var id = $(this).data('id');
                                var xhrPanier = new XMLHttpRequest();

                                xhrPanier.open('POST',
                                    '<?= base_url("vente_commande/commande/find_by_panier") ?>',
                                    true);
                                xhrPanier.setRequestHeader('X-Requested-With',
                                    'XMLHttpRequest');
                                xhrPanier.setRequestHeader('Content-Type',
                                    'application/x-www-form-urlencoded');

                                xhrPanier.onreadystatechange = function() {
                                    if (xhrPanier.readyState == 4 && xhrPanier
                                        .status == 200) {
                                        var response = JSON.parse(xhrPanier
                                            .responseText);
                                        if (response.success) {
                                            var products = response.paniers;
                                            var tablePane = document.createElement('table');
                                            tablePane.className = 'table table-light';
                                            var thead = document.createElement('thead');
                                            thead.innerHTML = `
                                                            <tr>
                                                                <th>ID du Produit</th>
                                                                <th>Nom du Produit</th>
                                                                <th>Quantité</th>
                                                            </tr>
                                                        `;
                                            var tbody = document.createElement('tbody');
                                            products.forEach(function(product) {
                                                var row = document.createElement('tr');
                                                row.innerHTML = `
                                                    <td>${product.id_produit}</td>
                                                    <td>${product.nom_produit}</td>
                                                    <td>${product.quantite}</td>
                                                `;
                                                tbody.appendChild(row);
                                            });
                                            tablePane.appendChild(thead);
                                            tablePane.appendChild(tbody);

                                            swal({
                                                title: "Les produits dans le panier",
                                                content: tablePane,
                                                icon: "info"
                                            });
                                        }
                                    }
                                };

                                xhrPanier.send('id=' + encodeURIComponent(
                                    id
                                ));
                            });

                        // Événement click sur les images Modifier
                        $('#commandeData tbody').on('click', '.img-modifier',
                            function() {
                                var id = $(this).data('id');
                                window.location.href =
                                    '<?= base_url("vente_commande/commande/update_commande") ?>' + "/" + id;
                            });

                        // Événement click sur les images Supprimer
                        $('#commandeData tbody').on('click', '.img-supprimer',
                            function() {
                                var id = $(this).data('id');
                                // Ajoutez ici la logique pour supprimer le client
                                swal({
                                    title: 'Confirmation de la suppression',
                                    text: 'Voulez vous vraiment supprimer ce commande',
                                    icon: 'warning',
                                    buttons: true,
                                    dangerMode: true,
                                }).then((isOkay) => {
                                    if (isOkay) {
                                        var xhrSupprimer = new XMLHttpRequest();

                                        xhrSupprimer.open('POST',
                                            '<?= base_url("vente_commande/commande/delete") ?>',
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
                                                        text: 'Commande supprimé avec succès.',
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
                                                    text: 'Ce commande ne peut pas etre supprimer',
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

        commandeForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(commandeForm);
            var xhr = creeXHR();
            xhr.open('POST', '<?= base_url("vente_commande/commande/store") ?>', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            swal({
                                title: 'Succès',
                                text: 'Commande ajouté avec succès.',
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
                            document.getElementById('datecommandeError').innerHTML = response.errors
                                .datecommande || '';
                            document.getElementById('clientError').innerHTML = response.errors.client ||
                                '';
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