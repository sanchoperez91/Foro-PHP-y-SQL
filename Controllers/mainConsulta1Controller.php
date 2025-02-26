<?php

    // Llamada a la conexión
    require_once '../Db/con1Db.php';
    // Llamada al modelo
    require_once '../Models/mainConsulta1Model.php';    

    // Instanciación del objeto
    $obj1 = new Datos;
    // Definición de la instrucción
    $sql1 = "SELECT u.nom_usu, p.tit_pos, p.fec_pos, p.can_pos, p.ide_pos
    FROM posts p
    JOIN usuarios u ON p.ide_usu = u.ide_usu;";
    // Llamada al método
    $data1 = $obj1->getData1($sql1);

    // Devolución de datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data1, JSON_UNESCAPED_UNICODE);

?>
