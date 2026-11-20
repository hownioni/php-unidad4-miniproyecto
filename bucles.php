<?php
$titulo = 'Bucles';
require 'includes/header.php';

// Número para la tabla de multiplicar: cambia según el día del mes (1-31 → 2-10)
$tablaDe = ((int) date('j') % 9) + 2;

// Datos reales que se recorrerán con foreach
$productos = [
    ['nombre' => 'Laptop',      'precio' => 15499.00, 'cantidad' => 1],
    ['nombre' => 'Mouse',       'precio' => 249.90,   'cantidad' => 2],
    ['nombre' => 'Teclado',     'precio' => 599.00,   'cantidad' => 1],
    ['nombre' => 'Monitor 24"', 'precio' => 3299.50,  'cantidad' => 2],
    ['nombre' => 'Memoria USB', 'precio' => 189.00,   'cantidad' => 3],
];

$diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

// ----- while: ahorro semanal hasta alcanzar una meta -----
$meta     = 1000;
$ahorro   = 0;
$semana   = 0;
$deposito = 150;
$historial = [];

while ($ahorro < $meta) {
    $semana++;
    $ahorro += $deposito;
    $historial[] = ['semana' => $semana, 'ahorro' => $ahorro];
}

// ----- do...while: se ejecuta al menos una vez -----
$intentos = 0;
$tiradas  = [];
do {
    $intentos++;
    $dado = rand(1, 6);
    $tiradas[] = $dado;
} while ($dado !== 6 && $intentos < 20);
?>

<h1>Estructuras de repetición (bucles)</h1>
<p class="intro">Los bucles permiten ejecutar un bloque de código varias veces sin tener que escribirlo repetidamente.</p>

<section class="tarjeta">
    <h2>¿Cómo se usan para realizar repeticiones?</h2>
    <div class="explicacion">
        <p><strong>for</strong> se utiliza cuando se conoce de antemano el número de repeticiones: tiene inicialización, condición e incremento en una sola línea. <strong>while</strong> repite mientras una condición sea verdadera y se usa cuando no se sabe cuántas vueltas dará; <strong>do...while</strong> es similar pero garantiza al menos una ejecución.</p>
        <p><strong>foreach</strong> está diseñado para recorrer arreglos elemento por elemento, obteniendo el valor (y opcionalmente la clave) sin manejar índices. Con <code>break</code> se sale del ciclo y con <code>continue</code> se salta a la siguiente iteración.</p>
    </div>
</section>

<section class="tarjeta">
    <h2>for: tabla de multiplicar del <?php echo $tablaDe; ?></h2>
    <p>El número de la tabla cambia según el día del mes (<code>date('j')</code>). La tabla se genera con un ciclo <code>for</code> de 1 a 10:</p>
    <div class="tabla-envoltura">
        <table class="tabla-multiplicar">
            <thead><tr><th>Operación</th><th>Resultado</th></tr></thead>
            <tbody>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <tr>
                        <td><?php echo "$tablaDe × $i"; ?></td>
                        <td><?php echo $tablaDe * $i; ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="tarjeta">
    <h2>for anidado: tabla pitagórica 1 a 10</h2>
    <p>Dos ciclos <code>for</code> (filas y columnas) generan la tabla dinámicamente. Se resalta la fila de la tabla del <?php echo $tablaDe; ?> y los cuadrados perfectos.</p>
    <div class="tabla-envoltura">
        <table class="tabla-multiplicar">
            <thead>
                <tr>
                    <th>×</th>
                    <?php for ($col = 1; $col <= 10; $col++): ?>
                        <th><?php echo $col; ?></th>
                    <?php endfor; ?>
                </tr>
            </thead>
            <tbody>
                <?php for ($fila = 1; $fila <= 10; $fila++): ?>
                    <tr>
                        <th><?php echo $fila; ?></th>
                        <?php for ($col = 1; $col <= 10; $col++): ?>
                            <?php $resaltar = ($fila === $tablaDe || $fila === $col); ?>
                            <td class="<?php echo $resaltar ? 'celda-resaltada' : ''; ?>"><?php echo $fila * $col; ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</section>

<div class="rejilla">
    <section class="tarjeta">
        <h2>while: meta de ahorro</h2>
        <p>Se depositan $<?php echo $deposito; ?> por semana <strong>mientras</strong> el ahorro sea menor a $<?php echo number_format($meta); ?>:</p>
        <div class="tabla-envoltura">
            <table>
                <thead><tr><th>Semana</th><th>Ahorro acumulado</th></tr></thead>
                <tbody>
                    <?php
                    $k = 0;
                    while ($k < count($historial)):
                    ?>
                        <tr>
                            <td><?php echo $historial[$k]['semana']; ?></td>
                            <td>$<?php echo number_format($historial[$k]['ahorro'], 2); ?></td>
                        </tr>
                    <?php
                        $k++;
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
        <p>Meta alcanzada en <strong><?php echo $semana; ?></strong> semanas.</p>
    </section>

    <section class="tarjeta">
        <h2>do...while: lanzar un dado</h2>
        <p>Se lanza un dado (<code>rand(1, 6)</code>) hasta obtener un 6. El bloque se ejecuta al menos una vez:</p>
        <div class="resultado">
            <p>Tiradas: <strong><?php echo implode(' → ', $tiradas); ?></strong></p>
            <p>Intentos: <strong><?php echo $intentos; ?></strong></p>
        </div>
        <p><a href="bucles.php">Recargar para lanzar de nuevo</a></p>

        <h3>for con continue y break</h3>
        <p>Números del 1 al 20, saltando múltiplos de 3 (<code>continue</code>) y deteniéndose al llegar a 17 (<code>break</code>):</p>
        <div class="resultado">
            <?php
            for ($n = 1; $n <= 20; $n++) {
                if ($n % 3 === 0) {
                    continue;
                }
                if ($n === 17) {
                    break;
                }
                echo $n . ' ';
            }
            ?>
        </div>
    </section>
</div>

<section class="tarjeta">
    <h2>foreach: carrito de compras</h2>
    <p>Se recorre un arreglo de productos con <code>foreach</code>, calculando el subtotal de cada uno y acumulando el total:</p>
    <div class="tabla-envoltura">
        <table>
            <thead><tr><th>#</th><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr></thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($productos as $indice => $producto):
                    $subtotal = $producto['precio'] * $producto['cantidad'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo $indice + 1; ?></td>
                        <td><?php echo e($producto['nombre']); ?></td>
                        <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4"><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<section class="tarjeta">
    <h2>foreach con clave y valor: días de la semana</h2>
    <ul class="chips">
        <?php foreach ($diasSemana as $posicion => $dia): ?>
            <?php if ($posicion + 1 === (int) date('N')): ?>
                <li class="celda-resaltada"><?php echo ($posicion + 1) . '. ' . $dia; ?> (hoy)</li>
            <?php else: ?>
                <li><?php echo ($posicion + 1) . '. ' . $dia; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'includes/footer.php'; ?>
