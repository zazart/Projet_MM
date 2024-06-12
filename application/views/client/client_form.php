<!DOCTYPE html>
<html>
<head>
    <title>Créer un Client</title>
</head>
<body>
    <h1>Créer un Client</h1>
    <form method="post" action="<?php echo base_url('client/store'); ?>">
        <label for="nomGlobal">Nom:</label>
        <input type="text" name="nomGlobal" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email"><br>

        <label for="adresse">Adresse:</label>
        <input type="text" name="adresse"><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
