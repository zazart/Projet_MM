<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
            <h5 class="card-title text-center">
                <?php if (isset($source['lieu'])) {
                    echo "Modification d'un source";
                } else{
                    echo "insertion d'un nouvelle source";
                } ?></h5>
<!-- Vertical Form -->
                <form action="<?php  echo site_url("Matiere_premier/create_source")?>" method="post" class="row g-3">
                    <input type="hidden" name="id" value="<?php echo isset($source['id']) ? $source['id'] : ''; ?>">
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Ajouter le lieu</label>
                         <input   id="lieu" type="text" class="form-control" name="lieu" value="<?php if (isset($source['lieu'])) { echo $source['lieu']; } ?>" required autofocus>								
                    </div>
                    <div class="text-center">
                        <button type="submit" class="boutton boutton-secondary">Inserer</button>
                    </div>
                </form>
<!-- Vertical Form -->
                </div>
            </div>
        </div>
    </div>
</section>