<?php
    session_start();
    
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = '';
    $DB_NAME = 'cadastro';


    
    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if ( mysqli_connect_errno() ) {
        
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }


    
    if ( !isset($_POST['email'], $_POST['senha']) ) {
        
        die ('E-mail/senha não existe!');
    }


    
    if ($stmt = $conn->prepare('SELECT email, senha, tipo FROM usuario WHERE email = ?')) {
    
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute(); 
    $stmt->store_result(); 


    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($email, $senha, $tipo);
        $stmt->fetch();      
        
        if (password_verify($_POST['senha'], $senha)) {
            
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['email'];
            $_SESSION['id'] = $id;




                
            } else {
                echo 'Senha/E-mail incorretos!';
            }
        } else {
            echo 'Senha/E-mail incorretos!';
        }
        $stmt->close();
    } else {
        echo 'Falha ao carregar!';
    }
    if ($tipo == "Admim") {

                      header ('Location: pesquisa.php');
                      echo"<script language='javascript' type='text/javascript'>
                        alert('Cadastrado com sucesso.')";
        }

    elseif ($tipo == "padrao") { 


            header('location: paginaComum.html');
            echo"<script language='javascript' type='text/javascript'>
                        alert('Cadastrado com sucesso.')";
                 
    }
    ?>