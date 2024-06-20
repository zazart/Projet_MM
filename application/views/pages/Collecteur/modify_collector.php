<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Modifier collecteur</h5>

              <!-- Vertical Form -->
              <form class="row g-3" id="modifCollecteurForm">
                <input type="hidden" name="id" value="<?php echo $collecteur['id_collecteur']; ?>" >
                <div class="col-12">
                  <label for="nom" class="form-label">Nom :</label>
                  <input type="text" class="form-control" id="nom" name="nom" value=" <?php echo $collecteur['nom']; ?>" >
                  <div class="text-danger" id="nomError"></div>
                </div>
                <div class="col-12">
                  <label for="genre" class="form-label">Genre :</label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name="genre" >
                      <option value="1">Femme</option>
                      <option value="2">Homme</option>
                    </select>
                    <p class="text-danger" id="genreError"></p>
                  </div>
                </div>
                <div class="col-12">
                  <label for="contact" class="form-label">Contact (phone) :</label>
                  <input type="text" class="form-control" id="inputNumber" name="contact" value="<?php echo $collecteur['contact']; ?>">
                  <p class="text-danger" id="contactError"></p>
                </div>
                <div class="col-12">
                  <label for="adresse" class="form-label">Adresse :</label>
                  <input type="text" class="form-control" id="adresse" placeholder="1234 Main St" name="adresse" value="<?php echo $collecteur['adresse']; ?>" >
                  <p class="text-danger" id="adresseError"></p>
                </div>
                <div class="col-12">
                  <label for="date" class="form-label">Début :</label>
                  <input type="date" class="form-control" id="date" name="date" value="<?php echo $collecteur['datedebuche']; ?>" >
                  <p class="text-danger" id="dateError"></p>
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Enregistrer</button>
                </div>
                <div class="boite" id="boite">
                  <img src="<?php echo(base_url("assets/img/check.png"))?>">
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
      </div>
    </section>