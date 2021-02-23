<?php

$name="root";
$pass="";
$dbName="db_tarefas_TCC";

$conexao = mysqli_connect("localhost",$name,$pass,$dbName);

if($conexao){
}else{
	echo "Sem conexão";
}
?>
