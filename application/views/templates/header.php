<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo($title)?></title>


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo(base_url("assets/vendor/bootstrap/css/bootstrap.min.css"))?>" rel="stylesheet">
  <link href="<?php echo(base_url("assets/vendor/bootstrap-icons/bootstrap-icons.css"))?>" rel="stylesheet">
  <link href="<?php echo(base_url("assets/vendor/boxicons/css/boxicons.min.css"))?>" rel="stylesheet">
  <link href="<?php echo(base_url("assets/vendor/quill/quill.snow.css"))?>" rel="stylesheet">
  <link href="<?php echo(base_url("assets/vendor/quill/quill.bubble.css"))?>" rel="stylesheet">
  <link href="<?php echo(base_url("assets/vendor/remixicon/remixicon.css"))?>" rel="stylesheet">
  <link href="<?php echo(base_url("assets/vendor/simple-datatables/style.css"))?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo(base_url("assets/css/style.css"))?>" rel="stylesheet">
  <link href="<?php echo(base_url("assets/css/itu.css"))?>" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block color_secondary text-uppercase">Flecs </span> <span class="d-none d-lg-block color_black"> Company</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn color_black"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo(base_url("assets/img/profile-img.jpg"))?>" alt="Profile" class="rounded-circle">
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
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bucket-fill color_black"></i><span class="color_black">Tâches collecteurs</span><i class="bi bi-chevron-down ms-auto color_black"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion Collecteur</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion Collecte</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion Salaire</span>
            </a>
          </li>
          <li>
            <a href="components-breadcrumbs.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion bonus</span>
            </a>
          </li>
          <li>
            <a href="components-breadcrumbs.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Paiement</span>
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
        <a class="nav-link collapsed" data-bs-target="#matiere-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-minecart-loaded color_black"></i><span class="color_black">Matière première</span><i class="bi bi-chevron-down ms-auto color_black"></i>
        </a>
        <ul id="matiere-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="matiere-alerts.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion matière première</span>
            </a>
          </li>
          <li>
            <a href="matiere-accordion.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion prix</span>
            </a>
          </li>
          <li>
            <a href="matiere-badges.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion source</span>
            </a>
          </li>
          <li>
            <a href="matiere-breadcrumbs.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion source matière</span>
            </a>
          </li>
        </ul>
      </li><!-- Matière première -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#personnel-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-fill color_black"></i><span class="color_black">Personnel</span><i class="bi bi-chevron-down ms-auto color_black"></i>
        </a>
        <ul id="personnel-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="personnel-alerts.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion personnel</span>
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
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Enregistrement heure de travail</span>
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
          <i class="bi bi-arrow-repeat color_black"></i><span class="color_black">Transformation</span><i class="bi bi-chevron-down ms-auto color_black"></i>
        </a>
        <ul id="transformation-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo(site_url("transformation/machine_controller/view_insertion_machine")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion machine</span>
            </a>
          </li>
          <li>
            <a href="<?php echo(site_url("transformation/machine_controller")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Machines du MM</span>
            </a>
          </li>
          <li>
            <a href="<?php echo(site_url("transformation/statut_controller/view_insertion_statut")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion état machine</span>
            </a>
          </li>
          <li>
            <a href="<?php echo(site_url("transformation/statut_controller")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Etat machines</span>
            </a>
          </li>
          <li>
            <a href="<?php echo(site_url("transformation/production_controller/view_insertion_production")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion production</span>
            </a>
          </li>
          <li>
            <a href="<?php echo(site_url("transformation/production_controller")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Détails production</span>
            </a>
          </li>
          <li>
            <a href="<?php echo(site_url("transformation/produit_controller")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Produits Disponibles</span>
            </a>
          </li>
          <li>
            <a href="<?php echo(site_url("transformation/stockproduit_controller")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Mouvement Stock Produit</span>
            </a>
          </li>
          <li>
            <a href="<?php echo(site_url("transformation/stockproduit_controller/view_stockproduit_actuel")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Etat stock produits</span>
            </a>
          </li>
          <li>
            <a href="transformation-breadcrumbs.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Statistique de saison</span>
            </a>
          </li>
        </ul>
      </li><!-- Transformation -->



      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#vente-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-graph-up-arrow color_black"></i><span class="color_black">Ventes & prise de commande</span><i class="bi bi-chevron-down ms-auto color_black"></i>
        </a>
        <ul id="vente-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="vente-alerts.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Vente</span>
            </a>
          </li>
          <li>
            <a href="vente-accordion.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Client</span>
            </a>
          </li>
          <li>
            <a href="<?php echo(site_url("commande/insert_commande")); ?>">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Commande</span>
            </a>
          </li>
          <li>
            <a href="vente-breadcrumbs.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Panier</span>
            </a>
          </li>
        </ul>
      </li><!-- vente et prise de commande -->




      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#depense-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-currency-dollar color_black"></i><span class="color_black">Dépenses</span><i class="bi bi-chevron-down ms-auto color_black"></i>
        </a>
        <ul id="depense-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="depense-alerts.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Insertion dépenses</span>
            </a>
          </li>
          <li>
            <a href="depense-accordion.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Journal</span>
            </a>
          </li>
          <li>
            <a href="depense-badges.html">
              <i class="bi bi-circle color_black_0"></i><span class="color_black_0">Grand livre</span>
            </a>
          </li>
        </ul>
      </li><!-- Dépenses -->


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    