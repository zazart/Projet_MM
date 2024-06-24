<!-- application/views/collects/search.php -->
<h2>Recherche des Collects</h2>

<?php echo form_open('collecteurs/CollectController/search'); ?>

    <label for="id_employe">Employé</label>
    <select name="id_employe">
        <option value="">Sélectionner un employé</option>
        <?php foreach ($collecteurs as $collecteur): ?>
            <option value="<?php echo $collecteur['id_employe']; ?>" <?php echo set_select('id_employe', $collecteur['id_employe']); ?>>
                <?php echo $collecteur['nom']; ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="date_start">Date de début</label>
    <input type="date" name="date_start" value="<?php echo set_value('date_start'); ?>"><br>

    <label for="date_end">Date de fin</label>
    <input type="date" name="date_end" value="<?php echo set_value('date_end'); ?>"><br>

    <label for="Id_MatierePremier">Matière première</label>
    <select name="Id_MatierePremier">
        <option value="">Sélectionner une Matière Première</option>
        <?php foreach ($matierepremiers as $matiere): ?>
            <option value="<?php echo $matiere['id_matierepremier']; ?>" <?php echo set_select('id_matierepremier', $matiere['id_matierepremier']); ?>>
                <?php echo $matiere['nom']; ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Rechercher">

<?php echo form_close(); ?>


