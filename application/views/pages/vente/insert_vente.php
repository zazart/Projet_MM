<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Insertion vente</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" id="venteForm">
                        <div class="col-12">
                            <label for="livraison" class="form-label">Etat Livraison :</label>
                            <select class="form-select" aria-label="Default select example" name="livraison"
                                id="livraison">
                                <option selected disabled>Choix d'etat livraison</option>
                                <option value="1">Non livrer</option>
                                <option value="2">livrer</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="date_vente" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="date_vente" name="date_vente">
                        </div>
                        <div class="col-12">
                            <label for="prixtotal" class="form-label">Prix :</label>
                            <input type="text" class="form-control" id="prixtotal">
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

<script>
document.getElementById('venteForm').addEventListener('submit', function() {
    localStorage.setItem('venteSubmitted', 'true');
});

window.addEventListener('load', function() {
    if (localStorage.getItem('venteSubmitted') === 'true') {
        document.getElementById('boite').style.display = 'block';
        setTimeout(function() {
            document.getElementById('boite').style.display = 'none';
        }, 2000);
        localStorage.removeItem('venteSubmitted');
    }
});
</script>