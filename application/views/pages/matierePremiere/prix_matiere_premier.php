<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
            <h5 class="card-title text-center">Prix des matières premières</h5>
<!-- Vertical Form -->
                <form class="row g-3" method="post" action="<?php echo site_url("Matiere_Premier/create_prix"); ?>">
                <input type="hidden" name="id" value="<?php echo isset($prix_matiere['id_prixmatierepremier']) ? $prix_matiere['id_prixmatierepremier'] : ''; ?>">
                <div class="col-12">
                <label for="nom" class="form-label">Nom</label>
                        <div class="col-sm-12">
                            <select class="form-select" name="nom" id="nom" aria-label="Default select example" required>
                                    <option value="" selected disabled>Selectionnez le nom</option>
                                    <?php foreach ($matiere_data as $matiere): ?>
                                        <option value="<?php echo $matiere['id_matierepremier']; ?>" 
                                                    <?php echo (isset($prix_matiere['matierpremier']) && $prix_matiere['matierpremier'] == $matiere['id_matierepremier']) ? 'selected' : ''; ?>>
                                                    <?php echo $matiere['nom']; ?>
                                        </option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                </div>
                <div class="col-12">
                                <label for="inputNanme4" class="form-label">Prix</label>
                                <input type="number" name="prix" class="form-control" id="prix" value="<?php if (isset($prix_matiere['prix'])) { echo $prix_matiere['prix'];} ?>" required autofocus>
                </div>
                <div class="col-12">
                                <label for="inputNanme4" class="form-label">Date</label>
                                <input type="Date" class="form-control" id="date"  name="date" value="<?php if (isset($prix_matiere['dateprix'])) { echo $prix_matiere['dateprix']; } ?>" required autofocus>
                </div>
                <div class="text-center">
                                <button type="submit" class="boutton boutton-secondary">OK</button>
                </div>
            </form>
<!-- Vertical Form -->
        </div>
        </div>
    </div>
    </div>
</section>



