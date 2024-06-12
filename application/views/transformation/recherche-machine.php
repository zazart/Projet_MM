<html>
<head>
    <title>Liste des Machines</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Liste des Machines</h1>
    <table border="1">
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Fonction</th>
            <th>Date achat</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($machines as $machine): ?>
        <tr>
            <td><?php echo $machine['id_machine']; ?></td>
            <td><?php echo $machine['nom_machine']; ?></td>
            <td><?php echo $machine['fonction']; ?></td>
            <td><?php echo $machine['date_achat']; ?></td>
            <td>
                <a href="<?php echo site_url('transformation/machine_controller/validation_update_machine/' . $machine['id_machine']); ?>">Modifier</a>
                <a href="<?php echo site_url('transformation/machine_controller/validation_delete_machine/' . $machine['id_machine']); ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="<?php echo site_url('transformation/machine_controller'); ?>">Tous les machines</a>
</body>
</html>
