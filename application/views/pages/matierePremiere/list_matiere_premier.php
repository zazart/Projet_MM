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
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php foreach($matiere_data as $matiere): ?>
                        <tr>
                        <td><?php echo $matiere['nom']; ?></td>
                        <td><a href="<?php echo site_url('Matiere_premier/edit_matier_permier/'.$matiere['id_matierepremier']);?>">Modifier</a></td>
                        <td><a href="<?php echo site_url('Matiere_premier/drop_matier_permier/'.$matiere['id_matierepremier']);?>">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>
          </div>
      </div>
    </section>
