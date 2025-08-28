<?php
session_start();
?>

<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify the username and password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["fnome"];
    $senha = md5($_POST["senha"]);

    if(filter_var("$nome", FILTER_VALIDATE_EMAIL)) {
//Logando com email
        $sql = "SELECT * FROM tb_usuarios_tb_config WHERE email = ? AND senha = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nome, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
           $sql = "SELECT * FROM tb_usuarios_tb_config WHERE email = ? AND senha = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nome, $senha);
            $stmt->execute();
            $result = $stmt->get_result();
            $array = $result->fetch_array(MYSQLI_ASSOC);
            $id = $array["id"];
            
            $adm = $array["admin"];
            
            $nome = $array["nome"];
            $_SESSION["id"] = "$id";
            $_SESSION["admin"] = "$adm";
            $_SESSION["nome"] = "$nome";
            //header("Location: index.php");
            echo "Login successful";
        }else{
            $sql = "SELECT * FROM tb_usuarios_tb_config WHERE email = ? AND senha = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nome, $senha);
            $stmt->execute();
            $result2 = $stmt->get_result();
            if ($result2->num_rows > 0) {
                $sql = "SELECT id FROM tb_usuarios_tb_config WHERE nome = ? AND senha = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $nome, $senha);
                $stmt->execute();
                $result = $stmt->get_result();
                $array = $result->fetch_array(MYSQLI_ASSOC);
                $id = $array["id"];
                
                $adm = $array["admin"];
                
                $_SESSION["id"] = "$id";
                $_SESSION["admin"] = "$adm";
                //header("Location: index.php");
                echo "Login successful";
            }else{
                echo "Login failed";
            }
        }
    }else{
//Logando com Nome
        $sql = "SELECT * FROM tb_usuarios_tb_config WHERE nome = ? AND senha = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nome, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $sql = "SELECT * FROM tb_usuarios_tb_config WHERE nome = ? AND senha = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nome, $senha);
            $stmt->execute();
            $result = $stmt->get_result();
            $array = $result->fetch_array(MYSQLI_ASSOC);
            $id = $array["id"];
            
            $adm = $array["admin"];
            
            $nome = $array["nome"];
            $_SESSION["id"] = "$id";
            $_SESSION["admin"] = "$adm";
            $_SESSION["nome"] = "$nome";
            //header("Location: index.php");
            echo "Login successful";
        }else{
            $sql = "SELECT * FROM tb_usuarios_tb_config WHERE email = ? AND senha = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nome, $senha);
            $stmt->execute();
            $result2 = $stmt->get_result();
            if ($result2->num_rows > 0) {
                $sql = "SELECT id FROM tb_usuarios_tb_config WHERE nome = ? AND senha = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $nome, $senha);
                $stmt->execute();
                $result = $stmt->get_result();
                $array = $result->fetch_array(MYSQLI_ASSOC);
                $id = $array["id"];
                
                $adm = $array["admin"];
                
                $_SESSION["id"] = "$id";
                $_SESSION["admin"] = "$adm";
                //header("Location: index.php");
                echo "Login successful";
            }else{
                echo "Login failed";
            }
        }
    }
}

// Close the database connection
$conn->close();
?>