<link rel="stylesheet" href="css/Bootstrap.min.css">
<link rel="stylesheet" href="css/Bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/cs.css">
<link rel="stylesheet" href="css/div.css">
<?php
include 'Conexao.php';
class tarefa
{

    function puxarIntegrantes()
    {
        global $conexao;

        $select = "select * from tb_integrantes";
        $informacao = mysqli_query($conexao, $select);
        echo '<br><label for="integrantes">Escolha os integrantes:</label><br>';
        while ($dados = mysqli_fetch_array($informacao)) { //Puxa integrantes de dentro do banco
            echo "<input type='checkbox' id='chb' name = 'ckbx_integrantes[]' value='" . $dados['tb_integrante_id'] . "'>" . $dados['tb_integrante_nome'] . " <br>";
        }
        echo '<br>';
    }

    function puxarTarefas()
    {
        global $conexao;
        $nomeTarefa = '';
        $jacomecado = false;

        $select = "select tb_tarefas.tb_tarefa_id, tb_tarefas.tb_tarefa_nome, tb_tarefas.tb_tarefa_descricao, tb_integrantes.tb_integrante_nome 
        from tb_grupos
        inner join tb_tarefas
        on tb_grupos.tb_tarefa_id = tb_tarefas.tb_tarefa_id
        inner join tb_integrantes
        on tb_integrantes.tb_integrante_id = tb_grupos.tb_integrante_id
        order by tb_tarefas.tb_tarefa_id;";
        
     

        $informacao = mysqli_query($conexao, $select);
        while ($dados = mysqli_fetch_array($informacao)) { //Puxa as tarefas separando por integrantes
            if ($jacomecado == false) {
             
                echo "
                      <th scope='col'> ". $dados['tb_tarefa_nome'] . 
                     "<th scope='col'>" . $dados['tb_tarefa_descricao'] .
                     "<th scope='col'>" . $dados['tb_integrante_nome'];

                $nomeTarefa = $dados['tb_tarefa_nome'];
                $jacomecado = true;

            }else {
                
                if ($nomeTarefa == $dados['tb_tarefa_nome']) {
                    echo ", ".$dados['tb_integrante_nome'];
                } else {
             echo "<tr>
                   <th scope='col'>#</th>
                   <th scope='col'>" . $dados['tb_tarefa_nome'] . 
                  "<th scope='col'>" . $dados['tb_tarefa_descricao'] . 
                  "<th scope='col'>" . $dados['tb_integrante_nome']."<br>";
                 $nomeTarefa = $dados['tb_tarefa_nome'];
                 $jacomecado = false;
                }
            }
        };


    }

    function pegaIdTarefa($nome, $descricao)
    {
        global $conexao;
        try {
            $selectPegaId = "SELECT tb_tarefa_id FROM tb_tarefas WHERE tb_tarefas.tb_tarefa_nome = '$nome' AND tb_tarefas.tb_tarefa_descricao = '$descricao';";
            mysqli_query($conexao, $selectPegaId); 
            $tarefaId = $conexao->query($selectPegaId)->fetch_assoc()['tb_tarefa_id'];
            return $tarefaId;
        } catch (Exception $erro) {
            return $erro;
        }
    }

    function fazerInsertGrupos($integrantes, $tarefaId)
    {
        global $conexao;
        foreach ($integrantes as $integrante) {
            try {
                mysqli_query($conexao, "INSERT INTO tb_grupos (tb_integrante_id, tb_tarefa_id) VALUES ('$integrante', '$tarefaId')");
            } catch (Exception $erro) {
                echo 'Erro - ' . $erro;
            }
        }
        echo "<center style='margin-top:50px; widht:120px;' class='alert alert-info' ><h5 style='margin-left: auto;
        margin-right: auto; 
        width:10px;'>Inserido!</h5></center>";
    }

    function insertTarefa($nome, $descricao)
    {
        global $conexao;
        try {
            mysqli_query($conexao, "INSERT INTO tb_tarefas (tb_tarefa_nome, tb_tarefa_descricao) VALUES ('$nome', '$descricao');");
        } catch (Exception $erro) {
            echo "Erro - " . $erro;
        }
    }
}
?>
<style>
#table{
background-color: lightsalmon;
margin-left: auto;
margin-right: auto; 
width:1366px;
font-size:18px;


}

</style>