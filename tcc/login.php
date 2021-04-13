<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="stylesheet" href="css-da-pagina/login.css">   
        <meta name="viewport"  content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body class="body" >
        <center>
            <div class="form-box">
                <div class="box-lado">       
                    <img class="img" src="img/user.png" alt="">
                    <form class="for" method="post">
                        <h1 class="h">Login</h1>                        <input type="text"  class="name" placeholder="Nome" name="txt_login"/>
                        <input type="password" class="bt" placeholder="Senha" name="txt_senha"/><br><br>
                        <input type="submit" class="button" name="btn_logar" value="Logar" id="btn_enviar">
                    </form>
                </div>  
                <!--<label class="label" >FAÇA LOGIN PARA<br> VER AS TAREFAS</label> -->
            </div>
        </center>
<?php
    require_once 'TarefaDAO.php';
    $tarefa = new Tarefa;
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        exit;
    }
    if (isset($_POST['btn_logar'])) {
        $login = $_POST['txt_login'];
        $senha = $_POST['txt_senha'];
        $tarefa->fazerLogin($login, $senha);
    }
    ?>
    </body>
</html>
