<section class="section">
  <div class="card-body">
    <h5 class="card-title text-center">Etat stock produit</h5>
      <table class="table table-hover" id="produitTable">
       
      </table>
  </div>
</section>
<script>
   document.addEventListener('DOMContentLoaded', function(){
    let xhr = creeXHR();
    xhr.open('GET', '<?= base_url("transformation/stockproduit_controller/getStockProsuits") ?>', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              var var_data = response.produits;
              const produitsArray = var_data.map(produit => Object.values(produit));
              viewTableData(
                "produitTable",
                [{title:'Nom Produit'},{title:'Quantite en stock'},{title : 'Date dernière production'}],
                produitsArray,
                null,
                null,false)
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