<?php

if (IsSet($_SESSION["id_func"]))
    $id_usuario = $_SESSION["id_func"];
if (IsSet($_SESSION["mat_func"]))
    $mat_usuario = $_SESSION["mat_func"];
if ((empty($id_usuario) OR empty($mat_usuario))) {
//    header("Location: sair.php");
}



//if (IsSet($_SESSION["id_func"]) AND IsSet($_SESSION["mat_func"])) {
//    $id_usuario = $_SESSION["id_func"];
//    $mat_usuario = $_SESSION["mat_func"];
//}
//
////if (IsSet($_SESSION['erro_login']))
//
//if ((empty($id_usuario) OR empty($mat_usuario))) {
////    header("Location: sair.php");
//    if ((IsSet($_SESSION['erro_login'])) AND ($_SESSION['erro_login'] == 1)) {
////
//        header("Location: erro_login.php");
//        echo 'erro de usuário inválido';
//    }
//    echo 'Erro de usuário vazio';
//}
?>
