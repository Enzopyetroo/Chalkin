<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$chat = $_POST["chat"];

$sql = "SELECT COUNT(*) FROM tb_mensagens WHERE tb_mensagens.chat = '$chat';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo $row["COUNT(*)"];
  }
} else {
  echo "0 resultados";
}
$conn->close();
?>