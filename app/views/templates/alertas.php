<?php 
    foreach ($alertas as $key => $mensaje) {
        foreach ($mensaje as $mensajes) {
?>
        <div class="alertas <?php echo $key ?>">
            <?php echo $mensajes ?>
        </div>
<?php
        }
    }
?>