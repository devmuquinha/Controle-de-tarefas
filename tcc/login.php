<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="sty.css">
         <link
            rel="stylesheet"   media="screen and (min-width: 900px)"href="widescreen.css">
        <link rel="stylesheet" media="screen and (max-width: 600px)" href="smallscreen.css">
        <meta name="viewport"  content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body class="body">
        <center>
            <div class="form-box">
                <h2 id="bb" style="color:white;">Bem Vindo</h2>
                <div class="box-lado">
                    <form method="post">
                        <h1 class="h1">Login</h1><br><br>
                        <input type="text" placeholder="Nome" name="txt_login"/><br>
                        <input type="password" class="bt" placeholder="Senha" name="txt_senha"/><br><br>
                        <input type="submit" class="button" name="btn_logar" value="Logar" id="btn_enviar">
                    </form>
                </div>  
                <input type="button" class="saiba_bt" value="Saiba Mais">
                <!--<label class="label" >FAÇA LOGIN PARA<br> VER AS TAREFAS</label> -->
            </div>
        </center>
        <br><br><br><br><br><br>
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
