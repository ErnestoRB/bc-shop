<canvas id="grafica2"></canvas>
    <script>
        const ctx = document.getElementById("grafica2");
        const data = {
            labels: [
                <?php
                    foreach($datos as $objeto){ ?>
                        "<?php echo $objeto -> Prenda ?>",
                    <?php }
                ?>
            ],
            datasets: [{
                label: 'Ventas realizadas por mes',
                data: [
                    <?php
                    foreach($datos as $objeto){ ?>
                        <?php echo $objeto -> Cantidad; ?>,
                    <?php }
                ?>
                ],
                backgroundColor: "#9d9db0"
            }]    
        };
        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        };
        var chart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>