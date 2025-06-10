<?php
session_start();
?>

<?php
include "config.php";
$id = $_SESSION["id"];

$conteudo = $_GET['cor'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE tb_usuarios_tb_config
        SET cor_nome = '$conteudo'
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
  echo "$conteudo";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
