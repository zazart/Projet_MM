<section class="section">
  <div class="card-body">
    <h5 class="card-title text-center">Mouvement de Stock produit</h5>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Nom produit</th>
            <th scope="col">Date de production</th>
            <th scope="col">Quantité Entrante</th>
            <th scope="col">Quantité Sortante</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($mouvementstocks as $mouvementstock): ?>
          <tr>
              <th scope="row"><?php echo $mouvementstock['nom_produit']; ?></th>
              <th scope="row"><?php echo $mouvementstock['datestockproduit']; ?></th>
              <td><?php echo $mouvementstock['quantiteentrant']; ?></td>
              <td><?php echo $mouvementstock['quantitesortant']; ?></td>
              <td>
                  <a href="<?php echo site_url('transformation/stockproduit_controller/validation_update_mouvementstock/' . $mouvementstock['id_stockproduit']); ?>">Modifier</a>
                  <a href="<?php echo site_url('transformation/stockproduit_controller/validation_delete_mouvementstock/' . $mouvementstock['id_stockproduit']); ?>">Supprimer</a>
              </td>
          </tr>
          <?php endforeach; ?>
        </tbody> 
      </table>
  </div>
</section>