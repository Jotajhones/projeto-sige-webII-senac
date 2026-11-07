<?php
require_once 'includes/header.php';
require_once 'classes/Participante.php';

$participanteObj = new Participante();
$participantes = $participanteObj->listar();
?>

<h2>Lista de Participantes</h2>
<a href="participantes_cadastrar.php" class="btn-novo">+ Cadastrar Novo Participante</a>

<table class="tabela-dados">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($participantes as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['nome'] ?></td>
            <td><?= $p['email'] ?></td>
            <td><?= $p['telefone'] ?></td>
            <td>
                <a href="participantes_editar.php?id=<?= $p['id'] ?>">Editar</a> |
                <a href="participantes_excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este participante? As inscrições dele também serão apagadas.');">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'includes/footer.php'; ?>