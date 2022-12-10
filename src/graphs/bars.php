<canvas id="grafica2"></canvas>
    <script>
        const ctx = document.getElementById("grafica2");
        const data = {
            labels: [
                <?php
                    foreach($ship as $objeto){ ?>
                        "<?php echo $objeto -> envio ?>",
                    <?php }
                ?>
            ],
            datasets: [{
                label: 'Ventas realizadas',
                data: [
                    <?php
                    foreach($ship as $objeto){ ?>
                        <?php echo $objeto -> numero_ventas; ?>,
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