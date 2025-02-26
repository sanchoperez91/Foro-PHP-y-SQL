<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $ide_usu = $_POST['ide_usu'] ?? null;
    $tit_pos = $_POST['tit_pos'] ?? null;
    $tex_pos = $_POST['tex_pos'] ?? null;
    $fec_pos = date('Y-m-d H:i:s');
    $can_pos = 0;
    

    // Validar que los datos no estén vacíos
    if (!$ide_usu || !$tit_pos || !$tex_pos || !$fec_pos ) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO posts (ide_usu, tit_pos, tex_pos, fec_pos, can_pos) VALUES (?, ?, ?, ?, ?)";
    $typeParameters = "isssi";

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters, $ide_usu, $tit_pos, $tex_pos, $fec_pos, $can_pos);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>