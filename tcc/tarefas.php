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
require_once 'TarefaDAO.php';
$tarefa = new Tarefa;
echo "<h1>Tarefas TCC</h1>";
echo "<table id='table' class='table table-dark'>";
echo "<thead>
<tr>
  <th scope='col'>Tarefa</th>
  <th scope='col'>Descriçao</th>
  <th scope='col'>Nome</th>
</tr>
</thead>
<tbody>
<tr>";
$tarefa->puxarTarefas();


?>
</body>
</html>