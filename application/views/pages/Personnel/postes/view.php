<div class="pagetitle">
      <h1 color_black_0><?php echo $title; ?></h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">

              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Détails du poste</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom</div>
                    <div class="col-lg-9 col-md-8"><?php echo $poste['nom']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Salaire</div>
                    <div class="col-lg-9 col-md-8"><?php echo $poste['montant_salaire']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Durée de Travail</div>
                    <div class="col-lg-9 col-md-8"><?php echo $poste['duree_travail']; ?></div>
                  </div>
                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

