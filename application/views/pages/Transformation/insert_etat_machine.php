<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <?php echo isset($statut) ? 'Modifier statut Machine' : 'Ajouter un statut'; ?>
                    </h5>

                    <!-- Vertical Form -->
                    <?php echo validation_errors(); ?>
                    <?php 
                    $action_url = isset($statut) && isset($statut['id_stat']) 
                        ? 'transformation/statut_controller/validation_update_statut/' . $statut['id_stat'] 
                        : 'transformation/statut_controller/validation_insert_statut';
                    echo form_open($action_url, ['class' => 'row g-3']); 
                    ?>
                    
                    <div class="col-12">
                        <label for="id_machine" class="form-label">Nom machine:</label>
                        <div class="col-sm-12">
                            <select class="form-select" aria-label="Default select example" id="id_machine" name="id_machine">
                                <option selected disabled>Choisis une machine</option>
                                <?php 
                                    foreach ($machines as $machine) {
                                      // Si le statut est défini et correspond à l'ID de la machine, on ajoute l'attribut selected
                                      $selected = isset($statut) && $statut['id_machine'] == $machine['id_machine'] ? 'selected' : '';
                                      echo '<option value="' . $machine["id_machine"] . '" ' . $selected . '>' . $machine["nom_machine"] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="date_verification" class="form-label">Date de la verification:</label>
                        <input type="date" class="form-control" name="date_verification" value="<?php echo isset($statut['date_verification']) ? $statut['date_verification'] : ''; ?>">
                    </div>

                    <div class="col-12">
                        <label for="statut" class="form-label">Statut:</label>
                        <input type="number" class="form-control" name="statut" value="<?php echo isset($statut['statut']) ? $statut['statut'] : ''; ?>">
                    </div>
                    
                    <div class="col-12">
                        <label for="descri" class="form-label">Description:</label>
                        <textarea class="form-control" name="descri"><?php echo isset($statut['descri']) ? $statut['descri'] : ''; ?></textarea>
                    </div>

                    <div class="text-center">
                        <input type="submit" name="submit" class="btn btn-secondary" value="<?php echo isset($statut) ? 'Mettre à Jour' : 'Ajouter'; ?>" /> 
                    </div>
                    
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
</section>
