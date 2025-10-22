<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);
$max_id = 0;
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
        MAX(id_msg) AS max_id
        FROM tb_mensagens
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $max_id = $row['max_id'];
}
$earliestID = $_POST["earliestID"];

if ($earliestID == "undefined" || $earliestID == -1){
  $earliestID = $max_id;
}

$sql2 = "SELECT 
        *
        FROM tb_mensagens

        INNER JOIN tb_usuarios_tb_config ON tb_mensagens.idusuario = tb_usuarios_tb_config.id
        WHERE tb_mensagens.id_msg < $earliestID+1 AND tb_mensagens.id_msg > $earliestID-50
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
