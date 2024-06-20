<!-- START FORMULAIRE DEPENSE -->
<section class="row"> 
    <div class="mx-auto col-10 p-2">
        <div class="card ">
            <div class="card-body m-2">
                <!-- Formulaire -->
                <form action="create" method="post" class="row g-3" enctype="multipart/form-data">
                    <!-- Description -->
                    <div class="col-12">
                        <label for="description" class="input-label">Description </label>
                        <input type="text" class="form-control" name="description" id="description" required>
                    </div>
                    <!-- Date -->
                    <div class="col-12">
                        <label for="dateDepense" class="input-label">Date de depense</label>
                        <input type="date" class="form-control" id="dateDepense" name="dateDepense" required>
                    </div>
                    <!-- Montant -->
                    <div class="col-12">
                        <label for="montant" class="input-label">Montant</label>
                        <input type="number" name="montant" id="montant" class="form-control" min="0" step="0.1">
                    </div>
                    <!-- PCG -->
                    <div class="col-12">
                        <label for="id_Pcg" class="input-label">PCG </label>
                        <select class="form-select" name="id_Pcg" id="id_Pcg" required>
                            <option value=""></option>
                            <?php foreach ($pcg as $item): ?>
                                <option value="<?php echo $item['id_pcg']; ?>"><?php echo $item['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Subcompte -->
                    <div class="col-12">
                        <label for="id_Categorie" class="input-label">Categorie </label>
                        <select class="form-select" name="id_Categorie" id="id_Categorie" required>
                            <option value=""></option>
                        </select>
                    </div>
                    <!-- Mode de paiement -->
                    <div class="col-12">
                        <label for="id_ModePaiment" class="input-label">Mode de paiement</label>
                        <select class="form-select" name="id_ModePaiment" id="id_ModePaiment" required>
                            <option value=""></option>
                            <?php foreach ($modes_de_paiement as $mode): ?>
                                <option value="<?php echo $mode['id_modepaiment']; ?>"><?php echo $mode['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Justificatif -->
                    <div class="col-12">
                        <label for="justificatif" class="input-label">Justificatif</label>
                        <input type="file" name="justificatif" id="justificatif" class="form-control">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="col-2 btn boutton-light">Inserer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
</section>
<script src="<?php echo base_url('assets/js/depenses/depenses.js'); ?>"></script>
<!-- END FORMULAIRE DEPENSE -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    const pcgSelect = document.getElementById("id_Pcg");
    const categorySelect = document.getElementById("id_Categorie");

    pcgSelect.addEventListener("change", function() {
        const pcgId = pcgSelect.value;

        if (pcgId) {
            fetch(`<?php echo base_url('depense/get_subcomptes?pcgId='); ?>${pcgId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    categorySelect.innerHTML = '<option value=""></option>'; // Clear previous options
                    data.forEach(subcompte => {
                        const option = document.createElement("option");
                        option.value = subcompte.id_sub_comptes;
                        option.textContent = subcompte.description;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching subcomptes:', error));
        } else {
            categorySelect.innerHTML = '<option value=""></option>'; // Clear if no PCG selected
        }
    });

    // Trigger change event to initialize subcomptes based on initial PCG selection
    pcgSelect.dispatchEvent(new Event('change'));
});

</script>
 