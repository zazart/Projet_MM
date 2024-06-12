<!-- START GRAND LIVRE -->
<section class="row">
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
        <table class="table text-center">
            <thead>
                <th class="col text-uppercase">Date</th>
                <th class="col text-uppercase">Libelle</th>
                <th class="col text-uppercase">Debit</th>
                <th class="col text-uppercase">Credit</th>
            </thead>
            <tbody>
                <tr class="">
                    <td colspan="4" class="bg-secondary text-light text-center text-uppercase">Lorem ipsum</td>
                </tr>
                <tr>
                    <td>-- / -- / --</td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                    <td>1</td>
                    <td>2</td>
                </tr> 
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-center text-uppercase">Total de grand livre</td>
                    <td>##</td>
                    <td>##</td>
                </tr>
            </tfoot>
        </table>
        <!-- #/ Tableau GRAND LIVRE -->
        <!-- Navigation buttons  -->
        <div class="row">
            <div class="col-6 d-flex justify-content-start">
                <button id="saisonPrecedentBtn" class="btn boutton-light px-12">Precedent</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <button id="saisonSuivantBtn" class="btn boutton-light px-12">Suivant</button>
            </div>
        </div>
        <!-- #/ Navigation buttons -->
    </div>
</section>
<script src="<?php echo base_url('assets/js/depenses/depenses.js')?>"></script>
<script src="<?php echo base_url('assets/js/depenses/grand-livre.js')?>">></script>
<!-- END GRAND LIVRE -->