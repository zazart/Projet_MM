<section class="section">
  <div class="card-body">
    <h5 class="card-title text-center">Liste machines</h5>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Fonction</th>
            <th scope="col">Date derniere verification</th>
            <th scope="col">Statut</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
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
        </tbody>
      </table>
  </div>
</section>