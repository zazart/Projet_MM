<!-- application/views/pages/depenses/journal_view.php -->
<section class="row">
    <div class="col-12">
        <div class="col-md-4 col d-flex justify-content-center">
            <h3 id="titreJournal">Journal des transactions</h3>
            <h3 id="titreSaison" class="text-center px-2">
                <b id="moisSaison"><?php echo $month; ?></b>
                <b id="anneeSaison"><?php echo $year; ?></b>
            </h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Numéro de Compte</th>
                    <th>Libellé</th>
                    <th>Débit</th>
                    <th>Crédit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($journal as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction->transaction_date; ?></td>
                        <td><?php echo $transaction->account_number; ?></td>
                        <td><?php echo $transaction->libelle; ?></td>
                        <td><?php echo $transaction->debit; ?></td>
                        <td><?php echo $transaction->credit; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-6 d-flex justify-content-start">
                <a href="<?php echo base_url('journal/previous'); ?>" class="btn boutton-light px-12">Précédent</a>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="<?php echo base_url('journal/next'); ?>" class="btn boutton-light px-12">Suivant</a>
            </div>
        </div>
        <!-- Bouton de téléchargement PDF -->
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center">
                <a href="<?php echo base_url('journal/generatePdf?month=' . $month . '&year=' . $year); ?>" class="btn btn-primary">Télécharger PDF</a>
            </div>
        </div>
    </div>
</section>
