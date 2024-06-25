<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Update produit</h5>

              <!-- Vertical Form -->
              <?php echo form_open('transformation/produit_controller/validation_update_produit/' . $produit['id_produit'], ['class' => 'row g-3']); ?>
              <form class="row g-3">
                <div class="col-12">
                  <label for="nom_produit" class="form-label">Nom Produit:</label>
                  <input type="text" class="form-control" id="nom_produit" name="nom_produit" value="<?php echo($produit['nom_produit']) ?>" readonly>
                </div>
                <div class="col-12">
                  <label for="prix_unitaire" class="form-label">Prix unitaire:</label>
                  <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" value="<?php echo($produit['prix_unitaire']) ?>">
                </div>
                <!-- <div class="col-12">
                  <label for="id_produit" class="form-label">Id Produit:</label>
                  <input type="hidden" name="id_produit" value="<?php echo $produit['id_produit']; ?>">
                </div> -->
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Modifier</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
      </div>
    </section>