<?php
include('includes/db.php');
include('header.php');

// Buscar todos os chamados
$sql = "SELECT Chamados.id, Clientes.nome AS cliente_nome, Chamados.descricao, Chamados.criticidade, Chamados.status 
        FROM Chamados
        JOIN Clientes ON Chamados.cliente_id = Clientes.id";
$result = $conn->query($sql);

echo "<h2>Lista de Chamados</h2>";
echo "<table>";
echo "<tr><th>Cliente</th><th>Descrição</th><th>Criticidade</th><th>Status</th><th>Ações</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['cliente_nome'] . "</td>
                <td>" . $row['descricao'] . "</td>
                <td>" . $row['criticidade'] . "</td>
                <td>" . $row['status'] . "</td>
                <td>
                    <a href='editar_chamado.php?id=" . $row['id'] . "'>Editar</a> |
                    <a href='excluir_chamado.php?id=" . $row['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este chamado?\")'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum chamado encontrado.";
}

$conn->close();
?>

