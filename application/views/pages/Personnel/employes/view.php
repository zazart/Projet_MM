   <div class="pagetitle">
      <h1 color_black_0><?php echo $title; ?></h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?php echo(base_url("assets/img/profile-img.jpg"))?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $employe['nom']; ?></h2>
              <h3><?php echo $employe['poste_nom']; ?></h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview color_light">Aperçu</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Détails du profil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">ID</div>
                    <div class="col-lg-9 col-md-8"><?php echo $employe['id_employe']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date d'Embauche</div>
                    <div class="col-lg-9 col-md-8"><?php echo $employe['embauche']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date de Débauche</div>
                    <div class="col-lg-9 col-md-8"><?php echo $employe['debauche']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nom</div>
                    <div class="col-lg-9 col-md-8"><?php echo $employe['nom']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $employe['email']; ?>2</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Numéro de Téléphone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $employe['telephone']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Adresse</div>
                    <div class="col-lg-9 col-md-8"><?php echo $employe['adresse']; ?></div>
                  </div>

                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
