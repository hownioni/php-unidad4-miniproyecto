<?php
$titulo = 'Condicionales';
require 'includes/header.php';

// ---------------------------------------------------------------
// Datos que se evaluarán con las estructuras condicionales
// ---------------------------------------------------------------
$hora       = (int) date('G');    // hora actual 0-23
$diaSemana  = (int) date('N');    // 1 (lunes) a 7 (domingo)
$numero     = rand(1, 100);       // número aleatorio en cada recarga

$alumnos = [
    ['nombre' => 'Carlos',  'calificacion' => 95],
    ['nombre' => 'María',   'calificacion' => 82],
    ['nombre' => 'Luis',    'calificacion' => 74],
    ['nombre' => 'Fernanda','calificacion' => 68],
    ['nombre' => 'Jorge',   'calificacion' => 45],
];

// ----- if / elseif / else: saludo según la hora -----
if ($hora >= 5 && $hora < 12) {
    $saludo = 'Buenos días';
} elseif ($hora >= 12 && $hora < 19) {
    $saludo = 'Buenas tardes';
} else {
    $saludo = 'Buenas noches';
}

// ----- if / else: par o impar -----
if ($numero % 2 === 0) {
    $paridad = 'par';
} else {
    $paridad = 'impar';
}

// ----- switch: nombre del día y tipo de jornada -----
switch ($diaSemana) {
    case 1:
        $nombreDia = 'Lunes';
        break;
    case 2:
        $nombreDia = 'Martes';
        break;
    case 3:
        $nombreDia = 'Miércoles';
        break;
    case 4:
        $nombreDia = 'Jueves';
        break;
    case 5:
        $nombreDia = 'Viernes';
        break;
    case 6:
        $nombreDia = 'Sábado';
        break;
    default:
        $nombreDia = 'Domingo';
}

switch ($diaSemana) {
    case 6:
    case 7:
        $jornada = 'Fin de semana: no hay clases.';
        break;
    case 5:
        $jornada = 'Viernes: último día de clases de la semana.';
        break;
    default:
        $jornada = 'Día hábil: hay clases.';
}

/**
 * Evalúa una calificación con if / elseif / else y devuelve
 * un arreglo con el nivel y la clase CSS de la insignia.
 */
function evaluarCalificacion(int $calificacion): array
{
    if ($calificacion >= 90) {
        return ['nivel' => 'Excelente', 'clase' => 'exito'];
    } elseif ($calificacion >= 80) {
        return ['nivel' => 'Muy bien', 'clase' => 'exito'];
    } elseif ($calificacion >= 70) {
        return ['nivel' => 'Aprobado', 'clase' => 'info'];
    } else {
        return ['nivel' => 'Reprobado', 'clase' => 'error'];
    }
}

/**
 * Asigna una letra con switch(true): cada case es una condición.
 */
function letraCalificacion(int $calificacion): string
{
    switch (true) {
        case $calificacion >= 90:
            return 'A';
        case $calificacion >= 80:
            return 'B';
        case $calificacion >= 70:
            return 'C';
        default:
            return 'F';
    }
}
?>

<h1>Estructuras condicionales</h1>
<p class="intro">Las condicionales permiten que el programa tome decisiones: ejecuta un bloque de código u otro dependiendo de si una condición es verdadera o falsa.</p>

<section class="tarjeta">
    <h2>¿Cómo se usan para tomar decisiones en PHP?</h2>
    <div class="explicacion">
        <p><strong>if</strong> evalúa una expresión booleana y ejecuta su bloque solo si es <code>true</code>. <strong>else</strong> define lo que ocurre cuando la condición es falsa, y <strong>elseif</strong> permite encadenar varias condiciones que se revisan en orden hasta que una se cumple.</p>
        <p><strong>switch</strong> compara una misma variable contra varios valores posibles (<code>case</code>). Cada caso termina con <code>break</code> para no continuar con los siguientes, y <code>default</code> se ejecuta si ningún caso coincide. Es más legible que muchos <code>elseif</code> cuando se evalúa un solo valor.</p>
    </div>
</section>

