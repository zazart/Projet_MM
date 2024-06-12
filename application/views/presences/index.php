<!-- application/views/presences/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h2><?php echo $title; ?></h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employé</th>
                <th>Date</th>
                <th>Heure d'Arrivée</th>
                <th>Heure de Départ</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($presences as $presence): ?>
            <tr>
                <td><?php echo $presence['id_presence']; ?></td>
                <td><?php echo $presence['email']; ?></td>
                <td><?php echo $presence['date']; ?></td>
                <td><?php echo $presence['heure_arrivee']; ?></td>
                <td><?php echo $presence['heure_depart']; ?></td>
                <td>
                    <a href="<?php echo site_url('presences/edit/'.$presence['id_presence']); ?>">Modifier</a> |
                    <a href="<?php echo site_url('presences/delete/'.$presence['id_presence']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette présence ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="<?php echo site_url('presences/create'); ?>">Ajouter une Présence</a></p>
</body>
</html>
