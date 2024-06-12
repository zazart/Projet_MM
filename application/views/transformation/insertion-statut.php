<html>
<head>
    <title><?php echo isset($statut) ? 'Modifier statut Machine' : 'Ajouter un statut'; ?></title>
</head>
<body>
    <h1><?php echo isset($statut) ? 'Modifier statut' : 'Ajouter un statut'; ?></h1>
    <?php echo validation_errors(); ?>
    <?php echo form_open(isset($statut) ? 'transformation/statut_controller/validation_update_statut/' . $statut['id_statut'] : 'transformation/statut_controller/validation_insert_statut'); ?>

    <label for="id_machine">Nom machine:</label>
    <select id="id_machine" name="id_machine">
        <?php 
            foreach ($machines as $machine) {
                echo '<option value="' . $machine["id_machine"] . '">' . $machine["nom_machine"] . '</option>';
            }
        ?>
    </select> <br />
    
    <label for="date_verification">Date verification:</label>
    <input type="date" name="date_verification" value="<?php echo isset($statut) ? $statut['date_verification'] : ''; ?>" /><br />

    <label for="statut">Statut:</label>
    <input type="number" name="statut" value="<?php echo isset($statut) ? $statut['statut'] : ''; ?>" /><br />

    <label for="descri">Description de son Etat:</label>
    <input type="text" name="descri" value="<?php echo isset($statut) ? $statut['descri'] : ''; ?>" /><br />

    <input type="submit" name="submit" value="<?php echo isset($statut) ? 'Mettre à Jour' : 'Ajouter'; ?>" />

    </form>
</body>
</html>
