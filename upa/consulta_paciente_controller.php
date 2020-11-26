<?php
session_start();
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
$tipo_campo = $_POST['tipoCampo'];
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
    <div class="form_centro_menor" style="text-align: center; padding-top: 15px;">
        <?php
        if ($tipo_campo == 'cpf') {
            $resultado = $_POST['cpf'];
            $paciente = getDadosPacienteByCpf($resultado);
            if ($paciente <> null) {
                echo 'Paciente: ' . $paciente['nm_paciente'] . ' - ' . $paciente['cpf_paciente'];
                $_SESSION['paciente'] = $paciente;
                header("Location: confere_recepcao.php");
            } else {
                echo 'Paciente não encontrado por CPF';
                echo '<br /><br /><input type="button" class="botao_dinamico" value="Novo cadastro" onClick="cadPaciente();"/>';
                echo '<br /><br /><input type="button" class="botao_dinamico" value="Nova Consulta" onClick="novaConsulta();"/>';
            }
        }
        if ($tipo_campo == 'ct_sus') {
            $resultado = $_POST['ct_sus'];
            $paciente = getDadosPacienteByCtSUS($resultado);
            if ($paciente <> null) {
                echo 'Paciente: ' . $paciente['nm_paciente'] . ' - ' . $paciente['nr_cartao_sus_paciente'];
                $_SESSION['paciente'] = $paciente;
                header("Location: confere_recepcao.php");
            } else {
                echo 'Paciente não encontrado por cartão SUS';
                echo '<br /><br /><input type="button" class="botao_dinamico" value="Novo cadastro" onClick="cadPaciente();"/>';
                echo '<br /><br /><input type="button" class="botao_dinamico" value="Nova Consulta" onClick="novaConsulta();"/>';
            }
        }
        if ($tipo_campo == 'rg') {
            $resultado = $_POST['rg'];
            $paciente = getDadosPacienteByRg($resultado);
            if ($paciente <> null) {
                echo 'Paciente: ' . $paciente['nm_paciente'] . ' - ' . $paciente['rg_paciente'];
                $_SESSION['paciente'] = $paciente;
                header("Location: confere_recepcao.php");
            } else {
                echo 'Paciente não encontrado por RG';
                echo '<br /><br /><input type="button" class="botao_dinamico" value="Novo cadastro" onClick="cadPaciente();"/>';
                echo '<br /><br /><input type="button" class="botao_dinamico" value="Nova Consulta" onClick="novaConsulta();"/>';
            }
        }
        if ($tipo_campo == 'nome') {
            $resultado = $_POST['nome'];
            //            $_SESSION['request_nome'] = $_POST['nome'];
            header("location: busca_controller.php?b=" . $resultado);
        }


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
        </script>
    </div>