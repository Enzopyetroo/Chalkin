<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
        *
        FROM tb_mensagens

        INNER JOIN tb_usuarios_tb_config ON tb_mensagens.idusuario = tb_usuarios_tb_config.id
        LEFT JOIN tb_imagens ON tb_usuarios_tb_config.id_img = tb_imagens.id
         
        ORDER BY tb_mensagens.datamensagem;
";
$result = $conn->query($sql);

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