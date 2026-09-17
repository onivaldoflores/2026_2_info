<?php
    require_once 'conexao.php';

    //VERIFICA SE O ID FOI INFORMADO
    if(!isset($_GET['id'])){
        die("Usuário não informado.");
    }

    //RECEBE O ID PELA URL
    $id = (int) $_GET["id"];

    try{
        //BUSCA O USUÁRIO NO BD, PELO ID
        $sql = "SELECT * FROM usuario where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        //RECUPERA OS DADOS DO USUÁRIO
        $usuario = $stmt->fetch();

        //VERIFICA SE O USUÁRIO EXISTE
        if(!$usuario){
            die("Usuário não econtrado.");
        }
    }catch(PDOException $e){
        die("Erro ao consultar usuário: ".$e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Usuários</title>
    <!-- CDN BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3>Editar Usuário</h3>
                    </div>
                    <div class="card-body">
                        <form action="processaEdicao.php" method="post">
                            <!-- ID DO USUÁRIO -->
                            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                            <!-- NOME DO USUÁRIO -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome completo</label>
                                <input type="text" class="form-control" 
                                name="nome" id="nome" 
                                value="<?= htmlspecialchars($usuario['nome']) ?>">
                            </div>
                            <!-- E-MAIL DO USUÁRIO -->
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" 
                                name="email" id="email" 
                                value="<?= htmlspecialchars($usuario['email']) ?>">
                            </div>
                            <!-- TELEFONE DO USUÁRIO -->
                            <div class="mb-3">
                                <label for="fone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" 
                                name="fone" id="fone" 
                                value="<?= htmlspecialchars($usuario['fone']) ?>">
                            </div>
                            <!-- SENHA DO USUÁRIO -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="senha" class="form-label">
                                        Nova Senha
                                    </label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="senha"
                                        name="senha">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="senha" class="form-label">
                                        Confirmar Nova Senha
                                    </label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="senha"
                                        name="senha">
                                </div>
                            </div>
                            <!-- TERMO DE USO -->
                            <div class="form-check mb-3">
                                <input type="checkbox" 
                                class="form-check-input"
                                name="termoUso"
                                id="termos"
                                <?= $usuario['termoUso'] ? 'checked' : '' ?>>
                                <label for="termos" class="form-check-label">Aceito os termos de uso</label>
                            </div>
                            <!-- BOTÕES DE AÇÃO -->
                            <div class="d-flex gap-2">
                                <a href="usuarios.php" class="btn btn-secundary">Voltar</a>
                                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>