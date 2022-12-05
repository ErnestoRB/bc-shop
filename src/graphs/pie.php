<canvas id="grafica1"></canvas>
    <script>
        const ctx = document.getElementById("grafica1");
        const data = {
            labels: [
                <?php
                    foreach($datos as $objeto){ ?>
                        "<?php echo $objeto -> Prenda ?>",
                    <?php }
                ?>
            ],
            datasets: [{
                data: [
                    <?php
                    foreach($datos as $objeto){ ?>
                        <?php echo $objeto -> Cantidad; ?>,
                    <?php }
                ?>
                ],
                backgroundColor: [
                    <?php
                    $red = 0;
                    $green = 0;
                    foreach($datos as $objeto){ ?>
                        '<?php echo "rgb($red, $green, 255)"; 
                            $red += 30;
                            if($red > 255 && $green < 255){
                                $green += 30;
                            } 
                        ?>',
                    <?php }
                ?>
                ]
            }]    
        };
        var chart = new Chart(ctx, {
            type: 'pie',
            data: data,
        });
    </script>