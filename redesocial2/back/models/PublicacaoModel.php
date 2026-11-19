<?php
function inserirPublicacao($con, $dados){
    $stmt = $con->prepare(
        "INSERT INTO PUBLICACAO (LEGENDA, IMAGEM_URL)
        VALUES(?,?)"
    );
    $stmt->execute([$dados["legenda"],
                    $dados["imagem_url"],]);
    http_response_code(202);
    echo json_encode(
        ["mensagem" => "Publicação criada com sucesso!",
        "id" => $con->lastInsertId()]
        );
}
function listarPublicacao($con){
    $stmt = $con->query("SELECT * FROM publicacoes");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC)
    );
}
function atualizarPublicacao($con, $id, $dados){
    $stmt = $con->prepare(
        "UPDATE publicacoes SET legenda = ?, imagem_url = ?
        WHERE id_publicacao = ?"
    );
    $stmt -> execute([  $dados["legenda"],
                        $dados["imagem_url"],
                        $id]);
    echo json_encode(["mensagem" => "PUblicação alterada com sucesso!"]);
}
function removerPublicacao ($con, $id){
    $stmt= $con->prepare("DELETE FROM publicacoes WHERE id_publicacao =?");
    $stmt->execute([$id]);
    echo json_encode (["mensagem" => "Publicação removida com sucesso!"]);
}