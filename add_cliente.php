<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_cliente = $_POST['nome_cliente'];
    $email_cliente = $_POST['email_cliente'];
    $telefone_cliente = $_POST['telefone_cliente'];

    $sql = "INSERT INTO Clientes (nome, emial, telefone) 
            VALUES ('$nome_cliente', '$email_cliente', '$telefone_cliente')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro: " . $conn->error;
    }

    $conn->close();
}
?>