<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Insertion commande</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" id="commandeForm">
                        <div class="col-12">
                            <label for="datecommande" class="form-label">Date :</label>
                            <input type="date" class="form-control" id="datecommande" name="datecommande">
                            <div class="text-danger" id="datecommandeError"></div>
                        </div>
                        <div class="col-12">
                            <label for="client" class="form-label">Client :</label>
                            <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="client">
                                    <option selected disabled>Choisit ton client</option>
                                    <?php foreach ($clients as $client) : ?>
                                    <option value="<?php echo $client['id_client']; ?>">
                                        <?php echo $client['nomglobal']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-danger" id="clientError"></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="boutton boutton-secondary">Inserer</button>
                        </div>
                        <div class="boite" id="boite">
                            <img src="<?php echo (base_url("assets/img/check.png")) ?>">
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <img src="<?php echo (base_url("assets/img/news-4.jpg")) ?>" class="card-img-top">
                <div class="card-body d-flex justify-content-center mt-3">
                    <button class="boutton boutton-primary" data-bs-toggle="modal"
                        data-bs-target="#verticalycentered">Voir liste des commandes</button>
                </div>
                <div class="modal fade" id="verticalycentered">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="card-title">Listes des commandes</h5>
                                <p>Voici les listes de tous les commandes dans le <span class="color_secondary">projet
                                        MM
                                    </span>avec ses informations:</p>
                                <div id="valiny">
                                    <table id="commandeData">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Date du commande</th>
                                                <th>Client</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>