<?php

$nome = "root";
$senha = "";
$bancoNome = "db_tarefas_TCC";

$conexao = mysqli_connect("localhost", $nome, $senha, $bancoNome);

if ($conexao)
{
}
else{
	echo "Sem conexão";
}
?>
