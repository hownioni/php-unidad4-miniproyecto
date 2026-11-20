<?php
/*
 * footer.php
 * Pie de página común, reutilizado con require en todas las páginas.
 */
?>
</main>

<footer class="pie">
    <div class="contenedor pie__contenido">
        <p>Programación Web &middot; Unidad 4 &mdash; Programación del lado del servidor con PHP</p>
        <p>
            Página generada el <?php echo date('d/m/Y'); ?> a las <?php echo date('H:i:s'); ?>
            con PHP <?php echo PHP_VERSION; ?>
        </p>
    </div>
</footer>
</body>
</html>
