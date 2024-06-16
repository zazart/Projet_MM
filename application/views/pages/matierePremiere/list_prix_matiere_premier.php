<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
            <h5 class="card-title text-center">Liste des matières premières</h5>

              <!-- Vertical Form -->
              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  
                  <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix Unitaire</th>
                        <th scope="col">Date</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                 </tr>
                </thead>
                <tbody>
                  <?php foreach($prix_matiere_data as $prix_matiere): ?>
                        <tr>
                            <td><?php echo $prix_matiere['nom']; ?></td>
                            <td><?php echo $prix_matiere['prix']; ?></td>
                            <td><?php echo $prix_matiere['dateprix']; ?></td>
                            <td><a href="<?php echo site_url('Matiere_Premier/edit_prix_matier_permier/'.$prix_matiere['id']);?>">Edit</a></td>
                            <td><a href="<?php echo site_url('Matiere_Premier/drop_prix_matier_permier/'.$prix_matiere['id']);?>">Delete</a></td>
                        </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>
          </div>
      </div>
    </section>
