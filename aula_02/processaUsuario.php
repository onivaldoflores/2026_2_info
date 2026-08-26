<?php
    require_once 'conexao.php'; //chama o arquivo de conexão com o banco de dados

    //Verifica se o formulário foi enviado via POST
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        die("Acesso não autorizado!");
    }

    //Captura as informações enviadas pelo formulário do arquivo index.php
    $nome = trim($_POST["nome"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $fone = trim($_POST["fone"] ?? '');
    $senha = trim($_POST["senha"] ?? '');
    $termoUso = trim($_POST["termoUso"] ?? '');
    //EXCPLICAÇÃO DO CÓDIGO ACIMA
    //Comando trim() remove caracteres do início e fim de uma string
    //Comando ?? é o operador de coalescência nula.. Ele devolve o valor da esquerda se ela existir e não for null; senão devolve o da direita.

    //verifica se o usuário já existe no banco de dados
    try{
        //constrói o SQL apenas como uma string
        $sql = "SELECT id FROM usuario WHERE email = :email";

        //prepara o SQL para execução
        $consultaUsuario = $pdo->prepare($sql);

        //transforma a string em apenas dados para execução no sql
        $consultaUsuario->bindValue(':email', $email);

        //executa o SQL no banco de dados
        $consultaUsuario->execute();

        if($consultaUsuario->fetch()){
            die("Este usuário já está cadastrado no sistema.");
        }

        //constrói o SQL apenas como uma string
        $sql = "INSERT INTO usuario
        (nome, email, fone, senha, termoUso)
        VALUES
        (:nome, :email, :fone, :senha, :termoUso)";

        $cadUsuario = $pdo->prepare($sql);

        $cadUsuario->bindValue(':nome', $nome);
        $cadUsuario->bindValue(':email', $email);
        $cadUsuario->bindValue(':fone', $fone);
        $cadUsuario->bindValue(':senha', $senha);
        $cadUsuario->bindValue(':termoUso', $termoUso);
        // Executa o INSERT
        $cadUsuario->execute();

        echo "Usuário cadastrado com sucesso!";


    } catch (PDOException $e) {

        echo "Erro ao cadastrar usuário: " . $e->getMessage();

    }
    


?>