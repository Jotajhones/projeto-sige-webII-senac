<?php
require_once 'Conexao.php';

class Inscricao {
    public $id;
    public $participante_id;
    public $evento_id;
    public $status;

    public function cadastrar() {
        $pdo = Conexao::getConexao();
        $sql = "INSERT INTO inscricoes (participante_id, evento_id) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->participante_id, $this->evento_id]);
    }

    public function listar() {
        $pdo = Conexao::getConexao();
        $sql = "SELECT i.id, p.nome AS participante, e.nome AS evento, i.data_inscricao, i.status 
                FROM inscricoes i 
                JOIN participantes p ON i.participante_id = p.id 
                JOIN eventos e ON i.evento_id = e.id 
                ORDER BY i.data_inscricao DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cancelar($id) {
        $pdo = Conexao::getConexao();
        $sql = "UPDATE inscricoes SET status = 'Cancelada' WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}