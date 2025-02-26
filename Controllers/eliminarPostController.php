<?php
session_start();
require_once '../Models/eliminarPostModel.php';

if (!isset($_SESSION['ide_usu'])) {
    echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
    exit();
}

// Leer el cuerpo de la solicitud en formato JSON
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['ide_pos'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID de post no proporcionado']);
    exit();
}

$ide_usu = $_SESSION['ide_usu'];
$ide_pos = $input['ide_pos'];

$postModel = new PostModel();
$post = $postModel->getPostById($ide_pos);

if (!$post) {
    echo json_encode(['status' => 'error', 'message' => 'Post no encontrado']);
    exit();
}

if ($post['ide_usu'] != $ide_usu) {
    echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para eliminar este post']);
    exit();
}

$result = $postModel->deletePost($ide_pos);

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Post eliminado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el post']);
}