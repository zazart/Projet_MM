<section class="section">
  <div class="card-body">
    <h5 class="card-title text-center">Liste machines</h5>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Nom</th>
            <th scope="col">Date derniere verification</th>
            <th scope="col">Statut</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($statuts as $statut): ?>
          <tr>
              <th scope="row"><?php echo $statut['nom_machine']; ?></th>
              <td><?php echo $statut['date_verification']; ?></td>
              <td><?php echo $statut['statut']; ?></td>
              <td><?php echo $statut['descri']; ?></td>
              <td>
                  <a href="<?php echo site_url('transformation/statut_controller/validation_update_statut/' . $statut['id_stat']); ?>">Modifier</a>
                  <a href="<?php echo site_url('transformation/statut_controller/validation_delete_statut/' . $statut['id_stat']); ?>">Supprimer</a>
              </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </div>
</section>