<section class="section">
    <form action="" id="dateForm" class="row g-3">
        <h1>Date: </h1>
        <div class="col-12">
            <label for="inputNanme4" class="form-label">Debut :</label>
            <input type="date" class="form-control" id="debut">
        </div>
        <div class="col-12">
            <label for="inputNanme4" class="form-label">Fin :</label>
            <input type="date" class="form-control" id="fin">
        </div>
    </form>
    <canvas class="mt-5" id="myChart" width="400" height="200"></canvas>
    <script>
    let debut = "";
    let fin = "";
    let myChart;

    const drawGraph = (url) => {
        $.getJSON(url, function(data) {
            console.log('Données reçues:', data); // Ajoutez cette ligne pour vérifier les données reçues

            const formatLabel = (year, month) => `${year}-${String(month).padStart(2, '0')}`;

            const groupedData = data.reduce((acc, item) => {
                const label = formatLabel(item.year_vente, item.month_vente);
                if (!acc[item.id_produit]) {
                    acc[item.id_produit] = {
                        nom_produit: item.nom_produit,
                        data: {}
                    }
                }
                if (!acc[item.id_produit].data[label]) {
                    acc[item.id_produit].data[label] = 0;
                }
                acc[item.id_produit].data[label] += parseInt(item.quantite);
                return acc;
            }, {});

            const labels = [...new Set(data.map(item => formatLabel(item.year_vente, item.month_vente)))];
            const datasets = Object.keys(groupedData).map(key => {
                return {
                    label: groupedData[key].nom_produit,
                    data: labels.map(label => groupedData[key].data[label] || 0),
                    borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
                    fill: false // Ajoutez cette ligne pour vérifier la visibilité des courbes
                }
            });

            console.log('Labels:', labels); // Ajoutez cette ligne pour vérifier les labels
            console.log('Datasets:', datasets); // Ajoutez cette ligne pour vérifier les datasets

            if (myChart) {
                myChart.destroy();
            }

            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
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
    }

    document.addEventListener('DOMContentLoaded', function() {
        var url = '<?= base_url("vente_commande/vente/data_statistique") ?>';
        drawGraph(url);
    });

    document.getElementById('dateForm').addEventListener('change', function() {
        var url = `<?= base_url("vente_commande/vente/data_statistique") ?>?debut=${debut}&fin=${fin}`;
        drawGraph(url);
    });

    </script>
</section>