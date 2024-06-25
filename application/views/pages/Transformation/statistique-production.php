<section class="section">
    <canvas id="productionChart" width="400" height="200"></canvas>
</section>
<script>
    function drawGraph(data) {
        const labels = data.map(item => `${item.nom_matierepremier}`);
        const quantiteBrutData = data.map(item => item.quantitebrut);
        const quantiteProduitData = data.map(item => item.quantiteproduit);

        // Create the chart
        const ctx = document.getElementById('productionChart').getContext('2d');
        const productionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Quantité Brut',
                        data: quantiteBrutData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Quantité Produit',
                        data: quantiteProduitData,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    document.addEventListener('DOMContentLoaded', (event) => {
        fetch('<?= base_url('/transformation/production_controller/data_production') ?>')
        .then(response => response.json())
        .then(data => drawGraph(data))
        .catch(error => console.error("Error: "  + error));
        
        // Extract labels and data
        
    });
</script>