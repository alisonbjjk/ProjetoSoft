<?php

// Criado Por Alison Tavares - 04-06-2020 - Natal/RN.

//Iniciando uma nova sessão.
// session_start();

// Incluindoa as variáveis de conexão com o banco de dados MySQL.
include("db.php");

// Incluindo função de Criptografia.
include("cripto.php");

// Criando a conexão com o banco de dados.
try {
    $conn = new PDO(
        "mysql:host=$s;dbname=$db",
        "$u",
        "$p",
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
}

// Messagem de Erro casos algo de errado na conexão com o banco de dados.
catch (PDOException $e) {
    echo $e->getMessage();
}

// Função para desconectar o usuario logado.
function sair($conexao)
{

    // Metodo para destruir a sessão.
    session_destroy();
    // Redirecionamento para a tela de Login.
    header("Location: index.php");
}

// Criando a função de autentiçaõ do usuario para a tela de login.
function autenticarUser($loginUser, $senhaUser)
{

    // introduzindo a variável de conexão com o bando de dados para o método global.
    global $conn;

    // Criptografando as variáveis de login e senha com a função cpt
    $loginUsercpt = cpt($loginUser);
    $senhaUsercpt = cpt($senhaUser);

    // parâmetros para a pesquisa do usuário no banco de dados.
    $sql_auth = ("SELECT * FROM usuario WHERE login_usuario = '" . $loginUsercpt . "' and senha_usuario = '" . $senhaUsercpt . "' and ativo = '1' and liberado = '1' and (permissao_usuario = '1' OR permissao_usuario = '2' OR permissao_usuario = '3');");

    $query = $conn->query($sql_auth) or die("Erro no select autentica " . print_r($conn->errorInfo()));

    $array = $query->fetch(PDO::FETCH_ASSOC);

    //var_dump($array);
    //die();

    // Criando uma variavel para receber o ip da maquina do usuario.
    $IP = ($_SERVER['REMOTE_ADDR']);

    if ($array <> null) {
        $_SESSION['logado'] = 1;

        //Criando log de acesso no banco de dados para usuário permitido.
        $conn->query("INSERT INTO `log_acesso`( `login_acesso`, `situacao`, `data_hora`, `IP`) VALUES ('$loginUser','PERMITIDO', NOW(), '$IP')");
    } else {

        $_SESSION['logado'] = 0;

        //Criando log de acesso no banco de dados para usuário negado.
        $conn->query("INSERT INTO `log_acesso`( `login_acesso`, `situacao`, `data_hora`, `IP`) VALUES ('$loginUser','NEGADO', NOW(), '$IP')");
        //header("Location: ../View/erro.php");   
    }
}

function inserirProfi($nome, $sexo, $rg, $cpf, $nascimento, $proficao, $estadoCivil, $endereco, $bairro, $idUF, $idCidade, $telefone, $email)
{

    global $conn;

    $loginCadcpt = cpt($cpf);
    $senhaCadcpt = cpt('123456');

    $sql = ("INSERT INTO `usuario` (`login_usuario`, `senha_usuario`, `nome`, `email`, `cpf_user`, `rg_user`, `dt_nasc_user`, `estado_civil`, `endereco_user`, `bairro_user`, `cod_estados`, `cod_cidades`, `telefone` ) VALUES ('$loginCadcpt', '$senhaCadcpt', '$nome', '$email', '$cpf', '$rg', '$nascimento', '$estadoCivil', '$endereco', '$bairro', '$idUF', '$idCidade', '$telefone');");

    $query = $conn->query($sql) or die("Erro ao cadastrar Profissional. " . print_r($conn->errorInfo()));
}
