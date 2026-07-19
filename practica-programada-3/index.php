<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado de cuenta</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        margin: 0;
        padding: 40px;
    }

    .contenedor {
        max-width: 700px;
        margin: auto;
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.10);
    }

    h2 {
        text-align: center;
        color: #1f3c5b;
    }

    hr {
        border: none;
        border-top: 1px solid #cccccc;
        margin: 20px 0;
    }

    a {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 16px;
        background-color: #1f3c5b;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    a:hover {
        background-color: #162d44;
    }
</style>
</head>
</div>
<body>
<div class="contenedor">

<?php

// Arreglo donde se almacenarán las transacciones
$transacciones = [];

// Función para registrar una transacción
function registrarTransaccion(&$transacciones, $id, $descripcion, $monto)
{
    $transacciones[] = [
        "id" => $id,
        "descripcion" => $descripcion,
        "monto" => $monto
    ];
}

// Registrar transacciones
registrarTransaccion($transacciones, 1, "Supermercado", 25000);
registrarTransaccion($transacciones, 2, "Gasolina", 18000);
registrarTransaccion($transacciones, 3, "Restaurante", 12500);

// Función para generar el estado de cuenta
function generarEstadoDeCuenta($transacciones)
{
    $total = 0;

    echo "<h2>ESTADO DE CUENTA</h2>";
    echo "<hr>";

    foreach ($transacciones as $transaccion)
    {
        echo "<strong>ID:</strong> " . $transaccion["id"] . "<br>";
        echo "<strong>Descripción:</strong> " . $transaccion["descripcion"] . "<br>";
        echo "<strong>Monto:</strong> ₡" . number_format($transaccion["monto"], 2) . "<br><br>";

        $total += $transaccion["monto"];
    }

    $interes = $total * 0.026;
    $cashback = $total * 0.001;
    $totalConInteres = $total + $interes;
    $montoFinal = $totalConInteres - $cashback;

    $contenidoArchivo = "========= ESTADO DE CUENTA =========\n\n";

    foreach ($transacciones as $transaccion)
    {
        $contenidoArchivo .= "ID: " . $transaccion["id"] . "\n";
        $contenidoArchivo .= "Descripción: " . $transaccion["descripcion"] . "\n";
        $contenidoArchivo .= "Monto: ₡" . number_format($transaccion["monto"], 2) . "\n\n";
    }

    $contenidoArchivo .= "------------------------------------\n";
    $contenidoArchivo .= "Total: ₡" . number_format($total, 2) . "\n";
    $contenidoArchivo .= "Interés (2.6%): ₡" . number_format($interes, 2) . "\n";
    $contenidoArchivo .= "Total con interés: ₡" . number_format($totalConInteres, 2) . "\n";
    $contenidoArchivo .= "Cash Back (0.1%): ₡" . number_format($cashback, 2) . "\n";
    $contenidoArchivo .= "Monto final: ₡" . number_format($montoFinal, 2) . "\n";

    file_put_contents("estado_cuenta.txt", $contenidoArchivo);

    echo "<hr>";
    echo "<strong>Total:</strong> ₡" . number_format($total, 2) . "<br>";
    echo "<strong>Interés (2.6%):</strong> ₡" . number_format($interes, 2) . "<br>";
    echo "<strong>Total con interés:</strong> ₡" . number_format($totalConInteres, 2) . "<br>";
    echo "<strong>Cash Back (0.1%):</strong> ₡" . number_format($cashback, 2) . "<br>";
    echo "<strong>Monto Final:</strong> ₡" . number_format($montoFinal, 2) . "<br>";

    echo "<br><em>El archivo estado_cuenta.txt fue generado correctamente.</em><br><br>";
    echo '<a href="estado_cuenta.txt" target="_blank">Ver estado de cuenta en archivo TXT</a>';
}

// Ejecutar la función y mostrar el estado de cuenta
generarEstadoDeCuenta($transacciones);

?>

</div>

</body>
</html>