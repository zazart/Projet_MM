<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo base_url("vente/store") ?>" method="post">
        <h1>Form vente</h1>
        <label for="commande-select">Commande</label>
        <select id="commande-select" name="id_commande">
            <?php foreach ($commandes as $commande): ?>
                <option value="<?php echo $commande['id_commande']; ?>"><?php echo $commande['nomglobal']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="livraison">Livraison:</label>
        <input type="checkbox" name="livraison"><br>

        <label for="date">Date:</label>
        <input type="date" name="date_vente"><br>
        
        <label for="prixTotal">Prix Total:</label>
        <input type="text" name="prixTotal" required><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>