<!DOCTYPE html>
<html>
<head>
    <title>Liste des Ventes</title>
</head>
<body>
    <h1>Liste des Ventes</h1>
    <a href="<?php echo base_url('vente/create'); ?>">Créer une nouvelle Vente</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Livraison</th>
            <th>Prix Total</th>
            <th>ID Commande</th>
        </tr>
        <?php foreach ($ventes as $vente): ?>
        <tr>
            <td><?php echo $vente['id_vente']; ?></td>
            <td><?php echo $vente['livraison'] ? 'Oui' : 'Non'; ?></td>
            <td><?php echo $vente['prixtotal']; ?></td>
            <td><?php echo $vente['id_commande']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
