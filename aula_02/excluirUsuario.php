<?php
require_once 'conexao.php';

//Verifica se o ID foi enviado via GET
if(!isset($_GET['id'])){
    die("Usuário não informado.");
}

//Recebe o ID enviado via GET (pela URL)
$id = (int) $_GET['id'];

try{
    //construção do SQL para excluir o usuário
    $sql = "DELETE FROM usuario WHERE id = :id";

    //Prepara o SQL para execução
    $stmt = $pdo->prepare($sql);

    //Executa passando o ID no mesmo comando
    $stmt->execute([
        'id' => $id
    ]);

    //Verifica se algum registro foi excluído
    if($stmt->rowCount() > 0){
        echo "Usuário excluído com sucesso";
    }else{
        echo "Usuário não encontrado";
    }
}catch (PDOException $e){
    echo "Erro ao excluir usuário: ". $e->getMessage();
}
?>