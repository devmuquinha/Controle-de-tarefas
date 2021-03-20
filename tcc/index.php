<!DOCTYPE html>
<html>
    <head>
        <title>TCC</title>

        <link rel="stylesheet" type="text/css" href="cs.css">
    </head>
    <body>

	<section class="header-site" style="background-image:url(img/a.png);">
    <div class="container">
        <div class="row">
            <div class="col">
				<button style="margin-left: auto; margin-right: auto; display: block; width:200px; background-color: rgba(173,255,47, 0.75); color:black" class="btn btn-danger">Cadastro</button>
            </div>
        </div>
    </div>
</section>

	</body>
</html>
<?php
require_once 'TarefaDAO.php';
$tarefa = new Tarefa;

echo '
<center>
<br><br>
<h1>TCC do OPA</h1>
<form method = "POST" > <br>
    <br>
        <input  style=" width:300px; padding:5px; border-radius:7px;	margin-left: auto;margin-right: auto; display: block;" name="tarefa_nome" placeholder="Escreva Aqui o Nome da Tarefa">
            <br>

            <textarea name="tarefa_descricao" class="input-tarefa" placeholder="ESCREVA AQUI A TAREFA DOS INTEGRANTES" ></textarea>
            <br><br>
';
	$tarefa->puxarIntegrantes();

	echo '
	<input type="submit" name="btn_enviar" class="btn" value="ENVIAR" id="btn_enviar">
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