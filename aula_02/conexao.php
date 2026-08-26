<?php

$host  = 'localhost'; //endereço do servidor de banco de dados
$banco = 'aula_php';  //nome do banco de dados
$login = 'root'; //login do banco de dados
$senha = 'root'; //senha do banco de dados

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco",$login,$senha
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e){
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

?>