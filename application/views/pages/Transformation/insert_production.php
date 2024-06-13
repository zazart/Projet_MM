<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Insertion production</h5>

              <!-- Vertical Form -->
              <?php echo validation_errors(); ?>
              <?php echo form_open(isset($machine) ? 'transformation/production_controller/update_machine/' . $machine['id_machine'] : 'transformation/production_controller/validation_insert_production', ['class' => 'row g-3']); ?>
                <div class="col-12">
                  <label for="id_matierep" class="form-label">Matiere premiere :</label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" id="id_machine" name="id_machine">
                                <option selected disabled>Choisis une matiere premiere</option>
                                <?php 
                                    foreach ($matierepremiers as $matierepremier) {
                                      $selected = isset($matierepremier) && $matierepremier['id_matierepremier'] == $matierepremier['id_matierepremier'] ? 'selected' : '';
                                      echo '<option value="' . $matierepremier['id_matierepremier'] . '" ' . $selected . '>' . $matierepremier['nom_matierepremier'] . '</option>';
                                    }
                                ?>
                            </select>
                  </div>
                </div>
                <div class="col-12">
                  <label for="quantiteburt" class="form-label">Quantite à produire:</label>
                  <input type="number" class="form-control" name="quantiteburt">
                </div>
                <div class="col-12">
                  <label for="quantite_produite" class="form-label">Quantite produite:</label>
                  <input type="number" class="form-control" name="quantite_produite">
                </div>
                <div class="col-12">
                  <label for="date_prod" class="form-label">Date de production:</label>
                  <input type="date" class="form-control" name="date_prod">
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