<!DOCTYPE html>
<html>

<head>
    <title>TCC</title>

    <link rel="stylesheet" type="text/css" href="css/cs.css">
    <link rel="stylesheet" href="css/Bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/div.css">
</head>

<body style="background-color: lightgray;">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/Bootstrap.min.js"></script>
    <style>
        .header-site {
            background-image: url("img/d.jpg");
            background-position: center top;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            color: rgb(0, 0, 0);
            padding-top: 300px;
            padding-bottom: 300px;
        }
    </style>

    <section class="header-site">

        <div class="container">
            <div class="row">
                <div class="col-14">
                    <a style="float: left;margin-top:120px; display: block; width:200px; background-color: orange; color:Black; border-radius:10px; padding:10px; text-align: center; border:1px;" href="tarefas.php">Opinhaa</a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<?php
error_reporting(E_ALL);
session_start();
require_once 'TarefaDAO.php';
$tarefa = new Tarefa;

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['login'] != 'Eduardo') {
    header("location: tarefas.php");
    exit;
  } else {echo '
    <center>
    <div id="frm" >
    
    <br>
    <h2>Form</h2>
    <form method = "POST" > <br>
        <br>
            <input  style=" width:300px; padding:5px; border-radius:7px;	margin-left: auto;margin-right: auto; display: block;" name="tarefa_nome" placeholder="Escreva Aqui o Nome da Tarefa">
                <br>
    
                <textarea name="tarefa_descricao" class="input-tarefa" placeholder="ESCREVA AQUI A TAREFA DOS INTEGRANTES" ></textarea>
                <br><br>
    ';
    $tarefa->puxarIntegrantes();
    
    echo '
        <input type="submit" name="btn_enviar" class="btn" value="ENVIAR" id="btn_enviar">
        <br>
    
        </div>
        </form>
        </div>
        </center>';
  }



if (isset($_POST['btn_enviar'])) {
        $nome = $_POST['tarefa_nome'];
        $descricao = $_POST['tarefa_descricao'];
        
        if (isset($_POST['ckbx_integrantes']) && $nome != '' && $descricao != '') {
            $integrantes = $_POST['ckbx_integrantes'];
            $tarefa->insertTarefa($nome, $descricao);
            $tarefaId = $tarefa->pegaIdTarefa($nome, $descricao);
            $tarefa->fazerInsertGrupos($integrantes, $tarefaId);
        } else {
            echo 'Preencha todos os campos!';
        }
}
?>