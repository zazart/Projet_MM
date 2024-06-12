<div class="card">
            <div class="card-body">
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
                        <td><a href="<?php echo site_url('Matiere_premier/edit_matier_permier/'.$matiere['id']);?>">Modifier</a></td>
                        <td><a href="<?php echo site_url('Matiere_premier/drop_matier_permier/'.$matiere['id']);?>">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>
