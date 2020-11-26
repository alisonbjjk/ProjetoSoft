<?php

// Criando uma função para criptograr senhas
function cpt($var)
{
    $var = $var . 'projetoSoft';
    $var_alterada = md5(sha1(sha1($var)));
    return $var_alterada;
}


// Criando uma função para criptograr senhas mais complexa
//function cpt($var) {
//    $var = $var . 'projetoSoft';
//    $var_alterada = base64_encode(sha1(md5($var)));
//    return $var_alterada;
//}
