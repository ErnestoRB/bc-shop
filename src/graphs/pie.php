<canvas id="grafica1"></canvas>
    <script>
        const ctx = document.getElementById("grafica1");
        const data = {
            labels: [
                <?php
                    foreach($category as $objeto){ ?>
                        "<?php echo $objeto -> categoria ?>",
                    <?php }
                ?>
            ],
            datasets: [{
                data: [
                    <?php
                    foreach($category as $objeto){ ?>
                        <?php echo $objeto -> ventas; ?>,
                    <?php }
                ?>
                ],
                backgroundColor: [
                    <?php
                    $red = 0;
                    $green = 0;
                    foreach($category as $objeto){ ?>
                        '<?php echo "rgb($red, $green, 255)"; 
                            $red += 150;
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