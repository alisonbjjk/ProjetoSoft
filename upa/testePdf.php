<?php

include("./inc/MPDF57/mpdf.php");
session_start();
ini_set('default_charset', 'UTF-8');
date_default_timezone_set("Brazil/East");
//include ("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
$paciente = $_SESSION['paciente'];
$resultado = $_SESSION['resultado'];

$nascimento = "";
if ($paciente['dt_nasc_paciente'] != '0000-00-00' && $paciente['dt_nasc_paciente'] != null) {
    $nascimento = $paciente['dt_nasc_paciente'];
}

if (isset($resultado['turno'])) {
    if ($resultado['turno'] == "m") {
        $resultado['turno'] = "Manhã";
    } else {
        $resultado['turno'] = "Noite";
    }
}




$html = "
<fieldset>
<h1> " . $paciente['nm_paciente'] . " </h1>
<p class='center sub-titulo'>
Nº <strong>0001</strong> -
VALOR <strong>R$ 700,00</strong>
</p>
<p>Recebi(emos) de <strong>Ebrahim Paula Leite</strong></p>
<p>a quantia de <strong>Setecentos Reais</strong></p>
<p>Correspondente a <strong>Serviços prestados ..<strong></p>
<p>e para clareza firmo(amos) o presente.</p>
<p class='direita'>Itapeva, 11 de Julho de 2017</p>
<p>Assinatura ......................................................................................................................................</p>
<p>Nome <strong>Alberto Nascimento Junior</strong> CPF/CNPJ: <strong>222.222.222-02</strong></p>
<p>Endereço <strong>Rua Doutor Pinheiro, 144 - Centro, Itapeva - São Paulo</strong></p>
</fieldset>
<div class='creditos'>
<p><a href='https://www.webcreative.com.br/artigo/gerar-pdf-com-php-e-html-usando-a-biblioteca-mpdf' target='_blank'>Aprenda como gerar PDF com PHP e HTML usando a biblioteca MPDF aqui</a></p>
</div>
";

$mpdf = new mPDF();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("css/estiloPdf.css");
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html);
$mpdf->Output();

exit;
