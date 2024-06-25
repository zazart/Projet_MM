<!-- application/views/pages/depenses/journal_view.php -->
<section class="row">
    <div class="col-12">
        <div class="col-md-6 col d-flex justify-content-center">
            <h3 id="titreJournal">Journal des transactions</h3>
            <h3 id="titreSaison" class="text-center px-2">
                <b id="moisSaison"><?php echo $month; ?></b>
                <b id="anneeSaison"><?php echo $year; ?></b>
            </h3>
        </div>
        <table class="table" id="journalData">
            
        </table>
        <div class="row">
            <div class="col-6 d-flex justify-content-start">
                <a href="<?php echo base_url('journal/previous'); ?>" id="saisonPrecedentBtn" class="btn boutton-light px-12">Précédent</a>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="<?php echo base_url('journal/next'); ?>" id="saisonSuivantBtn" class="btn boutton-light px-12">Suivant</a>
            </div>
        </div>
        <!-- Bouton de téléchargement PDF -->
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center">
                <a id="pdfBtn" href="<?php echo base_url('journal/generatePdf?month=' . $month . '&year=' . $year); ?>" class="btn boutton-secondary">Télécharger PDF</a>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url('assets/js/depenses/depenses.js')?>"></script>
<script src="<?php echo base_url('assets/js/depenses/journal.js')?>">></script>
<script>
    const base_url = '<?=base_url()?>'; 
</script>
