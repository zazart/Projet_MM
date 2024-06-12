<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center"><?php echo isset($machine) ? 'Modifier Machine' : 'Ajouter une Machine'; ?></h5>

              <!-- Vertical Form -->
              <?php echo validation_errors(); ?>
              <?php echo form_open(isset($machine) ? 'transformation/machine_controller/update_machine/' . $machine['id_machine'] : 'transformation/machine_controller/validation_insert_machine'); ?>
                <div class="col-12">
                  <label for="nom_machine" class="form-label">Nom:</label>
                  <input type="text" class="form-control" name="date_achat">
                </div>
                <div class="col-12">
                  <label for="fonction" class="form-label">Fonction de la machine:</label>
                  <input type="text" class="form-control" name="fonction">
                </div>
                <div class="col-12">
                  <label for="date_achat" class="form-label">Date Achat:</label>
                  <input type="date" class="form-control" name="date_achat">
                </div>
                <div class="text-center">
                  <input type="submit" name="submit" class="boutton boutton-secondary" value="<?php echo isset($machine) ? 'Mettre à Jour' : 'Ajouter'; ?>" /> 
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
      </div>
    </section>