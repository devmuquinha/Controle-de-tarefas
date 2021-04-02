<!DOCTYPE html>
<html>
    <head>
        <title>TCC</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="estilo.css">
        <link rel="stylesheet" media="screen and (min-width: 600px)" href="wid.css">
    </head>
    <body class="body">
    <?php
error_reporting(E_ALL);
session_start();
require_once 'TarefaDAO.php';
$tarefa = new Tarefa;
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['login'] != 'Eduardo') {
    header("location: tarefas.php");
    exit;
  } else {
    echo '
    <center>
    <div class="forms" >    
    <form method = "POST" > <br>
        <br>
            <input class="titulo-tarefa" name="tarefa_nome" placeholder="Titulo da Tarefa">
                <br>
                <textarea name="tarefa_descricao" class="desc-tarefa" placeholder="Descriçao da Tarefa" ></textarea>
                <br>
                <br>
    ';
    $tarefa->puxarIntegrantes();
    
    echo '
        <input type="submit" name="btn_enviar" class="btn" value="ENVIAR" id="btn_enviar">
        <br>
        <br>
        </form>';

        if (isset($_POST['btn_enviar'])) {
            $nome = $_POST['tarefa_nome'];
            $descricao = $_POST['tarefa_descricao'];
            $nome = mysqli_real_escape_string($conexao, $nome);
            $descricao = mysqli_real_escape_string($conexao, $descricao);
            
            if (isset($_POST['ckbx_integrantes']) && $nome != '' && $descricao != '') {
                $integrantes = $_POST['ckbx_integrantes'];
                $tarefa->insertTarefa($nome, $descricao);
                $tarefaId = $tarefa->pegaIdTarefa();
                $tarefa->fazerInsertGrupos($integrantes, $tarefaId);
            } else {
                echo '<div class="log"><label >Preencha todos os campos!</label ></div>';
            }
    }
        echo'
        </div>
        </center>';
  }
?>
    </body>
</html>