<?php
session_start();
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
?>


<script>
    $(document).ready(function() {
        $("#formulario").validate({
            // Define as regras
            rules: {
                nome: {
                    // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true,
                    minlength: 2
                }
            },
            // Define as mensagens de erro para cada regra
            messages: {
                nome: {
                    required: "Digite o seu nome",
                    minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
                }
            }
        });
    });
</script>

<form idlocalhost="formulario" action="erro.php" method="post">

    <label for="nome">Digite o seu nome: </label>
    <input id="nome" name="nome" />
    <input type="submit" value="enviar" />

</form>