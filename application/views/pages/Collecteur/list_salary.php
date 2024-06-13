<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Liste salaire</h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Collecteur</th>
                    <th scope="col">Montant</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($salary as  $b) { ?>
                    <tr>
                      <td><?php echo $b['dates'] ?></td>
                      <td><?php  echo $b['nom']  ?></td>
                      <td><?php echo $b['prix'] ?></td>
                    </tr>
                  <?php  } ?>
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>
        </div>
      </div>
    </section>