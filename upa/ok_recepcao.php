<!DOCTYPE html>
<?php
session_start();
include("inc/header.php");
include("inc/conn.php");
include("js/jquery_funcoes.php");
?>

<meta http-equiv="refresh" content="5; url=recepcao.php">


<div class="cabecalho"></div>

<div class="informacao">
        <h3>Paciente cadastrado com sucesso.</h3>
        <input class="botao" type="submit" value="Ok" onclick="location.href='recepcao.php';" />
</div>