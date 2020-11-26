<!DOCTYPE html>
<?php
session_start();
ini_set('default_charset', 'UTF-8');
date_default_timezone_set("Brazil/East");
include("inc/headerImprimir.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");

if (isset($_GET['id'])) {
    $paciente = getDadosPacienteById($_GET['id']);
    $_SESSION['paciente'] = $paciente;
    //$paciente = $_GET['paciente'];
} else {
    $paciente = $_SESSION['paciente'];
}
$resultado = $_SESSION['resultado'];

$nascimento = "";
if ($paciente['dt_nasc_paciente'] != "0000-00-00" && $paciente['dt_nasc_paciente'] != null) {
    $nascimento = bancoPaginaData($paciente['dt_nasc_paciente']);
}

if ($resultado['turno'] == "m") {
    $resultado['turno'] = "Manhã";
} else {
    $resultado['turno'] = "Noite";
}

?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">
        function DoPrinting() {
            if (!window.print) {
                alert("Erro ao tentar Imprimir.")
                return
            }
            window.print();
            window.location.href = 'index.php';
        }
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FFF;
            font: 12pt "Tahoma";


        }

        /* * {
                 box-sizing: border-box;
                 -moz-box-sizing: border-box;
             }*/
        .page {
            width: 794px;
            height: 260mm;
            padding: 0px;
            margin: 0;
            margin-left: 10px;
            border: 1px white solid;
            /* //border-radius: 5px; */
            background: white;

            /* //box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
        }

        .subpage {
            padding: 0;
            border: 1px white solid;
            height: 280mm;
            outline: 1cm #fff solid;
            margin: 30px;
            margin-left: 10px;

        }

        .cab {
            margin-top: 0px;
            width: 100%;
            border: 0px white solid;
            height: 113px;
        }

        .cab2 {
            margin-top: 0px;
        }

        .corpo {
            margin-top: 72px;
            border: 0px red solid;
            width: 100%;
            height: 162px;

        }

        .interno {
            margin: 4px;
            /* //border: 1px blue solid; */
            width: 100%;
            height: 100%;

        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                /*                    border-radius: initial;
                                        width: initial;*/
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        input {
            text-align: left;
            padding-right: 3px;
        }

        /* div {
            border: 1px solid white;
        } */
    </style>
</head>

<body onload="DoPrinting();">
    <div class="cabecalho"></div>
    <div class="pre_form">
        <p style="text-align: center; margin: 50px 0 30px 0px; font-weight: bolder; font-size: 20px">
            Boletim de Atendimento de Urgência
        </p>
        <p style="text-align: left; margin: 30px 0 15px 20px;">
            <?php
            echo 'Controle: <span style="font-weight: bolder;">' . $resultado['controle'] . '</span> - Turno: <span style="font-weight: bolder;">' . $resultado['turno'] . "</span> - " . date("d/m/Y - H:i:s");
            ?>
        </p>
    </div>
    <div class="form">
        <div class="form_conteudo">

            <form id="form_recep" name="form_recep" action="" method="post">
                <div class="info" style="margin-top: 30px">
                    Informações do Paciente
                </div>
                <div class="lbl1">
                    <div class="lbl_interno">Nome</div>
                </div>
                <input id="nome" class="texto" type="text" readonly="true" name="nome" value="<?php echo strtoupper($paciente['nm_paciente']); ?>" />

                <div class="lbl2">
                    <div class="lbl_interno">Sexo</div>
                </div>
                <div class="lbl2_2">
                    <div class="lbl_interno">
                        <?php
                        if ($paciente['sexo_paciente'] == 'm') {
                            echo '<input class="radio" type="radio" name="sexo" value="m" checked ><span class="lbl_interno_2">Masculino</span<</input>
                                <input class="radio" type="radio" name="sexo" value="f" disabled="true"><span class="lbl_interno_2">Feminino</span></input>';
                        } else if ($paciente['sexo_paciente'] == 'f') {
                            echo '<input class="radio" type="radio" name="sexo" value="m" ><span class="lbl_interno_2">Masculino</span<</input>
                                <input class="radio" type="radio" name="sexo" value="f" checked ><span class="lbl_interno_2">Feminino</span></input>';
                        } else {
                            echo '<input class = "radio" type = "radio" name = "sexo" value = "m"><span class = "lbl_interno_2">Masculino</span<</input><input class = "radio" type = "radio" name = "sexo" value = "f" disabled checked ><span class = "lbl_interno_2">Feminino</span></input>';
                        }
                        ?>
                    </div>
                </div>

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">CPF</div>
                </div>
                <input id="cpf" class="texto" type="text" name="cpf" readonly="true" value="<?php echo $paciente['cpf_paciente']; ?>" />
                <div class="lbl2">
                    <div class="lbl_interno">RG</div>
                </div>
                <input id="rg" class="texto" type="text" name="rg" readonly="true" value="<?php echo $paciente['rg_paciente']; ?>" />

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">Cartão SUS</div>
                </div>
                <input id="ct_sus" maxlength="16" class="texto" type="text" name="ct_sus" readonly="true" value="<?php echo $paciente['nr_cartao_sus_paciente']; ?>" />

                <div class="lbl2">
                    <div class="lbl_interno">Nascimento</div>
                </div>
                <input id="nascimento" class="texto" type="text" name="nascimento" readonly="true" value="<?php echo $nascimento; ?>" />

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">Profissão</div>
                </div>
                <select name="profissao" class="combo">
                    <?php
                    getProfissaoPorID($paciente['id_profissao']);
                    ?>
                </select>
                <span class="lbl2"><span class="lbl_interno">Estado Civil</span></span>
                <select name="estado_civil" class="combo">
                    <?php
                    getEstadoCivilPorID($paciente['id_estado_civil']);
                    ?>
                </select>

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">Mãe</div>
                </div>
                <input id="nomeMae" class="texto" type="text" name="nomeMae" readonly="true" value="<?php echo strtoupper($paciente['nm_responsavel_paciente']); ?>" />

                <span class="lbl2"><span class="lbl_interno">Endereço</span></span>
                <input class="texto" type="text" name="endereco" readonly="true" value="<?php echo strtoupper($paciente['endereco_paciente']); ?>" />


                <br />
                <br />

                <div class="lbl1"><span class="lbl_interno">Bairro</span></div>
                <input class="texto" type="text" name="bairro" readonly="true" value="<?php echo strtoupper($paciente['bairro_paciente']); ?>" />
                <span class="lbl2"><span class="lbl_interno">Telefone</span></span>
                <input id="telefone" class="texto" type="text" name="telefone" readonly="true" value="<?php echo $paciente['telefone']; ?>" />

                <br />
                <br />
                <span class="lbl1"><span class="lbl_interno">UF/Cidade</span></span>
                <select id="cod_uf_usuario" name="cod_uf_usuario" class="combo_uf" onchange="CarregaCidades(this.value, this.id, 'cod_cid_usuario', 'carregando_usuario');">
                    <?php getUFPorID($paciente['id_estado']); ?>
                </select>
                <select id="cod_cid_usuario" name="cod_cid_usuario" class="combo_cidades">
                    <?php getCidadesPorID($paciente['id_cidade'], $paciente['id_estado']); ?>
                </select>



                <br />
                <div class="form_submit">

                </div>


            </form>
        </div>

    </div>

</body>

</html>