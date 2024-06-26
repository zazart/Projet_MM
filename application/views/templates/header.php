<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo ($title) ?></title>


    <!-- Favicons -->
    <link href="<?php echo (base_url("assets/img/favicon.png")) ?>" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <script src="<?php echo (base_url("assets/js/sweetAlert.min.js")) ?>"></script>
    <script src="<?php echo (base_url("assets/js/jquery.min.js")) ?>"></script>
    <script src="<?php echo (base_url("assets/js/datatables.js")) ?>"></script>


    <!-- Vendor CSS Files -->
    <link href="<?php echo (base_url("assets/vendor/bootstrap/css/bootstrap.min.css")) ?>" rel="stylesheet">
    <link href="<?php echo (base_url("assets/vendor/bootstrap-icons/bootstrap-icons.css")) ?>" rel="stylesheet">
    <link href="<?php echo (base_url("assets/vendor/boxicons/css/boxicons.min.css")) ?>" rel="stylesheet">
    <link href="<?php echo (base_url("assets/vendor/quill/quill.snow.css")) ?>" rel="stylesheet">
    <link href="<?php echo (base_url("assets/vendor/quill/quill.bubble.css")) ?>" rel="stylesheet">
    <link href="<?php echo (base_url("assets/vendor/remixicon/remixicon.css")) ?>" rel="stylesheet">
    <link href="<?php echo (base_url("assets/vendor/simple-datatables/style.css")) ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo (base_url("assets/css/style.css")) ?>" rel="stylesheet">
    <link href="<?php echo (base_url("assets/css/datatables.css")) ?>" rel="stylesheet">
    <link href="<?php echo (base_url("assets/css/itu.css")) ?>" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?php echo (site_url("admin/")) ?>" class="logo d-flex align-items-center">
                <img src="<?php echo (base_url("assets/img/logo.png")) ?>" alt="">
                <span class="d-none d-lg-block color_secondary text-uppercase">Flecs </span> <span
                    class="d-none d-lg-block color_black"> Company</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn color_black"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?php echo (base_url("assets/img/profile-img.jpg")) ?>" alt="Profile"
                            class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2 color_black">JC.Alex</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>JACQUES Chan Alex</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="<?php echo ($etat == "collecteur") ? 'nav-link' : 'nav-link collapsed'; ?>"
                    data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bucket-fill color_black"></i><span class="color_black">Tâches collecteurs</span><i
                        class="bi bi-chevron-down ms-auto color_black"></i>
                </a>
                <ul id="components-nav"
                    class="<?php echo ($etat == "collecteur") ? 'nav-content collapse show' : 'nav-content collapse'; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?php echo (site_url("collecteurs/collecteurController/insert_collector")); ?>" <?php if ($activer == "lien_collecteur") {
                                                                                                        echo 'class="active"';
                                                                                                      } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">
                                Collecteur</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo (site_url("collecteurs/collectController/insert_collect")); ?>" <?php if ($activer == "lien_collect") {
                                                                                                  echo 'class="active"';
                                                                                                } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">
                                Collecte</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo (site_url("collecteurs/bonusController/insert_bonus")); ?>" <?php if ($activer == "lien_bonus") {
                                                                                              echo 'class="active"';
                                                                                            } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Bonus</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-breadcrumbs.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Etat</span>
                        </a>
                    </li>
                </ul>
            </li><!-- Collecteurs Nav -->

            <li class="nav-item">
                <a class="<?php echo ($etat == "matierePremiere") ? 'nav-link' : 'nav-link collapsed'; ?>"
                    data-bs-target="#matiere-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-minecart-loaded color_black"></i><span class="color_black">Matière première</span><i
                        class="bi bi-chevron-down ms-auto color_black"></i>
                </a>
                <ul id="matiere-nav"
                    class="<?php echo ($etat == "matierePremiere") ? 'nav-content collapse show' : 'nav-content collapse'; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?php echo site_url("Matiere_premier/matiere_premier_insert"); ?>" <?php if ($activer == "matiere_premiere") {
                                                                                          echo 'class="active"';
                                                                                        } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Matieres
                                Premières</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url("Matiere_premier/prixmatierepremier"); ?>" <?php if ($activer == "prix_matiere_premier") {
                                                                                      echo 'class="active"';
                                                                                    } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Prix</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url("Matiere_premier/source"); ?>" <?php if ($activer == "source_insert") {
                                                                          echo 'class="active"';
                                                                        } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Sources </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url("Matiere_premier/sourcematierepremier"); ?>" <?php if ($activer == "source_matiere_premiere") {
                                                                                        echo 'class="active"';
                                                                                      } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Soures et matières
                                premières</span>
                        </a>
                    </li>
                </ul>
            </li><!-- Matière première -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#personnel-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-fill color_black"></i><span class="color_black">Personnel</span><i
                        class="bi bi-chevron-down ms-auto color_black"></i>
                </a>
                <ul id="personnel-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="personnel-alerts.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion
                                personnel</span>
                        </a>
                    </li>
                    <li>
                        <a href="personnel-accordion.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Liste employés</span>
                        </a>
                    </li>
                    <li>
                        <a href="personnel-badges.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion poste</span>
                        </a>
                    </li>
                    <li>
                        <a href="personnel-breadcrumbs.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Liste poste</span>
                        </a>
                    </li>
                    <li>
                        <a href="personnel-breadcrumbs.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Enregistrement heure
                                de travail</span>
                        </a>
                    </li>
                    <li>
                        <a href="personnel-breadcrumbs.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Etat</span>
                        </a>
                    </li>
                </ul>
            </li><!-- Personnel -->


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#transformation-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-arrow-repeat color_black"></i><span class="color_black">Transformation</span><i
                        class="bi bi-chevron-down ms-auto color_black"></i>
                </a>
                <ul id="transformation-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="transformation-alerts.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion
                                matériaux</span>
                        </a>
                    </li>
                    <li>
                        <a href="transformation-accordion.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion état
                                matériaux</span>
                        </a>
                    </li>
                    <li>
                        <a href="transformation-badges.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion
                                production</span>
                        </a>
                    </li>
                    <li>
                        <a href="transformation-breadcrumbs.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Statistique de
                                saison</span>
                        </a>
                    </li>
                    <li>
                        <a href="transformation-breadcrumbs.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Liste matériaux</span>
                        </a>
                    </li>
                    <li>
                        <a href="transformation-breadcrumbs.html">
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Liste état
                                matériels</span>
                        </a>
                    </li>
                </ul>
            </li><!-- Transformation -->



            <li class="nav-item">
                <a class="<?php echo ($etat == "vente_commande") ? 'nav-link' : 'nav-link collapsed'; ?>"
                    data-bs-target="#vente-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-graph-up-arrow color_black"></i><span class="color_black">Ventes & prise de
                        commande</span><i class="bi bi-chevron-down ms-auto color_black"></i>
                </a>
                <ul id="vente-nav"
                    class="<?php echo ($etat == "vente_commande") ? 'nav-content collapse show' : 'nav-content collapse'; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?php echo (site_url("vente_commande/vente/insert_vente")); ?>" <?php if ($activer == "lien_vente") {
                                                                                        echo 'class="active"';
                                                                                      } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Vente</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo (site_url("vente_commande/client/insert_client")); ?>" <?php if ($activer == "lien_client") {
                                                                                          echo 'class="active"';
                                                                                        } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Client</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo (site_url("vente_commande/commande/insert_commande")); ?>" <?php if ($activer == "lien_commande") {
                                                                                              echo 'class="active"';
                                                                                            } ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Commande</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo(site_url("vente_commande/vente/statistique")); ?>"
                            <?php if ($activer == "lien_statistique") { echo 'class="active"';} ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Statisique</span>
                        </a>
                    </li>
                </ul>
            </li><!-- vente et prise de commande -->

            <li class="nav-item">
                <a class="<?php echo ($etat == "depense") ? 'nav-link' : 'nav-link collapsed'; ?>"
                    data-bs-target="#depense-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-currency-dollar color_black"></i><span class="color_black">Dépenses</span><i
                        class="bi bi-chevron-down ms-auto color_black"></i>
                </a>
                <ul id="depense-nav"
                    class="<?php echo ($etat == "depense") ? 'nav-content collapse show' : 'nav-content collapse'; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?php echo(base_url("depense/formulaire"))?>"
                            <?php if ($activer == "formulaire_depense") { echo 'class="active"';} ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Dépenses</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo(base_url("depense/journal"))?>"
                            <?php if ($activer == "lien_journal") { echo 'class="active"';} ?>>
                            <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Journal</span>
                        </a>
                    </li>
                </ul>
            </li><!-- Dépenses -->



        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">