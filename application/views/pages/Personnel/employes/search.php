<!-- application/views/employes/search.php -->
<h2>Recherche des employés</h2>

<?php echo form_open('Personnel/employes/search'); ?>

<label for="nom">Nom ou email:</label>
<input type="text" name="nom" /><br/>

<label for="debut_embauche">Date d'embauche entre:</label>
<input type="date" name="debut_embauche" />

<label for="fin_embauche">et:</label>
<input type="date" name="fin_embauche" /><br/>

<label for="id_genre">Genre :</label>
<select name="id_genre">
    <option value="">Tous</option>
    <?php foreach ($genres as $genre): ?>
        <option value="<?php echo $genre['id_genre']; ?>"><?php echo $genre['description']; ?></option>
    <?php endforeach; ?>
</select><br/>

<label for="id_poste">Poste :</label>
<select name="id_poste">
    <option value="">Tous</option>3
    <?php foreach ($postes as $poste): ?>
        <option value="<?php echo $poste['id_poste']; ?>"><?php echo $poste['nom']; ?></option>
    <?php endforeach; ?>
</select><br/>

<input type="submit" value="Rechercher" />

<?php echo form_close(); ?>
