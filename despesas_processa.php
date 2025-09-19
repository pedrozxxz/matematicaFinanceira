<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST["descricao"];
    $valor = $_POST["valor"];
    $categoria = $_POST["categoria"];

    $sql = "INSERT INTO despesas (descricao, valor, categoria) VALUES ('$descricao','$valor','$categoria')";
    if ($conn->query($sql) === TRUE) {
        header("Location: despesas.php");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>