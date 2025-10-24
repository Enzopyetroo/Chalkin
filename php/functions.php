<?php
session_start();

function enviarMsg($msg, $unix) {
    include "config.php";
    $id = $_SESSION["id"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO tb_mensagens (conteudo, datamensagem, idusuario)
    VALUES ('$msg', '$unix', $id)";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function Logoff() {
    session_unset();
    echo "Logoff";
}

function mudarNome($nome) {
    include "config.php";
    $id = $_SESSION["id"];
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE tb_usuarios_tb_config
        SET nome_exib = '$nome'
        WHERE id = $id";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function mudarCorNome($cor) {
    include "config.php";
    $cor = '#' . $cor;
    $id = $_SESSION["id"];
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE tb_usuarios_tb_config
        SET cor_nome = '$cor'
        WHERE id = $id";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function mudarFoto($foto) {
    include "config.php";
    $id = $_SESSION["id"];
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE tb_usuarios_tb_config
        SET numImg = '$foto'
        WHERE id = $id";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function mudarDesc($texto) {
    include "config.php";
    $id = $_SESSION["id"];
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE tb_usuarios_tb_config
        SET descri = '$texto'
        WHERE id = $id";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

$action = $_GET['action'] ?? 'default';
$param = $_GET['param'] ?? 'default';
$param2 = $_GET['param2'] ?? 'default';

switch ($action) {
    case 'default':
        case 'enviarMsg':
            enviarMsg($param, $param2);
        break;

        case 'logoff':
            Logoff();
        break;

        case 'mudarNome':
            mudarNome($param);
        break;

        case 'mudarCorNome':
            mudarCorNome($param);
        break;

        case 'mudarFoto':
            mudarFoto($param);
        break;

        case 'mudarDesc':
            mudarDesc($param);
        break;
        

    default:
        http_response_code(400);
        echo json_encode(["error" => "Unknown action"]);
        break;
}
?>