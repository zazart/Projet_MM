<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Liste collecteur</h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Date d' embauche</th>
                    <th scope="col">Genre</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($collector as  $b) {  $n = $b['id_employe'];  ?>
                    <tr>
                      <td><?php echo $b['noms'] ?></td>
                      <td><?php  echo $b['telephone']  ?></td>
                      <td><?php echo $b['adresse'] ?></td>
                      <td><?php  echo $b['embauche']  ?></td>
                      <td><?php  echo $b['id_genre']==1?"Femme":"Homme";  ?></td>
                      <td>   
                        <a href="<?php echo base_url("editCollecteur?id=$n") ; ?>">modify</a> 
                      </td>
                    </tr>
                  <?php  } ?>
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>
        </div>
      </div>
    </section>