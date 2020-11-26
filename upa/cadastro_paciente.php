<!DOCTYPE html>
<?php
session_start();
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
    <div class="form">
        <div class="form_conteudo">

            <form id="form_recep" name="form_recep" action="cadastro_paciente_controller.php" method="post" onSubmit="return(valida(this))">
                <div class="info">
                    Cadastro do Paciente
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
                <input id="nome" class="texto" type="text" name="nome" />

                <div class="lbl2">
                    <div class="lbl_interno">Sexo</div>
                </div>
                <div class="lbl2_2">
                    <div class="lbl_interno">
                        <input class="radio" type="radio" name="sexo" value="M" checked><span class="lbl_interno_2">Masculino</span>
                        <input class="radio" type="radio" name="sexo" value="F"><span class="lbl_interno_2">Feminino</span>
                    </div>
                </div>

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">CPF</div>
                </div>
                <input id="cpf" class="texto" type="text" name="cpf" />
                <div class="lbl2">
                    <div class="lbl_interno">RG</div>
                </div>
                <input id="rg" class="texto" type="text" name="rg" />

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">Cartão SUS</div>
                </div>
                <input id="ct_sus" maxlength="16" class="texto" type="text" name="ct_sus" />

                <div class="lbl2">
                    <div class="lbl_interno">Nascimento</div>
                </div>
                <input id="nascimento" class="texto" type="text" name="nascimento" />

                <br />
                <br />


                <div class="lbl1">
                    <div class="lbl_interno">Profissão</div>
                </div>
                <select name="profissao" class="combo">
                    <?php
                    getProfissao();
                    ?>
                </select>
                <span class="lbl2"><span class="lbl_interno">Estado Civil</span></span>
                <select name="estado_civil" class="combo">
                    <?php
                    getEstadoCivil();
                    ?>
                </select>

                <br />
                <br />

                <span class="lbl1"><span class="lbl_interno">Endereço</span></span>
                <input class="texto" type="text" name="endereco" />

                <div class="lbl2">
                    <div class="lbl_interno">Responsável</div>
                </div>
                <input id="nomeMae" class="texto" type="text" name="nomeMae" />

                <br />
                <br />

                <div class="lbl1"><span class="lbl_interno">Bairro</span></div>
                <input class="texto" type="text" name="bairro" />
                <span class="lbl2"><span class="lbl_interno">Telefone</span></span>
                <input id="telefone" class="texto" type="text" name="telefone" />


                <br />
                <br />

                <span class="lbl1"><span class="lbl_interno">UF/Cidade</span></span>
                <select id="cod_uf_usuario" name="cod_uf_usuario" class="combo_uf" onchange="CarregaCidades(this.value, this.id, 'cod_cid_usuario', 'carregando_usuario');">
                    <?php getUFPorRN(); ?>
                </select>
                <span id="carregando_usuario" class="carregando">Aguarde, carregando...</span>
                <select id="cod_cid_usuario" name="cod_cid_usuario" class="combo_cidades">
                    <?php getCidadesPorNatal(); ?>
                </select>


                <!--                <div class="lbl2"><div class="lbl_interno">Atendimento</div></div>
                <div class="lbl2_2">
                    <div class="lbl_interno">
                        <input class="radio" type="radio" name="atendimento" value="P" checked><span class="lbl_interno_2">Pediatria&nbsp;</span<</input>
                        <input class="radio" type="radio" name="atendimento" value="C"><span class="lbl_interno_2">Clínica Médica</span></input>
                        <input class="radio" type="radio" name="atendimento" value="O"><span class="lbl_interno_2">Ortopedia</span></input>
                        <input class="radio" type="radio" name="atendimento" value="S"><span class="lbl_interno_2">Saúde Mental</span></input>
                    </div>
                </div>-->

                <br />
                <div class="form_submit">
                    <input class="botao_enviar" type="submit" value="Salvar" />
                </div>
                <div id="sub" class="form_submit_centro" style="float: left">
                    <input id="sub_bt" class="botao" type="button" value="Voltar" onclick="window.location.href='index.php'" />
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
        //        $('#ct_sus').mask("9999999999999999999");


        //Script para Validar Campos do Formulário
        function voltar() {
            history.back(1);
        }
        $(document).ready(function() {
            $("#form_recep").validate({
                rules: {
                    nome: {
                        required: true,
                        minlength: 2
                    },
                    endereco: {
                        required: true,
                        minlength: 2
                    }
                },
                messages: {
                    nome: {
                        required: "Digite o nome",
                        minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
                    },
                    endereco: {
                        required: "Digite o endereço",
                        minLength: "O seu endereço deve conter, no mínimo, 2 caracteres"
                    }
                }
            });
        });

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