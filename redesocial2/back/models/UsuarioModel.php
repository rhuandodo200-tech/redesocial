<?php
//CREATE
function inserir($con,$dados){
    $stmt = $con->prepare(
        "INSERT INTO USUARIOS (nome, usename, email, senha)VALUE (?,?,?,?)"
    
    );
    $stmt -> execute([  $dados["nome"],
                        $dados["username"],
                        $dados["email"],
                        $dados["senhas"]]);
    return $con->lastInsertId();
}
//READ
function Listar($con){
    $stmt = $con -> query("SELECT  *  FROM usuarios");
    return $stmt->fetchALL(PDO::FETH_ASSOC);
}
//UPDATE
function atualizar($con,$id,$dados){
    $stmt = $con ->prepare(
        "UPDATE usuarios SET senha = ?
             WHERE id_usuario=?"
    );
    $stmt -> execute([  $dados["senha"],
                        $id]);
}
//DELETE
function remover($con,$id){
    $stmt = $con->prepare(
        "DELETE  FROM usuarios WHERE id_usuario = ?"
    );
    $stmt -> execute([$id]);
}