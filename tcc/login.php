<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <center>
        <form method="post">
            <h1>Login</h1>
            <label>Nome: </label>
            <input type="text" name="txt_login" /><br />
            <label>Senha :</label>
            <input type="password" name="txt_senha" /><br />
            <input type="submit" name="btn_logar" value="Logar" id="btn_enviar">
        </form>
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