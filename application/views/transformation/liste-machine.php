<html>
<head>
    <title>Liste des Machines</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Formulaire de recherche par date d'achat -->
    <h2>Recherche par date d'achat</h2>
    <?php echo form_open('transformation/machine_controller/search_by_date'); ?>

    <label for="date_debut">Date de début:</label>
    <input type="date" name="date_debut"/><br />

    <label for="date_fin">Date de fin:</label>
    <input type="date" name="date_fin"/><br />

    <input type="submit" name="search" value="Rechercher" />

    </form>

    <h1>Liste des Machines</h1>
    <table border="1">
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Fonction</th>
            <th>Date achat</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($machines as $machine): ?>
        <tr>
            <td><?php echo $machine['id_machine']; ?></td>
            <td><?php echo $machine['nom_machine']; ?></td>
            <td><?php echo $machine['fonction']; ?></td>
            <td><?php echo $machine['date_achat']; ?></td>
            <td>
                <a href="<?php echo site_url('transformation/machine_controller/validation_update_machine/' . $machine['id_machine']); ?>">Modifier</a>
                <a href="<?php echo site_url('transformation/machine_controller/validation_delete_machine/' . $machine['id_machine']); ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="<?php echo site_url('transformation/machine_controller/view_insertion_machine'); ?>">Ajouter une machine</a>
    <a href="<?php echo site_url('transformation/statut_controller/index'); ?>">Voir état machine</a>
</body>
</html>
