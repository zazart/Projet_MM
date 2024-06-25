<!-- application/views/employes/search_results.php -->search
<h2><?php echo $title; ?></h2>

<?php if (empty($employes)): ?>
    <p>Aucun employé trouvé.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Genre</th>
                <th>Poste</th>
                <th>Date d'embauche</th>
                <th>Date de départ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $employe): ?>
                <tr>
                    <td><?php echo $employe['nom']; ?></td>
                    <td><?php echo $employe['email']; ?></td>
                    <td><?php echo $employe['telephone']; ?></td>
                    <td><?php echo $employe['adresse']; ?></td>
                    <td><?php echo $employe['genre_description']; ?></td>
                    <td><?php echo $employe['poste_nom']; ?></td>
                    <td><?php echo $employe['embauche']; ?></td>
                    <td><?php echo $employe['debauche']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
