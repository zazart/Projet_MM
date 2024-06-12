<html>
<head>
    <title>Liste des Machines</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Etat des Machines</h1>
    <table border="1">
        <tr>
            <th>Nom machine</th>
            <th>Date Verification</th>
            <th>Statut</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($statuts as $statut): ?>
        <tr>
            <td><?php echo $statut['nom_machine']; ?></td>
            <td><?php echo $statut['date_verification']; ?></td>
            <td><?php echo $statut['statut']; ?></td>
            <td><?php echo $statut['descri']; ?></td>
            <td>
                <a href="<?php echo site_url('transformation/statut_controller/validation_update_statut/' . $statut['id_stat']); ?>">Modifier</a>
                <a href="<?php echo site_url('transformation/statut_controller/validation_delete_statut/' . $statut['id_stat']); ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>    

    <a href="<?php echo site_url('transformation/statut_controller/view_insertion_statut'); ?>">Ajouter statut machine</a>
</body>
</html>
