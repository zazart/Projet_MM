<section class="section">
  <div class="card-body">
    <h5 class="card-title text-center">Liste produits disponibles</h5>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Nom Produit</th>
            <th scope="col">Prix unitaire</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($produits as $produit): ?>
          <tr>
              <th scope="row"><?php echo $produit['nom_produit']; ?></th>
              <th scope="row"><?php echo $produit['prix_unitaire']; ?></th>
              <td>
                  <a href="<?php echo site_url('transformation/produit_controller/validation_update_produit/' . $produit['id_produit']); ?>">Modifier</a>
                  <a href="<?php echo site_url('transformation/produit_controller/validation_delete_produit/' . $produit['id_produit']); ?>">Supprimer</a>
              </td>
          </tr>
          <?php endforeach; ?>
        </tbody> 
      </table>
  </div>
</section>