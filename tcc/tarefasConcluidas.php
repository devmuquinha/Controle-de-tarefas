<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css-da-pagina/tarefa.css">
    <link rel="stylesheet" href="css-da-pagina/tarefamenorr.css" media="screen and (max-width: 1225px)" />
    <link rel="stylesheet" href="css-da-pagina/tarefamaior.css" media="screen and (min-width: 1125px)" />

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <title>Tarefas</title>
</head>

<body class="body">
    <a href="index.php"> <img class="setaC" src="img/setaC.png" alt=""> </a>
    <label for="" class="tarefa">Tarefas Concluidas</label>
    <?php
    session_start();
    require_once 'TarefaDAO.php';
    $tarefa = new Tarefa;

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['login'] != 'Eduardo' && $_SESSION['login'] != 'Matheus') {
        header("location: tarefas.php");
        exit;
    } else {
        echo "<form class='form_task' method='post'>";
        
        echo "<table class='table' id='tab'>
        <thead>
        <tr class='tr'>
      
        <th scope='col' class='nomee'>Nome da Tarefa" . "
        </th><th scope='col desc' class='desc'>Descrição" . "
        </th><th scope='col inter' class='inter'>Integrantes
        </th></thead>";

        $tarefa->puxarTarefasConcluidas();

        echo "</form>
    
    
    
    ";
    }
    ?>
</body>

</html>