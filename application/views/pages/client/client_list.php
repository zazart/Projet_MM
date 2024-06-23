<!DOCTYPE html>
<html>
<head>
    <title>Liste des Clients</title>
</head>
<body>
    <h1>Liste des Clients</h1>
    <a href="<?php echo base_url('client/create'); ?>">Créer un nouveau Client</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($clients as $client): ?>
        <tr>
            <td><?php echo $client['id_client']; ?></td>
            <td><?php echo $client['nomglobal']; ?></td>
            <td><?php echo $client['email']; ?></td>
            <td><?php echo $client['adresse']; ?></td>
            <td>
                <a href="<?php echo base_url('client/edit/' . $client['id_client']); ?>">Modifier</a>
                <a href="<?php echo base_url('client/delete/' . $client['id_client']); ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce client ?');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
