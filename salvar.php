<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Cadastro</title>
</head>

<body>
<?php
    include "conectar.php";

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    
    if ($_FILES) { 
        if ($_FILES['avatar']) { 
            $dir = './avatares/'; 
            $temp = $_FILES['avatar']['tmp_name']; 
            $fileName = $_FILES['avatar']['name']; 
            $separa = explode(".", $fileName); 
            $separa = array_reverse($separa); 
            $fileType = $separa[0]; 
            $avatar = $email . "." . $fileType; 
            move_uploaded_file($temp, $dir . $avatar); }} 

    $sql_insert = " INSERT INTO usuario (nome,email,senha,tipo,avatar)
    VALUES('$nome','$email','$senha','$tipo','$avatar')";

    if (mysqli_query ($conn, $sql_insert)) {
        echo"<script language='javascript' type='text/javascript'>
                        alert('Cadastrado com sucesso.');window.location
                        .href='index.html';</script>";
    }else{
        echo"<script language='javascript' type='text/javascript'>
                        alert('Nome não cadastrado.');window.location
                        .href='index.html';</script>";
    }
    
    


      
?>

<a href ="cadastro.html" class="btn btn-success">Voltar</a>
 
</body>

</html>