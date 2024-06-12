<!-- application/views/presences/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('presences/edit/'.$presence['id_presence']); ?>
        <label for="id_employe">Employé</label>
        <select name="id_employe">
            <?php foreach ($employes as $employe): ?>
            <option value="<?php echo $employe['id_employe']; ?>" <?php echo $employe['id_employe'] == $presence['id_employe'] ? 'selected' : ''; ?>><?php echo $employe['email']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="date">Date</label>
        <input type="date" name="date" value="<?php echo $presence['date']; ?>"><br>

        <label for="heure_arrivee">Heure d'Arrivée</label>
        <input type="time" name="heure_arrivee" value="<?php echo $presence['heure_arrivee']; ?>"><br>

        <label for="heure_depart">Heure de Départ</label>
        <input type="time" name="heure_depart" value="<?php echo $presence['heure_depart']; ?>"><br>

        <input type="submit" name="submit" value="Modifier la Présence">
    </form>
</body>
</html>
