<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Liste collecte</h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Matiere premiere</th>
                    <th scope="col">Quantite</th>
                    <th scope="col">Collecteur</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($collects as  $b) { ?>
                    <tr>
                      <td><?php echo $b['dates'] ?></td>
                      <td><?php  echo $b['matiere']  ?></td>
                      <td><?php echo $b['qtt'] ?></td>
                      <td><?php  echo $b['collecteur']  ?></td>
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