<section class="section">
  <div class="card-body">
    <h5 class="card-title text-center">Liste produits disponibles</h5>
      <table class="table table-hover" id="produitTable">
      </table>
  </div>
</section>
<script>
   document.addEventListener('DOMContentLoaded', function(){
    let xhr = creeXHR();
    xhr.open('GET', '<?= base_url("transformation/produit_controller/produitsData") ?>', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              var var_data = response.produits;
              const produitsArray = var_data.map(produit => Object.values(produit));
              viewTableData(
                "produitTable",
                [{title:'Id'},{title:'Nom Produit'},{title:'Prix unitaire'}],
                produitsArray,
                'transformation/produit_controller/validation_update_produit',
                'transformation/produit_controller/validation_delete_produit')
            } else {
              alert('Erreur lors de l\'insertion : ' + response.message);
            }
          } else {
            console.error('Erreur AJAX : ', xhr.status, xhr.statusText);
            alert('Une erreur s\'est produite lors de la requête AJAX.');
          }
        }
      };
      xhr.send()
   })
</script>