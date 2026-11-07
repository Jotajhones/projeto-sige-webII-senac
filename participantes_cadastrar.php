<?php
require_once 'classes/Participante.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $participante = new Participante();
        $participante->nome = $_POST['nome'];
        $participante->email = $_POST['email'];
        $participante->telefone = $_POST['telefone'];

        if ($participante->cadastrar()) {
            header('Location: participantes_listar.php');
            exit;
        } else {
            $erro = "Erro desconhecido ao cadastrar participante.";
        }
    } catch (PDOException $e) {
        $erro = "Erro de Banco de Dados: " . $e->getMessage();
    }
}

require_once 'includes/header.php';
?>

<h2>Cadastrar Participante</h2>

<?php if (!empty($erro)): ?>
    <div class="alerta-erro">
        <strong>Atenção:</strong> <?= $erro ?>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div class="form-group">
        <label>Nome do Participante:</label><br>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <label>E-mail:</label><br>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Telefone:</label><br>
        <input type="text" name="telefone" class="form-control">
    </div>
    <button type="submit" class="btn-sucesso">Salvar Participante</button>
</form>

<?php require_once 'includes/footer.php'; ?>