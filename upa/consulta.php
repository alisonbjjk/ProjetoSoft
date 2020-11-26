<!DOCTYPE html>

<?php
session_start();
$_SESSION['menu_ativo'] = 'inicio';
include("../Model/conn.php");
include("../Controller/verifica.php");
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
?>

<html>

<body>
    <div class="cabecalho"></div>
    <div class="pre_form">
        <?php
        echo date("d/m/Y - H:i:s");
        ?>
    </div>
    <div class="form_centro_menor_2">
        <div class="form_conteudo">
            <form id="form_recep" action="consulta_paciente_controller.php" method="post">
                <div class="info">
                    Consulta dados do Paciente
                </div>
                <select id="tipoCampo" class="combo_medio" name="tipoCampo">
                    <option value="Escolha um campo">Escolha o campo</option>
                    <option value="nome">Nome</option>
                    <option value="cpf">CPF</option>
                    <option value="ct_sus">Cartão SUS</option>
                    <option value="rg">RG</option>
                </select>
                <br />
                <br />

                <div id="lbl_nm" class="lbl1" style="display:none;">
                    <div id="lbl_nm_int" class="lbl_interno" style="display: none;">Nome</div>
                </div>
                <input id="nome" class="texto" type="text" name="nome" style="display:none;" />

                <div id="lbl_cpf" class="lbl1" style="display:none;">
                    <div id="lbl_cpf_int" class="lbl_interno" style="display:none;">CPF</div>
                </div>
                <input id="cpf" class="texto" type="text" name="cpf" style="display:none;" />

                <div id="lbl_ct_sus" class="lbl1" style="display:none;">
                    <div id="lbl_ct_sus_int" class="lbl_interno" style="display:none;">Cartão SUS</div>
                </div>
                <input id="ct_sus" maxlength="16" class="texto" type="text" name="ct_sus" style="display:none;" />

                <div id="lbl_rg" class="lbl1" style="display:none;">
                    <div id="lbl_rg_int" class="lbl_interno" style="display:none;">RG</div>
                </div>
                <input id="rg" class="texto" type="text" name="rg" style="display:none;" />

                <br />
                <br />
                <div id="sub" class="form_submit_centro" style="display:none;">
                    <input id="sub_bt" class="botao" type="submit" value="Consultar" style="display:none;" />
                </div>

                <div id="sub" class="form_submit_centro" style="float: left">
                    <input id="sub_bt" class="botao" type="button" value="Relatório" onclick="window.location.href='relatorio_turno.php';" />
                </div>
            </form>
        </div>

    </div>


    <script>
        //Código para as máscaras dos formulários
        $('#telefone').mask("(99)9999-9999");
        $('#nascimento').mask("99/99/9999");
        $('#cpf').mask("999.999.999-99");
        //        $('#rg').mask("999.999.999");

        $('#tipoCampo').change(function() {

            escolhido = $('#tipoCampo').val();
            //            alert("Valor do Escolhido: " + escolhido);


            if (escolhido == 'cpf') {
                $('#lbl_cpf').show();
                $('#lbl_cpf_int').show();
                $('#cpf').show();
                $('#cpf').focus();
                //            
                $('#lbl_ct_sus').hide();
                $('#lbl_ct_sus_int').hide();
                $('#ct_sus').hide();
                $('#lbl_rg').hide();
                $('#lbl_rg_int').hide();
                $('#rg').hide();
                $('#lbl_nm').hide();
                $('#lbl_nm_int').hide();
                $('#nome').hide();
                //            
                $('#sub').show();
                $('#sub_bt').show();
            }

            //            if (escolhido == 'cpf') {
            //                Alert("Escolhido, CPF");
            //                $('#lbl_cpf').show();
            //                $('#lbl_cpf_int').show();
            //                $('#cpf').show();
            //
            //                $('#lbl_ct_sus').hide();
            //                $('#lbl_ct_sus_int').hide();
            //                $('#ct_sus').hide();
            //                $('#lbl_rg').hide();
            //                $('#lbl_rg_int').hide();
            //                $('#rg').hide();
            //                
            //                $('#sub').show();
            //                $('#sub_bt').show();
            //            } 
            //            
            if (escolhido == 'ct_sus') {
                $('#lbl_ct_sus').show();
                $('#lbl_ct_sus_int').show();
                $('#ct_sus').show();
                $('#ct_sus').focus();

                $('#lbl_cpf').hide();
                $('#lbl_cpf_int').hide();
                $('#cpf').hide();
                $('#lbl_rg').hide();
                $('#lbl_rg_int').hide();
                $('#rg').hide();
                $('#lbl_nm').hide();
                $('#lbl_nm_int').hide();
                $('#nome').hide();

                $('#sub').show();
                $('#sub_bt').show();
            }
            //        
            if (escolhido == 'rg') {
                $('#lbl_rg').show();
                $('#lbl_rg_int').show();
                $('#rg').show();
                $('#rg').focus();

                $('#lbl_cpf').hide();
                $('#lbl_cpf_int').hide();
                $('#cpf').hide();
                $('#lbl_ct_sus').hide();
                $('#lbl_ct_sus_int').hide();
                $('#ct_sus').hide();
                $('#lbl_nm').hide();
                $('#lbl_nm_int').hide();
                $('#nome').hide();

                $('#sub').show();
                $('#sub_bt').show();
            }

            if (escolhido == 'nome') {
                $('#lbl_nm').show();
                $('#lbl_nm_int').show();
                $('#nome').show();
                $('#nome').focus();

                $('#lbl_cpf').hide();
                $('#lbl_cpf_int').hide();
                $('#cpf').hide();
                $('#lbl_rg').hide();
                $('#lbl_rg_int').hide();
                $('#rg').hide();
                $('#lbl_ct_sus').hide();
                $('#lbl_ct_sus_int').hide();
                $('#ct_sus').hide();

                $('#sub').show();
                $('#sub_bt').show();
            }

            if (escolhido == 'Escolha um campo') {
                $('#lbl_cpf').hide();
                $('#lbl_cpf_int').hide();
                $('#cpf').hide();
                $('#lbl_ct_sus').hide();
                $('#lbl_ct_sus_int').hide();
                $('#ct_sus').hide();
                $('#lbl_rg').hide();
                $('#lbl_rg_int').hide();
                $('#rg').hide();
                $('#sub').hide();
                $('#lbl_nm').hide();
                $('#lbl_nm_int').hide();
                $('#nome').hide();
                $('#sub_bt').show();
            }

        });


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
    </script>




</body>

</html>