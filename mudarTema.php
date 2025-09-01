<?php
session_start();

include "config.php";

$cor1 = $_GET['cor1'];
$cor2 = $_GET['cor2'];
$cor3 = $_GET['cor3'];
$cor4 = $_GET['cor4'];
$id = $_SESSION["id"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
  $sql = "UPDATE tb_usuarios_tb_config
  SET cor1 = '$cor1', cor2 = '$cor2', cor3 = '$cor3', cor4 = '$cor4'
  WHERE id = '$id'";

if ($conn->query($sql) === FALSE) {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>