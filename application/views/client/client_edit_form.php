<!DOCTYPE html>
<html>
<head>
    <title>Modifier un Client</title>
</head>
<body>
    <h1>Modifier un Client</h1>
    <form method="post" action="<?php echo base_url('client/update/' . $client['id']); ?>">
        <label for="nomGlobal">Nom:</label>
        <input type="text" name="nomGlobal" value="<?php echo $client['nomGlobal']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $client['email']; ?>"><br>

        <label for="adresse">Adresse:</label>
        <input type="text" name="adresse" value="<?php echo $client['adresse']; ?>"><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
