<!-- application/views/employes/create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('employes/create'); ?>
        <label for="embauche">Date d'Embauche</label>
        <input type="date" name="embauche"><br>

        <label for="debauche">Date de Débauche</label>
        <input type="date" name="debauche"><br>

        <label for="nom">Nom</label>
        <input type="text" name="nom"><br>
        
        <label for="email">Email</label>
        <input type="text" name="email"><br>

        <label for="telephone">Numéro de Téléphone</label>
        <input type="text" name="telephone"><br>

        <label for="adresse">Adresse</label>
        <input type="text" name="adresse"><br>

        <label for="id_genre">Genre</label>
        <select name="id_genre">
            <?php foreach ($genres as $genre): ?>
            <option value="<?php echo $genre['id']; ?>"><?php echo $genre['description']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="id_poste">Poste</label>
        <select name="id_poste">
            <?php foreach ($postes as $poste): ?>
            <option value="<?php echo $poste['id_poste']; ?>"><?php echo $poste['nom']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" name="submit" value="Créer un nouvel employé">
    </form>
</body>
</html>
