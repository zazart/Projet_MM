<!-- application/views/collects/search_results.php -->
<h2><?php echo $title; ?></h2>

<?php if (empty($collects)): ?>
    <p>Aucune collecte trouvée.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date de Collecte</th>
                <th>Quantité</th>
                <th>Employé</th>
                <th>Matière Première</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($collects as $collect): ?>
                <tr>
                    <td><?php echo $collect['id_collects']; ?></td>
                    <td><?php echo $collect['datecollect']; ?></td>
                    <td><?php echo $collect['qtt']; ?></td>
                    <td><?php echo $collect['nom_employe']; ?></td>
                    <td><?php echo $collect['nom_matierepremier']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
