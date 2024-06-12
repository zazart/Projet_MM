<!-- START FORMULIARE DEPENSE -->
<section class="row"> 
    <div class="mx-auto col-10 p-2">
        <!-- Formulaire -->
            <form action="depenses/insertion" method="post" class="card">
                <!-- Description -->
                <div class="row mb-3">
                    <label for="description" class="input-label">Description </label>
                    <input type="text" class="form-control" name="description" id="description" required>
                </div>
                <!-- Date -->
                <div class="row mb-3">
                    <label for="dateDepense" class="input-label">Date de depense</label>
                    <input type="date" class="form-control" id="dateDepense" name="dateDepense" required>
                </div>
                <!-- Montant -->
                <div class="row mb-3">
                    <label for="montant" class="input-lalbel">Montant</label>
                    <input type="number" name="montant" id="montant" class="form-control" min="0" step="0.1">
                </div>
                <!-- Categorie -->
                <div class="row mb-3">
                    <label for="categorie" class="input-label">Categorie </label>
                    <select class="form-select" name="categorie" id="categorie" required>
                        <option value=""></option>
                        <option value="1">Transport</option>
                        <option value="2">Maintenance</option>
                    </select>
                </div>
                <!-- Mode de paiement -->
                <div class="row mb-3">
                <label for="categorie" class="input-label">Mode de paiement</label>
                    <select class="form-select" name="categorie" id="categorie" required>
                        <option value=""></option>
                        <option value="1">Espece</option>
                        <option value="2">Carte Bancaire</option>
                    </select>
                </div>
                <!-- Justificatif -->
                <div class="row mb-3">
                <label for="justificatif" class="input-lalbel">Justificatif</label>
                    <input type="file" name="justificatif" id="justificatif" class="form-control">
                </div>
                <div class="row">
                    <button type="submit" class="col-2 btn boutton-light">Inserer</button>
                </div>
            </form>
    </div>

</section>
<script src="<?php echo base_url('assets/js/depenses/depenses.js')?>"></script>
<!-- END FORMULAIRE DEPENSE -->