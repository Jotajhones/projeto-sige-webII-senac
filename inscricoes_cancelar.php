<?php
require_once 'classes/Inscricao.php';

if (isset($_GET['id'])) {
    try {
        $inscricaoObj = new Inscricao();
        $inscricaoObj->cancelar($_GET['id']);
    } catch (PDOException $e) {
    }
}

header('Location: inscricoes_listar.php');
exit;