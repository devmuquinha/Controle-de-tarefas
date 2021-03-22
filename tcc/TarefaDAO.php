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
            echo "<input type='checkbox' id='chb' name = 'ckbx_integrantes[]' value='" . $dados['tb_integrante_id'] . "'> " . $dados['tb_integrante_nome'] . " <br>";
        }
        echo '<br>';
    }

    function puxarTarefas()
    {
        global $conexao;
        $nomeTarefa = '';
        $jacomecado = false;
        $nomes = '';

        $select = "select tb_tarefas.tb_tarefa_id, tb_tarefas.tb_tarefa_nome, tb_tarefas.tb_tarefa_descricao, tb_integrantes.tb_integrante_nome 
        from tb_grupos
        inner join tb_tarefas
        on tb_grupos.tb_tarefa_id = tb_tarefas.tb_tarefa_id
        inner join tb_integrantes
        on tb_integrantes.tb_integrante_id = tb_grupos.tb_integrante_id
        order by tb_tarefas.tb_tarefa_id;";

        $InformacaoidMaximo = mysqli_query($conexao, "SELECT MAX(tb_tarefa_id) FROM tb_tarefas;");
        $idMaximo = mysqli_fetch_array($InformacaoidMaximo);
        $informacao = mysqli_query($conexao, $select);
        $idMaximo = $idMaximo[0];
        while ($dados = mysqli_fetch_array($informacao)) { //Puxa as tarefas separando por integrantes
            if ($jacomecado == false) {
                
                echo "
                     <th scope='col'>" . $dados['tb_tarefa_nome'] .
                    "<th scope='col'>" . $dados['tb_tarefa_descricao'] .
                    "<th scope='col'>" . $dados['tb_integrante_nome'];
                    
                $nomes = $nomes . ' ' . $dados['tb_integrante_nome'];
                $nomeTarefa = $dados['tb_tarefa_nome'];
                $jacomecado = true;
            } else {
                if ($nomeTarefa == $dados['tb_tarefa_nome']) {
                    echo ", " . $dados['tb_integrante_nome'];
                    $nomes = $nomes . ' ' . $dados['tb_integrante_nome'];
                } else {
                    if (str_contains($nomes, $_SESSION['login']))
                    {
                    echo "<th scope='col'> <input type='checkbox' id='chb' name = 'ckbx_integrantes[]' value='valor'>";
                    }
                    $nomes = '';
                    echo "<tr>
                         <th scope='col'>" . $dados['tb_tarefa_nome'] .
                        "<th scope='col'>" . $dados['tb_tarefa_descricao'] .
                        "<th scope='col'>" . $dados['tb_integrante_nome'];
                    $nomes = $nomes . ' ' . $dados['tb_integrante_nome'];
                    $nomeTarefa = $dados['tb_tarefa_nome'];
                }$tarefaidd = $dados['tb_tarefa_id'];
            }
        };
        if (str_contains($nomes, $_SESSION['login']) && $idMaximo == $tarefaidd )
        {
        echo "<th scope='col'> <input type='checkbox' id='chb' name = 'ckbx_integrantes[]' value='valor'>";
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
            mysqli_query($conexao, "INSERT INTO tb_tarefas (tb_tarefa_nome, tb_tarefa_descricao, tb_tarefa_situacao) VALUES ('$nome', '$descricao', '0');");
        } catch (Exception $erro) {
            echo "Erro - " . $erro;
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
            echo 'Login não encontrado :(';
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