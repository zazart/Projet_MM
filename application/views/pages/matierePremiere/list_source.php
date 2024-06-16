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
                    <th scope="col">Lieu</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                  
                </thead>
                <tbody>
                <?php foreach($source as $source): ?>
                <tr>
                <td><?php echo $source['lieu']; ?></td>
                <td><a href="<?php echo site_url('Matiere_Premier/edit_source/'.$source['id']);?>">Edit</a></td>
                <td><a href="<?php echo site_url('Matiere_Premier/drop_source/'.$source['id']);?>">Delete</a></td>
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
