<?php

session_start();
include("../Model/conn.php");
include("../upa/inc/conn.php");

$nome = $_POST['nome'];
$sexo = $_POST['sexo'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];

$nascimento = $_POST['nascimento'];
$proficao = $_POST['profissao'];
$estadoCivil = $_POST['estado_civil'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$idUF = $_POST['cod_uf_usuario'];
$idCidade = $_POST['cod_cid_usuario'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$nascimento = "";

if ($_POST['nascimento'] != null && $_POST['nascimento'] != "") {
    $nascimento = paginaBancoData($_POST['nascimento']);
}


inserirProfi($nome, $sexo, $rg, $cpf, $nascimento, $proficao, $estadoCivil, $endereco, $bairro, $idUF, $idCidade, $telefone, $email);



//    $_SESSION['paciente'] = $paciente;
//    $resultado = insertRecepcao($paciente_dados['id'], $_POST['atendimento']);
//    //print_r ($resultado);
//    //die();
//    $_SESSION['resultado'] = $resultado;

header("Location: ../upa/consulta.php");
