<div class="card">
<div class="card-body">
    <h5 class="card-title"><?php echo $title; ?></h5>

    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Salaire</th>
            <th scope="col">Durée de Travail</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($postes as $poste): ?>
        <tr>
            <td><?php echo $poste['nom']; ?></td>
            <td><?php echo $poste['montant_salaire']; ?></td>
            <td><?php echo $poste['duree_travail']; ?></td>
            <td>
                <a href="<?php echo site_url('Personnel/postes/view/'.$poste['id_poste']); ?>">Voir</a> |
                <a href="<?php echo site_url('Personnel/postes/edit/'.$poste['id_poste']); ?>">Modifier</a> |
                <a href="<?php echo site_url('Personnel/postes/delete/'.$poste['id_poste']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?');">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>

</div>
</div>