<div class="card">
<div class="card-body">
    <h5 class="card-title color_black_0"><?php echo $title; ?></h5>

    <table class="table table-hover">
    <thead>
        <tr>
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
            <td><?php echo $employe['nom']; ?></td>
            <td><?php echo $employe['email']; ?></td>
            <td><?php echo $employe['telephone']; ?></td>
            <td><?php echo $employe['adresse']; ?></td>
            <td><?php echo $employe['genre_description']; ?></td>
            <td><?php echo $employe['poste_nom']; ?></td>
            <td>
                <a href="<?php echo site_url('personnel/employes/view/'.$employe['id_employe']); ?>"><i class="bi bi-card-list color_black"></i></i></a> 
                <a href="<?php echo site_url('personnel/employes/edit/'.$employe['id_employe']); ?>"><i class="bi bi-pencil-square color_light"></i></a>
                <!-- <a href="<?php echo site_url('personnel/employes/delete/'.$employe['id_employe']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');"><i class="bi bi-trash3 color_black"></i></a> -->
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>

</div>
</div>