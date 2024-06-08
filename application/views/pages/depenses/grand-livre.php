<!-- START GRAND LIVRE -->
<section class="row">
    <!-- Titre GRAND LIVRE -->
    <div class="col-12 d-flex justify-content-center">
        <h2>GRAND LIVRE</h2>
    </div>
</section>
<section class="row">
    <div class="col-12">
        <!-- Indication de saison -->
        <div class=" col-md-4 col d-flex justify-content-center">
            <h3 id="titreJouranl">Saison</h3>
            <h3 id="titreSaison" class="text-center px-2">
                <b id="anneeSaison">####</b>
        </h3>
        </div>
        <!-- #/ Indication de saison -->
        <!-- Tableau de GRAND LIVRE -->
        <table class="table">
            <!-- <thead class="row">
                <th >Date</th>
                <th>Libelle</th>
                <th>Debit</th>
                <th>Credit</th>
            </thead>
            <tbody>
                <tr>
                    <td>-- / -- / --</td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                    <td>Transport</td>
                    <td>50 000Ar</td>
                    <td>1</td>
                    <td>2</td>
                    <td></td>
                </tr>
                <tr>
                    <td>-- / -- / --</td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                    <td>Transport</td>
                    <td>50 000Ar</td>
                    <td>1</td>
                    <td>2</td>
                    <td></td>
                </tr>
            </tbody> -->
        </table>
        <!-- #/ Tableau GRAND LIVRE -->
        <!-- Navigation buttons  -->
        <div class="row">
            <div class="col-6 d-flex justify-content-start">
                <button id="saisonPrecedentBtn" class="btn btn-secondary px-12">Precedent</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <button id="saisonSuivantBtn" class="btn btn-secondary px-12">Suivant</button>
            </div>
        </div>
        <!-- #/ Navigation buttons -->
    </div>
</section>
<script src="<?php echo base_url('assets/js/depenses/grand-livre.js')?>">></script>
<!-- END GRAND LIVRE -->