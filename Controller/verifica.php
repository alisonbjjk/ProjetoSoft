<?php
//Verifica se o usuario está conectado.
// Caso não esteja ele redireciona para a tela de Erro.
if (isset($_SESSION['logado'])) {
    if ($_SESSION['logado'] == 1) {
    } else {
        header("Location: ../View/loginUser.php");
    }
} else {
    header("Location: ../View/loginUser.php");
}
