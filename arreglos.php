<?php
$titulo = 'Arreglos';
require 'includes/header.php';

// ---------------------------------------------------------------
// 1. Arreglo indexado: los elementos se identifican por posición (0, 1, 2...)
// ---------------------------------------------------------------
$lenguajes = ['PHP', 'JavaScript', 'Python', 'Java', 'C#'];

// Manipulación del arreglo indexado
$lenguajesOriginal = $lenguajes;
array_push($lenguajes, 'Go');          // agrega al final
array_unshift($lenguajes, 'HTML');     // agrega al inicio
$eliminado = array_pop($lenguajes);    // quita el último
$ordenados = $lenguajes;
sort($ordenados);                      // ordena alfabéticamente

// ---------------------------------------------------------------
// 2. Arreglo asociativo: los elementos se identifican por una clave (texto)
// ---------------------------------------------------------------
$alumno = [
    'nombre'    => 'Daniela Ruiz',
    'matricula' => '22050123',
    'carrera'   => 'Ingeniería en Sistemas',
    'semestre'  => 5,
    'promedio'  => 8.9,
];
$alumno['correo'] = 'daniela@ejemplo.com';   // se agrega una nueva clave

// ---------------------------------------------------------------
// 3. Arreglo multidimensional: arreglo que contiene otros arreglos
// ---------------------------------------------------------------
$inventario = [
    ['codigo' => 'P001', 'producto' => 'Cuaderno',   'categoria' => 'Papelería',  'precio' => 35.50,  'stock' => 120],
    ['codigo' => 'P002', 'producto' => 'Calculadora','categoria' => 'Electrónica','precio' => 450.00, 'stock' => 8],
    ['codigo' => 'P003', 'producto' => 'Bolígrafo',  'categoria' => 'Papelería',  'precio' => 12.00,  'stock' => 0],
    ['codigo' => 'P004', 'producto' => 'Mochila',    'categoria' => 'Accesorios', 'precio' => 699.90, 'stock' => 15],
    ['codigo' => 'P005', 'producto' => 'Audífonos',  'categoria' => 'Electrónica','precio' => 389.00, 'stock' => 4],
    ['codigo' => 'P006', 'producto' => 'Regla 30cm', 'categoria' => 'Papelería',  'precio' => 18.00,  'stock' => 60],
];

// Multidimensional asociativo: grupos con su lista de alumnos y calificaciones
$grupos = [
    'Grupo A' => [
        'Ana'    => [90, 85, 100],
        'Bruno'  => [70, 65, 80],
    ],
    'Grupo B' => [
        'Carla'  => [60, 55, 70],
        'Diego'  => [88, 92, 79],
        'Elena'  => [100, 98, 95],
    ],
];

// Funciones de arreglos aplicadas al inventario
$precios       = array_column($inventario, 'precio');
$stockTotal    = array_sum(array_column($inventario, 'stock'));
$precioMaximo  = max($precios);
$sinStock      = array_filter($inventario, function ($p) { return $p['stock'] === 0; });
$nombresMayus  = array_map('strtoupper', array_column($inventario, 'producto'));
$categorias    = array_unique(array_column($inventario, 'categoria'));
?>

<h1>Arreglos</h1>
<p class="intro">Un arreglo (array) es una variable que guarda varios valores organizados por índices numéricos o por claves.</p>

<section class="tarjeta">
    <h2>Manipulación de datos con arreglos en PHP</h2>
    <div class="explicacion">
        <p>Los arreglos se crean con corchetes <code>[]</code> (o con <code>array()</code>). Pueden ser <strong>indexados</strong> (posiciones numéricas desde 0), <strong>asociativos</strong> (claves de texto como <code>'nombre' =&gt; 'Ana'</code>) o <strong>multidimensionales</strong> (arreglos dentro de arreglos, ideales para representar tablas o registros).</p>
        <p>Los usamos para agrupar información relacionada y procesarla con bucles, principalmente <code>foreach</code>. PHP ofrece muchas funciones para manipularlos: <code>count()</code>, <code>array_push()</code>, <code>sort()</code>, <code>in_array()</code>, <code>array_sum()</code>, <code>array_filter()</code>, <code>array_map()</code>, entre otras.</p>
    </div>
</section>

<section class="tarjeta">
    <h2>1. Arreglo indexado</h2>
    <pre>$lenguajes = <?php echo e(print_r($lenguajesOriginal, true)); ?></pre>
    <div class="rejilla">
        <div>
            <h3>Recorrido con foreach</h3>
            <ol>
                <?php foreach ($lenguajes as $indice => $lenguaje): ?>
                    <li>
                        [<?php echo $indice; ?>] <?php echo $lenguaje; ?>
                        <?php if ($lenguaje === 'PHP'): ?>
                            <span class="insignia insignia--exito">lado del servidor</span>
                        <?php elseif ($lenguaje === 'HTML'): ?>
                            <span class="insignia insignia--alerta">lenguaje de marcado</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
        <div>
            <h3>Funciones aplicadas</h3>
            <ul class="lista-temas">
                <li><code>array_push</code> agregó "Go" y <code>array_unshift</code> agregó "HTML" al inicio.</li>
                <li><code>array_pop</code> eliminó: <strong><?php echo $eliminado; ?></strong></li>
                <li><code>count($lenguajes)</code>: <strong><?php echo count($lenguajes); ?></strong> elementos</li>
                <li><code>$lenguajes[0]</code>: <strong><?php echo $lenguajes[0]; ?></strong></li>
                <li><code>in_array('Python', $lenguajes)</code>: <strong><?php echo in_array('Python', $lenguajes) ? 'true' : 'false'; ?></strong></li>
                <li><code>sort()</code>: <strong><?php echo implode(', ', $ordenados); ?></strong></li>
                <li><code>implode(' | ', ...)</code>: <strong><?php echo implode(' | ', $lenguajes); ?></strong></li>
            </ul>
        </div>
    </div>
