<?php
include('includes/db.php');
include('header.php');

// Verificar se a exclusão foi requisitada
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Certificar que o valor é um inteiro

    // Query de exclusão no banco de dados
    $sql = "DELETE FROM Chamados WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "Chamado excluído com sucesso!";
    } else {
        echo "Erro ao excluir chamado: " . $conn->error;
    }

    // Redirecionar para evitar múltiplas requisições GET
    header('Location: listar_chamados.php');
    exit;
}

// Query para listar chamados
$sql = "SELECT Chamados.id, Chamados.descricao, Chamados.criticidade, Chamados.status, Chamados.data_abertura, 
        Clientes.nome AS cliente_nome, 
        Colaboradores.nome AS colaborador_nome 
        FROM Chamados 
        LEFT JOIN Clientes ON Chamados.cliente_id = Clientes.id 
        LEFT JOIN Colaboradores ON Chamados.colaborador_id = Colaboradores.id";
$result = $conn->query($sql);
?>

<h1>Lista de Chamados</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Criticidade</th>
        <th>Status</th>
        <th>Data de Abertura</th>
        <th>Cliente</th>
        <th>Colaborador</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['descricao']; ?></td>
            <td><?php echo ucfirst($row['criticidade']); ?></td>
            <td><?php echo ucfirst($row['status']); ?></td>
            <td><?php echo date('d/m/Y H:i', strtotime($row['data_abertura'])); ?></td> <!-- Exibindo a data formatada -->
            <td><?php echo $row['cliente_nome']; ?></td>
            <td><?php echo $row['colaborador_nome'] ? $row['colaborador_nome'] : 'Não atribuído'; ?></td>
            <td>
                <a href="editar_chamado.php?id=<?php echo $row['id']; ?>">Editar</a>
                |
                <a href="listar_chamados.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este chamado?');">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php
$conn->close();
?>
