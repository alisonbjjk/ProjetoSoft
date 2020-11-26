<?php
// Ultilizando a função para desconectar o usuário.
session_start();
include("../Model/conn.php");
sair($conexao);
