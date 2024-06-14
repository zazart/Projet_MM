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
              

              <?php echo form_open('Personnel/postes/edit/'.$poste['id_poste'], ['class' => 'row g-3']);?>
              <div class="col-12">
                  <label for="nom" class="form-label">Nom :</label>
                  <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $poste['nom']; ?>">
                </div>
                <div class="col-12">
                  <label for="montant_salaire" class="form-label">Salaire :</label>
                  <input type="number" class="form-control" name="montant_salaire" id="montant_salaire" value="<?php echo $poste['montant_salaire']; ?>">
                </div>
                <div class="col-12">
                  <label for="duree_travail" class="form-label">Durée de Travail :</label>
                  <input type="time" class="form-control" name="duree_travail" id="duree_travail" value="<?php echo $poste['duree_travail']; ?>">
                </div>

                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Modifier le Poste</button>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </section>