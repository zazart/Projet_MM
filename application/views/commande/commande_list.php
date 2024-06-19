<!DOCTYPE html>
<html>
<head>
    <title>Liste des Commandes</title>
</head>
<body>
    <h1>Liste des Commandes</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Date de Commande</th>
            <th>Client</th>
            <th>Action</th>
        </tr>
        <?php foreach ($commandes as $commande): ?>
        <tr>
            <td><?php echo $commande['id_commande']; ?></td>
            <td><?php echo $commande['datecommande']; ?></td>
            <td><?php echo $commande['nomglobal']; ?></td>
            <td>
                <a href="<?=base_url('/panier/list/' . $commande['id_commande'])?>" >Voir Panier</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
