<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Medifier collecteur</h5>

              <!-- Vertical Form -->
              <?php echo form_open('updateCollecteur', array('method' => 'post','class' => 'row g-3')); ?>
              <input type="hidden" name="id" value="<?php echo $collecteur['id_employe']; ?>" >
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nom :</label>
                  <input type="text" class="form-control" id="inputName" name="nom" value=" <?php echo $collecteur['noms']; ?>" >
                  <?php echo form_error('nom','<div class="text-danger"> ','</div>');  ?>
                </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Genre :</label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="genre" >
                      <option value="1">Femme</option>
                      <option value="2">Homme</option>
                    </select>
                    <?php echo form_error('genre','<div class="text-danger"> ','</div>');  ?>
                  </div>
                </div>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label">Contact (phone) :</label>
                  <input type="text" class="form-control" id="inputNumber" name="contact" value="<?php echo $collecteur['telephone']; ?>">
                  <?php echo form_error('contact','<div class="text-danger"> ','</div>');  ?>
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Adresse :</label>
                  <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="adresse" value="<?php echo $collecteur['adresse']; ?>" >
                  <?php echo form_error('adresse','<div class="text-danger"> ','</div>');  ?>
                </div>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label">Début :</label>
                  <input type="date" class="form-control" id="inputNumber" name="date" value="<?php echo $collecteur['embauche']; ?>" >
                  <?php echo form_error('date','<div class="text-danger"> ','</div>');  ?>
                </div>
                <div class="text-align-right">
                  <a href="list_collector">Voir liste des collecteurs</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Enregistrer</button>
                </div>
                <?php echo form_close(); ?>

            </div>
          </div>
        </div>
      </div>
    </section>