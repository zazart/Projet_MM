<!-- application/views/paiementEmployes/create.php -->
<h2>Ajouter un Paiement Employé</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('Personnel/paiementEmployes/create'); ?>

<label for="libelle">Libellé :</label>
<input type="text" name="libelle" /><br/>

<label for="id_employe">Employé :</label>
<select name="id_employe">
    <option value="">Sélectionnez</option>
    <?php foreach ($employes as $employe): ?>
        <option value="<?php echo $employe['id_employe']; ?>"><?php echo $employe['nom']; ?></option>
    <?php endforeach; ?>
</select><br/>

<input type="submit" value="Ajouter" />

<?php echo form_close(); ?>
