<?php
/*
 * menu.php
 * Menú de navegación común. Se genera a partir de un arreglo asociativo
 * (archivo => texto) recorrido con foreach; un if marca la página actual.
 */
$paginasMenu = [
    'index.php'         => 'Inicio',
    'variables.php'     => 'Variables',
    'condicionales.php' => 'Condicionales',
    'bucles.php'        => 'Bucles',
    'arreglos.php'      => 'Arreglos',
    'sesiones.php'      => 'Sesiones',
];
?>
<nav class="menu">
    <ul class="contenedor menu__lista">
        <?php foreach ($paginasMenu as $archivo => $texto): ?>
            <?php if ($archivo === $paginaActual): ?>
                <li><a class="menu__enlace activo" href="<?php echo $archivo; ?>"><?php echo $texto; ?></a></li>
            <?php else: ?>
                <li><a class="menu__enlace" href="<?php echo $archivo; ?>"><?php echo $texto; ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</nav>
