<?php
session_start();
?>

<?php
include "config.php";

$conteudo = $_GET["msg"];
$id = $_SESSION["id"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO tb_mensagens (conteudo, datamensagem, idusuario)
VALUES ('$conteudo', CURRENT_TIMESTAMP(), $id)";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>