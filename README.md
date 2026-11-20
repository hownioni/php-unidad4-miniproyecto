# Mini Proyecto 1 · Unidad 4: Desarrollo Web con PHP

Sitio web dinámico en PHP que demuestra variables, tipos de datos, estructuras de control, arreglos y manejo de sesiones.

## Equipo

- Enrique Alejandro Alvares Escobar
- José Luis Gómez Gutiérrez
- Sergio Luna Antón

## Materia

**Programación Web**, Unidad 4: Programación del lado del servidor con PHP.

## Descripción

El sistema tiene 6 páginas PHP con el mismo encabezado, menú y pie de página, que se reutilizan con `require`. Cada página explica un tema y muestra ejemplos que PHP ejecuta en el servidor (tablas generadas con bucles, decisiones con datos que cambian como la hora, el día o números aleatorios, etc.).

La sesión se inicia desde `index.php`. En ese momento se guarda la hora de inicio con `time()` en `$_SESSION`, y a partir de ahí todas las páginas muestran:

```txt
Hora inicio sesión: 10:15:32
Hora actual: 10:18:10
Tiempo activo: 2 minutos 38 segundos
```

Desde el index (o desde `sesiones.php`) se puede **reiniciar** la sesión, que la destruye y crea una nueva hora de inicio, o **salir**, que la destruye y obliga a iniciarla de nuevo.

## Temas PHP implementados

| Página | Tema | Qué se demuestra |
| --- | --- | --- |
| `index.php` | Inicio de sesión | `session_start()`, `$_SESSION['inicio'] = time()`, `session_destroy()`, reinicio y salida |
| `variables.php` | Variables y tipos de datos | `string`, `int`, `float`, `boolean`, `array`, `null`, constantes, `echo`, `date()`, `count()`, `gettype()`, `var_dump()`, casting |
| `condicionales.php` | Condicionales | `if`, `else`, `elseif`, `switch` (incluye casos agrupados y `switch(true)`), operadores de comparación y lógicos, ternario |
| `bucles.php` | Bucles | `for` (tabla de multiplicar y tabla pitagórica anidada), `while`, `do...while`, `foreach`, `break`, `continue` |
| `arreglos.php` | Arreglos | Indexado, asociativo y multidimensional; recorrido con `foreach` y condicionales; `array_push`, `sort`, `in_array`, `array_column`, `array_filter`, `array_map`, etc. |
| `sesiones.php` | Sesiones | `session_id()`, contenido de `$_SESSION`, cálculo paso a paso del tiempo activo (`time()`, `intdiv`, `%`), contador de visitas por página |

## Estructura

```
/
├── index.php
├── variables.php
├── condicionales.php
├── bucles.php
├── arreglos.php
├── sesiones.php
├── css/
│   └── styles.css
├── includes/
│   ├── sesion.php     # session_start() y funciones de tiempo activo
│   ├── header.php     # encabezado + panel de sesión
│   ├── menu.php       # menú generado con foreach
│   └── footer.php
└── img/
    ├── logo.svg       # logo del encabezado
    └── favicon.svg    # ícono de la pestaña
```

## Ejecutar localmente

```bash
php -S localhost:8000
```

Después abre <http://localhost:8000> en el navegador.

## Enlaces

- Repositorio: <https://github.com/hownioni/php-unidad4-miniproyecto>
- Sitio publicado: <http://minipeweb4.infinityfree.io/index.php>
