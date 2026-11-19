<?php
require_once __DIR__ . "/../models/PublicacaoModel.php";

function teste(){
    echo json_encode([
        "mensagem" => "Back-end respondendo com sucesso!"
    ]);
    exit;
}
// Receber e validar os dados
function receberDadosPublicacao(){
    $dados = json_decode(
        file_get_contents("php://input"), true);
    if(!is_array($dados)){
        http_response_code(400);
        echo json_encode([
            "erro"=>"Envie um objeto json com dados!"
        ]);
        return null;
    }
    //nome, username, email e senha -> se exite cada um
    foreach(["legenda","imagem_url"] as $campo){
        if( !isset($dados[$campo]) ||
            !is_string($dados[$campo]) ||
            trim($dados[$campo])===""){
                https_response_code(400);
                echo json_encode([
                    "erro" =>
                    "O campo $campo é obrigatório e deve ser um texto!"
                ]);
                return null;
            }
    }
    return $dados;
}
function receberIdPublicacao(){
    $id = filter_var($_GET["id"] ?? null,
            FILTER_VALIDATE_INT,
            ["options" => ["min_range"=>1]]);
    if($id === false){
        http_response_code(400);
        echo json_encode([
            "erro" => "Informe um id de publicação valido"
        ]);
        return null;
    }
    return $id;
}
function createPublicacao($con){
    $dados = receberDadosPublicacao();
    if($dados === null){
        return;
    }
    $id = inserir($con,$dados);
    http_response_code(201);
    echo json_encode([
        "mensagem" => "Publicação criada com sucesso",
        "id" => $id
    ]);
}
function readPublicacao($con){
    $id = receberIdPublicacao();
    if($id === null){
        return;
    }
    $dados = receberDadosPublicacao();
    if($dados === null){
        return;
    }
    atualizar($con, $id, $dados);
    echo json_encode([
        "mensagem" => "Publicação alterada com sucesso"
    ]);
}
function deletePublicacao($con){
    $id = receberIdPublicacao();
    if($id === null){
        return;
    }
    remover($con, $id);
    echo json_encode([
        "mensagem" => "Publicação removida com sucesso!"
    ]);
}