<?php

$nome = "root";
$senha = "root";
$bancoNome = "db_tarefas_TCC";

$conexao = mysqli_connect("localhost", $nome, $senha, $bancoNome);

if ($conexao)
{
}
else{
	echo "Sem conexão";
}
?>
