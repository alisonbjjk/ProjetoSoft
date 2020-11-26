<?php
session_start();
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
//$tipo_campo = $_POST['tipoCampo'];
$cadastro_paciente = 'cadastro_paciente.php';
$nova_consulta = 'consulta.php';
?>
<html>
<header></header>

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
        <?php
        $resultado = $_GET['b'];
        ?>

        <table class="info_busca">
            <th class="info_busca_primeiro">
                Id
            </th>
            <th class="info_busca_meio" width="650px" style="text-align: left;">
                Nome completo
            </th>
            <th class="info_busca_meio">
                CPF
            </th>
            <th class="info_busca_ultima">
                RG
            </th>
            </tr>
            <?php
            $paciente = getListaDePacientesByNome($resultado);
            ?>

        </table>
        <div style="margin: auto; padding-top: 20px; text-align: center;">
            <input type="button" class="botao_dinamico" value="&nbsp;&nbsp;Voltar&nbsp;&nbsp;" width="110px" onClick="voltar();" />&nbsp;&nbsp;
            <input type="button" class="botao_dinamico" value="Novo cadastro" onClick="cadPaciente();" />&nbsp;&nbsp;<input type="button" class="botao_dinamico" value="Nova Consulta" onClick="novaConsulta();" />
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

            function voltar() {
                history.back(1);
            }
        </script>
    </div>
</body>

</html>