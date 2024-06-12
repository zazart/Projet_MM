<!-- application/views/employes/index.php -->
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
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Numéro de Téléphone</th>
                <th>Adresse</th>
                <th>Genre</th>
                <th>Poste</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $employe): ?>
            <tr>
                <td><?php echo $employe['id_employe']; ?></td>
                <td><?php echo $employe['nom']; ?></td>
                <td><?php echo $employe['email']; ?></td>
                <td><?php echo $employe['telephone']; ?></td>
                <td><?php echo $employe['adresse']; ?></td>
                <td><?php echo $employe['genre_description']; ?></td>
                <td><?php echo $employe['poste_nom']; ?></td>
                <td>
                    <a href="<?php echo site_url('employes/view/'.$employe['id_employe']); ?>">Voir</a> |
                    <a href="<?php echo site_url('employes/edit/'.$employe['id_employe']); ?>">Modifier</a> |
                    <a href="<?php echo site_url('employes/delete/'.$employe['id_employe']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="<?php echo(site_url("employes/_create")); ?>">Créer un nouvel employé</a></p>
</body>
</html>
