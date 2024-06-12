<!-- application/views/postes/view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h2><?php echo $title; ?></h2>
    <p>Nom: <?php echo $poste['nom']; ?></p>
    <p>Salaire: <?php echo $poste['montant_salaire']; ?></p>
    <p>Durée de Travail: <?php echo $poste['duree_travail']; ?></p>
    <p><a href="<?php echo site_url('postes'); ?>">Retour à la liste des postes</a></p>
</body>
</html>
