<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css-da-pagina/tarefa.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link
            href='https://fonts.googleapis.com/css?family=Open+Sans'
            rel='stylesheet'
            type='text/css'>

        <title>Tarefas</title>
    </head>
    <body class="body">
        <form action="" method="POST">
            <input type='submit' class="quit" name='btn_sair' value='Sair'>
        </form>
        <label for="" class="tarefa">Tarefas</label>
    <?php
  session_start();
  require_once 'TarefaDAO.php';
  $tarefa = new Tarefa;

  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
  } else {
    echo "<form class='form_task' method='post'>";
    $tarefa->puxarTarefas();
   
    echo "</form>";
  }
  if (isset($_POST['btn_sair'])) {
    $tarefa->deslogar();
  }

  if (isset($_POST['btnExcluir'])) {
    if (isset($_POST['ckbx_tarefas'])) {
      $tarefas = $_POST['ckbx_tarefas'];
      $tarefa->excluir($tarefas);
    } else {
      echo '<div class="alert-danger">Nenhuma tarefa selecionada!';
    }
  }
  ?>
    </body>
</html>