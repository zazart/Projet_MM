<!-- application/views/employes/search.php -->
<h2>Recherche des employés</h2>

<?php echo form_open('Personnel/employes/search'); ?>

<label for="nom">Nom :</label>
<input type="text" name="nom" /><br/>

<label for="email">Email :</label>
<input type="text" name="email" /><br/>

<label for="telephone">Téléphone :</label>
<input type="text" name="telephone" /><br/>

<label for="adresse">Adresse :</label>
<input type="text" name="adresse" /><br/>

<label for="id_genre">Genre :</label>
<select name="id_genre">
    <option value="">Sélectionnez</option>
    <!-- Remplissez les options avec les genres disponibles -->
</select><br/>

<label for="id_poste">Poste :</label>
<select name="id_poste">
    <option value="">Sélectionnez</option>
    <!-- Remplissez les options avec les postes disponibles -->
</select><br/>

<label for="embauche_before">Embauche avant :</label>
<input type="date" name="embauche_before" /><br/>

<label for="embauche_after">Embauche après :</label>
<input type="date" name="embauche_after" /><br/>

<label for="debauche_before">Débauche avant :</label>
<input type="date" name="debauche_before" /><br/>

<label for="debauche_after">Débauche après :</label>
<input type="date" name="debauche_after" /><br/>

<label for="debauche_is_null">Débauche est NULL :</label>
<input type="checkbox" name="debauche_is_null" value="1" /><br/>

<input type="submit" value="Rechercher" />

<?php echo form_close(); ?>
