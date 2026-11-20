<?php
$titulo = 'Sesiones';
require 'includes/header.php';

// Etiquetas legibles para las páginas registradas en $_SESSION['visitas']
$nombresPaginas = [
    'index.php'         => 'Inicio',
    'variables.php'     => 'Variables',
    'condicionales.php' => 'Condicionales',
    'bucles.php'        => 'Bucles',
    'arreglos.php'      => 'Arreglos',
    'sesiones.php'      => 'Sesiones',
];
?>

<h1>Manejo de sesiones</h1>
<p class="intro">Una sesión permite conservar información del usuario mientras navega entre las páginas del sitio, sin necesidad de base de datos ni formularios.</p>

<section class="tarjeta">
    <h2>Persistencia de datos en memoria: ¿para qué sirve?</h2>
    <div class="explicacion">
        <p>HTTP es un protocolo sin estado: cada vez que se carga una página, el servidor no recuerda nada de la petición anterior. Las sesiones resuelven esto: <code>session_start()</code> crea (o reanuda) una sesión y envía al navegador una cookie con un identificador único (<code>PHPSESSID</code>). En cada petición, PHP usa ese identificador para recuperar los datos guardados en el arreglo superglobal <code>$_SESSION</code>.</p>
        <p>Sirven para mantener al usuario identificado, guardar preferencias, carritos de compra o, como en este sistema, la <strong>hora de inicio</strong> para calcular el tiempo activo en todas las páginas. Con <code>session_destroy()</code> se eliminan los datos y la sesión termina.</p>
    </div>
</section>

<?php if (!sesionActiva()): ?>

    <section class="tarjeta">
        <h2>No hay sesión activa</h2>
        <p><span class="insignia insignia--alerta">Sin sesión</span> Para ver los datos guardados en <code>$_SESSION</code> primero inicia la sesión desde el index.</p>
        <div class="acciones">
            <a class="boton" href="index.php?accion=iniciar">Iniciar sesión</a>
        </div>
    </section>

<?php else: ?>
    <?php
    $t           = tiempoActivo();
    $inicio      = $_SESSION['inicio'];
    $ahora       = time();
    $totalVisitas = array_sum($_SESSION['visitas']);
    ?>

    <section class="tarjeta">
        <h2>Datos de la sesión actual</h2>
        <div class="tabla-envoltura">
            <table>
                <thead><tr><th>Dato</th><th>Valor</th><th>Obtenido con</th></tr></thead>
                <tbody>
                    <tr><td>Estado</td><td><span class="insignia insignia--exito">Activa</span></td><td><code>session_status()</code> = <?php echo session_status(); ?> (PHP_SESSION_ACTIVE)</td></tr>
                    <tr><td>Identificador</td><td><code><?php echo e(session_id()); ?></code></td><td><code>session_id()</code></td></tr>
                    <tr><td>Nombre de la cookie</td><td><?php echo e(session_name()); ?></td><td><code>session_name()</code></td></tr>
                    <tr><td>Hora de inicio</td><td><?php echo date('d/m/Y H:i:s', $inicio); ?></td><td><code>$_SESSION['inicio']</code></td></tr>
                    <tr><td>Páginas visitadas</td><td><?php echo $totalVisitas; ?></td><td><code>array_sum($_SESSION['visitas'])</code></td></tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="tarjeta">
        <h2>Cálculo del tiempo activo</h2>
        <p>El tiempo activo se obtiene restando la hora de inicio guardada en la sesión a la hora actual. Ambas son <em>timestamps</em> Unix (segundos desde el 1 de enero de 1970) generados con <code>time()</code>:</p>
        <div class="tabla-envoltura">
            <table>
                <thead><tr><th>Paso</th><th>Operación</th><th>Resultado</th></tr></thead>
                <tbody>
                    <tr><td>1</td><td>Hora de inicio: <code>$_SESSION['inicio']</code></td><td><?php echo $inicio; ?> (<?php echo date('H:i:s', $inicio); ?>)</td></tr>
                    <tr><td>2</td><td>Hora actual: <code>time()</code></td><td><?php echo $ahora; ?> (<?php echo date('H:i:s', $ahora); ?>)</td></tr>
                    <tr><td>3</td><td>Diferencia: <code>time() - $_SESSION['inicio']</code></td><td><?php echo $t['total']; ?> segundos</td></tr>
                    <tr><td>4</td><td>Minutos: <code>intdiv($total, 60)</code></td><td><?php echo $t['minutos']; ?></td></tr>
                    <tr><td>5</td><td>Segundos restantes: <code>$total % 60</code></td><td><?php echo $t['segundos']; ?></td></tr>
                </tbody>
            </table>
        </div>
        <div class="resultado">
            <p style="font-size:1.2rem;margin:0;">Tiempo activo: <strong><?php echo formatoTiempo($t['minutos'], $t['segundos']); ?></strong></p>
        </div>
        <?php if ($t['total'] < 60): ?>
            <p><span class="insignia insignia--info">Nuevo</span> La sesión tiene menos de un minuto.</p>
        <?php elseif ($t['total'] < 600): ?>
            <p><span class="insignia insignia--exito">Activo</span> Llevas algunos minutos navegando el sitio.</p>
        <?php else: ?>
            <p><span class="insignia insignia--alerta">Sesión larga</span> Llevas más de 10 minutos en el sitio.</p>
        <?php endif; ?>
    </section>

    <section class="tarjeta">
        <h2>Visitas por página guardadas en la sesión</h2>
        <p>Cada vez que se carga una página, <code>header.php</code> incrementa <code>$_SESSION['visitas'][pagina]</code>. Este dato persiste mientras la sesión exista:</p>
        <div class="tabla-envoltura">
            <table>
                <thead><tr><th>Página</th><th>Visitas</th></tr></thead>
                <tbody>
                    <?php foreach ($nombresPaginas as $archivo => $nombre): ?>
                        <?php $visitas = isset($_SESSION['visitas'][$archivo]) ? $_SESSION['visitas'][$archivo] : 0; ?>
                        <tr>
                            <td><a href="<?php echo $archivo; ?>"><?php echo $nombre; ?></a></td>
                            <td>
                                <?php if ($visitas === 0): ?>
                                    <span class="insignia insignia--alerta">Sin visitar</span>
                                <?php else: ?>
                                    <?php echo $visitas; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="tarjeta">
        <h2>Contenido completo de $_SESSION</h2>
        <pre><?php echo e(print_r($_SESSION, true)); ?></pre>
    </section>

    <section class="tarjeta">
        <h2>Reiniciar o terminar la sesión</h2>
        <p><strong>Reiniciar</strong> destruye la sesión actual con <code>session_destroy()</code> y crea una nueva con una nueva hora inicial. <strong>Salir</strong> solo la destruye; para volver a contar el tiempo hay que iniciarla de nuevo en el index.</p>
        <div class="acciones">
            <a class="boton boton--secundario" href="index.php?accion=reiniciar">Reiniciar sesión</a>
            <a class="boton boton--peligro" href="index.php?accion=salir">Salir (destruir sesión)</a>
        </div>
    </section>

<?php endif; ?>

<?php require 'includes/footer.php'; ?>
