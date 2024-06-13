<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center color_black_0"><?php echo $title; ?></h5>


              <?php if (validation_errors()) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"> Erreur : </i>
                      <?php echo validation_errors(); ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              <?php endif; ?>

              <?php echo form_open('employes/create', ['class' => 'row g-3']);?>
                <div class="col-12">
                  <label for="embauche" class="form-label">Date d'Embauche :</label>
                  <input type="date" class="form-control" name="embauche" id="embauche">
                </div>
                <div class="col-12">
                  <label for="debauche" class="form-label">Date de Débauche :</label>
                  <input type="date" class="form-control" name="debauche" id="debauche">
                </div>
                <div class="col-12">
                  <label for="nom" class="form-label">Nom :</label>
                  <input type="text" class="form-control" name="nom" id="nom">
                </div>
                <div class="col-12">
                  <label for="email" class="form-label">Email :</label>
                  <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="col-12">
                  <label for="telephone" class="form-label">Téléphone :</label>
                  <input type="text" class="form-control" name="telephone" id="telephone">
                </div>
                <div class="col-12">
                  <label for="adresse" class="form-label">Adresse :</label>
                  <input type="text" class="form-control" name="adresse" id="adresse">
                </div>
                <div class="col-12">
                  <label for="id_genre" class="form-label">Genre :</label>
                  <div class="col-sm-12">
                    <select name="id_genre" class="form-select" aria-label="Default select example">
                        <?php foreach ($genres as $genre): ?>
                        <option value="<?php echo $genre['id']; ?>"><?php echo $genre['description']; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <label for="id_poste" class="form-label">Poste :</label>
                  <div class="col-sm-12">
                    <select name="id_poste" class="form-select" aria-label="Default select example">
                        <?php foreach ($postes as $poste): ?>
                        <option value="<?php echo $poste['id_poste']; ?>"><?php echo $poste['nom']; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Créer un nouvel employé</button>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </section>