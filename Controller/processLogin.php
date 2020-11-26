<?php
include_once("../Model/conn.php");
//include_once("../View/loginUser.php");
print_r($_POST);
$loginUser = filter_input(INPUT_POST, 'loginUser');
$senhaUser = filter_input(INPUT_POST, 'senhaUser');

autenticarUser($loginUser, $senhaUser);
