<?php
//CREATE
function inserirCurtidas($con, $dados){
    $stmt = $con->prepare(
        "INSERT INTO CURTIDAS (ID_USUARIO, ID_PUBLICACAO)
        VALUES(?,?)"
    );
    $stmt->execute([$dados["id_usuario"],
                    $dados["id_publicacao"],]);
    http_response_code(201);
    echo json_encode(
        ["mensagem" => "Curtida criado com sucesso!",
        "id" => $con->lastInsertId()]
        );
}   
function listarCurtidas($con){
    $stmt = $con->query("SELECT * FROM curtidas");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC)
    );
}
function atualizarCurtidas($con, $id, $dados){
    $stmt = $con->prepare(
        "UPDATE Curtidas SET id_usuario = ?, id_publicacao = ?
        WHERE id_curtida = ?"
    );
    $stmt -> execute([  $dados["id_usuario"],
                        $dados["id_publicacao"],]);
    echo json_encode(["mensagem" => "Curtida alterada com sucesso!"]);
}
function removerCurtidas ($con, $id){
    $stmt= $con->prepare("DELETE FROM curtidas WHERE id_curtida =?");
    $stmt->execute([$id]);
    echo json_encode (["mensagem" => "Curtida removida com sucesso!"]);
}