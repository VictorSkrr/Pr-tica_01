<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $criticidade = $_POST['criticidade'];
    $descricao = $_POST['descricao'];
    $data_abertura = $_POST['data_abertura'];

    $sql = "INSERT INTO Chamados (status, criticidade, descricao, data_abertura) 
            VALUES ('$status', '$criticidade', '$descricao', '$data_abertura')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro: " . $conn->error;
    }

    $conn->close();
}
?>