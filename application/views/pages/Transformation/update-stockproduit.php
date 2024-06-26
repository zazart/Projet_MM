<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Update Stock Produit</h5>

              <!-- Vertical Form -->
              <?php echo form_open('transformation/stockproduit_controller/validation_update_mouvementstock/' . $stockproduit['id_stockproduit'], ['class' => 'row g-3']); ?>
              <form class="row g-3">
                <div class="col-12">
                  <label for="id_produit" class="form-label">Nom Produit</label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" id="id_produit" name="id_produit">
                      <?php 
                        foreach ($produits as $produit) {
                          $selected = isset($produit) && $produit['id_produit'] == $produit['id_produit'] ? 'selected' : '';
                          echo '<option value="' . $produit["id_produit"] . '" ' . $selected . '>' . $produit["nom_produit"] . '</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-12">
                  <label for="quantietentrant" class="form-label">Quantite Entrant:</label>
                  <input type="number" class="form-control" id="quantietentrant" name="quantietentrant" value="<?php echo($stockproduit['quantiteentrant']) ?>" <?php echo ($stockproduit['quantiteentrant'] == 0) ? 'readonly' : ''; ?>>
                </div>
                <div class="col-12">
                  <label for="quantietsortant" class="form-label">Quantite Sortant:</label>
                  <input type="number" class="form-control" id="quantietsortant" name="quantietsortant" value="<?php echo($stockproduit['quantitesortant']) ?>" <?php echo ($stockproduit['quantitesortant'] == 0) ? 'readonly' : ''; ?>>
                </div>
                <div class="col-12">
                  <label for="datestock" class="form-label">Date Stockage:</label>
                  <input type="date" class="form-control" id="datestock" name="datestock" value="<?php echo($stockproduit['datestockproduit']) ?>">
                </div>
                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Modifier</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
      </div>
    </section>