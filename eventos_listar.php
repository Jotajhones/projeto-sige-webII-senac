<?php
require_once 'includes/header.php';
require_once 'classes/Evento.php';

$eventoObj = new Evento();
$eventos = $eventoObj->listar();
?>

<h2>Lista de Eventos</h2>
<a href="eventos_cadastrar.php" class="btn-novo">+ Cadastrar Novo Evento</a>

<table class="tabela-dados">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data</th>
            <th>Local</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventos as $e): ?>
        <tr>
            <td><?= $e['id'] ?></td>
            <td><?= $e['nome'] ?></td>
            <td><?= date('d/m/Y', strtotime($e['data_evento'])) ?></td>
            <td><?= $e['local'] ?></td>
            <td>
                <a href="eventos_editar.php?id=<?= $e['id'] ?>">Editar</a> |
                <a href="eventos_excluir.php?id=<?= $e['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este evento?');">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'includes/footer.php'; ?>