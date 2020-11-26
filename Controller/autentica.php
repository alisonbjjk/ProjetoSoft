<?php
session_start();

include_once("../Model/conn.php");
include_once("autenticaCPF.php");


$validaCaptcha = true;

if (isset($_POST['g-recaptcha-response'])) {

    $getResponse = 'https://www.google.com/recaptcha/api/siteverify?secret=' . '6LdHggAVAAAAAOLmzGOL0V1w9_jpK0uKhaikTrgg' . '&response=' . $_POST['g-recaptcha-response'];
    $GoogleResponse = (file_get_contents($getResponse));

    if (strpos($GoogleResponse, '"success": true') !== false) {

        $validaCaptcha = true;
    } else {

        $loginUser = filter_input(INPUT_POST, 'loginUser');
        $senhaUser = "";
        autenticarUser($loginUser, $senhaUser);
    }
}

if (($validaCaptcha == true) and (isCpfValid($_POST['loginUser']) == true)) {

    $loginUser = filter_input(INPUT_POST, 'loginUser');
    $senhaUser = filter_input(INPUT_POST, 'senhaUser');
    autenticarUser($loginUser, $senhaUser);
}

if ($_SESSION['logado'] == 1) {
    header('Location: ../upa');
} else {

    header("Location: ../View/erro.php");
}
