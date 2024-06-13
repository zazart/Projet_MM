<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Liste de paiement</h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Collecteur</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Type</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($paiement as  $b) { ?>
                    <tr>
                      <td><?php echo $b['dates'] ?></td>
                      <td><?php  echo $b['nom']  ?></td>
                      <td><?php echo $b['prix'] ?></td>
                      <td><?php  echo $b['libelle']  ?></td>
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