
<section class="section">
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var url = '<?=base_url("vente_commande/vente/data_statistique")?>';
        $.getJSON(url, function(data) {

            const formatLabel = (year, month) => `${year}-${String(month).padStart(2, '0')}`;

            const groupedData = data.reduce((acc, item) => {
                const label = formatLabel(item.year_vente,  item.month_vente);
                if (!acc[item.id_produit]) {
                    acc[item.id_produit] = {
                        nom_produit: item.nom_produit,
                        data:{} 
                    }
                }
                if (!acc[item.id_produit].data[label]) {
                    acc[item.id_produit].data[label] = 0; 
                }
                acc[item.id_produit].data[label] += parseInt(item.quantite);
                return acc;
            }, {});
            // Extract months and quantities for chart data
            const labels = [...new Set(data.map(item => formatLabel(item.year_vente, item.month_vente)))];
            const datasets = Object.keys(groupedData).map(key => {
                return {
                    label: groupedData[key].nom_produit,
                    data: labels.map(label => groupedData[key].data[label] || 0),
                    borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`
                }
            });
            console.log(datasets);

            // Create the line chart
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets,
                },
                options: {
                    scales: {
                        x: {
                            type: 'category',
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantité'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    }
                }
            });
        }).fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            console.error("Request Failed: " + err);
        });

    });
    </script>
</section>