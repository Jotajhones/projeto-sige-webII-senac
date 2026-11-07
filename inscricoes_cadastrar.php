<?php
require_once 'classes/Inscricao.php';
require_once 'classes/Evento.php';
require_once 'classes/Participante.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $inscricao = new Inscricao();
        $inscricao->participante_id = $_POST['participante_id'];
        $inscricao->evento_id = $_POST['evento_id'];

        if ($inscricao->cadastrar()) {
            header('Location: inscricoes_listar.php');
            exit;
        } else {
            $erro = "Erro desconhecido ao registrar inscrição.";
        }
    } catch (PDOException $e) {
        $erro = "Erro de Banco de Dados: " . $e->getMessage();
    }
}

$eventoObj = new Evento();
$eventos = $eventoObj->listar();

$participanteObj = new Participante();
$participantes = $participanteObj->listar();

require_once 'includes/header.php';
?>

<h2>Registrar Inscrição</h2>

<?php if (!empty($erro)): ?>
    <div class="alerta-erro">
        <strong>Atenção:</strong> <?= $erro ?>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div class="form-group">
        <label>Participante:</label><br>
        <select name="participante_id" class="form-control" required>
            <option value="">Selecione um participante...</option>
            <?php foreach ($participantes as $p): ?>
                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Evento:</label><br>
        <select name="evento_id" class="form-control" required>
            <option value="">Selecione um evento...</option>
            <?php foreach ($eventos as $e): ?>
                <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn-sucesso">Salvar Inscrição</button>
</form>

<?php require_once 'includes/footer.php'; ?>