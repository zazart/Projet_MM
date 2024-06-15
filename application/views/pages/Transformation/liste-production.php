<section class="section">
  <div class="card-body">
    <h5 class="card-title text-center">Liste production</h5>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Matière Première</th>
            <th scope="col">Nom Matière Première</th>
            <th scope="col">Quantité Matière Première</th>
            <th scope="col">Quantité Produit</th>
            <th scope="col">Date production</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($productions as $production): ?>
          <tr>
              <th scope="row"><?php echo $production['id_production']; ?></th>
              <th scope="row"><?php echo $production['nom_matierepremier']; ?></th>
              <td><?php echo $production['quantitebrut']; ?></td>
              <td><?php echo $production['quantiteproduit']; ?></td>
              <td><?php echo $production['dateproduction']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody> 
      </table>
  </div>
</section>