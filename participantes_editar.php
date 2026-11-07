<?php
require_once 'classes/Participante.php';

$erro = "";
$participanteObj = new Participante();

if (!isset($_GET['id'])) {
    header('Location: participantes_listar.php');
    exit;
}

$id = $_GET['id'];
$dadosParticipante = $participanteObj->buscarPorId($id);

if (!$dadosParticipante) {
    header('Location: participantes_listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $participanteObj->id = $id;
        $participanteObj->nome = $_POST['nome'];
        $participanteObj->email = $_POST['email'];
        $participanteObj->telefone = $_POST['telefone'];

        if ($participanteObj->editar()) {
            header('Location: participantes_listar.php');
            exit;
        } else {
            $erro = "Erro desconhecido ao editar participante.";
        }
    } catch (PDOException $e) {
        $erro = "Erro de Banco de Dados: " . $e->getMessage();
    }
}

require_once 'includes/header.php';
?>

<h2>Editar Participante</h2>

<?php if (!empty($erro)): ?>
    <div class="alerta-erro">
        <strong>Atenção:</strong> <?= $erro ?>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div class="form-group">
        <label>Nome do Participante:</label><br>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($dadosParticipante['nome']) ?>" required>
    </div>
    <div class="form-group">
        <label>E-mail:</label><br>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($dadosParticipante['email']) ?>" required>
    </div>
    <div class="form-group">
        <label>Telefone:</label><br>
        <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($dadosParticipante['telefone']) ?>">
    </div>
    <button type="submit" class="btn-sucesso">Atualizar Participante</button>
</form>

<?php require_once 'includes/footer.php'; ?>