</section>

<section class="tarjeta">
    <h2>2. Arreglo asociativo</h2>
    <p>Cada dato del alumno se guarda con una clave descriptiva. Se recorre con <code>foreach ($alumno as $clave =&gt; $valor)</code> y se aplica formato según la clave:</p>
    <div class="tabla-envoltura">
        <table>
            <thead><tr><th>Clave</th><th>Valor</th></tr></thead>
            <tbody>
                <?php foreach ($alumno as $clave => $valor): ?>
                    <tr>
                        <td><code>'<?php echo $clave; ?>'</code></td>
                        <td>
                            <?php if ($clave === 'promedio'): ?>
                                <?php echo number_format($valor, 1); ?>
                                <?php if ($valor >= 8.5): ?>
                                    <span class="insignia insignia--exito">Alto rendimiento</span>
                                <?php else: ?>
                                    <span class="insignia insignia--info">Regular</span>
                                <?php endif; ?>
                            <?php elseif ($clave === 'semestre'): ?>
                                <?php echo $valor; ?>° semestre
                            <?php else: ?>
                                <?php echo e($valor); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p>
        Claves (<code>array_keys</code>): <strong><?php echo implode(', ', array_keys($alumno)); ?></strong><br>
        ¿Existe la clave 'telefono'? (<code>array_key_exists</code>): <strong><?php echo array_key_exists('telefono', $alumno) ? 'Sí' : 'No'; ?></strong><br>
        Acceso directo <code>$alumno['nombre']</code>: <strong><?php echo $alumno['nombre']; ?></strong>
    </p>
</section>

<section class="tarjeta">
    <h2>3. Arreglo multidimensional: inventario</h2>
    <p>Cada elemento del arreglo es a su vez un arreglo asociativo (un registro). Se recorre con <code>foreach</code> y dentro del recorrido se usan condicionales para determinar el estado del stock:</p>
    <div class="tabla-envoltura">
        <table>
            <thead><tr><th>Código</th><th>Producto</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Estado</th></tr></thead>
            <tbody>
                <?php foreach ($inventario as $item): ?>
                    <?php
                    if ($item['stock'] === 0) {
                        $estado = ['texto' => 'Agotado', 'clase' => 'error'];
                    } elseif ($item['stock'] < 10) {
                        $estado = ['texto' => 'Stock bajo', 'clase' => 'alerta'];
                    } else {
                        $estado = ['texto' => 'Disponible', 'clase' => 'exito'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $item['codigo']; ?></td>
                        <td><?php echo $item['producto']; ?></td>
                        <td><?php echo $item['categoria']; ?></td>
                        <td>$<?php echo number_format($item['precio'], 2); ?></td>
                        <td><?php echo $item['stock']; ?></td>
                        <td><span class="insignia insignia--<?php echo $estado['clase']; ?>"><?php echo $estado['texto']; ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p>Acceso a un elemento específico: <code>$inventario[1]['producto']</code> = <strong><?php echo $inventario[1]['producto']; ?></strong></p>

    <h3>Resumen calculado con funciones de arreglos</h3>
    <ul class="lista-temas">
        <li>Total de productos (<code>count</code>): <strong><?php echo count($inventario); ?></strong></li>
        <li>Unidades en stock (<code>array_sum</code> + <code>array_column</code>): <strong><?php echo $stockTotal; ?></strong></li>
        <li>Precio más alto (<code>max</code>): <strong>$<?php echo number_format($precioMaximo, 2); ?></strong></li>
        <li>Productos agotados (<code>array_filter</code>): <strong><?php echo count($sinStock); ?></strong>
            <?php foreach ($sinStock as $p) { echo '(' . $p['producto'] . ')'; } ?></li>
        <li>Categorías únicas (<code>array_unique</code>): <strong><?php echo implode(', ', $categorias); ?></strong></li>
        <li>Nombres en mayúsculas (<code>array_map</code>): <strong><?php echo implode(', ', $nombresMayus); ?></strong></li>
    </ul>
</section>

<section class="tarjeta">
    <h2>Multidimensional con foreach anidado: calificaciones por grupo</h2>
    <p>Tres niveles: grupo → alumno → lista de calificaciones. Se usan dos <code>foreach</code> anidados y una condicional para aprobar o reprobar según el promedio:</p>
    <?php foreach ($grupos as $nombreGrupo => $alumnosGrupo): ?>
        <h3><?php echo $nombreGrupo; ?> (<?php echo count($alumnosGrupo); ?> alumnos)</h3>
        <div class="tabla-envoltura">
            <table>
                <thead><tr><th>Alumno</th><th>Calificaciones</th><th>Promedio</th><th>Resultado</th></tr></thead>
                <tbody>
                    <?php foreach ($alumnosGrupo as $nombreAlumno => $califs): ?>
                        <?php $prom = array_sum($califs) / count($califs); ?>
                        <tr>
                            <td><?php echo $nombreAlumno; ?></td>
                            <td><?php echo implode(', ', $califs); ?></td>
                            <td><?php echo number_format($prom, 1); ?></td>
                            <td>
                                <?php if ($prom >= 70): ?>
                                    <span class="insignia insignia--exito">Aprobado</span>
                                <?php else: ?>
                                    <span class="insignia insignia--error">Reprobado</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</section>

<section class="tarjeta">
    <h2>Estructura interna con print_r()</h2>
    <pre><?php echo e(print_r($grupos, true)); ?></pre>
</section>

<?php require 'includes/footer.php'; ?>
