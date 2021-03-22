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
    echo "<form method='post'>";
    echo "<h1>Tarefas TCC</h1> <input type='submit' name='btn_sair' id='btn_sair' value='Sair'>";
    echo "<table id='table' class='table table-dark'>";
    echo "<thead>
            <tr>
              <th scope='col'>Tarefa</th>
              <th scope='col'>Descrição</th>
              <th scope='col'>Nome</th>
            </tr>
          </thead>
          <tbody>
            <tr>";
    echo "</form>";
    $tarefa->puxarTarefas();
  }

  if (isset($_POST['btn_sair'])) {
    $tarefa->deslogar();
  }

  ?>
</body>

</html>