<!-- application/views/presences/create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('presences/create'); ?>
        <label for="id_employe">Employé</label>
        <select name="id_employe">
            <?php foreach ($employes as $employe): ?>
            <option value="<?php echo $employe['id_employe']; ?>"><?php echo $employe['email']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="date">Date</label>
        <input type="date" name="date"><br>

        <label for="heure_arrivee">Heure d'Arrivée</label>
        <input type="time" name="heure_arrivee"><br>

        <label for="heure_depart">Heure de Départ</label>
        <input type="time" name="heure_depart"><br>

        <input type="submit" name="submit" value="Ajouter une Présence">
    </form>
</body>
</html>
