<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);
$max_id = 0;
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$numMensagens = $_POST["numMensagens"];

$sql = "SELECT 
        MAX(id_msg) AS max_id
        FROM tb_mensagens
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $max_id = $row['max_id'];
}
$sql2 = "SELECT 
        *
        FROM tb_mensagens

        INNER JOIN tb_usuarios_tb_config ON tb_mensagens.idusuario = tb_usuarios_tb_config.id
        WHERE tb_mensagens.id_msg < $max_id+1 AND tb_mensagens.id_msg > $max_id-$numMensagens
        ORDER BY tb_mensagens.datamensagem;
";
$result = $conn->query($sql2);

if ($result->num_rows > 0) {
  while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $data[] = $row;
  }
  echo json_encode($data);
} else {
  echo "0 resultados";
}
$conn->close();
?>