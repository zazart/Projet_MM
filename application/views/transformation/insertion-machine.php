<html>
<head>
    <title><?php echo isset($machine) ? 'Modifier Machine' : 'Ajouter une Machine'; ?></title>
</head>
<body>
    <h1><?php echo isset($machine) ? 'Modifier Machine' : 'Ajouter une Machine'; ?></h1>
    <?php echo validation_errors(); ?>
    <?php echo form_open(isset($machine) ? 'transformation/machine_controller/update_machine/' . $machine['id_machine'] : 'transformation/machine_controller/validation_insert_machine'); ?>

    <label for="nom_machine">Nom:</label>
    <input type="text" name="nom_machine" value="<?php echo isset($machine) ? $machine['nom_machine'] : ''; ?>" /><br />

    <label for="fonction">Fonction:</label>
    <input type="text" name="fonction" value="<?php echo isset($machine) ? $machine['fonction'] : ''; ?>" /><br />

    <label for="date_achat">Date Achat:</label>
    <input type="date" name="date_achat" value="<?php echo isset($machine) ? $machine['date_achat'] : ''; ?>" /><br />

    <input type="submit" name="submit" value="<?php echo isset($machine) ? 'Mettre à Jour' : 'Ajouter'; ?>" />

    </form>
</body>
</html>
