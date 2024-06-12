<!-- application/views/employes/view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h2><?php echo $title; ?></h2>

    <table>
        <tr>
            <th>ID</th>
            <td><?php echo $employe['id_employe']; ?></td>
        </tr>
        <tr>
            <th>Date d'Embauche</th>
            <td><?php echo $employe['embauche']; ?></td>
        </tr>
        <tr>
            <th>Date de Débauche</th>
            <td><?php echo $employe['debauche']; ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?php echo $employe['nom']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $employe['email']; ?></td>
        </tr>
        <tr>
            <th>Numéro de Téléphone</th>
            <td><?php echo $employe['telephone']; ?></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><?php echo $employe['adresse']; ?></td>
        </tr>
        <tr>
            <th>Genre</th>
            <td><?php echo $employe['genre_description']; ?></td>
        </tr>
        <tr>
            <th>Poste</th>
            <td><?php echo $employe['poste_nom']; ?></td>
        </tr>
    </table>

    <p><a href="<?php echo site_url('employes'); ?>">Retour à la liste</a></p>
</body>
</html>
