<?php
require_once __DIR__ . "/../controllers/UsuarioControllers.php";

$rota = $_GET["rota"] ?? "";
$metodo = $_SERVER["REQUEST_METHOD"];

if ($rota === "usuario"){
    switch($metodo){
        case "POST":
            createUsuario($con);
            break;
        case "GET":
            readUsuario:($con);
            break;
        case "PUT":
            updateUsuario:($con);
            break;
        case "DELETE":
             deleteUsuario($con);
        break;
        default:
        teste();


    }

}

else if( $rota === "curtidas"){
        switch($metodo){
        case "POST":
            inserirCurtidas($con, $corpo);
            break;
        case "GET":
            listarCurtidas($con);
            break;
        case "PUT":
            atualizarCurtidas($con, $_GET["id"], $corpo);
            break;
        case "DELETE":
            removerCurtidas($con, $_GET["id"]);
            break;
        default:
            teste ();
    }
} 
else if( $rota === "publicacao"){
        switch($metodo){
        case "POST":
            inserirPublicacao($con, $corpo);
            break;
        case "GET":
            listarPublicacao($con);
            break;
        case "PUT":
            atualizarPublicacao($con, $_GET["placa"], $corpo);
            break;
        case "DELETE":
            removerPublicacao($con, $_GET["id"]);
            break;
        default:
            teste ();
    }

}