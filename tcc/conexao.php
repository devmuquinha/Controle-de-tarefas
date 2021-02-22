<?php

$name="root";
$pass="root";
$dbName="db_tarefas_TCC";

$conexao = mysqli_connect("localhost",$name,$pass,$dbName);

if($conexao){
}else{
	echo "Sem conexão";
}
?>