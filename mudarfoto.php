<?php
session_start();

$servername = "sql101.infinityfree.com";
$username = "if0_38104376";
$password = "6EY1IDRM7tG";
$dbname = "if0_38104376_testesdoenzo";
$id = $_SESSION["id"];
$conteudo = $_POST['foto']; // This should be the base64 image content

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the next ID
$queryIdSelect = "SELECT MAX(id) + 1 AS next_id FROM tb_imagens;";
$queryId = $conn->query($queryIdSelect);

// Check if the query ran successfully
if ($queryId) {
    $row = $queryId->fetch_assoc();
    $IdFinal = $row['next_id']; // Next available ID
    
    // Prepare and escape the values
    $conteudo = $conn->real_escape_string($conteudo);
    $id = $conn->real_escape_string($id);

    // Prepare the SQL query to insert the image and update the user record
    $sql = "
        INSERT INTO tb_imagens (id, base64) VALUES ('$IdFinal', '$conteudo');
        UPDATE tb_usuarios_tb_config
        SET id_img = '$IdFinal'
        WHERE id = '$id';
    ";

    // Execute the query
    if ($conn->multi_query($sql)) {
        echo "New record created and user configuration updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
