<?php
/*
 * sesion.php
 * Lógica común de sesión que se carga en TODAS las páginas.
 * - Configura la zona horaria para que date() muestre la hora local.
 * - Inicia (o reanuda) la sesión con session_start().
 * - Ofrece funciones auxiliares para calcular el tiempo activo.
 */

date_default_timezone_set('America/Mexico_City');

// session_start() crea una sesión nueva o reanuda la existente
// (identificada por la cookie PHPSESSID que envía el navegador).
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Indica si el usuario ya inició sesión desde el index.
 */
function sesionActiva(): bool
{
    return isset($_SESSION['inicio']);
}

/**
 * Calcula el tiempo activo: hora actual - hora de inicio de sesión.
 * Devuelve un arreglo asociativo con el total en segundos,
 * y su conversión a minutos y segundos.
 */
function tiempoActivo(): array
{
    $total    = time() - $_SESSION['inicio'];  // diferencia en segundos
    $minutos  = intdiv($total, 60);            // minutos completos
    $segundos = $total % 60;                   // segundos restantes

    return [
        'total'    => $total,
        'minutos'  => $minutos,
        'segundos' => $segundos,
    ];
}

/**
 * Devuelve el texto "X minutos Y segundos" respetando singular/plural.
 */
function formatoTiempo(int $minutos, int $segundos): string
{
    $txtMin = $minutos === 1 ? 'minuto' : 'minutos';
    $txtSeg = $segundos === 1 ? 'segundo' : 'segundos';
    return "$minutos $txtMin $segundos $txtSeg";
}

/**
 * Lleva en la sesión un contador de visitas por página.
 */
function registrarVisita(string $pagina): void
{
    if (!sesionActiva()) {
        return;
    }
    if (!isset($_SESSION['visitas'][$pagina])) {
        $_SESSION['visitas'][$pagina] = 0;
    }
    $_SESSION['visitas'][$pagina]++;
}

/**
 * Escapa texto antes de imprimirlo en HTML.
 */
function e($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
