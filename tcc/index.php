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

$select = "select * from tb_integrantes;";
$result = $conexao->query($select);
if ($result->num_rows > 0) {
echo '<label for="integrantes">Escolha os integrantes:</label><br>';
	while ($row = $result->fetch_assoc()) {
		echo "<input type='checkbox' id = 'ckbx_" . $row['tb_integrante_nome'] ."'>". $row['tb_integrante_nome']. " <br>";
	}; 
	echo '<br>';
}
//Comentario teste.
echo'
	<br><br>
	<textarea name="tarefa"class="input-tarefa"placeholder="ESCREVA AQUI A TAREFA DOS INTEGRANTES" ></textarea>
	<br><br>
	<input type="submit" name="btn_enviar" class="btn" value="ENVIAR" id="btn_enviar">
	</div>
</form>
</center>';


if(isset($_POST['btn_enviar'])){ 

$nome = $_POST['integrante'];
$tarefa = $_POST['tarefa'];
try 
{
	for ($qtd_integrantes = 0; $qtd_integrantes != str_split(implode(" ", $row), ''); $qtd_integrantes)
	{
	$sql = mysqli_query($conexao,"INSERT INTO tb_integrantes (tb_integrante_nome) VALUE ('$nome');");
	echo "Inserido";
	}
}
catch (Exception $err)
{
	echo $err;
}
}
?>