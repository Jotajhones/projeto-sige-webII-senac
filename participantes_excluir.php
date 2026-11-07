<?php
require_once 'classes/Participante.php';

if (isset($_GET['id'])) {
    try {
        $participanteObj = new Participante();
        $participanteObj->excluir($_GET['id']);
    } catch (PDOException $e) {
        
    }
}

header('Location: participantes_listar.php');
exit;