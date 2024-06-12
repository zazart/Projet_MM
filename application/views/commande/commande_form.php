<!DOCTYPE html>
<html>
<head>
    <title>Créer une Commande</title>
    <script src="<?= base_url("/assets/js/jquery-3.7.1.min.js") ?>"></script>
    <script>
        $(document).ready(function() {
            $('#add-product').click(function() {
                var productId = $('#product-select').val();
                var productName = $('#product-select option:selected').text();
                var quantity = $('#quantity').val();

                if (quantity && !isNaN(quantity)) {
                    var newRow = `<tr>
                        <td>` + productId + `</td>
                        <td>` + productName + `</td>
                        <td>` + quantity + `</td>
                        <td><button type="button" class="remove-product">Supprimer</button></td>
                    </tr>`;
                    $('#product-table tbody').append(newRow);
                    $('#quantity').val('');

                    // Ajouter des champs cachés pour les produits et les quantités
                    var hiddenProductInput = `<input type="hidden" name="produits[]" value="` + productId + `">`;
                    var hiddenQuantityInput = `<input type="hidden" name="quantites[]" value="` + quantity + `">`;
                    $('#hidden-fields').append(hiddenProductInput);
                    $('#hidden-fields').append(hiddenQuantityInput);
                } else {
                    alert("Quantité invalide.");
                }
            });

            // Supprimer un produit du tableau et des champs cachés
            $(document).on('click', '.remove-product', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
</head>
<body>
    <h1>Créer une Commande</h1>
    <form method="post" action="<?php echo base_url('commande/store'); ?>">
        <label for="id_client">Client:</label>
        <select name="id_client" required>
            <?php foreach ($clients as $client): ?>
                <option value="<?php echo $client['id']; ?>"><?php echo $client['nomglobal']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="">Date</label>
        <input type="date" name="date" id=""><br>
        <h2>Ajouter des Produits</h2>
        <select id="product-select">
            <?php foreach ($produits as $produit): ?>
                <option value="<?php echo $produit['id']; ?>"><?php echo $produit['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" id="quantity" placeholder="Quantité">
        <button type="button" id="add-product">Ajouter</button><br>

        <h2>Panier</h2>
        <table id="product-table" border="1">
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

        <div id="hidden-fields">
            <!-- Les champs cachés pour les produits et les quantités seront ajoutés ici -->
        </div>

        <br>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
