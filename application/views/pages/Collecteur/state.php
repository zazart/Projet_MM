    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">

            <?php for ($i=0; $i < count($etat); $i++) { ?>
              <h5 class="card-title text-center"><?php echo $etat[$i]['nom'] ?></h5>
              
              <!-- Progress Bars with labels-->
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?php echo intval($etat[$i]['pourcentage']); ?>%" aria-valuenow="<?php echo $etat[$i]['pourcentage'] ?>" aria-valuemin="0" aria-valuemax="100">
                  <?php echo intval($etat[$i]['pourcentage']); ?>%
                </div>
              </div>
              
              <?php } ?>
            </div><!-- End Progress Bars with labels -->
            </div>
          </div>
        </div>
      </div>
    </section>