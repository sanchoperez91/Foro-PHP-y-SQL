<?php
session_start();
header('Content-Type: application/json');

try {
    require_once "../Models/eliminarpostmodel.php"; 
    $postModel = new PostModel(); 

    $ide_usu = $_SESSION['ide_usu'] ?? null; 
    $ide_pos = $_POST['ide_pos'] ?? null; 
    $tit_pos = $_POST['tit_pos'] ?? null; 
    $tex_pos = $_POST['tex_pos'] ?? null; 

    if (!$ide_usu || !$ide_pos || !$tit_pos || !$tex_pos) {
        throw new Exception("Datos incompletos.");
    }

    // Intentar actualizar el post
    $resultado = $postModel->updatePost($ide_pos, $tit_pos, $tex_pos, $ide_usu);

    if ($resultado) {
        echo json_encode(["status" => "success", "message" => "Post actualizado correctamente."]);
    } else {
        throw new Exception("No tienes permisos para editar este post o no se realizaron cambios.");
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>
