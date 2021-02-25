<!DOCTYPE html>
<html>
<head>
	<title>TCC</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<img src="opa.png" width="1300" height="132">
</body>
</html>
<?php
require_once 'Tarefa.php';
$tarefa = new Tarefa;

echo '
<center>
<br>
<form  method="POST">
	<br><br>
	<input id="inpt" name="tarefa_nome" placeholder="ESCREVA AQUI O NOME DA TAREFA" >
	<br><br>
	<textarea id="txtarea" name="tarefa_descricao" class="input-tarefa" placeholder="ESCREVA AQUI A TAREFA DOS INTEGRANTES" ></textarea>
	<br><br>';

	$tarefa->puxarIntegrantes();

	echo '
	<input type="submit" id="btn" name="btn_enviar" class="btn" value="ENVIAR" id="btn_enviar">
	</div>
	</form>
	</center>';

if(isset($_POST['btn_enviar'])){ 
	
$integrantes = $_POST['ckbx_integrantes'];
$nome = $_POST['tarefa_nome'];
$descricao = $_POST['tarefa_descricao'];


$tarefa->insertTarefa($nome, $descricao);		
$tarefaId = $tarefa->pegaIdTarefa($nome, $descricao);
$tarefa->fazerInsertGrupos($integrantes, $tarefaId);
}
?>
