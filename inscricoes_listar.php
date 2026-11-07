<?php
require_once 'includes/header.php';
require_once 'classes/Inscricao.php';

$inscricaoObj = new Inscricao();
$inscricoes = $inscricaoObj->listar();
?>

<h2>Lista de Inscrições</h2>
<a href="inscricoes_cadastrar.php" class="btn-novo">+ Nova Inscrição</a>

<table class="tabela-dados">
    <thead>
        <tr>
            <th>ID</th>
            <th>Participante</th>
            <th>Evento</th>
            <th>Data da Inscrição</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inscricoes as $i): ?>
        <tr>
            <td><?= $i['id'] ?></td>
            <td><?= htmlspecialchars($i['participante']) ?></td>
            <td><?= htmlspecialchars($i['evento']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($i['data_inscricao'])) ?></td>
            <td><?= $i['status'] ?></td>
            <td>
                <?php if ($i['status'] === 'Confirmada'): ?>
                    <a href="inscricoes_cancelar.php?id=<?= $i['id'] ?>" onclick="return confirm('Deseja realmente cancelar esta inscrição?');">Cancelar</a>
                <?php else: ?>
                    Cancelada
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'includes/footer.php'; ?>