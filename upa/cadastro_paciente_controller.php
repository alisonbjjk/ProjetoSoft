<?php
session_start();
include("inc/conn.php");
include("inc/header.php");


$_SESSION['nome'] = $_POST['nome'];
$_SESSION['sexo'] = $_POST['sexo'];
$_SESSION['rg'] = $_POST['rg'];
$_SESSION['cpf'] = $_POST['cpf'];
$_SESSION['ct_sus'] = $_POST['ct_sus'];
$_SESSION['atendimento'] = $_POST['atendimento'];

$_SESSION['nascimento'] = $_POST['nascimento'];
$_SESSION['profissao'] = $_POST['profissao'];
$_SESSION['estado_civil'] = $_POST['estado_civil'];
$_SESSION['endereco'] = $_POST['endereco'];
$_SESSION['bairro'] = $_POST['bairro'];
$_SESSION['cod_uf_usuario'] = $_POST['cod_uf_usuario'];
$_SESSION['cod_cid_usuario'] = $_POST['cod_cid_usuario'];
$_SESSION['telefone'] = $_POST['telefone'];
$_SESSION['nomeMae'] = $_POST['nomeMae'];
$nascimento = "";
if ($_POST['nascimento'] != null && $_POST['nascimento'] != "") {
    $nascimento = paginaBancoData($_POST['nascimento']);
}
$paciente_dados = insertPaciente($_POST['nome'], $_POST['sexo'], $_POST['cpf'], $_POST['rg'], $_POST['ct_sus'], $nascimento, $_POST['profissao'], $_POST['estado_civil'], $_POST['endereco'], $_POST['bairro'], $_POST['cod_cid_usuario'], $_POST['cod_uf_usuario'], $_POST['telefone'], $_POST['nomeMae']);
if ($paciente_dados['ok'] == 1) {
    $insert_paciente = 1;
    $paciente = getDadosPacienteById($paciente_dados['id']);
    $_SESSION['idade'] = "";
    if ($paciente['dt_nasc_paciente'] != '0000-00-00' && $paciente['dt_nasc_paciente'] != null) {
        $_SESSION['idade'] = calc_idade(date('d/m/Y', strtotime($paciente['dt_nasc_paciente'])));
    }
    $_SESSION['paciente'] = $paciente;
    $resultado = insertRecepcao($paciente_dados['id'], $_POST['atendimento']);
    //print_r ($resultado);
    //die();
    $_SESSION['resultado'] = $resultado;
    header("Location: Imprime_Atendimento.php");
} else {
    echo '<br />Não cadastrou paciente';
}
