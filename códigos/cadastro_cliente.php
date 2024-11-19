<?php
include('includes/db.php');
include('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido!";
    } else {
        $sql = "INSERT INTO Clientes (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Cliente cadastrado com sucesso!";
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<form method="POST" action="cadastro_cliente.php">
    Nome: <input type="text" name="nome" required><br>
    E-mail: <input type="email" name="email" required><br>
    Telefone: <input type="text" name="telefone" required><br>
    <input type="submit" value="Cadastrar Cliente">
</form>

</body>
</html>
