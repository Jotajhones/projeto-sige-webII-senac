<?php
require_once 'Conexao.php';

class Evento {
    public $id;
    public $nome;
    public $descricao;
    public $data_evento;
    public $local;

    public function cadastrar() {
        $pdo = Conexao::getConexao();
        $sql = "INSERT INTO eventos (nome, descricao, data_evento, local) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->nome, $this->descricao, $this->data_evento, $this->local]);
    }

    public function listar() {
        $pdo = Conexao::getConexao();
        $sql = "SELECT * FROM eventos ORDER BY data_evento ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $pdo = Conexao::getConexao();
        $sql = "SELECT * FROM eventos WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar() {
        $pdo = Conexao::getConexao();
        $sql = "UPDATE eventos SET nome = ?, descricao = ?, data_evento = ?, local = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->nome, $this->descricao, $this->data_evento, $this->local, $this->id]);
    }

    public function excluir($id) {
        $pdo = Conexao::getConexao();
        $sql = "DELETE FROM eventos WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}