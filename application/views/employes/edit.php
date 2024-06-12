<!-- application/views/employes/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('employes/edit/'.$employe['id_employe']); ?>
        <label for="embauche">Date d'Embauche</label>
        <input type="date" name="embauche" value="<?php echo $employe['embauche']; ?>"><br>

        <label for="debauche">Date de Débauche</label>
        <input type="date" name="debauche" value="<?php echo $employe['debauche']; ?>"><br>

        <label for="nom">Nom</label>
        <input type="text" name="nom" value="<?php echo $employe['nom']; ?>"><br>

        <label for="email">Email</label>
        <input type="text" name="email" value="<?php echo $employe['email']; ?>"><br>

        <label for="telephone">Numéro de Téléphone</label>
        <input type="text" name="telephone" value="<?php echo $employe['telephone']; ?>"><br>

        <label for="adresse">Adresse</label>
        <input type="text" name="adresse" value="<?php echo $employe['adresse']; ?>"><br>

        <label for="id_genre">Genre</label>
        <select name="id_genre">
            <?php foreach ($genres as $genre): ?>
            <option value="<?php echo $genre['id']; ?>" <?php echo ($employe['id_genre'] == $genre['id']) ? 'selected' : ''; ?>><?php echo $genre['description']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="id_poste">Poste</label>
        <select name="id_poste">
            <?php foreach ($postes as $poste): ?>
            <option value="<?php echo $poste['id_poste']; ?>" <?php echo ($employe['id_poste'] == $poste['id_poste']) ? 'selected' : ''; ?>><?php echo $poste['nom']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" name="submit" value="Modifier l'employé">
    </form>
</body>
</html>
