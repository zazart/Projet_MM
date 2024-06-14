<div class="card">
<div class="card-body">
    <h5 class="card-title color_black_0"><?php echo $title; ?></h5>

    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Numéro de Téléphone</th>
            <th scope="col">Adresse</th>
            <th scope="col">Genre</th>
            <th scope="col">Poste</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($employes as $employe): ?>
        <tr>
            <td><?php echo $employe['id_employe']; ?></td>
            <td><?php echo $employe['nom']; ?></td>
            <td><?php echo $employe['email']; ?></td>
            <td><?php echo $employe['telephone']; ?></td>
            <td><?php echo $employe['adresse']; ?></td>
            <td><?php echo $employe['genre_description']; ?></td>
            <td><?php echo $employe['poste_nom']; ?></td>
            <td>
                <a href="<?php echo site_url('Personnel/employes/view/'.$employe['id_employe']); ?>">Voir</a> |
                <a href="<?php echo site_url('Personnel/employes/edit/'.$employe['id_employe']); ?>">Modifier</a> |
                <a href="<?php echo site_url('Personnel/employes/delete/'.$employe['id_employe']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>

</div>
</div>