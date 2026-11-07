<?php
require_once 'classes/Evento.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $evento = new Evento();
        $evento->nome = $_POST['nome'];
        $evento->descricao = $_POST['descricao'];
        $evento->data_evento = $_POST['data_evento'];
        $evento->local = $_POST['local'];

        if ($evento->cadastrar()) {
            header('Location: eventos_listar.php');
            exit;
        } else {
            $erro = "Erro desconhecido ao cadastrar evento.";
        }
    } catch (PDOException $e) {
        $erro = "Erro de Banco de Dados: " . $e->getMessage();
    }
}

require_once 'includes/header.php';
?>

<h2>Cadastrar Evento</h2>

<?php if (!empty($erro)): ?>
    <div class="alerta-erro">
        <strong>Atenção:</strong> <?= $erro ?>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div class="form-group">
        <label>Nome do Evento:</label><br>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Descrição:</label><br>
        <textarea name="descricao" rows="4" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label>Data:</label><br>
        <input type="date" name="data_evento" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Local:</label><br>
        <input type="text" name="local" class="form-control" required>
    </div>
    <button type="submit" class="btn-sucesso">Salvar Evento</button>
</form>

<?php require_once 'includes/footer.php'; ?>