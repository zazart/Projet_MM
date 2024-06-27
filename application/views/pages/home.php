<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo (site_url("admin/dashbord")) ?>">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">2024</a></li>
                                <li><a class="dropdown-item" href="#">2023</a></li>
                                <li><a class="dropdown-item" href="#">2022</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Machines <span>| Années 2024</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-clipboard2-pulse-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>145</h6>
                                    <span class="text-success small pt-1 fw-bold">12%</span>
                                    <span class="text-muted small pt-2 ps-1">increase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">2024</a></li>
                                <li><a class="dropdown-item" href="#">2023</a></li>
                                <li><a class="dropdown-item" href="#">2022</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Bénefice <span>| Années 2024</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>$3,264</h6>
                                    <span class="text-success small pt-1 fw-bold">8%</span>
                                    <span class="text-muted small pt-2 ps-1">increase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">
                    <div class="card info-card customers-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">2024</a></li>
                                <li><a class="dropdown-item" href="#">2023</a></li>
                                <li><a class="dropdown-item" href="#">2022</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Employer <span>| 2024</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>1244</h6>
                                    <span class="text-danger small pt-1 fw-bold">12%</span>
                                    <span class="text-muted small pt-2 ps-1">decrease</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Customers Card -->

            </div><!-- End inner row -->
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
            <!-- Recent Activity -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Étapes à faire à chaque saison <span>| 2024</span></h5>
                    <div class="activity">
                        <!-- Exemple d'activité avec une commande -->
                        <div class="activity-item d-flex">
                            <div class="activite-label">Étapes 1</div>
                            <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                            <div class="activity-content">
                                Effectuer la collecte des matières premières par <span class="fw-bold text-dark">les collecteurs</span>
                            </div>
                        </div><!-- End activity item-->
                        <!-- Exemple d'activité avec une vente -->
                        <div class="activity-item d-flex">
                            <div class="activite-label">Étapes 2</div>
                            <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                            <div class="activity-content">
                                Assurer le transport des <span class="fw-bold text-dark"> matières premières </span>vers le laboratoire
                            </div>
                        </div><!-- End activity item-->
                        <!-- Exemple d'activité avec une production -->
                        <div class="activity-item d-flex">
                            <div class="activite-label">Étapes 3</div>
                            <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
                            <div class="activity-content">
                                Recruter des <span class="fw-bold text-dark"> personnels </span>compétents pour chaque poste de travail
                            </div>
                        </div><!-- End activity item-->
                        <!-- Exemple d'activité avec une dépense -->
                        <div class="activity-item d-flex">
                            <div class="activite-label">Étapes 4</div>
                            <i class="bi bi-circle-fill activity-badge text-info align-self-start"></i>
                            <div class="activity-content">
                                Optimiser la<span class="fw-bold text-dark"> transformation </span>des matières premières pour la qualité des produits finaux
                            </div>
                        </div><!-- End activity item-->
                        <!-- Exemple d'activité avec une modification de machine -->
                        <div class="activity-item d-flex">
                            <div class="activite-label">Étapes 5</div>
                            <i class="bi bi-circle-fill activity-badge text-warning align-self-start"></i>
                            <div class="activity-content">
                                Gérer les  <span class="fw-bold text-dark">ventes et les commandes </span>des produits avec efficacité
                            </div>
                        </div><!-- End activity item-->
                        <!-- Exemple d'activité avec une collecte -->
                        <div class="activity-item d-flex">
                            <div class="activite-label">Étapes 6</div>
                            <i class="bi bi-circle-fill activity-badge text-muted align-self-start"></i>
                            <div class="activity-content">
                                Réduire les <span class="fw-bold text-dark">dépenses </span>pour maximiser les bénéfices
                            </div>
                        </div><!-- End activity item-->
                    </div>
                </div>
            </div><!-- End Recent Activity -->
        </div><!-- End Right side columns -->

    </div><!-- End outer row -->
</section>
