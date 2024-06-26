<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Modification commande</h5>
                    <!-- Vertical Form -->
                    <form class="row g-3" id="commandeForm">
                        <input type="hidden" name="id_commande" value="<?php echo ($commandes['id_commande']); ?>">
                        <div class="col-12">
                            <label for="datecommande" class="form-label">Date :</label>
                            <input type="date" class="form-control" id="datecommande" name="datecommande"
                                value="<?php echo date('Y-m-d', strtotime($commandes['datecommande'])); ?>">
                            <div class="text-danger" id="datecommandeError"></div>
                        </div>
                        <div class="col-12">
                            <label for="client" class="form-label">Client :</label>
                            <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="client">
                                    <option selected disabled>Choisit ton client</option>
                                    <?php foreach ($clients as $client) : ?>
                                    <option value="<?php echo $client['id_client']; ?>"
                                        <?php echo ($client['id_client'] == $commandes['id_client']) ? 'selected' : ''; ?>>
                                        <?php echo $client['nomglobal']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-danger" id="clientError"></div>
                            </div>
                        </div>
                        <div class="card custom-card-bg">
                            <div class="card-body">
                                <div class="card-title">Panier</div>
                                <div class="col-12">
                                    <label for="ajoutProduit" class="form-label">Ajouter des Produits :</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example"
                                            name="ajoutProduit" id="ajoutProduit">
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
                                    <label for="qtt" class="form-label">Quantite :</label>
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
                                    <tbody>
                                        <?php foreach ($paniers as $panier) : ?>
                                        <tr>
                                            <td><input type="hidden" name="produits[]"
                                                    value="<?php echo $panier['id_produit']; ?>"><?php echo $panier['id_produit']; ?>
                                            </td>
                                            <td><?php echo $panier['nom_produit']; ?></td>
                                            <td><input type="hidden" name="quantites[]"
                                                    value="<?php echo $panier['quantite']; ?>"><?php echo $panier['quantite']; ?>
                                            </td>
                                            <td><button class="btn btn-danger btn-sm remove-product">Supprimer</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    </tbody>
                                </table>
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

document.addEventListener('DOMContentLoaded', function() {

    // Ajouter un écouteur d'événement pour les boutons de suppression existants
    document.querySelectorAll('.remove-product').forEach(function(button) {
        button.addEventListener('click', function() {
            var row = this.closest('tr');
            row.parentNode.removeChild(row);
        });
    });

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

    commandeForm.addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(commandeForm);
        var xhr = creeXHR();
        xhr.open('POST', '<?= base_url("vente_commande/commande/storeupdate") ?>', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        swal({
                            title: 'Succès',
                            text: 'Commande modifier avec succès.',
                            icon: 'success',
                            buttons: 'OK'
                        }).then((isOkay) => {
                            if (isOkay) {
                                window.location.href =
                                    '<?= base_url("vente_commande/commande/insert_commande") ?>'
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