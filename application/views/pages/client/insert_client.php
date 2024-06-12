<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Insertion client</h5>

              <!-- Vertical Form -->
              <form  action="<?php echo(base_url("vente_commande/client/store"))?>" class="row g-3" method="post">
                <div class="col-12">
                  <label for="nomGlobal" class="form-label">Username :</label>
                  <input type="text" class="form-control" id="nomGlobal" name="nomGlobal">
                </div>
                <div class="col-12">
                  <label for="email" class="form-label">Email :</label>
                  <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="col-12">
                  <label for="adresse" class="form-label">Adresse :</label>
                  <input type="text" class="form-control" id="adresse" name="adresse">
                </div>

                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Inserer</button>
                </div>
              </form><!-- Vertical Form -->
            </div>
          </div>
        </div>
      </div>
    </section>