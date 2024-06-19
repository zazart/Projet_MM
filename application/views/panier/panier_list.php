<!DOCTYPE html>
<html>
<head>
    <title>Panier</title>
</head>
<body>
    <h1>Panier</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix</th>
        </tr>
        <?php foreach ($paniers as $panier): ?>
        <tr>
            <td><?php echo $panier['id_panier']; ?></td>
            <td><?php echo $panier['nom_produit']; ?></td>
            <td><?php echo $panier['quantite']; ?></td>
            <td><?php echo $panier['quantite'] * $panier["prix_unitaire"]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
