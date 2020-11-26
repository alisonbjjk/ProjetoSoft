<?php
session_start();
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
$cadastro_paciente = 'cadastro_paciente.php';
$nova_consulta = 'consulta.php';
?>

<body>
    <div class="cabecalho"></div>
    <div class="pre_form">
        <?php
        echo date("d/m/Y - H:i:s");
        ?>
    </div>

    <div class="form_centro_menor_2">
        <div class="form_conteudo">
            <form id="form_recep" action="relatorio_turno_controller.php" method="get">
                <div class="info">
                    Relatório de atendimentos
                </div>
                <div style="float: left; width: 100%;">
                    <div style="float: left; width: 40%;" class="lbl1">
                        Data Início: <br /><input id="dt_inicio" class="texto" type="text" name="dt_inicio" style="width:120px;" /><br /><br />
                        Data Fim: <br /><input id="dt_fim" class="texto" type="text" name="dt_fim" style="width:120px;" />
                    </div>
                    <div style="float: left; width: 60%;" class="lbl1">
                        <!--                        Data final: <br /><input id="dt_final" class="texto" type="text" name="dt_final" style="width:120px;"/>-->
                        Plantão: <br />
                        <div style="margin-top: 10px;">
                            <input type='radio' name='turno' value='m' /><label>Manhã</label>&nbsp;
                            <input type='radio' name='turno' value='n' /><label>Noite</label>&nbsp;
                            <input type='radio' name='turno' value='a' /><label>Ambos</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div style="float: left; width: 100%; margin-top: 60px;" class="lbl1">
                        <!--                        Turno: <br />
                                                <input type='radio' name='turno' value='m' /><label>Manhã</label>&nbsp;
                                                <input type='radio' name='turno' value='n' /><label>Noite</label>&nbsp;
                                                <input type='radio' name='turno' value='a' /><label>Ambos</label>-->
                    </div>
                    <br />
                    <br />
                    <div id="sub" class="form_submit_centro">
                        <input id="sub_bt" class="botao" type="submit" value="Consultar" />
                    </div>
                    <div id="sub" class="form_submit_centro" style="float: left">
                        <input id="sub_bt" class="botao" type="button" value="Voltar" onClick="voltar();" />
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        $('#dt_inicio').mask("99/99/9999");
        $('#dt_fim').mask("99/99/9999");

        function voltar() {
            history.back(1);
        }
    </script>
</body>