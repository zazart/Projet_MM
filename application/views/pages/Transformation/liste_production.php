<section class="section">
  <div class="card-body">
    <h5 class="card-title text-center">Liste machines</h5>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Matière Première</th>
            <th scope="col">Quantité Brut</th>
            <th scope="col">Quantité Produit</th>
            <th scope="col">Date production</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($machines as $machine): ?>
          <tr>
              <th scope="row"><?php echo $machine['id_machine']; ?></th>
              <td><?php echo $machine['quantitebrut']; ?></td>
              <td><?php echo $machine['quantiteproduit']; ?></td>
              <td><?php echo $machine['dateproduction']; ?></td>
              <td>
                  <a href="<?php echo site_url('transformation/production_controller/validation_update_production/' . $production['id_production']); ?>">Modifier</a>
                  <a href="<?php echo site_url('transformation/production_controller/validation_delete_production/' . $production['id_production']); ?>">Supprimer</a>
              </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </div>
</section>