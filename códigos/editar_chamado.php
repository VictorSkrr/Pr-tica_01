<?php
include('includes/db.php');
include('header.php');

// Verificar se um ID de chamado foi passado
if (isset($_GET['id'])) {
    $chamado_id = $_GET['id'];

    // Buscar os dados do chamado
    $sql = "SELECT * FROM Chamados WHERE id = $chamado_id";
    $result = $conn->query($sql);
    $chamado = $result->fetch_assoc();

    // Se o chamado não existir, redirecionar
    if (!$chamado) {
        echo "Chamado não encontrado.";
        exit;
    }

    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $descricao = $_POST['descricao'];
        $criticidade = $_POST['criticidade'];
        $status = $_POST['status'];
        $colaborador_id = isset($_POST['colaborador_id']) ? $_POST['colaborador_id'] : NULL; // Garantir que se não houver colaborador, seja NULL

        // Atualizar o chamado no banco de dados
        $sql = "UPDATE Chamados SET descricao = '$descricao', criticidade = '$criticidade', status = '$status', colaborador_id = " . ($colaborador_id ? $colaborador_id : 'NULL') . " WHERE id = $chamado_id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Chamado atualizado com sucesso!";
            header('Location: listar_chamados.php'); // Redireciona de volta para a lista
            exit;
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<form method="POST" action="editar_chamado.php?id=<?php echo $chamado_id; ?>">
    Descrição: <textarea name="descricao" required><?php echo $chamado['descricao']; ?></textarea><br>

    Criticidade:
    <select name="criticidade">
        <option value="baixa" <?php if ($chamado['criticidade'] == 'baixa') echo 'selected'; ?>>Baixa</option>
        <option value="média" <?php if ($chamado['criticidade'] == 'média') echo 'selected'; ?>>Média</option>
        <option value="alta" <?php if ($chamado['criticidade'] == 'alta') echo 'selected'; ?>>Alta</option>
    </select><br>

    Status:
    <select name="status">
        <option value="aberto" <?php if ($chamado['status'] == 'aberto') echo 'selected'; ?>>Aberto</option>
        <option value="em andamento" <?php if ($chamado['status'] == 'em andamento') echo 'selected'; ?>>Em andamento</option>
        <option value="resolvido" <?php if ($chamado['status'] == 'resolvido') echo 'selected'; ?>>Resolvido</option>
    </select><br>

    Colaborador Responsável:
    <select name="colaborador_id">
        <option value="">Selecione um colaborador</option>
        <?php
        // Buscar colaboradores
        $sql = "SELECT id, nome FROM Colaboradores";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "' " . ($chamado['colaborador_id'] == $row['id'] ? 'selected' : '') . ">" . $row['nome'] . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Atualizar Chamado">
</form>

<?php
$conn->close();
?>

