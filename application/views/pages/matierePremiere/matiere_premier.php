<?php 
    include("../../templates/template.php");
?>	
<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Insertion matière premiere</h5>

              <!-- Vertical Form -->

              <form class="row g-3" action="Matiere_Premier/create" method="post">
                <input type="hidden" name="id" value="<?php echo isset($matiere['id']) ? $matiere['id'] : ''; ?>">
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nom</label>
                  <input   id="inputName" type="text" class="form-control" name="matierepremier" value="<?php if (isset($matiere['Nom'])) { echo $matiere['Nom']; } ?>" required autofocus>								
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
<?php 
?>


