<?php

include 'conectar.php';

$id = $_GET['codigo_usuario'];



$dir = "avatares/";

$sql = "SELECT avatar FROM usuario WHERE codigo_usuario = '$id'"; 

$result = $conn->query($sql); 

$avatar = mysqli_fetch_row($result); 



$arq = unlink($dir . $avatar[0]);

if($arq) { 
    echo "Arquivo de avatar excluído com sucesso";
} else { 
    echo "Arquivo de avatar não pôde ser excluído";
}



$sql = "DELETE FROM usuario WHERE codigo_usuario = '$id'";


if (mysqli_query($conn, $sql)) {
    echo "Usuário excluído com sucesso!";
   
    include_once 'pesquisa.php';
    exit();
}   else { 
    echo "Error: " . $sql . "" . mysqli_error($conn);
}