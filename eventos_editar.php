<?php
require_once 'classes/Evento.php';

$erro = "";
$eventoObj = new Evento();

if (!isset($_GET['id'])) {
    header('Location: eventos_listar.php');
    exit;
}

$id = $_GET['id'];
$dadosEvento = $eventoObj->buscarPorId($id);

if (!$dadosEvento) {
    header('Location: eventos_listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $eventoObj->id = $id;
        $eventoObj->nome = $_POST['nome'];
        $eventoObj->descricao = $_POST['descricao'];
        $eventoObj->data_evento = $_POST['data_evento'];
        $eventoObj->local = $_POST['local'];

        if ($eventoObj->editar()) {
            header('Location: eventos_listar.php');
            exit;
        } else {
            $erro = "Erro desconhecido ao editar evento.";
        }
    } catch (PDOException $e) {
        $erro = "Erro de Banco de Dados: " . $e->getMessage();
    }
}

require_once 'includes/header.php';
?>

<h2>Editar Evento</h2>

<?php if (!empty($erro)): ?>
    <div class="alerta-erro">
        <strong>Atenção:</strong> <?= $erro ?>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div class="form-group">
        <label>Nome do Evento:</label><br>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($dadosEvento['nome']) ?>" required>
    </div>
    <div class="form-group">
        <label>Descrição:</label><br>
        <textarea name="descricao" rows="4" class="form-control"><?= htmlspecialchars($dadosEvento['descricao']) ?></textarea>
    </div>
    <div class="form-group">
        <label>Data:</label><br>
        <input type="date" name="data_evento" class="form-control" value="<?= $dadosEvento['data_evento'] ?>" required>
    </div>
    <div class="form-group">
        <label>Local:</label><br>
        <input type="text" name="local" class="form-control" value="<?= htmlspecialchars($dadosEvento['local']) ?>" required>
    </div>
    <button type="submit" class="btn-sucesso">Atualizar Evento</button>
</form>

<?php require_once 'includes/footer.php'; ?>