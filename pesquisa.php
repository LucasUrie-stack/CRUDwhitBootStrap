<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Banco de Pesquisa</title>
    <script>
        function uploadFile(target) {
            document.getElementById("file-name").innerHTML = target.files[0].name;
        }
    </script>
</head>

<body>

    <?php
    if (isset($_POST['busca'])) {
        $pesquisa = $_POST['busca'];
    } else {
        $pesquisa = '';
    }

    include "conectar.php";

    $sql = "SELECT codigo_usuario,nome,email,tipo,avatar FROM usuario WHERE nome LIKE '%" . $pesquisa . "%'";

    $dados = mysqli_query($conn, $sql);

    ?>

    <div class="container">

        <h1>Banco de Pesquisa</h1>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <form class="d-flex" action="pesquisa.php" method="POST">
                    <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" name="busca">
                    <button class="btn btn-outline-success" type="submit">Pesquisar</button>
                </form>
            </div>
        </nav>
        <table class="table table-hover">

            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">tipo</th>
                    <th scope="col">avatar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($linha = mysqli_fetch_assoc($dados)) {
                    echo "<tr>";
                    echo "<td>";
                    echo $linha['codigo_usuario'];
                    echo "</td>";
                    echo "<td>";
                    echo $linha['nome'];
                    echo "</td>";
                    echo "<td>";
                    echo $linha['email'];
                    echo "</td>";
                    echo "<td>";
                    echo $linha['tipo'];
                    echo "</td>";
                    echo "<td>";
                    echo "<img src='./avatares/" . $linha['avatar'] . "' style='max-height:16px'>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='excluirCadastro.php?codigo_usuario=" . $linha['codigo_usuario'] . "'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>

        </table>
        <a class="btn btn-info btn-lg" href="login.html" role="button">Voltar para Login</a><hr>

    </div>
    <div class="container">


        <h1>Cadastro</h1>
        <form class = "jumbotron"method="POST" action="salvarpesquisa.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome completo:</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
            <div class="form-group">
                <label for="tipo">Admim</label>
                <input type="radio" class="form-control" name="tipo" value="Admim" required>
            </div>
            <div class="form-group">
                <label for="tipo">Padrão</label>
                <input type="radio" class="form-control" name="tipo" value="padrao" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Cadastrar">
              
            </div>
            <div class="form-control">
                <label for="upload-button" class="btn btn-success btn-sm"> Avatar </label>
                <input style="display: none" type="file" name="avatar" id="upload-button" onchange="uploadFile(this)" />
                <span id="file-name"></span><br><br>
            </div>
        </form>


    </div>
      
        
        
        
        





</body>

</html>