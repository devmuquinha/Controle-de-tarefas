<link rel="stylesheet" type="text/css" href="style.css">
<?php 
    include 'Conexao.php';
class tarefa{

    function puxarIntegrantes()
    {
    global $conexao;

    $select = "select * from tb_integrantes";
    $informacao = mysqli_query($conexao, $select);
        echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><label for="integrantes">Escolha os integrantes:</label><br>';
        while ($dados = mysqli_fetch_array($informacao)) {
                echo "<input type='checkbox' id='chb' name = 'ckbx_integrantes[]' value='" . $dados['tb_integrante_id'] ."'>". $dados['tb_integrante_nome']. " <br>";
            }
            echo '<br>';
        }
    
    function puxarTarefas()
    {
    global $conexao;

    $select = "select tb_tarefas.tb_tarefa_id, tb_tarefas.tb_tarefa_nome, tb_tarefas.tb_tarefa_descricao, tb_integrantes.tb_integrante_nome 
    from tb_grupos
    inner join tb_tarefas
    on tb_grupos.tb_tarefa_id = tb_tarefas.tb_tarefa_id
    inner join tb_integrantes
    on tb_integrantes.tb_integrante_id = tb_grupos.tb_integrante_id
    order by tb_tarefas.tb_tarefa_id;";

    $informacao = mysqli_query($conexao, $select);
            while ($dados = mysqli_fetch_array($informacao)) {
                echo "<label>Nome - </label>" . $dados['tb_tarefa_nome'] ." <label >Descrição - </label>". $dados['tb_tarefa_nome']. " <label>Integrante - </label>" . $dados['tb_integrante_nome'] . "<br><br>";
            }; 
            echo '<br>';
    }   

    function pegaIdTarefa($nome, $descricao)
    {   
    global $conexao;
        try
        {
            $selectPegaId = "SELECT tb_tarefa_id FROM tb_tarefas WHERE tb_tarefas.tb_tarefa_nome = '$nome' AND tb_tarefas.tb_tarefa_descricao = '$descricao';";    
            mysqli_query($conexao, $selectPegaId);
            $tarefaId = $conexao->query($selectPegaId)->fetch_assoc()['tb_tarefa_id'];
            return $tarefaId;
        }
        catch (Exception $erro)
        {
            return $erro;
        }
    }

    function fazerInsertGrupos($integrantes, $tarefaId)
    {
    global $conexao;
	foreach ($integrantes as $integrante)
	{
		try 
        {
            mysqli_query($conexao, "INSERT INTO tb_grupos (tb_integrante_id, tb_tarefa_id) VALUES ('$integrante', '$tarefaId')");
        }
        catch (Exception $erro)
        {
            echo 'Erro - ' . $erro;
        }
	}
    echo "<center style='margin-top:150px;'>Inserido!</center>";
    }

    function insertTarefa($nome, $descricao)
    {
        global $conexao;
        try{
            mysqli_query($conexao, "INSERT INTO tb_tarefas (tb_tarefa_nome, tb_tarefa_descricao) VALUES ('$nome', '$descricao');");
        }
        catch (Exception $erro)
        {
            echo "Erro - " . $erro;
        }
    }
}
?>
