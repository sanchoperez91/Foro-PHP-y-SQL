<?php

// Llamada a la conexión
require_once '../Db/con1Db.php';
// Llamada al modelo
require_once '../Models/respuestasConsulta1Model.php';   

// Verificar si el parámetro 'idNumCom' está presente en la URL
  // Verificar si el parámetro 'idNumCom' está presente en la URL
  if (isset($_GET['ide_pos'])) {
    $numero = intval($_GET['ide_pos']); // Convertir a entero
} else {
    $numero = 0; // Valor predeterminado si no está presente
}

// Instanciación del objeto
$obj1 = new Datos;
// Definición de la instrucción
$sql1 = "SELECT 
u.nom_usu, 
r.tex_res, 
r.fec_res
FROM respuestas r
JOIN usuarios u ON r.ide_usu = u.ide_usu
WHERE r.ide_pos = ?";

        
// Llamada al método
$data1 = $obj1->getData1($sql1, $numero);

// Devolución de datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>
