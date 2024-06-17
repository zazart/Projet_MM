<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center"><?php echo $title; ?></h5>

              <?php if (validation_errors()) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"> Erreur : </i>
                      <?php echo validation_errors(); ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              <?php endif; ?>
              
              <?php echo form_open('Personnel/postes/create', ['class' => 'row g-3']);?>
                <div class="col-12">
                  <label for="nom" class="form-label">Nom :</label>
                  <input type="text" class="form-control" name="nom" id="nom">
                </div>
                <div class="col-12">
                  <label for="montant_salaire" class="form-label">Salaire :</label>
                  <input type="number" class="form-control" name="montant_salaire" id="montant_salaire">
                </div>

                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Créer le Poste</button>
                </div>
              <?php echo form_close(); ?>

            </div>
          </div>
        </div>
      </div>
    </section>