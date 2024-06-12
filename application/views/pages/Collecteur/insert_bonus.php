
    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Insertion bonus</h5>

              <!-- Vertical Form -->
            <?php echo form_open('saveBonus', array('method' => 'post','class' => 'row g-3')); ?>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label">Montant :</label>
                  <input type="number" class="form-control" name="amount">
                  <?php echo form_error('amount','<div class="text-danger"> ','</div>');  ?>
                </div>

                <div class="text-center">
                  <button type="submit" class="boutton boutton-secondary">Inserer</button>
                </div>
            <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </section>