<!-- START JOURNAL -->
<section class="row">
</section>
<section class="row">
    <div class="col-12">
        <!-- Indication de saison -->
        <div class=" col-md-4 col d-flex justify-content-center">
            <h3 id="titreJouranl">Titre</h3>
            <h3 id="titreSaison" class="text-center px-2">
                <b id="moisSaison">##</b>
                <b id="anneeSaison">####</b>
        </h3>
        </div>
        <!-- #/ Indication de saison -->
        <!-- Tableau de journal --> 
        <table class="table">
            <thead>
                <th>Date</th>
                <th>Intitule (Description)</th>
                <th>Categorie</th>
                <th>Montant</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Justificatif</th>
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
            </tbody>
        </table>
        <!-- #/ Tableau journal -->
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
<script src="<?php echo base_url('assets/js/depenses/journal.js')?>">></script>
<!-- END JOURNAL -->