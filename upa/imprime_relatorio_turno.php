<?php

session_start();
//include ("inc/headerImprimir.php");
include("inc/conn.php");

if (isset($_GET['dt_inicio'])) {
    $dt_inicio = $_GET['dt_inicio'];
} else {
    $dt_inicio = date("d/m/Y");
}
if (isset($_GET['dt_fim'])) {
    $dt_fim = $_GET['dt_fim'];
} else {
    $dt_fim = "";
}
if (isset($_GET['turno'])) {
    $turno = $_GET['turno'];
} else {
    $turno = "m";
}
$relatorio = getRelatorioExcel($dt_inicio, $turno, $dt_fim);
?>
<!--<body onload="window.print();">
    <div class="cabecalho"></div>
    <div class="pre_form">
        <?php
        echo date("d/m/Y - H:i:s");
        ?>
    </div>
    <div style="margin: auto; text-align: center; padding-top: 15px;">
        <table class="info_busca2">
            <th class="info_busca2_primeiro2">
                ID
            </th>
            <th class="info_busca2_meio2" style="text-align: left;">
                Paciente - Responsável
            </th>
            <th class="info_busca2_meio2" width="100px">
                Nascimento - Idade
            </th>
            <th class="info_busca2_meio2" width="200px">
                CPF - RG
            </th>
            <th class="info_busca2_meio2" width="140px">
                Data - Hora
            </th>
            <th class="info_busca2_meio2" width="100px">
                Bairro - Cidade
            </th>
            <th class="info_busca2_meio2" width="60px">
                Plantão
            </th>
            <th class="info_busca2_ultima2" width="40px">
                Sexo
            </th>
            </tr>
            <?php
            //$relatorio = getRelatorioImpressao($dt_inicio, $turno, $dt_fim);
            ?>
        </table>

    </div>-->