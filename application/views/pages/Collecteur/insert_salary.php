    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Insertion salaire</h5>

              <!-- Vertical Form -->
              <?php echo form_open('saveSalaire', array('method' => 'post','class' => 'row g-3')); ?>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Liste des Collecteurs :</label>
                    <div class="col-sm-12">
                      <select class="form-select" aria-label="Default select example" name="collecteur">
                        <?php foreach($collectors as $collector): ?>
                            <option value="<?php echo $collector['id_collecteur']; ?>"><?php echo $collector['nom']; ?></option>
                        <?php endforeach; ?>
                        </select>
                      <?php echo form_error('collecteur','<div class="text-danger"> ','</div>');  ?>
                    </div>
                  </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Montant :</label>
                    <input type="number" class="form-control" id="inputNumber" name="prix" >
                    <?php echo form_error('prix','<div class="text-danger"> ','</div>');  ?>
                </div>
                <div class="text-align-right">
                  <a href="list_salary">Voir liste des salaires</a>
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