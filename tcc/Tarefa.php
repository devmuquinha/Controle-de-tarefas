<?php 
    include 'Conexao.php';
class tarefa{

    function puxarIntegrantes()
    {
    global $conexao;

    $select = "select * from tb_integrantes;";
	$result = $conexao->query($select);
        if ($result->num_rows > 0) {
        echo '<label for="integrantes">Escolha os integrantes:</label><br>';
            while ($row = $result->fetch_assoc()) {
                echo "<input type='checkbox' name = 'ckbx_integrantes[]' value='" . $row['tb_integrante_id'] ."'>". $row['tb_integrante_nome']. " <br>";
            }; 
            echo '<br>';
        }
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
    echo "Inserido!";
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