<?php
session_start();

function Logoff() {
    session_unset();
    echo "Logoff";
}

$action = $_GET['action'] ?? 'default';

switch ($action) {
    case 'default':
    case 'logoff':
            Logoff();
        break;

    // case 'getCursoDetalhes':
    //     $crsCodigo = $_GET['curso'] ?? '';
    //     echo getCursoDetalhes($crsCodigo);
    //     break;

    default:
        http_response_code(400);
        echo json_encode(["error" => "Unknown action"]);
        break;
}
?>