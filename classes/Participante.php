<?php
require_once 'Conexao.php';

class Participante {
    public $id;
    public $nome;
    public $email;
    public $telefone;

    public function cadastrar() {
        $pdo = Conexao::getConexao();$sql = "INSERT INTO participantes (nome, email, telefone) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->nome, $this->email,$this->telefone]);
    }

    public function listar() {
        $pdo = Conexao::getConexao();$sql = "SELECT * FROM participantes ORDER BY nome ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $pdo = Conexao::getConexao();$sql = "SELECT * FROM participantes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar() {
        $pdo = Conexao::getConexao();$sql = "UPDATE participantes SET nome = ?, email = ?, telefone = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->nome,$this->email, $this->telefone,$this->id]);
    }

    public function excluir($id) {
        $pdo = Conexao::getConexao();$sql = "DELETE FROM participantes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}