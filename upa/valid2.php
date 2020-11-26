<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Exemplo de Validação com jQuery</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <script language="JavaScript" src="js/jquery.js" type="text/javascript"></script>
    <script language="JavaScript" src="js/jquery.validate.js" type="text/javascript"></script>

    <style type="text/css">
        * {
            font-family: Verdana;
            font-size: 96%;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        label.error {
            float: none;
            color: red;
            margin: 0 .5em 0 0;
            vertical-align: top;
            font-size: 10px
        }

        p {
            clear: both;
        }

        .submit {
            margin-top: 1em;
        }

        em {
            font-weight: bold;
            padding-right: 1em;
            vertical-align: top;
        }
    </style>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#formularioContato").validate({
                // Define as regras
                rules: {
                    campoNome: {
                        // campoNome será obrigatorio (required) e terá tamanho minimo (minLength)
                        required: true,
                        minlength: 2
                    },
                    campoEmail: {
                        // campoEmail será obrigatorio (required) e precisará ser um e-mail válido (email)
                        required: true,
                        email: true
                    },
                    campoMensagem: {
                        // campoMensagem será obrigatorio (required) e terá tamanho minimo (minLength)
                        required: true,
                        minlength: 2
                    }
                },
                // Define as mensagens de erro para cada regra
                messages: {
                    campoNome: {
                        required: "Digite o seu nome",
                        minlength: "O seu nome deve conter, no mínimo, 2 caracteres"
                    },
                    campoEmail: {
                        required: "Digite o seu e-mail para contato",
                        email: "Digite um e-mail válido"
                    },
                    campoMensagem: {
                        required: "Digite a sua mensagem",
                        minlength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                    }
                }
            });
        });
    </script>

</head>

<body>
    <p>Exemplo de validação de formulário com jQuery<br />Criado por <strong>Thiago Belem</strong><br />&nbsp;<a href="http://thiagobelem.net/blog/">http://thiagobelem.net/blog/</a></p>

    <form id="formularioContato" method="post" action="">
        <label>Nome</label>
        <input name="campoNome" type="text" value="" />

        <label>E-mail</label>
        <input name="campoEmail" type="text" value="" />

        <label>Mensagem</label>
        <textarea name="campoMensagem"></textarea><br />

        <input type="submit" class="submit" value="Enviar" />
    </form>

</body>

</html>