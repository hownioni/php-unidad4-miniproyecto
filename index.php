<?php
/*
 * index.php
 * Página principal. Aquí se INICIA la sesión del sistema.
 *  - accion=iniciar / accion=reiniciar: si ya existe una sesión se destruye
 *    y se crea una nueva, guardando la nueva hora de inicio con time().
 *  - accion=salir: destruye la sesión por completo.
 * No se usan formularios: las acciones se envían con enlaces (método GET).
 */
require_once 'includes/sesion.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

/**
 * Elimina todos los datos de la sesión actual y su cookie.
 */
function destruirSesion(): void
{
    $_SESSION = [];                       // vacía el arreglo de sesión

    if (ini_get('session.use_cookies')) { // borra la cookie PHPSESSID
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }

    session_destroy();                    // destruye la sesión en el servidor
}

if ($accion === 'iniciar' || $accion === 'reiniciar') {
    // Si ya había una sesión, se destruye para iniciar nuevamente libre.
    if (sesionActiva()) {
        destruirSesion();
        session_start();                  // se abre una sesión nueva
        session_regenerate_id(true);      // con un identificador nuevo
    }

    $_SESSION['inicio']  = time();        // hora de inicio (timestamp Unix)
    $_SESSION['visitas'] = [];            // contador de visitas por página

    header('Location: index.php');        // evita repetir la acción al recargar
    exit;
}

if ($accion === 'salir') {
    destruirSesion();
    header('Location: index.php?estado=cerrada');
    exit;
}

$titulo = 'Inicio';
require 'includes/header.php';

// Datos del proyecto que se muestran dinámicamente
$integrantes = ['HitmanII1234', 'Kodegmxz', 'Hownioni'];
$secciones = [
    ['archivo' => 'variables.php',     'tema' => 'Variables y tipos de datos', 'descripcion' => 'Cómo se declaran las variables y qué tipos de datos maneja PHP.'],
    ['archivo' => 'condicionales.php', 'tema' => 'Condicionales',              'descripcion' => 'Toma de decisiones con if, elseif, else y switch.'],
    ['archivo' => 'bucles.php',        'tema' => 'Bucles',                     'descripcion' => 'Repeticiones con for, while, do-while y foreach.'],
    ['archivo' => 'arreglos.php',      'tema' => 'Arreglos',                   'descripcion' => 'Arreglos indexados, asociativos y multidimensionales.'],
    ['archivo' => 'sesiones.php',      'tema' => 'Sesiones',                   'descripcion' => 'Persistencia de datos entre páginas con $_SESSION.'],
];
?>

<h1>Bienvenido al sistema</h1>
<p class="intro">Sitio dinámico desarrollado en PHP para demostrar variables, estructuras de control, arreglos y manejo de sesiones.</p>

<?php if (isset($_GET['estado']) && $_GET['estado'] === 'cerrada'): ?>
    <div class="tarjeta">
        <span class="insignia insignia--alerta">Sesión cerrada</span>
        <p>La sesión fue destruida con <code>session_destroy()</code>. Para volver a contar el tiempo activo es necesario <strong>reiniciar la sesión</strong>.</p>
    </div>
<?php endif; ?>

<section class="tarjeta">
    <h2>Control de sesión</h2>
    <?php if (sesionActiva()): ?>
        <p>
            <span class="insignia insignia--exito">Sesión activa</span>
            Iniciada el <strong><?php echo date('d/m/Y', $_SESSION['inicio']); ?></strong>
            a las <strong><?php echo date('H:i:s', $_SESSION['inicio']); ?></strong>.
        </p>
        <p>Al reiniciar, la sesión actual se destruye y se registra una nueva hora de inicio. Al salir, la sesión se elimina y habrá que iniciarla otra vez.</p>
        <div class="acciones">
            <a class="boton boton--secundario" href="index.php?accion=reiniciar">Reiniciar sesión</a>
            <a class="boton boton--peligro" href="index.php?accion=salir">Salir (destruir sesión)</a>
        </div>
    <?php else: ?>
        <p>
            <span class="insignia insignia--alerta">Sin sesión</span>
            Todavía no se ha iniciado una sesión. Al iniciarla se guardará la hora actual con <code>time()</code>
            en <code>$_SESSION['inicio']</code> y el tiempo activo se mostrará en todas las páginas.
        </p>
        <div class="acciones">
            <a class="boton" href="index.php?accion=iniciar">Iniciar sesión</a>
        </div>
    <?php endif; ?>
</section>

<section class="tarjeta">
    <h2>Contenido del sitio</h2>
    <div class="tabla-envoltura">
        <table>
            <thead>
                <tr><th>#</th><th>Página</th><th>Tema</th><th>Descripción</th></tr>
            </thead>
            <tbody>
                <?php foreach ($secciones as $i => $seccion): ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><a href="<?php echo $seccion['archivo']; ?>"><?php echo $seccion['archivo']; ?></a></td>
                        <td><?php echo $seccion['tema']; ?></td>
                        <td><?php echo $seccion['descripcion']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p>El sitio contiene <strong><?php echo count($secciones) + 1; ?></strong> páginas PHP que comparten el mismo encabezado, menú y pie mediante <code>require</code>.</p>
</section>

<section class="tarjeta">
    <h2>Equipo</h2>
    <ul class="chips">
        <?php foreach ($integrantes as $integrante): ?>
            <li><?php echo e($integrante); ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Materia: <strong>Programación Web</strong> &middot; Unidad 4: Programación del lado del servidor con PHP.</p>
</section>

<?php require 'includes/footer.php'; ?>
