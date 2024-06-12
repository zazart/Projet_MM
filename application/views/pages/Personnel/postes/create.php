<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center"><?php echo $title; ?></h5>

              <?php echo form_open('postes/create', ['class' => 'row g-3']);?>
                <div class="col-12">
                  <label for="nom" class="form-label">Nom :</label>
                  <input type="text" class="form-control" name="nom" id="nom">
                </div>
                <div class="col-12">
                  <label for="montant_salaire" class="form-label">Salaire :</label>
                  <input type="number" class="form-control" name="montant_salaire" id="montant_salaire">
                </div>
                <div class="col-12">
                  <label for="duree_travail" class="form-label">Durée de Travail :</label>
                  <input type="time" class="form-control" name="duree_travail" id="duree_travail">
                </div>

                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Créer le Poste</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>