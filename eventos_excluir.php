<?php
require_once 'classes/Evento.php';

if (isset($_GET['id'])) {
    try {
        $eventoObj = new Evento();
        $eventoObj->excluir($_GET['id']);
    } catch (PDOException $e) {
        
    }
}

header('Location: eventos_listar.php');
exit;