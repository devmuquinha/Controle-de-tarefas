<!DOCTYPE html>
<html>
<head>
	<title>TCC</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
</body>
</html>
<?php
include "conexao.php";

echo '
<center>
<h1>Adicionar tarefas TCC</h1>
<br>
<form  method="POST">';
echo'
	<br><br>
	<textarea name="tarefa_nome" placeholder="ESCREVA AQUI O NOME DA TAREFA" ></textarea>
	<br><br>
	<textarea name="tarefa_descricao" class="input-tarefa" placeholder="ESCREVA AQUI A TAREFA DOS INTEGRANTES" ></textarea>
	<br><br>';
	$select = "select * from tb_integrantes;";
	$result = $conexao->query($select);
	if ($result->num_rows > 0) {
	echo '<label for="integrantes">Escolha os integrantes:</label><br>';
		while ($row = $result->fetch_assoc()) {
			echo "<input type='checkbox' name = 'ckbx_integrantes[]' value='" . $row['tb_integrante_id'] ."'>". $row['tb_integrante_nome']. " <br>";
		}; 
		echo '<br>';
	}
	echo '
	<input type="submit" name="btn_enviar" class="btn" value="ENVIAR" id="btn_enviar">
	</div>
	</form>
	</center>';

if(isset($_POST['btn_enviar'])){ 
	
$integrantes = $_POST['ckbx_integrantes'];
$nome = $_POST['tarefa_nome'];
$descricao = $_POST['tarefa_descricao'];
try 
{
	foreach ($integrantes as $integrante)
	{
		echo $integrante . '<br>';
	}
	//$sql = mysqli_query($conexao, "INSERT INTO tb_tarefas (tb_integrante_nome, tb_tarefa_descricao, tb_integrante_id) VALUES ('$nome', '$descricao', '$integrante');");
	echo "Inserido";
}
catch (Exception $err)
{
	echo $err;
}
}
?>