<?php
//Chama o arquivo de conexão com o banco de dados
require_once 'conexao.php';

//quantidade de registro por página - Para páginação
$limite = 5;

//Verifica em qual página da paginação, estamos
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

if($pagina < 1){
    $pagina = 1;
}

//Calcula de onde a consulta deve começar
$inicio = ($pagina - 1) * $limite;

try{
    //SQL para descobrir o total de usuários cadastrados
    $sql = "SELECT COUNT(*) FROM usuario";
    $contagem = $pdo->query($sql);
    $totalUsuarios = $contagem->fetchColumn();

    //Calcula a quantidade de páginas que teremos
    $totalPaginas = ceil($totalUsuarios / $limite);

    //Busca a relação de usuários no BD
    $sql = "SELECT * FROM usuario LIMIT :inicio, :limite";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->execute();
    $usuarios = $stmt->fetchAll();

}catch(PDOException $e){
    die("Erro ao consultar usuários: " . $e->getMessage());
}
?>

<!--COMENTÁRIO NO HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <!-- CDN BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Usuários Cadastrados</h3>
                <a href="index.php" class="btn btn-primary">+ Novo Usuário</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuarios): ?>
                                <tr>
                                    <td><?= $usuarios['id'] ?></td>
                                    <td><?= htmlspecialchars($usuarios['nome']) ?></td>
                                    <td><?= htmlspecialchars($usuarios['email']) ?></td>
                                    <td><?= htmlspecialchars($usuarios['fone']) ?></td>
                                    <td>
                                        <a href="editarUsuario.php?id=<?= $usuarios['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="excluirUsuario.php?id=<?= $usuarios['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este usuário?')">Excluir</a>
                                    </td>                                    
                                </tr>
                            <?php endforeach; ?>    
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>
