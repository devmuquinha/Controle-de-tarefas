<?php
include 'Conexao.php';
class tarefa
{
    function puxarIntegrantes()
    {
        global $conexao;
        $select = "select * from tb_integrantes";
        $informacao = mysqli_query($conexao, $select);
        echo '<label for="integrantes" class="escolha">Escolha os integrantes:</label><br>';
        while ($dados = mysqli_fetch_array($informacao)) { //Puxa integrantes de dentro do banco
            echo "<table class='tab' border='1'>
            <thead class='thead' >
                <tr class='tr'>
                  <th ><input type='checkbox' class='chb' name = 'ckbx_integrantes[]' value='" . $dados['tb_integrante_id'] . "'> </th>
                  <th class='nome' >" . $dados['tb_integrante_nome'] . "</th>
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
        $idTarefa = '';
        $nomes = '';
        $tarefaId = '';
        $tarefasIniciado = false;

        $select = "select tb_tarefas.tb_tarefa_id, tb_tarefas.tb_tarefa_nome, tb_tarefas.tb_tarefa_descricao, tb_integrantes.tb_integrante_nome, tb_tarefas.tb_tarefa_situacao, tb_grupos.tb_integrante_id
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

            if ($tarefasIniciado == false) { //Lógica para abrir a 1º tabela se for a primeira vez passando dentro do while
                echo "<table class='table'>";
                $tarefasIniciado = true;
            }

            if ($dados['tb_tarefa_situacao'] == '0') { //Verifica se a tarefa está concluida e mostra as não concluidas

                if (str_contains($nomes, $_SESSION['login']) && $idTarefa != $dados['tb_tarefa_id']) { //Verifica se o nome da sessão é igual a algum dos nomes de integrantes e se é uma nova tarefa para acrescentar a checkbox de conclusão
                    echo " <input type='checkbox' id='chb' name = 'ckbx_tarefas[]' value='$tarefaId'></tr>";
                }

                if ($idTarefa != $dados['tb_tarefa_id']) { //Se a tarefa acabou a tupla é fechada
                    echo " </th></thead>";
                }

                if ($idTarefa != $dados['tb_tarefa_id']) { //Se a tarefa puxada for nova é criada uma nova tupla
                    echo "
                    <thead>
                    <tr>
                         <th scope='col'>Nome - " .        $dados['tb_tarefa_nome'] .
                        "</th><th scope='col'>Descrição - " .   $dados['tb_tarefa_descricao'] .
                        "</th><th scope='col'>Nome integrantes - " . $dados['tb_integrante_nome'];

                    $nomes = '';
                    $nomes = $nomes . ' ' . $dados['tb_integrante_nome'];
                    $idTarefa = $dados['tb_tarefa_id'];
                } else { //Se a tarefa puxara for a mesma é acrescentado um integrante
                    echo ", " . $dados['tb_integrante_nome'];
                    $nomes = $nomes . ' ' . $dados['tb_integrante_nome'] . "";
                }
                $tarefaId = $dados['tb_tarefa_id'];
            } else {
            }
        };

        if (str_contains($nomes, $_SESSION['login'])) { //Verifica se o nome da sessão é igual a algum dos nomes de integrantes para acrescentar a checkbox de exclusão
            echo " <input type='checkbox' id='chb' name = 'ckbx_tarefas[]' value='$tarefaId'></tr>";
        }
        echo "</table>";
        $tarefasIniciado = false;
    }

    function pegaIdTarefa()
    {
        global $conexao;
        try {
            $selectPegaId = "SELECT MAX(tb_tarefa_id) FROM tb_tarefas;";

            $informacao = mysqli_query($conexao, $selectPegaId);
            $dado = mysqli_fetch_array($informacao);
            $tarefaId = $dado[0];
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
        $excluidoBool = false;
        foreach ($tarefas as $tarefa) {
            try {
                mysqli_query($conexao, "UPDATE tb_tarefas SET tb_tarefa_situacao = '1' WHERE tb_tarefa_id = '$tarefa';");
                $excluidoBool = true;
            } catch (Exception $erro) {
                echo 'Erro - ' . $erro;
                $excluidoBool = false;
            }
        }
        if ($excluidoBool == true) {
            header('location:tarefas.php');
        }
    }

    function fazerLogin($login, $senha)
    {
        global $conexao;

        $login = mysqli_real_escape_string($conexao, $login);
        $senha = mysqli_real_escape_string($conexao, $senha);
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
            echo '<div class="login"><label style="margin-top:5px;">Login não encontrado</label></div>';
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
