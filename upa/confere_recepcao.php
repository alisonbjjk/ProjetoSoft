<!DOCTYPE html>
<?php
session_start();
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");

if (isset($_GET['id'])) {
    $paciente = getDadosPacienteById($_GET['id']);
    $_SESSION['paciente'] = $paciente;
    //$paciente = $_GET['paciente'];
} else {
    $paciente = $_SESSION['paciente'];
}

$nascimento = "";
if ($paciente['dt_nasc_paciente'] != "0000-00-00" && $paciente['dt_nasc_paciente'] != null) {
    $nascimento = bancoPaginaData($paciente['dt_nasc_paciente']);
}

?>


<html>

<body>
    <div class="cabecalho"></div>
    <div class="pre_form">
        <?php
        echo date("d/m/Y - H:i:s");
        ?>
    </div>
    <div class="form">
        <div class="form_conteudo">

            <form id="form_recep" name="form_recep" action="confere_recepcao_controller.php" method="post" onSubmit="return(valida(this))">
                <div class="info">
                    Informações do Paciente
                </div>

                <div class="lbl1">
                    <div class="lbl_interno">Atendimento</div>
                </div>
                <div class="lbl2_3">
                    <div class="lbl_interno">
                        <input class="radio" type="radio" name="atendimento" value="C" checked><span class="lbl_interno_2">Clínica Médica</span>
                        <input class="radio" type="radio" name="atendimento" value="P"><span class="lbl_interno_2">Pediatria</span>
                        <input class="radio" type="radio" name="atendimento" value="M"><span class="lbl_interno_2">Medicamento</span>
                        <input class="radio" type="radio" name="atendimento" value="O"><span class="lbl_interno_2">Odontologia</span>
                        <input class="radio" type="radio" name="atendimento" value="S"><span class="lbl_interno_2">Sutura</span>
                    </div>
                </div>
                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">Nome</div>
                </div>
                <input id="nome" class="texto" type="text" name="nome" value="<?php echo strtoupper($paciente['nm_paciente']); ?>" />

                <div class="lbl2">
                    <div class="lbl_interno">Sexo</div>
                </div>
                <div class="lbl2_2">
                    <div class="lbl_interno">
                        <?php
                        if ($paciente['sexo_paciente'] == 'm') {
                            echo '<input class="radio" type="radio" name="sexo" value="M" checked><span class="lbl_interno_2">Masculino</span<</input>
                                <input class="radio" type="radio" name="sexo" value="F"><span class="lbl_interno_2">Feminino</span></input>';
                        } else if ($paciente['sexo_paciente'] == 'f') {
                            echo '<input class="radio" type="radio" name="sexo" value="M"><span class="lbl_interno_2">Masculino</span<</input>
                                <input class="radio" type="radio" name="sexo" value="F" checked><span class="lbl_interno_2">Feminino</span></input>';
                        } else {
                            echo '<input class = "radio" type = "radio" name = "sexo" value = "M" disabled><span class = "lbl_interno_2">Masculino</span<</input><input class = "radio" type = "radio" name = "sexo" value = "F" disabled checked ><span class = "lbl_interno_2">Feminino</span></input>';
                        }
                        ?>
                    </div>
                </div>

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">CPF</div>
                </div>
                <input id="cpf" class="texto" type="text" name="cpf" value="<?php echo $paciente['cpf_paciente']; ?>" />
                <div class="lbl2">
                    <div class="lbl_interno">RG</div>
                </div>
                <input id="rg" class="texto" type="text" name="rg" value="<?php echo $paciente['rg_paciente']; ?>" />

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">Cartão SUS</div>
                </div>
                <input id="ct_sus" maxlength="16" class="texto" type="text" name="ct_sus" value="<?php echo $paciente['nr_cartao_sus_paciente']; ?>" />

                <div class="lbl2">
                    <div class="lbl_interno">Nascimento</div>
                </div>
                <input id="nascimento" class="texto" type="text" name="nascimento" value="<?php echo $nascimento; ?>" />

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

                <span class="lbl1"><span class="lbl_interno">Endereço</span></span>
                <input class="texto" type="text" name="endereco" value="<?php echo strtoupper($paciente['endereco_paciente']); ?>" />

                <div class="lbl2">
                    <div class="lbl_interno">Responsável</div>
                </div>
                <input id="nomeMae" class="texto" type="text" name="nomeMae" value="<?php echo strtoupper($paciente['nm_responsavel_paciente']); ?>" />

                <br />
                <br />

                <div class="lbl1"><span class="lbl_interno">Bairro</span></div>
                <input class="texto" type="text" name="bairro" value="<?php echo strtoupper($paciente['bairro_paciente']); ?>" />
                <span class="lbl2"><span class="lbl_interno">Telefone</span></span>
                <input id="telefone" class="texto" type="text" name="telefone" value="<?php echo $paciente['telefone']; ?>" />

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
                <div target="_blank" class="form_submit">
                    <input class="botao_enviar" target="_blank" type="submit" value="Imprimir/Salvar" />&nbsp;&nbsp;<input target="_blank" type="button" class="botao_dinamico" value="Nova Consulta" onClick="novaConsulta();" />
                    <!--<input class="botao_enviar" type="button" value="Editar" />-->
                </div>


            </form>
        </div>

    </div>





    <script>
        //Código para as máscaras dos formulários
        $('#telefone').mask("(99)9999-9999");
        $('#nascimento').mask("99/99/9999");
        $('#cpf').mask("999.999.999-99");

        //Script para Validar Campos do Formulário
        $(document).ready(function() {
            $("#form_recep").validate({
                // Define as regras
                rules: {
                    nome: {
                        // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                        required: true,
                        minlength: 2
                    },
                    //                    campoEmail:{
                    //                        // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                    //                        required: true, email: true
                    //                    },
                    endereco: {
                        // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                        required: true,
                        minlength: 2
                    }
                },
                // Define as mensagens de erro para cada regra
                messages: {
                    nome: {
                        required: "Digite o seu nome",
                        minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
                    },
                    //                    campoEmail:{
                    //                        required: "Digite o seu e-mail para contato",
                    //                        email: "Digite um e-mail válido"
                    //                    },
                    endereco: {
                        required: "Digite o endereço",
                        minLength: "O seu endereço deve conter, no mínimo, 2 caracteres"
                    }
                }
            });
        });

        function novaConsulta() {
            window.location.href = "consulta.php";
        }

        function valida(form) {
            var nome;
            var resultado = "s";
            nome = form.nome.value;
            if (nome == "" || nome == null) {
                resultado = "n";
                $(document.form_recep.nome).css({
                    "border": "1px solid #F00",
                    "padding": "0 9px 0 0px"
                });
            }
            if (resultado == "n") {
                return false;
            } else {
                return true;
            }
        }
    </script>




</body>

</html>