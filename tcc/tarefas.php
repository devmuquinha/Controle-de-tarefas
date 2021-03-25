<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Tarefas</title>
</head>

<body>
  <?php
  session_start();
  require_once 'TarefaDAO.php';
  $tarefa = new Tarefa;

  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
  } else {
    echo "<form method='post'><br><br><input type='submit' name='btnExcluir' id='btnExcluir' value='Excluir'> <input type='submit' name='btn_sair' id='btn_sair' value='Sair'> <br>";
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
      echo 'Nenhuma tarefa selecionada!';
    }
  }
  ?>
</body>

</html>