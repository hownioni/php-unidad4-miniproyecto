<?php
$titulo = 'Variables';
require 'includes/header.php';

// ---------------------------------------------------------------
// 1. Declaración de variables: en PHP inician con $ y el tipo se
//    asigna automáticamente según el valor (tipado dinámico).
// ---------------------------------------------------------------
$nombre     = "Ana López";                          // string
$edad       = 20;                                   // int
$promedio   = 9.35;                                 // float
$inscrito   = true;                                 // boolean
$materias   = ["Programación Web", "Bases de Datos", "Redes"]; // array
$telefono   = null;                                 // null

// Constante: su valor no puede cambiar durante la ejecución
define('ESCUELA', 'Instituto Tecnológico');
const SEMESTRE = 5;

// Arreglo con la información de cada variable para mostrarla en tabla
$variables = [
    '$nombre'   => $nombre,
    '$edad'     => $edad,
    '$promedio' => $promedio,
    '$inscrito' => $inscrito,
    '$materias' => $materias,
    '$telefono' => $telefono,
];

/**
 * Convierte cualquier valor a texto legible para mostrarlo en pantalla.
 */
function mostrarValor($valor): string
{
    if (is_bool($valor)) {
        return $valor ? 'true' : 'false';
    }
    if (is_array($valor)) {
        return '[' . implode(', ', $valor) . ']';
    }
    if (is_null($valor)) {
        return 'null';
    }
    return (string) $valor;
}

// Operaciones con variables
$anioActual     = (int) date('Y');
$anioNacimiento = $anioActual - $edad;
$promedioRedond = round($promedio, 1);
$totalMaterias  = count($materias);
$mensaje        = "Hola, me llamo $nombre y tengo $edad años.";   // interpolación
$mensaje2       = 'Estudio en ' . ESCUELA . ', semestre ' . SEMESTRE; // concatenación

// Conversión de tipos (casting)
$textoNumero = "42.7";
$comoEntero  = (int) $textoNumero;
$comoFlotante = (float) $textoNumero;
$comoBooleano = (bool) $textoNumero;
?>

<h1>Variables y tipos de datos</h1>
<p class="intro">Una variable es un espacio en memoria con nombre donde se guarda un valor que puede cambiar durante la ejecución del script.</p>

<section class="tarjeta">
    <h2>¿Cómo se crean las variables en PHP?</h2>
    <div class="explicacion">
        <p>En PHP toda variable comienza con el símbolo <code>$</code> seguido de su nombre (letras, números y guion bajo; no puede iniciar con número). No es necesario declarar el tipo: PHP es un lenguaje de <strong>tipado dinámico</strong>, así que el tipo se determina por el valor asignado y puede cambiar si se asigna otro valor.</p>
        <p>Los nombres distinguen mayúsculas de minúsculas (<code>$edad</code> y <code>$Edad</code> son distintas). Para imprimir su contenido se usa <code>echo</code>, y funciones como <code>gettype()</code> o <code>var_dump()</code> permiten conocer su tipo.</p>
    </div>
</section>

