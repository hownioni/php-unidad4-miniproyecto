<?php
/*
 * header.php
 * Encabezado común: se reutiliza en todas las páginas con require.
 * Antes de incluirlo, cada página define la variable $titulo.
 */
require_once __DIR__ . '/sesion.php';

$paginaActual = basename($_SERVER['PHP_SELF']);
registrarVisita($paginaActual);

if (!isset($titulo)) {
    $titulo = 'Inicio';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($titulo); ?> | PHP Unidad 4</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header class="encabezado">
    <div class="contenedor encabezado__contenido">
        <a href="index.php" class="logo">
            <span class="logo__icono">&lt;?php</span>
            <span class="logo__texto">Programación Web &middot; Unidad 4</span>
        </a>
        <p class="encabezado__sub">Variables, estructuras de control, arreglos y sesiones</p>
    </div>
    <?php require __DIR__ . '/menu.php'; ?>
</header>

<section class="contenedor">
    <?php if (sesionActiva()): ?>
        <?php $t = tiempoActivo(); ?>
        <div class="panel-sesion">
            <div class="panel-sesion__dato">
                <span class="etiqueta">Hora inicio sesión</span>
                <strong><?php echo date('H:i:s', $_SESSION['inicio']); ?></strong>
            </div>
            <div class="panel-sesion__dato">
                <span class="etiqueta">Hora actual</span>
                <strong><?php echo date('H:i:s'); ?></strong>
            </div>
            <div class="panel-sesion__dato">
                <span class="etiqueta">Tiempo activo</span>
                <strong><?php echo formatoTiempo($t['minutos'], $t['segundos']); ?></strong>
            </div>
            <a class="boton boton--chico" href="<?php echo e($paginaActual); ?>">Actualizar</a>
        </div>
    <?php else: ?>
        <div class="panel-sesion panel-sesion--inactiva">
            <span>No hay una sesión iniciada. El tiempo activo comienza a contar al iniciar sesión.</span>
            <a class="boton boton--chico" href="index.php?accion=iniciar">Iniciar sesión</a>
        </div>
    <?php endif; ?>
</section>

<main class="contenedor contenido">
