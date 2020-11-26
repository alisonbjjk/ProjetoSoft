<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
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

$redirecionamento = "imprime_relatorio_turno.php?dt_inicio=" . $dt_inicio . "&turno=" . $turno . "&dt_fim=" . $dt_fim;

?>

<body>
    <div class="cabecalho"></div>
    <div class="pre_form">
        <?php
        echo date("d/m/Y - H:i:s");
        ?>
    </div>
    <!--    <form method="post" action="confere_recepcao.php" id="form_paciente">
            <input type="hidden" name="id_paciente" id="id_paciente" />
        </form>-->
    <div style="margin: auto; text-align: center; padding-top: 15px;">
        <table class="info_busca">
            <th class="info_busca_primeiro">
                ID
            </th>
            <th class="info_busca_meio" width="370px" style="text-align: left;">
                Paciente - Responsável
            </th>
            <th class="info_busca_meio">
                Nascimento - Idade
            </th>
            <th class="info_busca_meio">
                CPF - RG
            </th>
            <th class="info_busca_meio">
                Data - Hora
            </th>
            <th class="info_busca_meio">
                Bairro - Cidade
            </th>
            <th class="info_busca_meio">
                Plantão
            </th>
            <th class="info_busca_ultima">
                Sexo
            </th>
            </tr>
            <?php
            $relatorio = getRelatorio($dt_inicio, $turno, $dt_fim);
            ?>
        </table>
        <div style="margin: auto; padding-top: 20px; text-align: center;">
            <input type="button" class="botao_dinamico" value="&nbsp;&nbsp;Voltar&nbsp;&nbsp;" width="110px" onClick="voltar();" />&nbsp;&nbsp;
            <input type="button" class="botao_dinamico" value="Novo cadastro" onClick="cadPaciente();" />&nbsp;&nbsp;<input type="button" class="botao_dinamico" value="Nova Consulta" onClick="novaConsulta();" />
            &nbsp;&nbsp;<input type="button" class="botao_dinamico" value="Imprime Relatório" onClick="imprimirRelatorio();" />
        </div>

        <?php
        //echo '<br />Resultado: ' . $resultado;
        //echo '<br />Tipo do Campo: ' . $tipo_campo;
        ?>

        <script>
            function cadPaciente() {
                window.location.href = "cadastro_paciente.php";
            }

            function novaConsulta() {
                window.location.href = "consulta.php";
            }

            function imprimirRelatorio() {
                window.location.href = "<?php echo $redirecionamento; ?>";
            }

            function voltar() {
                history.back(1);
            }
        </script>
    </div>