<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Liste des bonus</h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Montant</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($bonus as  $b) { ?>
                    <tr>
                      <td><?php echo $b['datedebut'] ?></td>
                      <td><?php  echo $b['amount']  ?></td>
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