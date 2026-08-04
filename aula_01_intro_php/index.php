<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--ATÉ AQUI TEMOS O HTML -->
    <?php
        //AQUI ESTOU DENTRO DO PHP E O HTML NÃO FUNCIONA MAIS
        echo "Hello World!";
        echo "<br>";
        echo "Nosso primeiro código em PHP";
        //criando uma variável com texto dentro
        $variavel = "Esse texto está dentro de uma variável";
                //pulando de linha PHP + HTML
        echo "<br><br>";
        //criando uma tag H1 com o texto da variável
        echo "<h1>";
            echo $variavel;    
        echo "</h1>";
        /*AQUI TERMINA O CÓDIGO PHP*/
    ?>
    <!--AQUI EU VOLTO PARA O HTML -->
    <form action="dados.php" method="post">
        <input type="text" name="abobrinha" placeholder="Digite seu nome">
        <input type="email" name="mail" placeholder="Digite seu e-mail">
        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>