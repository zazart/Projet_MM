<!-- application/views/genres/index.php -->
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
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($genres as $genre): ?>
            <tr>
                <td><?php echo $genre['description']; ?></td>
                <td>
                    <a href="<?php echo site_url('genres/view/'.$genre['id']); ?>">Voir</a> |
                    <a href="<?php echo site_url('genres/edit/'.$genre['id']); ?>">Modifier</a> |
                    <a href="<?php echo site_url('genres/delete/'.$genre['id']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce genre ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="<?php echo site_url('genres/create'); ?>">Créer un nouveau genre</a></p>
</body>
</html>
