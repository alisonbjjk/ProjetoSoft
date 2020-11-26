<!DOCTYPE html>
<?php
session_start();
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
$paciente = $_SESSION['paciente'];
$resultado = $_SESSION['resultado'];

if ($resultado['turno'] == "m") {
    $resultado['turno'] = "Manhã";
} else {
    $resultado['turno'] = "Noite";
}

?>


<script type="text/javascript">
    $(document).ready(function() {
        DoPrinting();
    })
</script>


<body>
    <div class="cabecalho"></div>
    <div class="pre_form">
        <?php
        echo date("d/m/Y - H:i:s");
        ?>
    </div>
    <div class="form">
        <div class="form_conteudo">

            <form id="form_recep" action="imprime_recepcao.php" method="post">
                <div class="info"><span>Atendimento: <?php echo $resultado['controle']; ?> - Turno: <?php echo $resultado['turno']; ?></span></div>
                <div class="info">
                    Informações do Paciente
                </div>

                <div class="lbl1">
                    <div class="lbl_interno">Nome</div>
                </div>
                <input id="nome" class="texto" type="text" name="nome" disabled value="<?php echo $paciente['nm_paciente']; ?>" />

                <div class="lbl2">
                    <div class="lbl_interno">Sexo</div>
                </div>
                <div class="lbl2_2">
                    <div class="lbl_interno">
                        <?php
                        if ($paciente['sexo_paciente'] == 'm') {
                            echo '<span class = "lbl_interno_2">Masculino</span>';
                        } else if ($paciente['sexo_paciente'] == 'f') {
                            echo '<span class = "lbl_interno_2">Feminino</span>';
                        } else {
                            echo '<input class = "radio" type = "radio" name = "sexo" value = "m" disabled><span class = "lbl_interno_2">Masculino</span<</input><input class = "radio" type = "radio" name = "sexo" value = "f" disabled checked ><span class = "lbl_interno_2">Feminino</span></input>';
                        }
                        ?>
                    </div>
                </div>

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">CPF</div>
                </div>
                <input id="cpf" class="texto" type="text" name="cpf" disabled value="<?php echo $paciente['cpf_paciente']; ?>" />
                <div class="lbl2">
                    <div class="lbl_interno">RG</div>
                </div>
                <input id="rg" class="texto" type="text" name="rg" disabled value="<?php echo $paciente['rg_paciente']; ?>" />

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">Cartão SUS</div>
                </div>
                <input id="ct_sus" maxlength="16" class="texto" type="text" name="ct_sus" disabled value="<?php echo $paciente['nr_cartao_sus_paciente']; ?>" />

                <div class="lbl2">
                    <div class="lbl_interno">Nascimento</div>
                </div>
                <input id="nascimento" class="texto" type="text" name="nascimento" disabled value="<?php echo $paciente['dt_nasc_paciente']; ?>" />

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">Profissão</div>
                </div>
                <select name="profissao" class="combo">
                    <option><?php echo $paciente['nm_profissao'] ?></option>
                </select>
                <span class="lbl2"><span class="lbl_interno">Estado Civil</span></span>
                <select name="estado_civil" class="combo">
                    <option><?php echo $paciente['nm_estado_civil']; ?></option>
                </select>
                </select>

                <br />
                <br />

                <span class="lbl1"><span class="lbl_interno">Endereço</span></span>
                <input class="texto" type="text" name="endereco" disabled value="<?php echo $paciente['endereco_paciente']; ?>" />
                <div class="lbl2"><span class="lbl_interno">Bairro</span></div>
                <input class="texto" type="text" name="bairro" disabled value="<?php echo $paciente['bairro_paciente']; ?>" />

                <br />
                <br />

                <span class="lbl1"><span class="lbl_interno">UF/Cidade</span></span>
                <select id="cod_uf_usuario" name="cod_uf_usuario" class="combo_uf">
                    <?php echo '<option>' . $paciente['uf_sigla'] . '</option>'; ?>
                </select>
                <select id="cod_cid_usuario" name="cod_cid_usuario" class="combo_cidades">
                    <?php echo '<option>' . $paciente['cid_nome'] . '</option>'; ?>
                </select>

                <span class="lbl2"><span class="lbl_interno">Telefone</span></span>
                <input id="telefone" class="texto" type="text" name="telefone" disabled value="<?php echo $paciente['telefone']; ?>" />

                <br />


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
    </script>




</body>

</html>