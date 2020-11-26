 <script type='text/javascript'>
     window.print();
 </script>

 <?php
    session_start();
    ini_set('default_charset', 'UTF-8');
    date_default_timezone_set("Brazil/East");
    //include ("inc/header.php");
    include("inc/conn.php");
    include("js/jquery_funcoes.php");
    $paciente = $_SESSION['paciente'];
    $resultado = $_SESSION['resultado'];

    $nascimento = "";
    if ($paciente['dt_nasc_paciente'] != '0000-00-00' && $paciente['dt_nasc_paciente'] != null) {
        $nascimento = $paciente['dt_nasc_paciente'];
    }

    if (isset($resultado['turno'])) {
        if ($resultado['turno'] == "m") {
            $resultado['turno'] = "Manhã";
        } else {
            $resultado['turno'] = "Noite";
        }
    }

    $tipoAtendimento = "";
    switch ($_SESSION['atendimento']) {
        case 'P':
            $tipoAtendimento = "Pediatria";
            break;
        case 'C':
            $tipoAtendimento = "Clínica Médica";
            break;
        case 'O':
            $tipoAtendimento = "Odontologia";
            break;
        case 'M':
            $tipoAtendimento = "Medicamento";
            break;
        case 'S':
            $tipoAtendimento = "Sutura";
            break;
        default:
            $tipoAtendimento = "";
            break;
    }

    ?>

 <html>

 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <script type="text/javascript">
         function DoPrinting() {
             if (!window.print) {
                 alert("Erro ao tentar Imprimir.")
                 return
             }
             //                window.print();
             //                window.setTimeout();
             //                window.location.href = 'index.php';
         }
     </script>
     <style>
         body {
             margin: 0;
             padding: 0;
             background-color: #FFF;
             font: 12pt "Tahoma";


         }

         /* {
             box-sizing: border-box;
             -moz-box-sizing: border-box;
        } */

         .page {
             width: 794px;
             height: 250mm;
             padding: 0px;
             margin: 0;
             margin-left: 10px;
             border: 1px white solid;
             /* border-radius: 5px; */
             background: white;

             /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
         }

         .subpage {
             padding: 0;
             border: 1px white solid;
             height: 280mm;
             outline: 1cm #fff solid;
             margin: 30px;
             margin-left: 10px;

         }

         .cab {
             margin-top: 10px;
             width: 100%;
             border: 0px white solid;
             height: 70px;
         }

         .cab2 {
             margin-top: 0px;
         }

         .corpo {
             margin-top: 72px;
             border: 0px red solid;
             width: 100%;
             height: 162px;

         }

         .interno {
             margin: 4px;
             /* //border: 1px blue solid; */
             width: 100%;
             height: 100%;

         }

         @page {
             size: A4;
             margin: 0;
         }

         @media print {
             .page {
                 margin: 0;
                 border: initial;
                 /*                    border-radius: initial;
                                        width: initial;*/
                 min-height: initial;
                 box-shadow: initial;
                 background: initial;
                 page-break-after: always;
             }
         }

         input {
             text-align: left, ;
             padding-right: 3px;
         }

         /* div {
             border: 1px solid white;
         } */
     </style>
 </head>

 <body onload="DoPrinting();">
     <!--  -->
     <?php
        require_once("./inc/MPDF70/mpdf.php");
        ?>


     <div class="book">
         <div class="page">
             <div class="subpage">
                 <form id="form_recep" action="Imprime_Atendimento.php" method="post">

                     <div class="cab">
                         <br><br><br>
                         <div style="width: 33%; height: 90%; float: left;">
                             <div style="text-align: center; margin-top:35px;">
                                 <label style="font: 12pt; color: white;">&nbsp;</label>
                             </div>
                         </div>
                         <div style="width: 34%; height: 90%; float: left; text-align: center;">
                             <div style="margin-top: 10px;">&nbsp;
                                 <!--<img src="img/images.jpg" width="83px" height="83px" />-->
                             </div>
                         </div>
                         <div style="width: 33%; height: 90%; float: left;">
                             <div style="text-align: center; margin-top:25px;"><label style="font: 12pt; color: white;">&nbsp;</label></div>

                             <div style="width:350px; height: 27px; float: right; margin-top:-20px; margin-right:60px ">&nbsp;&nbsp;&nbsp;<input style="width: 90%;
                                 height: 80%; border: 1px solid white; " type="text" name="numero" value="<?php echo $resultado['controle'] . ' - Turno: ' . $resultado['turno'] . ' - ' . $tipoAtendimento . ' SUS ' . $paciente['nr_cartao_sus_paciente']; ?>" />
                             </div>
                         </div>
                     </div>

                     <div class="cab2">
                         <div style="width:250px; height: 27px; float: left; margin-left: 7%; "><input style="width: 100%; height: 100%; border: 1px solid white;" type="text" name="distrito" value="Distrito Norte I - UPA Pajuçara"></div>
                         <div style="width:120px; height: 27px; float: left; margin-left: 14% "><input style="width: 100%; height: 100%; border: 1px solid white;" type="text" name="dataEntrada" value="<?php echo date("d/m/Y"); ?>" /></div>
                         <div style="width:80px; height: 27px; float: left; margin-left: 12% "><input style="width: 100%;  height: 100%; border: 1px solid white;" type="text" name="horaEntrada" value="<?php echo date("H:i:s"); ?>" /></div>
                         <?php
                            //                            if ($_SESSION['idade'] != "") {
                            //                                echo '<div style="width:100%; height: 27px; float: right; margin-top: 7px; margin-right: 10px;"><input style="width: 100%;  height: 100%; border: 1px solid white;" type="text" name="unidadeSaude" value="UPA Potengi - Idade: ' . $_SESSION['idade'] . '" /></div>';
                            //                            } else {
                            //                                echo '<div style="width:100%; height: 27px; float: right; margin-top: 7px; margin-right: 10px;"><input style="width: 100%;  height: 100%; border: 1px solid white;" type="text" name="unidadeSaude" value="UPA Potengi" /></div>';
                            //                            }
                            //                            unset($_SESSION['idade']);
                            ?>



                     </div>
                     <div class="corpo">
                         <div class="interno">
                             <!--<div><label style="color: white; font: 9pt 'Arial'">&nbsp;</label></div>-->
                             <div style="width:300px; height: 27px; float: left; margin-left: 10%; "><input style="width: 100%; height:100%; border: 1px solid white;" type="text" name="nomePaciente" value="<?php echo $paciente['nm_paciente']; ?>" /></div>
                             <div style="width:30px; height: 27px; float: left; margin-left: 35%; border: 1px solid white;"><input style="width: 100%; height: 100%; border: 1px solid white;" type="text" name="nomePaciente" value="<?php echo $paciente['sexo_paciente']; ?>" />
                                 <!--                                    <div style="float: left;">
                                        <label style="font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    </div>-->
                                 <!--<div style="margin-left: 29px; margin-bottom: 2px; float: left;">-->
                                 <?php
                                    //                                        if ($paciente['sexo_paciente'] == 'm') {
                                    //                                            echo "<div style='border: 1px solid black; background-color: #000000; margin-rigth:3px; width: 6px; height: 6px;'></div>";
                                    ////                                            echo "<div style='border: 1px solid black; background-color: #000; width: 10px; height: 9px;'></div>";
                                    ////                                            echo "<input style='width: 10px; height: 9px;' type='radio' name='sexo' value='m' checked='true'><label style='font-size: 9px' /></label><br/>";
                                    ////                                            echo "<input style='width: 10px; height: 9px;' type='radio' name='sexo' value='f'><label style='font-size: 9px' /></label>";
                                    //                                        } else {
                                    //                                            echo "<div style='border: 1px solid white; background-color: #fff; width: 8px; height: 8px;'></div>";
                                    //                                            echo "<div style='border: 1px solid black; background-color: #000000; margin-rigth:3px; margin-top:3px; width: 6px; height: 6px;'></div>";
                                    //                                        }
                                    ?>

                                 <!--</div>-->
                             </div>
                             <div style="width:450px; height: 27px; float: left; margin-right: 300px; margin-left: 10%;"><input style="width: 100%;  height: 100%;  border: 1px solid white;" type="text" name="responsavel" value="<?php
                                                                                                                                                                                                                                    //                                        if ($paciente['nm_responsavel_paciente'] != "") {
                                                                                                                                                                                                                                    //                                            if ($nascimento != null) {
                                                                                                                                                                                                                                    //                                                echo 'Resp.: ' . $paciente['nm_responsavel_paciente'] . ' - Nasc.: ' . date('d/m/Y', strtotime($nascimento));
                                                                                                                                                                                                                                    //                                            } else {
                                                                                                                                                                                                                                    //                                                echo 'Resp.: ' . $paciente['nm_responsavel_paciente'];
                                                                                                                                                                                                                                    //                                            }
                                                                                                                                                                                                                                    //                                        } else {
                                                                                                                                                                                                                                    //                                            if ($nascimento != null) {
                                                                                                                                                                                                                                    //                                                echo 'Nasc.: ' . date('d/m/Y', strtotime($nascimento));
                                                                                                                                                                                                                                    //                                            }
                                                                                                                                                                                                                                    //                                        }
                                                                                                                                                                                                                                    echo $paciente['nm_responsavel_paciente'];
                                                                                                                                                                                                                                    ?>" /></div>

                             <div style="width:150px; height: 27px; float: left; margin-left: 10%; margin-top: 2px; "><input style="width: 100%;  height: 100%;  border: 1px solid white;" type="text" name="nascimento" value="<?php echo date('d/m/Y', strtotime($nascimento)) . ' (' . $_SESSION['idade'] . ' Anos)'; ?>" /></div>

                             <div style="width:100px; height: 27px; float: left;  margin-left: 30%"><input style="width: 100%;  height: 100%;  border: 1px solid white;" type="text" name="estadoCivil" value="<?php echo getEstadoCivilID($paciente['id_estado_civil']); ?>" /></div>

                             <div style="width:130px; height: 27px; float: left;  margin-left: 7%;"><input style="width: 100%;  height: 100%;  border: 1px solid white;" type="text" name="telefone" value="<?php echo $paciente['telefone']; ?>" /></div>

                             <div style="width:320px; height: 27px; float: left; margin-left: -10%; "><input style="width: 100%;  height:100%; border: 1px solid white;" type="text" name="endereco" value="<?php echo $paciente['endereco_paciente']; ?>" /></div>

                             <div style="width:150px; height: 27px; float: left;  margin-left: 15%;"><input style="width: 100%;  height: 100%;  border: 1px solid white;" type="text" name="profissao" value="<?php echo $paciente['nm_profissao'] ?>" /></div>

                             <div style="width:180px; height: 27px; float: left; margin-left: 20%;  "><input style="width: 100%; height: 100%;  border: 1px solid white;" type="text" name="bairro" value="<?php echo $paciente['bairro_paciente']; ?>" /></div>
                             <div style="width:100px; height: 27px; float: left; margin-left: 17%; "><input style="width: 100%; height: 100%;  border: 1px solid white;" type="text" name="cidade" value="<?php echo $paciente['cid_nome']; ?>" /></div>

                             <div style="width:30px; height: 27px; float: left; margin-left: 4px; margin-left: 15%; "><input style="width: 100%; height: 100%;  border: 1px solid white;" type="text" name="uf" value="<?php echo $paciente['uf_sigla']; ?>" /></div>

                         </div>
                     </div>

                 </form>
             </div>
         </div>
     </div>
 </body>

 </html>