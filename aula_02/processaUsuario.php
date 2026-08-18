<?php
    //Captura as informações enviadas pelo formulário do arquivo index.php
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $fone = $_POST["fone"];
    $senha = $_POST["senha"];
    $termoUso = $_POST["termoUso"];

    echo "Meu usuário é $nome, com o e-mail: $email, Telefone: $fone, Senha: $senha, $termoUso";


?>