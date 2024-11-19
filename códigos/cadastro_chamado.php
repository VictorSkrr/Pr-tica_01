<?php
include('includes/db.php');
include('header.php');

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $descricao = $_POST['descricao'];
    $criticidade = $_POST['criticidade'];
    $status = 'aberto';  // Status padrão

    // Inserir o chamado no banco de dados
    $sql = "INSERT INTO Chamados (cliente_id, descricao, criticidade, status) 
            VALUES ('$cliente_id', '$descricao', '$criticidade', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Chamado registrado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}

?>

<form method="POST" action="cadastro_chamado.php">
    <!-- Selecione um cliente existente -->
    Cliente:
    <select name="cliente_id" required>
        <option value="">Selecione um cliente</option>
        <?php
        // Buscar todos os clientes cadastrados
        $sql = "SELECT id, nome FROM Clientes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Exibir cada cliente no select
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
            }
        } else {
            echo "<option value=''>Nenhum cliente cadastrado</option>";
        }
        ?>
    </select><br>

    Descrição: <textarea name="descricao" required></textarea><br>

    Criticidade:
    <select name="criticidade">
        <option value="baixa">Baixa</option>
        <option value="média">Média</option>
        <option value="alta">Alta</option>
    </select><br>

    <input type="submit" value="Registrar Chamado">
</form>

</body>
</html>
