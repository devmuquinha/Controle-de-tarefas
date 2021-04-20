<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <input type="text" name="txtNome" id="">
    <input type="password" name="txtSenha" id="">
    <button name="btnCadastrar">Cadastrar
    </form>
</body>
</html>

<?php
if (isset($_POST['btnCadastrar'])) {

    try{
    $nome = "root";
    $senha = "root";
    $bancoNome = "db_tarefas_TCC";
    
    $nomeU = $_POST['txtNome'];
    $senhaU = $_POST['txtSenha'];
    $senhaU = md5($senhaU);
    
    $conexao = mysqli_connect("localhost", $nome, $senha, $bancoNome);
    mysqli_query($conexao, "INSERT INTO tb_integrantes (tb_integrante_nome, tb_integrante_senha) VALUES ('$nomeU', '$senhaU')");
    echo "Cadastrado com sucesso!";}
    catch(Exception $erro){
        echo $erro;
    }
    
}

?>