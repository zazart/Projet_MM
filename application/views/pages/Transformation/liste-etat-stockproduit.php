<section class="section">
  <div class="card-body">
    <h5 class="card-title text-center">Etat stock produit</h5>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Nom Produit</th>
            <th scope="col">Quantité stock (kg)</th>
            <th scope="col">Date dernière production</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stockactuels as $stockactuel): ?>
            <tr>
              <th scope="row"><?php echo $stockactuel['nom_produit']; ?></th>
              <th scope="row"><?php echo $stockactuel['stock_actuel']; ?></th>
              <td><?php echo $stockactuel['datederniereproduction']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody> 
      </table>
  </div>
</section>