<!DOCTYPE html>
<?php
session_start();
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
$pac = getDadosRecepcao($_SESSION['controle_atual']);
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
            <form action="recepcao_controller.php" method="post">
                <div class="lbl1">
                    <div class="lbl_interno">Nº Controle</div>
                </div>
                <div class="lbl_maior">
                    <?php echo $_SESSION['controle_atual'] ?>
                </div>

                <br />
                <div class="lbl1">
                    <div class="lbl_interno">Nome</div>
                </div>
                <input class="texto" type="text" name="nome" value="<?php echo $pac['nm_paciente'] ?>" disabled />

                <div class="lbl2">
                    <div class="lbl_interno">Sexo</div>
                </div>
                <div class="lbl2_2">
                    <div class="lbl_interno">
                        <?php
                        if ($pac['sexo_paciente'] == 'm') {
                            echo '<input class = "radio" type = "radio" name = "sexo" value = "m" disabled checked><span class = "lbl_interno_2">Masculino</span<</input>';
                        } else if ($pac['sexo_paciente'] == 'f') {
                            echo '<input class = "radio" type = "radio" name = "sexo" value = "f" disabled checked ><span class = "lbl_interno_2">Feminino</span></input>';
                        } else {
                            echo '<input class = "radio" type = "radio" name = "sexo" value = "m" disabled><span class = "lbl_interno_2">Masculino</span<</input><input class = "radio" type = "radio" name = "sexo" value = "f" disabled checked ><span class = "lbl_interno_2">Feminino</span></input>';
                        }
                        ?>

                    </div>
                </div>

                <br />
                <br />


                <div class="lbl1">
                    <div class="lbl_interno">Procedência</div>
                </div>
                <select id="cod_uf_procedencia" name="cod_uf_procedencia" class="combo_uf">
                    <?php echo '<option>' . $pac['proc_sigla'] . '</option>'; ?>
                </select>
                <select id="cod_cid_procedencia" name="cod_cid_procedencia" class="combo_cidades">
                    <?php echo '<option>' . $pac['proc_cid'] . '</option>'; ?>
                </select>

                <div class="lbl2">
                    <div class="lbl_interno">Nascimento</div>
                </div>
                <input id="nascimento" class="texto" type="text" name="nascimento" disabled value="<?php echo bancoPaginaData($pac['dt_nascimento']); ?>" />

                <br />
                <br />

                <div class="lbl1">
                    <div class="lbl_interno">Profissão</div>
                </div>
                <select name="profissao" class="combo">
                    <option><?php echo $pac['nm_profissao'] ?></option>
                </select>
                <span class="lbl2"><span class="lbl_interno">Estado Civil</span></span>
                <select name="estado_civil" class="combo">
                    <option><?php echo $pac['nm_estado_civil']; ?></option>
                </select>

                <br />
                <br />

                <span class="lbl1"><span class="lbl_interno">Endereço</span></span>
                <input class="texto" type="text" name="endereco" value="<?php echo $pac['endereco']; ?>" disabled />
                <div class="lbl2"><span class="lbl_interno">Bairro</span></div>
                <input class="texto" type="text" name="bairro" value="<?php echo $pac['bairro']; ?>" disabled />

                <br />
                <br />

                <span class="lbl1"><span class="lbl_interno">UF/Cidade</span></span>
                <select id="cod_uf_usuario" name="cod_uf_usuario" class="combo_uf">
                    <?php echo '<option>' . $pac['uf_sigla'] . '</option>'; ?>
                </select>
                <select id="cod_cid_usuario" name="cod_cid_usuario" class="combo_cidades">
                    <?php echo '<option>' . $pac['cid_nome'] . '</option>'; ?>
                </select>

                <span class="lbl2"><span class="lbl_interno">Telefone</span></span>
                <input id="telefone" class="texto" type="text" name="telefone" value="<?php echo $pac['telefone']; ?>" disabled />
                <br />

            </form>
        </div>

    </div>

</body>

</html>