<div class="rejilla">
    <section class="tarjeta">
        <h2>if / elseif / else</h2>
        <p>Saludo según la hora actual del servidor (<code>date('G')</code> = <strong><?php echo $hora; ?></strong>):</p>
        <div class="resultado">
            <p style="font-size:1.3rem;margin:0;"><strong><?php echo $saludo; ?></strong></p>
        </div>
        <ul class="lista-temas">
            <li>De 5 a 11 h: Buenos días</li>
            <li>De 12 a 18 h: Buenas tardes</li>
            <li>Otro horario: Buenas noches</li>
        </ul>
    </section>

    <section class="tarjeta">
        <h2>if / else</h2>
        <p>Número aleatorio generado con <code>rand(1, 100)</code>:</p>
        <div class="resultado">
            <p style="font-size:1.3rem;margin:0;">
                El número <strong><?php echo $numero; ?></strong> es <strong><?php echo $paridad; ?></strong>
            </p>
        </div>
        <p>
            <?php if ($numero > 50): ?>
                Además es <span class="insignia insignia--info">mayor que 50</span>
            <?php else: ?>
                Además es <span class="insignia insignia--alerta">menor o igual a 50</span>
            <?php endif; ?>
        </p>
        <p><a href="condicionales.php">Recargar para generar otro número</a></p>
    </section>
</div>

<section class="tarjeta">
    <h2>switch</h2>
    <p><code>date('N')</code> devuelve hoy el valor <strong><?php echo $diaSemana; ?></strong>. Con un <code>switch</code> se convierte en el nombre del día y con otro se determina el tipo de jornada (agrupando casos 6 y 7):</p>
    <div class="resultado">
        <p style="margin:0;">Hoy es <strong><?php echo $nombreDia; ?></strong>. <?php echo $jornada; ?></p>
    </div>
</section>

<section class="tarjeta">
    <h2>Condicionales aplicadas a un arreglo</h2>
    <p>Cada alumno del arreglo se evalúa con <code>if / elseif / else</code> (nivel) y con <code>switch(true)</code> (letra):</p>
    <div class="tabla-envoltura">
        <table>
            <thead><tr><th>Alumno</th><th>Calificación</th><th>Letra (switch)</th><th>Nivel (if/elseif/else)</th></tr></thead>
            <tbody>
                <?php foreach ($alumnos as $alumno): ?>
                    <?php $evaluacion = evaluarCalificacion($alumno['calificacion']); ?>
                    <tr>
                        <td><?php echo $alumno['nombre']; ?></td>
                        <td><?php echo $alumno['calificacion']; ?></td>
                        <td><?php echo letraCalificacion($alumno['calificacion']); ?></td>
                        <td><span class="insignia insignia--<?php echo $evaluacion['clase']; ?>"><?php echo $evaluacion['nivel']; ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="tarjeta">
    <h2>Operadores usados en las condiciones</h2>
    <div class="tabla-envoltura">
        <table>
            <thead><tr><th>Operador</th><th>Significado</th><th>Ejemplo evaluado</th><th>Resultado</th></tr></thead>
            <tbody>
                <tr><td><code>==</code></td><td>Igual (valor)</td><td><code>5 == "5"</code></td><td><?php echo (5 == "5") ? 'true' : 'false'; ?></td></tr>
                <tr><td><code>===</code></td><td>Idéntico (valor y tipo)</td><td><code>5 === "5"</code></td><td><?php echo (5 === "5") ? 'true' : 'false'; ?></td></tr>
                <tr><td><code>!=</code></td><td>Diferente</td><td><code>$hora != 12</code></td><td><?php echo ($hora != 12) ? 'true' : 'false'; ?></td></tr>
                <tr><td><code>&gt;=</code></td><td>Mayor o igual</td><td><code>$numero &gt;= 50</code></td><td><?php echo ($numero >= 50) ? 'true' : 'false'; ?></td></tr>
                <tr><td><code>&amp;&amp;</code></td><td>Y lógico</td><td><code>$hora &gt;= 5 &amp;&amp; $hora &lt; 12</code></td><td><?php echo ($hora >= 5 && $hora < 12) ? 'true' : 'false'; ?></td></tr>
                <tr><td><code>||</code></td><td>O lógico</td><td><code>$diaSemana == 6 || $diaSemana == 7</code></td><td><?php echo ($diaSemana == 6 || $diaSemana == 7) ? 'true' : 'false'; ?></td></tr>
                <tr><td><code>? :</code></td><td>Ternario (if corto)</td><td><code>$numero % 2 ? 'impar' : 'par'</code></td><td><?php echo $numero % 2 ? 'impar' : 'par'; ?></td></tr>
            </tbody>
        </table>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
