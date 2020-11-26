<?php

include ("f.php");
include ("b.php");

try {
    $conn = new PDO("mysql:host=$s;dbname=$db", "$u", "$p",
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch(PDOException $e){
    echo $e->getMessage();
}

function getDadosPacienteByCpf($cpf) {
    global $conn;

    $paciente = 0;
    $sql = "SELECT p.*, uf.sigla AS uf_sigla, cid.nome AS cid_nome, pro.nm_profissao, c.nm_estado_civil
        FROM paciente p
        INNER JOIN estados uf ON p.id_estado = uf.cod_estados
        INNER JOIN cidades cid ON p.id_cidade = cid.cod_cidades
        INNER JOIN profissao pro ON p.id_profissao = pro.id_profissao
        INNER JOIN estado_civil c ON p.id_estado_civil = c.id_estado_civil
        WHERE p.cpf_paciente= '" . $cpf . "'";

    if ( $query = $conn->query($sql) or die("Erro no select ")) {
        $array =  $query->fetch(PDO::FETCH_ASSOC);
        $paciente = $array;
    }
    return $paciente;
}

function getDadosPacienteByRg($rg) {
    global $conn;

    $paciente = 0;
    if ($query = $conn->query("SELECT p.*, uf.sigla AS uf_sigla, cid.nome AS cid_nome, pro.nm_profissao, c.nm_estado_civil
        FROM paciente p
        INNER JOIN estados uf ON p.id_estado = uf.cod_estados
        INNER JOIN cidades cid ON p.id_cidade = cid.cod_cidades
        INNER JOIN profissao pro ON p.id_profissao = pro.id_profissao
        INNER JOIN estado_civil c ON p.id_estado_civil = c.id_estado_civil
        WHERE p.rg_paciente = '" . $rg . "'") or die("Erro no select " )) {
        $array = $query->fetch(PDO::FETCH_ASSOC);
        $paciente = $array;
    }
    return $paciente;
}

function getDadosPacienteByCtSUS($ct_sus) {
    global $conn;

    $paciente = 0;
    if ($query = $conn->query("SELECT p.*, uf.sigla AS uf_sigla, cid.nome AS cid_nome, pro.nm_profissao, c.nm_estado_civil
        FROM paciente p
        INNER JOIN estados uf ON p.id_estado = uf.cod_estados
        INNER JOIN cidades cid ON p.id_cidade = cid.cod_cidades
        INNER JOIN profissao pro ON p.id_profissao = pro.id_profissao
        INNER JOIN estado_civil c ON p.id_estado_civil = c.id_estado_civil
        WHERE p.nr_cartao_sus_paciente = '" . $ct_sus . "'") or die("Erro no select " )) {
        $array = $query->fetch(PDO::FETCH_ASSOC);
        $paciente = $array;
    }
    return $paciente;
}

function getDadosPacienteById($id) {
    global $conn;

    $paciente = 0;
    if ($query = $conn->query("SELECT p.*, pro.*, c.*, uf.*, cid.*, uf.sigla AS uf_sigla, cid.nome AS cid_nome, pro.nm_profissao, c.nm_estado_civil
        FROM paciente p
        INNER JOIN estados uf ON p.id_estado = uf.cod_estados
        INNER JOIN cidades cid ON p.id_cidade = cid.cod_cidades
        INNER JOIN profissao pro ON p.id_profissao = pro.id_profissao
        INNER JOIN estado_civil c ON p.id_estado_civil = c.id_estado_civil
        WHERE p.id_paciente = '" . $id . "'") or die("Erro no select " )) {
        $array = $query->fetch(PDO::FETCH_ASSOC);
        $paciente = $array;
    }
    return $paciente;
}

function getListaDePacientesByNome($nome) {
    global $conn;

    $paciente = 0;
    $limite = 30;
    if (isset($_GET['id'])) {
        $pagina = $_GET['id'];
    } else {
        $pagina = 1;
    }
    $inicio = ($pagina * $limite) - $limite;
    if ($query = $conn->query("SELECT * FROM paciente WHERE nm_paciente LIKE '%" . $nome . "%' LIMIT $inicio,$limite")
            or die("Erro no select nome " )) {

        $arrayPaciente = array();
        $cont = 0;
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {

            if ($cont % 2 == 0) {
                echo '<tr class="info_busca_1"><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['id_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['nm_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['cpf_paciente'] . '</a></td>' . '</td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['rg_paciente'] . '</a></td></tr>';
            } else {
                echo '<tr class="info_busca_2"><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['id_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['nm_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['cpf_paciente'] . '</a></td>' . '</td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['rg_paciente'] . '</a></td></tr>';
            }
            $cont ++;
        }
    } else {
        $arrayPaciente = 0;
    }
    $novaConsulta = $conn->query("SELECT * FROM paciente WHERE nm_paciente LIKE '%" . $nome . "%'")
            or die("Erro no select nome " );
    $total_registros = count($novaConsulta->fetchAll()) ;
    $total_paginas = Ceil($total_registros / $limite);
    echo '<div>Total de registros: ' . $total_registros . '</div>';
    echo '<div class="contador">Páginas ';
    for ($i = 1; $i <= $total_paginas; $i++) {

        //CORRIGIR para exibir páginas em sequência
        if ($pagina == $i) {
            echo '<span class="span_ativo">&nbsp;' . $i . '&nbsp;</span>';
        } else {
            echo '<span class="span_inativo"><a href="busca_controller.php?id=' . $i . '&b=' . $nome . '">&nbsp;' . $i . '&nbsp;</a>';
        }
    }
    echo '</div>';
}

function calc_idade($data_nasc) {
    $data_nasc = explode("/", $data_nasc);
    $data = date("d/m/Y");
    $data = explode("/", $data);
    $anos = $data[2] - $data_nasc[2];
    if ($data_nasc[1] > $data[1]) {
        return $anos - 1;
    } if ($data_nasc[1] == $data[1]) {
        if ($data_nasc[0] <= $data[0]) {
            return $anos;
        } else {
            return $anos - 1;
        }
    } if ($data_nasc[1] < $data[1]) {
        return $anos;
    }
}

function getRelatorio($dt_inicio, $turno, $dt_fim) {
    global $conn;

    $paciente = 0;
    $limite = 30;
    $data_inicio = paginaBancoDataSemHora($dt_inicio);
    if ($dt_fim == "") {
        if ($turno == 'm') {
            $data_fim = paginaBancoDataSemHora($dt_inicio);
            $turnoAux = 'm';
            $turnoAux2 = 'm';
        } else {
            $data_fim = paginaBancoDataSemHora(date('d/m/Y', strtotime("+1 days", strtotime($data_inicio))));

            if ($turno == 'n') {
                $turnoAux = 'n';
                $turnoAux2 = 'n';
            } else {
                $turnoAux = 'm';
                $turnoAux2 = 'n';
            }
        }
    } else {
        $data_fim = paginaBancoDataSemHora($dt_fim);
        if ($turno == 'm') {
            $turnoAux = 'm';
            $turnoAux2 = 'm';
        } else {
            if ($turno == 'n') {
                $turnoAux = 'n';
                $turnoAux2 = 'n';
            } else {
                $turnoAux = 'm';
                $turnoAux2 = 'n';
            }
        }
    }

    if (isset($_GET['id'])) {
        $pagina = $_GET['id'];
    } else {
        $pagina = 1;
    }
    $inicio = ($pagina * $limite) - $limite;
    if ($query = $conn->query("SELECT *, DATE_FORMAT(dt_nasc_paciente, '%d/%m/%Y') AS NASCIMENTO FROM paciente as p INNER JOIN recepcao as r ON p.id_paciente = r.id_paciente INNER JOIN cidades as c ON p.id_cidade = c.cod_cidades
            WHERE (DATE_FORMAT(r.dt_inclusao, '%Y-%m-%d') BETWEEN '" . $data_inicio . "' AND '" . $data_fim . "') AND (r.plantao = '" . $turnoAux . "' OR  r.plantao = '" . $turnoAux2 . "') ORDER BY DATE_FORMAT(r.dt_inclusao,'%d/%m/%Y'),DATE_FORMAT(r.dt_inclusao,'%H:%i:%s')  LIMIT $inicio,$limite")
            or die("Erro no select relatorio " )) {
        $arrayPaciente = array();
        $cont = 0;
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            $data_inclusao = bancoPaginaData($array['dt_inclusao']);
            $hora_inclusao = bancoPaginaHora($array['dt_inclusao']);
            if (strtoupper($array['plantao']) == 'M') {
                $turnoRelatorio = 'D';
            } else {
                $turnoRelatorio = 'N';
            }
            $nascimento = "";
            $idade = "";
            if ($array['NASCIMENTO'] != "00/00/0000" && $array['NASCIMENTO'] != "") {
                $nascimento = $array['NASCIMENTO'];
                $idade = calc_idade($nascimento);
            }
            if ($cont % 2 == 0) {
                echo '<tr class="info_busca_1"><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . ($inicio + 1) . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . strtoupper($array['nm_paciente']) . ' - ' . $array['nm_responsavel_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $nascimento . ' - ' . $idade . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['cpf_paciente'] . ' - ' . $array['rg_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $data_inclusao . ' - ' . $hora_inclusao . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . strtoupper($array['bairro_paciente']) . ' - ' . strtoupper($array['nome']) . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $turnoRelatorio . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . strtoupper($array['sexo_paciente']) . '</a></td></tr>';
            } else {
                echo '<tr class="info_busca_2"><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . ($inicio + 1) . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . strtoupper($array['nm_paciente']) . ' - ' . $array['nm_responsavel_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $nascimento . ' - ' . $idade . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['cpf_paciente'] . ' - ' . $array['rg_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $data_inclusao . ' - ' . $hora_inclusao . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . strtoupper($array['bairro_paciente']) . ' - ' . strtoupper($array['nome']) . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $turnoRelatorio . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . strtoupper($array['sexo_paciente']) . '</a></td></tr>';
            }
            $cont ++;
            $inicio ++;
        }
    } else {
        $arrayPaciente = 0;
    }
    $novaConsulta = $conn->query("SELECT * FROM paciente as p INNER JOIN recepcao as r ON p.id_paciente = r.id_paciente
        WHERE (DATE_FORMAT(r.dt_inclusao, '%Y-%m-%d') BETWEEN '" . $data_inicio . "' AND '" . $data_fim . "') AND (r.plantao = '" . $turnoAux . "' OR  r.plantao = '" . $turnoAux2 . "') ORDER BY DATE_FORMAT(r.dt_inclusao,'%d/%m/%Y'),DATE_FORMAT(r.dt_inclusao,'%H:%i:%s')")
            or die("Erro no select nome " );
    $total_registros = count($novaConsulta->fetchAll());
    $total_paginas = Ceil($total_registros / $limite);
    echo '<div>Total de registros: ' . $total_registros . '</div>';
    echo '<div class="contador">Páginas ';
    for ($i = 1; $i <= $total_paginas; $i++) {
        //CORRIGIR para exibir páginas em sequência
        if ($pagina == $i) {
            echo '<span class="span_ativo">&nbsp;' . $i . '&nbsp;</span>';
        } else {
            echo '<span class="span_inativo"><a href="relatorio_turno_controller.php?id=' . $i . '&dt_inicio=' . $dt_inicio . '&dt_fim=' . $dt_fim . '&turno=' . $turno . '">&nbsp;' . $i . '&nbsp;</a>';
        }
    }
    echo '</div>';
}

function getRelatorioImpressao($dt_inicio, $turno, $dt_fim) {
    global $conn;

    $data_inicio = paginaBancoDataSemHora($dt_inicio);
    if ($dt_fim == "") {
        if ($turno == 'm') {
            $data_fim = paginaBancoDataSemHora($dt_inicio);
            $turnoAux = 'm';
            $turnoAux2 = 'm';
        } else {
            $data_fim = paginaBancoDataSemHora(date('d/m/Y', strtotime("+1 days", strtotime($data_inicio))));
            
            if ($turno == 'n') {
                $turnoAux = 'n';
                $turnoAux2 = 'n';
            } else {
                $turnoAux = 'm';
                $turnoAux2 = 'n';
            }
        }
    } else {
        $data_fim = paginaBancoDataSemHora($dt_fim);
        if ($turno == 'm') {
            $turnoAux = 'm';
            $turnoAux2 = 'm';
        } else {
            if ($turno == 'n') {
                $turnoAux = 'n';
                $turnoAux2 = 'n';
            } else {
                $turnoAux = 'm';
                $turnoAux2 = 'n';
            }
        }
    }

    if ($query = $conn->query("SELECT *, DATE_FORMAT(dt_nasc_paciente, '%d/%m/%Y') AS NASCIMENTO FROM paciente as p INNER JOIN recepcao as r ON p.id_paciente = r.id_paciente INNER JOIN cidades as c ON p.id_cidade = c.cod_cidades
            WHERE (DATE_FORMAT(r.dt_inclusao, '%Y-%m-%d') BETWEEN '" . $data_inicio . "' AND '" . $data_fim . "') AND (r.plantao = '" . $turnoAux . "' OR  r.plantao = '" . $turnoAux2 . "') ORDER BY DATE_FORMAT(r.dt_inclusao,'%d/%m/%Y'),DATE_FORMAT(r.dt_inclusao,'%H:%i:%s')")
            or die("Erro no select relatorio " )) {
        $arrayPaciente = array();
        $cont = 1;

        $query2 = $conn->query("SELECT *, DATE_FORMAT(dt_nasc_paciente, '%d/%m/%Y') AS NASCIMENTO FROM paciente as p INNER JOIN recepcao as r ON p.id_paciente = r.id_paciente INNER JOIN cidades as c ON p.id_cidade = c.cod_cidades
            WHERE (DATE_FORMAT(r.dt_inclusao, '%Y-%m-%d') BETWEEN '" . $data_inicio . "' AND '" . $data_fim . "') AND (r.plantao = '" . $turnoAux . "' OR  r.plantao = '" . $turnoAux2 . "') ORDER BY DATE_FORMAT(r.dt_inclusao,'%d/%m/%Y'),DATE_FORMAT(r.dt_inclusao,'%H:%i:%s')");
        $num_registros = count($query->fetchAll());

        echo '<div>Total de registros: ' . $num_registros . '</div>';
        echo '<br />';
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            $data_inclusao = bancoPaginaData($array['dt_inclusao']);
            $hora_inclusao = bancoPaginaHora($array['dt_inclusao']);
            if (strtoupper($array['plantao']) == 'M') {
                $turnoRelatorio = 'D';
            } else {
                $turnoRelatorio = 'N';
            }
            $nascimento = "";
            $idade = "";
            if ($array['NASCIMENTO'] != "00/00/0000" && $array['NASCIMENTO'] != "") {
                $nascimento = $array['NASCIMENTO'];
                $idade = calc_idade($nascimento);
            }
            echo '<tr class="info_busca_1"><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . ($cont) . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . strtoupper($array['nm_paciente']) . ' - ' . $array['nm_responsavel_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $nascimento . ' - ' . $idade . ' </a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $array['cpf_paciente'] . ' - ' . $array['rg_paciente'] . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $data_inclusao . ' - ' . $hora_inclusao . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . strtoupper($array['bairro_paciente']) . ' - ' . strtoupper($array['nome']) . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . $turnoRelatorio . '</a></td><td><a href="confere_recepcao.php?id=' . $array['id_paciente'] . '">' . strtoupper($array['sexo_paciente']) . '</a></td></tr>';
            $cont ++;
        }
    } else {
        $arrayPaciente = 0;
    }
    echo '</div>';
}

function getRelatorioExcel($dt_inicio, $turno, $dt_fim) {
    global $conn;

    $data_inicio = paginaBancoDataSemHora($dt_inicio);
    if ($dt_fim == "") {
        if ($turno == 'm') {
            $data_fim = paginaBancoDataSemHora($dt_inicio);
            $turnoAux = 'm';
            $turnoAux2 = 'm';
        } else {
            $data_fim = paginaBancoDataSemHora(date('d/m/Y', strtotime("+1 days", strtotime($data_inicio))));
            if ($turno == 'n') {
                $turnoAux = 'n';
                $turnoAux2 = 'n';
            } else {
                $turnoAux = 'm';
                $turnoAux2 = 'n';
            }
        }
    } else {
        $data_fim = paginaBancoDataSemHora($dt_fim);
        if ($turno == 'm') {
            $turnoAux = 'm';
            $turnoAux2 = 'm';
        } else {
            if ($turno == 'n') {
                $turnoAux = 'n';
                $turnoAux2 = 'n';
            } else {
                $turnoAux = 'm';
                $turnoAux2 = 'n';
            }
        }
    }
    if ($query = $conn->query("SELECT *, DATE_FORMAT(dt_nasc_paciente, '%d/%m/%Y') AS NASCIMENTO
        FROM paciente as p
        INNER JOIN recepcao as r ON p.id_paciente = r.id_paciente
        INNER JOIN cidades as c ON p.id_cidade = c.cod_cidades
        INNER JOIN profissao f ON f.id_profissao = p.id_profissao
        WHERE (DATE_FORMAT(r.dt_inclusao, '%Y-%m-%d') BETWEEN '" . $data_inicio . "' AND '" . $data_fim . "') AND (r.plantao = '" . $turnoAux . "' OR  r.plantao = '" . $turnoAux2 . "') ORDER BY DATE_FORMAT(r.dt_inclusao,'%d/%m/%Y'),DATE_FORMAT(r.dt_inclusao,'%H:%i:%s')")
            or die("Erro no select relatorio " )) {

        $query2 = $conn->query("SELECT *, DATE_FORMAT(dt_nasc_paciente, '%d/%m/%Y') AS NASCIMENTO
        FROM paciente as p
        INNER JOIN recepcao as r ON p.id_paciente = r.id_paciente
        INNER JOIN cidades as c ON p.id_cidade = c.cod_cidades
        INNER JOIN profissao f ON f.id_profissao = p.id_profissao
        WHERE (DATE_FORMAT(r.dt_inclusao, '%Y-%m-%d') BETWEEN '" . $data_inicio . "' AND '" . $data_fim . "') AND (r.plantao = '" . $turnoAux . "' OR  r.plantao = '" . $turnoAux2 . "') ORDER BY DATE_FORMAT(r.dt_inclusao,'%d/%m/%Y'),DATE_FORMAT(r.dt_inclusao,'%H:%i:%s')");

        $cont = count($query2->fetchAll());
        if ($cont > 0) {
            $cont2 = 1;
            $i = 0;
            $html[$i] = "";
            $html[$i] .= "<table>";
            $html[$i] .= "<tr>";
            $html[$i] .= "<td><b>ORDEM</b></td>";
            $html[$i] .= "<td><b>T. ATENDIMENTO</b></td>";
            $html[$i] .= "<td><b>PACIENTE</b></td>";
            $html[$i] .= "<td><b>RESPONSÁVEL</b></td>";
            $html[$i] .= "<td><b>NASCIMENTO</b></td>";
            $html[$i] .= "<td><b>IDADE</b></td>";
            $html[$i] .= "<td><b>SEXO</b></td>";
            $html[$i] .= "<td><b>CPF</b></td>";
            $html[$i] .= "<td><b>RG</b></td>";
            $html[$i] .= "<td><b>SUS</b></td>";
            $html[$i] .= "<td><b>PROFISSÃO</b></td>";
            $html[$i] .= "<td><b>TELEFONE</b></td>";
            $html[$i] .= "<td><b>LOGRADOURO</b></td>";
            $html[$i] .= "<td><b>BAIRRO</b></td>";
            $html[$i] .= "<td><b>CIDADE</b></td>";
            $html[$i] .= "<td><b>ATENDIMENTO</b></td>";
            $html[$i] .= "<td><b>PLANTÃO</b></td>";
            $html[$i] .= "</tr>";
            $html[$i] .= "</table>";
            $i = 1;
            while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
                $data_inclusao = bancoPaginaData($array['dt_inclusao']);
                $hora_inclusao = bancoPaginaHora($array['dt_inclusao']);
                $horarioAtendimento = $data_inclusao . " " . $hora_inclusao;
                if (strtoupper($array['plantao']) == 'M') {
                    $turnoRelatorio = 'D';
                } else {
                    $turnoRelatorio = 'N';
                }
                $nascimento = "";
                $idade = "";
                if ($array['NASCIMENTO'] != "00/00/0000" && $array['NASCIMENTO'] != "") {
                    $nascimento = $array['NASCIMENTO'];
                    $idade = calc_idade($nascimento);
                }
                $sexo = "";
                if ($array['sexo_paciente'] == 'm') {
                    $sexo = "Masculino";
                } else {
                    $sexo = "Feminino";
                }
                $tipoAtendimento = "";
                switch ($array['tipo_atendimento']) {
                    case 'P':
                        $tipoAtendimento = "Pediatria";
                        break;
                    case 'C':
                        $tipoAtendimento = "Clínica Médica";
                        break;
                    case 'M':
                        $tipoAtendimento = "Medicamento";
                        break;
                    case 'S':
                        $tipoAtendimento = "Sutura";
                        break;
                    case 'O':
                        $tipoAtendimento = "Odontologia";
                        break;
                    default:
                        $tipoAtendimento = "";
                        break;
                }

                $ordem = $cont2;
                $nome = strtoupper($array['nm_paciente']);
                $responsavel = strtoupper($array['nm_responsavel_paciente']);
                $cpf = $array['cpf_paciente'];
                $rg = $array['rg_paciente'];
                $sus = $array['nr_cartao_sus_paciente'];
                $profissao = strtoupper($array['nm_profissao']);
                $tefefone = $array['telefone'];
                $logradouro = strtoupper($array['endereco_paciente']);
                $bairro = strtoupper($array['bairro_paciente']);
                $cidade = strtoupper($array['nome']);

                @$html[$i] .= "<table>";
                $html[$i] .= "<tr>";
                $html[$i] .= "<td>$ordem</td>";
                $html[$i] .= "<td>$tipoAtendimento</td>";
                $html[$i] .= "<td>$nome</td>";
                $html[$i] .= "<td>$responsavel</td>";
                $html[$i] .= "<td>$nascimento</td>";
                $html[$i] .= "<td>$idade</td>";
                $html[$i] .= "<td>$sexo</td>";
                $html[$i] .= "<td>$cpf</td>";
                $html[$i] .= "<td>$rg</td>";
                $html[$i] .= "<td>$sus</td>";
                $html[$i] .= "<td>$profissao</td>";
                $html[$i] .= "<td>$tefefone</td>";
                $html[$i] .= "<td>$logradouro</td>";
                $html[$i] .= "<td>$bairro</td>";
                $html[$i] .= "<td>$cidade</td>";
                $html[$i] .= "<td>$horarioAtendimento</td>";
                $html[$i] .= "<td>$turnoRelatorio</td>";
                $html[$i] .= "</tr>";
                $html[$i] .= "</table>";
                $i++;
                $cont2 ++;
            }

            $arquivo = 'relatorioAtendimento.xls';
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            header("Content-type: application/x-msexcel");
            header("Content-Disposition: attachment; filename={$arquivo}");
            header("Content-Description: PHP Generated Data");

            for ($i = 0; $i <= $cont; $i++) {
                echo $html[$i];
            }
        }
    } else {
        $arrayPaciente = 0;
    }
}

function getControleAtual() {
    global $conn;

    $controle = 0;
    if ($query = $conn->query("SELECT * FROM recepcao ORDER BY id_recepcao DESC")) {
        $array = $query->fetch(PDO::FETCH_ASSOC);
        $controle = $array['id_recepcao'] + 1;
    }
    return $controle;
}

function getProfissao() {
    global $conn;

    if ($query = $conn->query("SELECT id_profissao, nm_profissao FROM profissao ORDER BY nm_profissao") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $array['id_profissao'] . '">' . ($array['nm_profissao']) . "</option>";
        }
    }
}

function getProfissaoPorID($idProfissao) {
    global $conn;

    if ($query = $conn->query("SELECT id_profissao, nm_profissao FROM profissao ORDER BY nm_profissao") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            if ($idProfissao == $array['id_profissao']) {
                echo '<option selected="true" value="' . $array['id_profissao'] . '">' . ($array['nm_profissao']) . "</option>";
            } else {
                echo '<option value="' . $array['id_profissao'] . '">' . ($array['nm_profissao']) . "</option>";
            }
        }
    }
}

function getUF() {
    global $conn;

    if ($query = $conn->query("SELECT cod_estados, sigla FROM estados ORDER BY sigla") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $array['cod_estados'] . '">' . $array['sigla'] . "</option>";
        }
    }
}

function getUFPorRN() {
    global $conn;

    if ($query = $conn->query("SELECT cod_estados, sigla FROM estados ORDER BY sigla") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            if ("RN" == $array['sigla']) {
                echo '<option selected="true" value="' . $array['cod_estados'] . '">' . $array['sigla'] . "</option>";
            } else {
                echo '<option value="' . $array['cod_estados'] . '">' . $array['sigla'] . "</option>";
            }
        }
    }
}

function getUFPorID($idEstado) {
    global $conn;

    if ($query = $conn->query("SELECT cod_estados, sigla FROM estados ORDER BY sigla") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            if ($idEstado == $array['cod_estados']) {
                echo '<option selected="true" value="' . $array['cod_estados'] . '">' . $array['sigla'] . "</option>";
            } else {
                echo '<option value="' . $array['cod_estados'] . '">' . $array['sigla'] . "</option>";
            }
        }
    }
}

function getCidades() {
    global $conn;

    if ($query = $conn->query("SELECT cod_cidades, nome FROM cidades ORDER BY nome") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $array['cod_cidades'] . '">' . $array['nome'] . "</option>";
        }
    }
}

function getCidadesPorNatal() {
    global $conn;

    if ($query = $conn->query("SELECT c.cod_cidades, c.nome FROM cidades c
            INNER JOIN estados e ON c.estados_cod_estados = e.cod_estados
            WHERE e.sigla = 'RN' ORDER BY nome") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            if ("Natal" == $array['nome']) {
                echo '<option selected="true" value="' . $array['cod_cidades'] . '">' . $array['nome'] . "</option>";
            } else {
                echo '<option value="' . $array['cod_cidades'] . '">' . $array['nome'] . "</option>";
            }
        }
    }
}

function getCidadesPorID($idCidade, $idEstado) {
    global $conn;

    if ($query = $conn->query("SELECT c.cod_cidades, c.nome FROM cidades c
            INNER JOIN estados e ON c.estados_cod_estados = e.cod_estados
            WHERE c.estados_cod_estados = " . $idEstado . " ORDER BY nome") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            if ($idCidade == $array['cod_cidades']) {
                echo '<option selected="true" value="' . $array['cod_cidades'] . '">' . $array['nome'] . "</option>";
            } else {
                echo '<option value="' . $array['cod_cidades'] . '">' . $array['nome'] . "</option>";
            }
        }
    }
}

function getEstadoCivil() {
    global $conn;

    if ($query = $conn->query("SELECT id_estado_civil, nm_estado_civil FROM estado_civil ORDER BY id_estado_civil") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $array['id_estado_civil'] . '">' . ($array['nm_estado_civil']) . "</option>";
        }
    }
}

function getEstadoCivilPorID($idEstadoCivil) {
    global $conn;

    if ($query = $conn->query("SELECT id_estado_civil, nm_estado_civil FROM estado_civil ORDER BY id_estado_civil") or die("Erro no select " )) {
        while ($array = $query->fetch(PDO::FETCH_ASSOC)) {
            if ($idEstadoCivil == $array['id_estado_civil']) {
                echo '<option selected="true" value="' . $array['id_estado_civil'] . '">' . ($array['nm_estado_civil']) . "</option>";
            } else {
                echo '<option value="' . $array['id_estado_civil'] . '">' . ($array['nm_estado_civil']) . "</option>";
            }
        }
    }
}

function getEstadoCivilID($idEstadoCivil) {
    global $conn;

//    echo "SELECT nm_estado_civil FROM estado_civil WHERE id_estado_civil = $idEstadoCivil";
//    die();
    if ($query = $conn->query("SELECT nm_estado_civil FROM estado_civil WHERE id_estado_civil = $idEstadoCivil") or die("Erro no select " )) {
        $estado_civil = $query->fetch(PDO::FETCH_ASSOC);
        return $estado_civil['nm_estado_civil'];
    }
}

//Cadastrar o Paciente na Tabela paciente e retornar variáveis para inserir na tabela recepção e confirmar que está OK
function insertPaciente($nm_paciente, $sexo_paciente, $cpf, $rg, $ct_sus, $dt_nascimento, $id_profissao, $id_estado_civil, $endereco, $bairro, $id_cidade, $id_estado, $telefone, $nomeMae) {
    global $conn;

    if ($conn->query("INSERT INTO paciente (nm_paciente,
                                            sexo_paciente,
                                            cpf_paciente,
                                            rg_paciente,
                                            nr_cartao_sus_paciente,
                                            dt_nasc_paciente,
                                            id_profissao,
                                            id_estado_civil,
                                            endereco_paciente,
                                            bairro_paciente,
                                            id_cidade,
                                            id_estado,
                                            telefone,
                                            nm_responsavel_paciente)
        VALUES ('" . $nm_paciente . "',
                    '" . $sexo_paciente . "',
                    '" . $cpf . "',
                    '" . $rg . "',
                    '" . $ct_sus . "',
                    '" . $dt_nascimento . "',
                    " . $id_profissao . ",
                    " . $id_estado_civil . ",
                    '" . $endereco . "',
                    '" . $bairro . "',
                    " . $id_cidade . ",
                    " . $id_estado . ",
                    '" . $telefone . "',
                    '" . $nomeMae . "');") or die("Erro na Saída " )) {

//Busca as informações do paciente que acabou de ser cadastrado
        if ($query = $conn->query("SELECT * FROM paciente WHERE id_paciente = " . $conn->lastInsertId()) or die("Erro no select dos dados do Paciente" )) {
            $array_pac = $query->fetch(PDO::FETCH_ASSOC);
        }

//Grava as informações que retornaram da busca do paciente
        $resultado_paciente['ok'] = 1;
        $resultado_paciente['id'] = $array_pac['id_paciente'];
        return $resultado_paciente;
    } else {
        echo '<br />Erro.';
        return 0;
//        header("Location: erro.php");
    }
}

function atualizarPaciente($idPaciente, $nm_paciente, $sexo_paciente, $cpf, $rg, $ct_sus, $dt_nascimento, $id_profissao, $id_estado_civil, $endereco, $bairro, $id_cidade, $id_estado, $telefone, $nomeMae) {
    global $conn;

    if ($conn->query("UPDATE paciente SET
        nm_paciente = '" . $nm_paciente . "',
        sexo_paciente = '" . $sexo_paciente . "',
        cpf_paciente = '" . $cpf . "',
        rg_paciente = '" . $rg . "',
        nr_cartao_sus_paciente = '" . $ct_sus . "',
        dt_nasc_paciente = '" . $dt_nascimento . "',
        id_profissao = " . $id_profissao . ",
        id_estado_civil = " . $id_estado_civil . ",
        endereco_paciente = '" . $endereco . "',
        bairro_paciente = '" . $bairro . "',
        id_cidade = " . $id_cidade . ",
        id_estado = " . $id_estado . ",
        telefone = '" . $telefone . "',
        nm_responsavel_paciente = '" . $nomeMae . "'
        WHERE id_paciente = " . $idPaciente) or die("Erro no Atualizadar dados do servidor " )) {

    } else {
        echo '<br />Erro.';
        return 0;
    }
}

//Insere informações para gravar na tabela recepção, o ID do Paciente e o horário que ele chegou
function insertRecepcao($id_paciente, $tipoAtendimento) {
    global $conn;

    $resultado = array();
    $dt_inicio_plantao = "";
    $dt_fim_plantao = "";

    //CONTINUAR ORGANIZANDO AS DATAS PARA FICAREM IGUAIS AO DO SELECT QUE ESTÁ COM DATA FIXA
    if ((date("H:i") < date("18:59")) && (date("H:i") > date("07:00"))) {
        $resultado['turno'] = "m";
        $hoje_inicio = date('Y-m-d') . ' 07:00';
        $hoje_fim = date('Y-m-d') . ' 18:59';
        $dt_inicio_plantao = date($hoje_inicio);
        $dt_fim_plantao = date($hoje_fim);
    } else {
        $resultado['turno'] = "n";
        //Verifica se ainda o horário é entre 19 e 00 horas para pegar o número de controle certo entre as datas
        if ((date("H:i") > date("19:00")) && (date("H:i") < date("23:59"))) {
            $hoje_inicio = date('Y-m-d') . ' 19:00';
            $dt_inicio_plantao = date($hoje_inicio);
            $teste = date('Y-m-d');
            $amanha_fim = date('Y-m-d', strtotime("+1 days", strtotime($teste))) . ' 00:00';
            $resultado['teste'] = $amanha_fim;
            $dt_fim_plantao = date($amanha_fim);
        } else {
            $ontem_inicio = date('Y-m-d', strtotime("-1 days", strtotime(date('Y-m-d')))) . ' 19:00';
            $dt_inicio_plantao = date($ontem_inicio);
            $hoje_fim = date('Y-m-d') . ' 06:59';
            $dt_fim_plantao = date($hoje_fim);
        }
    }
    //Contador para inserir o número correto no Insert
    //dt_inclusao >= '" . $dt_inicio_plantao . "' AND dt_inclusao <= '" . $dt_fim_plantao . "';"
    if ($query = $conn->query("SELECT COUNT(*) AS count FROM recepcao WHERE DATE_FORMAT(dt_inclusao,  '%Y-%m-%d %H:%i') BETWEEN '" . $dt_inicio_plantao . "' AND '" . $dt_fim_plantao . "';") or die(" Erro no insert da Recepcao " )) {
        $array = $query->fetch(PDO::FETCH_ASSOC);
        $resultado['controle'] = $array['count'];

        if ($resultado['controle'] == 0) {
            $resultado['controle'] = 1;
        } else {
            $resultado['controle'] = $resultado['controle'] + 1;
        }


        $resultado['cont'] = 'entrou';

        $resultado['dt_inicio_plantao'] = $dt_inicio_plantao;
        $resultado['dt_fim_plantao'] = $dt_fim_plantao;
    }



    if ($conn->query("INSERT INTO recepcao (id_paciente, nr_controle_recepcao, plantao, tipo_atendimento) VALUES (" . $id_paciente . ", " . $resultado['controle'] . ", '" . $resultado['turno'] . "' , '" . $tipoAtendimento . "');") or die(" Erro no insert da Recepcao " )) {
        $resultado['resultado'] = 1;
    } else {
        $resultado['resultado'] = 0;
    }


    return $resultado;
}

function getDadosRecepcao($num_controle) {
    global $conn;

    if ($query = $conn->query("SELECT r.*, uf_proc.sigla AS proc_sigla, cid_proc.nome AS proc_cid,
 uf.sigla AS uf_sigla, cid.nome AS cid_nome, p.nm_profissao, c.nm_estado_civil
FROM recepcao r
INNER JOIN estados uf ON r.id_estado = uf.cod_estados
INNER JOIN estados uf_proc ON r.id_uf_procedencia = uf_proc.cod_estados
INNER JOIN cidades cid_proc ON r.id_cid_procedencia = cid_proc.cod_cidades
INNER JOIN cidades cid ON r.id_cidade = cid.cod_cidades
INNER JOIN profissao p ON r.id_profissao = p.id_profissao
INNER JOIN estado_civil c ON r.id_estado_civil = c.id_estado_civil
WHERE r.id_recepcao = " . $num_controle) or die("Erro no select " )) {
        $array = $query->fetch(PDO::FETCH_ASSOC);
    }
    return $array;
}

function paginaBancoData($dt) {
    $data = str_replace("/", "-", $dt);
    $data = date('Y-m-d H:i:s', strtotime($data));
    return $data;
}

function bancoPaginaData($dt) {
    $data = str_replace("-", "/", $dt);
    $data = date('d/m/Y', strtotime($data));
    return $data;
}

function bancoPaginaHora($dt) {
    $data = str_replace("-", "/", $dt);
    $data = date('H:i:s', strtotime($data));
    return $data;
}

function paginaBancoDataSemHora($dt) {
    $data = str_replace("/", "-", $dt);
    $data = date('Y-m-d', strtotime($data));
    return $data;
}
