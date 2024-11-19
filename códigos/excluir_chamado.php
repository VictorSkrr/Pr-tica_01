<?php
include('includes/db.php');

// Verificar se um ID de chamado foi passado
if (isset($_GET['id'])) {
    $chamado_id = $_GET['id'];

    // Excluir o chamado do banco de dados
    $sql = "DELETE FROM Chamados WHERE id = $chamado_id";

    if ($conn->query($sql) === TRUE) {
        echo "Chamado excluído com sucesso!";
        header('Location: listar_chamados.php'); // Redireciona para a lista após exclusão
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
}

$conn->close();
?>

