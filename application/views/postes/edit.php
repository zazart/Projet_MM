<!-- application/views/postes/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('postes/edit/'.$poste['id_poste']); ?>

    <label for="nom">Nom</label>
    <input type="text" name="nom" value="<?php echo $poste['nom']; ?>" /><br />

    <label for="montant_salaire">Salaire</label>
    <input type="number" name="montant_salaire" value="<?php echo $poste['montant_salaire']; ?>" /><br />

    <label for="duree_travail">Durée de Travail</label>
    <input type="time" name="duree_travail" value="<?php echo $poste['duree_travail']; ?>" /><br />

    <input type="submit" name="submit" value="Modifier le Poste" />

    </form>
</body>
</html>
