    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Insertion collecte</h5>

              <!-- Vertical Form -->
              <?php echo form_open('saveCollect', array('method' => 'post','class' => 'row g-3')); ?>
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
                  <label for="inputEmail4" class="form-label">Matiere premiere :</label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="matiere" >
                      <option value="1">ricin</option>
                      <option value="2">jojoba</option>
                      <option value="3">figue</option>
                    </select>
                    <?php echo form_error('matiere','<div class="text-danger"> ','</div>');  ?>
                  </div>
                </div>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label">Quantite :</label>
                  <input type="number" class="form-control" name="qtt">
                  <?php echo form_error('qtt','<div class="text-danger"> ','</div>');  ?>
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Inserer</button>
                </div>
              <?php echo form_close(); ?>

            </div>
          </div>
        </div>
      </div>
    </section>