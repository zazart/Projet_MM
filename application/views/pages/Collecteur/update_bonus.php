<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Modification bonus</h5>
                    <!-- Vertical Form -->
                    <form class="row g-3" id="bonusForm">
                        <input type="hidden" name="id_bonus" value="<?php echo ($bonus['id_bonus']); ?>">
                        <div class="col-12">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo ($bonus['datedebut']); ?>"">
                            <p class=" text-danger" id="dateError"></p>
                        </div>
                        <div class="col-12">
                            <label for="inputPassword4" class="form-label">Montant :</label>
                            <input type="number" class="form-control" name="amount" value="<?php echo ($bonus['amount']); ?>">
                            <p class="text-danger" id="amountError"></p>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="boutton boutton-secondary">Modifier</button>
                        </div>
                    </form><!-- Vertical Form -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function creeXHR() {
        var xhr;
        try {
            xhr = new ActiveXObject('Msxml2.XMLHTTP');
        } catch (e) {
            try {
                xhr = new ActiveXObject('Microsoft.XMLHTTP');
            } catch (e2) {
                try {
                    xhr = new XMLHttpRequest();
                } catch (e3) {
                    xhr = false;
                }
            }
        }
        return xhr;
    }


    bonusForm.addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(bonusForm);
        var xhr = creeXHR();
        xhr.open('POST', '<?= base_url("collecteurs/bonusController/storeupdate") ?>', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        swal({
                            title: 'Succès',
                            text: 'Bonus modifié avec succès.',
                            icon: 'success',
                            buttons: 'OK'
                        }).then((isOkay) => {
                            if (isOkay) {
                                window.location.href =
                                    '<?= base_url("collecteurs/bonusController/insert_bonus") ?>'
                            }
                        });
                    } else {
                        document.getElementById('amountError').innerHTML = response.errors
                            .amount || '';
                        document.getElementById('dateError').innerHTML = response.errors
                            .date || '';
                    }
                } else {
                    console.error('Erreur AJAX : ', xhr.status, xhr.statusText);
                    alert('Une erreur s\'est produite lors de la requête AJAX.');
                }
            }
        };

        xhr.onerror = function() {
            console.error('Erreur réseau');
            alert('Une erreur s\'est produite lors de la requête AJAX.');
        };

        xhr.send(formData);
    });
</script>