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
            echo "<table border='1' style='width:200px;'>
            <thead style='width:50px;'>
                <tr style='text-align:center;'>
                  <th style='width:10px' ><input type='checkbox' id='chb' name = 'ckbx_integrantes[]' value='" . $dados['tb_integrante_id'] . "'> </th>
                  <th >" . $dados['tb_integrante_nome'] . "</th>
                </tr>
               <tr>
            </thead>
            </tbody>
          </table> ";
        }
        echo '<br>';
    }

    function puxarTarefas()
    {
        global $conexao;
        $nomeTarefa = '';
        $nomes = '';
        $tarefaId = '';

        $select = "select tb_tarefas.tb_tarefa_id, tb_tarefas.tb_tarefa_nome, tb_tarefas.tb_tarefa_descricao, tb_integrantes.tb_integrante_nome, tb_tarefas.tb_tarefa_situacao
        from tb_grupos
        inner join tb_tarefas
        on tb_grupos.tb_tarefa_id = tb_tarefas.tb_tarefa_id
        inner join tb_integrantes
        on tb_integrantes.tb_integrante_id = tb_grupos.tb_integrante_id
        order by tb_tarefas.tb_tarefa_id;";

        $InformacaoidMaximo = mysqli_query($conexao, "SELECT MAX(tb_tarefa_id) FROM tb_tarefas;");
        $idMaximo = mysqli_fetch_array($InformacaoidMaximo);
        $idMaximo = $idMaximo[0];
        $informacao = mysqli_query($conexao, $select);
        while ($dados = mysqli_fetch_array($informacao)) { //Puxa as tarefas separando por integrantes

            if ($dados['tb_tarefa_situacao'] == '0') {
                if (str_contains($nomes, $_SESSION['login']) && $nomeTarefa != $dados['tb_tarefa_nome']) {
                    echo " <input type='checkbox' id='chb' name = 'ckbx_tarefas[]' value='$tarefaId'>";
                }

                if ($nomeTarefa != $dados['tb_tarefa_nome']) {
                    echo '<br> <br>';

                    echo "
                    Nome - " .           $dados['tb_tarefa_nome'] .
                        "<br> Descrição - " . $dados['tb_tarefa_descricao'] .
                        "<br> Nome Tarefa - " . $dados['tb_integrante_nome'];

                    $nomes = '';
                    $nomes = $nomes . ' ' . $dados['tb_integrante_nome'];
                    $nomeTarefa = $dados['tb_tarefa_nome'];
                } else {
                    echo ", " . $dados['tb_integrante_nome'];
                    $nomes = $nomes . ' ' . $dados['tb_integrante_nome'];
                }
                $tarefaId = $dados['tb_tarefa_id'];
            } else {
            }
        };


        if (str_contains($nomes, $_SESSION['login'])) {
            echo " <input type='checkbox' id='chb' name = 'ckbx_tarefas[]' value='$tarefaId'>";
        }
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
        try {
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
        } catch (Exception $e) {
        }
    }


    function insertTarefa($nome, $descricao)
    {
        global $conexao;
        try {
            mysqli_query($conexao, "INSERT INTO tb_tarefas (tb_tarefa_nome, tb_tarefa_descricao, tb_tarefa_situacao) VALUES ('$nome', '$descricao', '0');");
        } catch (Exception $erro) {
            echo "Erro - " . $erro;
        }
    }

    function excluir($tarefas)
    {
        global $conexao;
        foreach ($tarefas as $tarefa) {
            try {
                mysqli_query($conexao, "UPDATE tb_tarefas SET tb_tarefa_situacao = '1' WHERE tb_tarefa_id = '$tarefa';");
                echo "Deletado";
            } catch (Exception $erro) {
                echo 'Erro - ' . $erro;
            }
        }
    }

    function fazerLogin($login, $senha)
    {
        global $conexao;

        $login = mysqli_real_escape_string($conexao, $login);
        $senha = mysqli_real_escape_string($conexao, $senha); //$senha = mysqli_real_escape_string($conexao,md5($senha));
        $selectLogin =  "SELECT * FROM tb_integrantes WHERE tb_integrantes.tb_integrante_nome = '$login' AND tb_integrantes.tb_integrante_senha = '$senha';";

        $resultado = mysqli_query($conexao, $selectLogin);
        if ($resultado->num_rows > 0) {
            $_SESSION['login'] = $login;
            $_SESSION['senha'] = $senha;
            //FAZER O QUE QUISER AQUI 
            header('location:index.php');
            $_SESSION["loggedin"] = true;
            $_SESSION["login"] = $login;
        } else {
            echo '<div class="log"><label style="margin-top:5px;">Login não encontrado</label></div>';
        }
    }

    function deslogar()
    {
        echo 'start';
        session_start();
        $_SESSION = array();
        session_destroy();
        header("location: login.php");
        exit;
    }
}
?>
<style>
    #table {
        background-color: lightsalmon;
        margin-left: auto;
        margin-right: auto;
        width: 1366px;
        font-size: 18px;


    }
</style>