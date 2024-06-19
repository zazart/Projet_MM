<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-7">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Insertion vente</h5>

          <!-- Vertical Form -->
          <form class="row g-3" id="venteForm">
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Username :</label>
              <input type="text" class="form-control" id="inputName">
            </div>
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Date :</label>
              <input type="date" class="form-control" id="inputName">
            </div>
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Year :</label>
              <input type="text" class="form-control" id="inputName">
            </div>

            <div class="text-center">
              <button type="submit" class="boutton boutton-secondary">Inserer</button>
            </div>
            <div class="boite"  class="boite" id="boite">
                <img src="<?php echo(base_url("assets/img/check.png"))?>">
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