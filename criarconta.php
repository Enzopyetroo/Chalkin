
<?php
include "config.php";

$nome = $_POST['fnome'];
$nomexib = $_POST['nomexib'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($email != null){
    $sql = "INSERT INTO tb_usuarios_tb_config (LOWER(nome), nome_exib, email, senha)
    VALUES ('$nome', '$nomexib', '$email', '$senha')";        
}

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
    exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>