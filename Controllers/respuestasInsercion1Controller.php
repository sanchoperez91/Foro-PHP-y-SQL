<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $ide_pos = $_POST['ide_pos'] ?? null;
    $ide_usu = $_POST['ide_usu'] ?? null;
    $tex_res = $_POST['tex_res'] ?? null;
    $fec_res = date('Y-m-d H:i:s');

    // Validar que los datos no estén vacíos
    if (!$ide_pos || !$ide_usu || !$tex_res || !$fec_res ) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL para insertar la respuesta
    $sql1 = "INSERT INTO respuestas (ide_pos, ide_usu, tex_res, fec_res) VALUES (?, ?, ?, ?)";
    $typeParameters = "iiss";

    // Llamar al método del modelo para insertar los datos de la respuesta
    $data1 = $obj1->insertData($sql1, $typeParameters, $ide_pos, $ide_usu, $tex_res, $fec_res);

    // Definir la instrucción SQL para actualizar el contador de respuestas del post
    $sql2 = "UPDATE posts p
            JOIN (SELECT ide_pos, COUNT(ide_res) AS total_respuestas
                FROM respuestas
                GROUP BY ide_pos) r
            ON p.ide_pos = r.ide_pos
            SET p.can_pos = r.total_respuestas
            WHERE p.ide_pos = ?";
    $typeParameters2 = "i";

    // Llamar al método del modelo para actualizar el contador de respuestas
    $data2 = $obj1->insertData($sql2, $typeParameters2, $ide_pos);

    // Enviar la respuesta como JSON
    echo json_encode(["status" => "success", "message" => "agregada correctamente", "data" => $data1]);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>
