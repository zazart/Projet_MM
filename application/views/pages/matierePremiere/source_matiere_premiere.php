<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <?php
                            if (isset($source_matiere_premier_data['matierpremier'])){
                                echo "Modification du source de matiere premiere";
                            }
                            else{
                                echo "insertion d'une source a une matiere premiere";
                            }
                        ?>
                    </h5>
                        <form class="row g-3" action="<?php echo site_url("Matiere_premier/create_source_matiere_premier")?>"  method="post">
                            <input type="hidden" name="id" value="<?php echo isset($source_matiere_premier_data['id_sourcematierepremier']) ? $source_matiere_premier_data['id_sourcematierepremier'] : ''; ?>">	
                            <div class="col-12">
                                            <div class="col-sm-12">
                                                <label for="nom" class="form-label">Nom matière premiere</label>
                                                <select class="form-select" name="nom" id="nom" aria-label="Default select example" required>
                                                        <option value="" selected disabled>Selectionnez le nom</option>
                                                        <?php foreach ($matiere_data as $matiere): ?>
                                                            <option value="<?php echo $matiere['id_matierepremier']; ?>" 
                                                                    <?php echo (isset($source_matiere_premier_data['matierpremier']) && $source_matiere_premier_data['matierpremier'] == $matiere['id_matierepremier']) ? 'selected' : ''; ?>>
                                                                    <?php echo $matiere['nom']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputNanme4" class="form-label">Date prelevement</label>
                                                <input type="Date" class="form-control" id="date"  name="date" value="<?php if (isset($source_matiere_premier_data['dateprelevement'])) { echo $source_matiere_premier_data['dateprelevement']; } ?>" required autofocus>
                                            </div>  

                                            <div class="col-sm-12">
                                                <label for="nom" class="form-label">Source</label>
                                                <select class="form-select" name="source" id="nom" aria-label="Default select example" required>
                                                        <option value="" selected disabled>Selectionnez la source</option>
                                                        <?php foreach ($source_data as $source): ?>
											                <option value="<?php echo $source['id_source']; ?>" 
											                    <?php echo (isset($source_matiere_premier_data['source']) && $source_matiere_premier_data['source'] == $source['id_source']) ? 'selected' : ''; ?>>
											                    <?php echo $source['lieu']; ?>
											                </option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>
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
