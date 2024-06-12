<!-- application/views/postes/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2><?php echo $title; ?></h2>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Salaire</th>
                <th>Durée de Travail</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($postes as $poste): ?>
            <tr>
                <td><?php echo $poste['nom']; ?></td>
                <td><?php echo $poste['montant_salaire']; ?></td>
                <td><?php echo $poste['duree_travail']; ?></td>
                <td>
                    <a href="<?php echo site_url('postes/view/'.$poste['id_poste']); ?>">Voir</a> |
                    <a href="<?php echo site_url('postes/edit/'.$poste['id_poste']); ?>">Modifier</a> |
                    <a href="<?php echo site_url('postes/delete/'.$poste['id_poste']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="<?php echo site_url('postes/create'); ?>">Créer un nouveau poste</a></p>
</body>
</html>