<section class="tarjeta">
    <h2>Tipos de datos básicos</h2>
    <p>La siguiente tabla se genera recorriendo las variables declaradas en el script; el tipo se obtiene en tiempo de ejecución con <code>gettype()</code>.</p>
    <div class="tabla-envoltura">
        <table>
            <thead>
                <tr><th>Variable</th><th>Valor</th><th>Tipo (gettype)</th><th>Descripción</th></tr>
            </thead>
            <tbody>
                <?php
                $descripciones = [
                    'string'  => 'Cadena de texto, entre comillas simples o dobles.',
                    'integer' => 'Número entero, positivo o negativo, sin decimales.',
                    'double'  => 'Número de punto flotante (float), con decimales.',
                    'boolean' => 'Valor lógico: true o false.',
                    'array'   => 'Colección de valores en una sola variable.',
                    'NULL'    => 'Variable sin valor asignado.',
                ];
                foreach ($variables as $nombreVar => $valor):
                    $tipo = gettype($valor);
                ?>
                    <tr>
                        <td><code><?php echo $nombreVar; ?></code></td>
                        <td><?php echo e(mostrarValor($valor)); ?></td>
                        <td><span class="insignia insignia--info"><?php echo $tipo; ?></span></td>
                        <td><?php echo $descripciones[$tipo]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<div class="rejilla">
    <section class="tarjeta">
        <h2>Mostrar variables con echo</h2>
        <div class="resultado">
            <?php
            echo "<p><strong>Nombre:</strong> " . $nombre . "</p>";
            echo "<p><strong>Edad:</strong> $edad años</p>";
            echo "<p><strong>Promedio:</strong> " . number_format($promedio, 2) . "</p>";
            echo "<p><strong>¿Inscrito?:</strong> " . ($inscrito ? 'Sí' : 'No') . "</p>";
            echo "<p><strong>Primera materia:</strong> " . $materias[0] . "</p>";
            ?>
        </div>
        <p>Con comillas dobles las variables se interpolan dentro del texto; con el punto (<code>.</code>) se concatenan cadenas.</p>
    </section>

    <section class="tarjeta">
        <h2>Funciones date() y count()</h2>
        <div class="resultado">
            <p><strong>Fecha de hoy:</strong> <?php echo date('d/m/Y'); ?></p>
            <p><strong>Hora del servidor:</strong> <?php echo date('H:i:s'); ?></p>
            <p><strong>Día de la semana (número):</strong> <?php echo date('N'); ?></p>
            <p><strong>Materias registradas:</strong> <?php echo count($materias); ?></p>
        </div>
        <p><code>date()</code> da formato a la fecha/hora actual y <code>count()</code> devuelve cuántos elementos tiene un arreglo.</p>
    </section>
</div>

<section class="tarjeta">
    <h2>Operaciones con variables</h2>
    <div class="tabla-envoltura">
        <table>
            <thead><tr><th>Expresión</th><th>Resultado</th></tr></thead>
            <tbody>
                <tr><td><code>date('Y') - $edad</code></td><td>Año de nacimiento aproximado: <?php echo $anioNacimiento; ?></td></tr>
                <tr><td><code>round($promedio, 1)</code></td><td><?php echo $promedioRedond; ?></td></tr>
                <tr><td><code>count($materias)</code></td><td><?php echo $totalMaterias; ?></td></tr>
                <tr><td><code>strlen($nombre)</code></td><td><?php echo strlen($nombre); ?> caracteres (bytes)</td></tr>
                <tr><td><code>strtoupper($nombre)</code></td><td><?php echo strtoupper($nombre); ?></td></tr>
                <tr><td><code>$edad * 12</code></td><td><?php echo $edad * 12; ?> meses</td></tr>
                <tr><td><code>$promedio * 10 / 2</code></td><td><?php echo $promedio * 10 / 2; ?></td></tr>
                <tr><td><code>"... $nombre ... $edad ..."</code></td><td><?php echo e($mensaje); ?></td></tr>
                <tr><td><code>'...' . ESCUELA . '...' . SEMESTRE</code></td><td><?php echo e($mensaje2); ?></td></tr>
            </tbody>
        </table>
    </div>
</section>

<section class="tarjeta">
    <h2>Conversión de tipos (casting)</h2>
    <p>Partiendo de la cadena <code>$textoNumero = "<?php echo $textoNumero; ?>"</code>:</p>
    <div class="tabla-envoltura">
        <table>
            <thead><tr><th>Conversión</th><th>Resultado</th><th>Tipo</th></tr></thead>
            <tbody>
                <tr><td><code>(int) $textoNumero</code></td><td><?php echo $comoEntero; ?></td><td><?php echo gettype($comoEntero); ?></td></tr>
                <tr><td><code>(float) $textoNumero</code></td><td><?php echo $comoFlotante; ?></td><td><?php echo gettype($comoFlotante); ?></td></tr>
                <tr><td><code>(bool) $textoNumero</code></td><td><?php echo mostrarValor($comoBooleano); ?></td><td><?php echo gettype($comoBooleano); ?></td></tr>
            </tbody>
        </table>
    </div>
</section>

<section class="tarjeta">
    <h2>Inspección con var_dump()</h2>
    <p><code>var_dump()</code> muestra el tipo y el valor exacto de una variable; es muy útil para depurar.</p>
    <pre><?php
        ob_start();
        var_dump($nombre, $edad, $promedio, $inscrito, $materias);
        echo e(ob_get_clean());
    ?></pre>
</section>

<?php require 'includes/footer.php'; ?>
