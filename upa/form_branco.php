<html>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";


        }

        /* * {
                 box-sizing: border-box;
                 -moz-box-sizing: border-box;
             }*/
        .page {
            width: 794px;
            height: 260mm;
            padding: 0px;
            margin: 0;
            border: 1px blue solid;
            /* //border-radius: 5px; */
            background: white;

            /* //box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
        }

        .subpage {
            padding: 0;
            border: 1px red solid;
            height: 280mm;
            outline: 1cm #FFEAEA solid;
            margin: 30px;
        }

        .cab {
            margin-top: 0px;
            width: 100%;
            border: 0px green solid;
            height: 113px;
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
            text-align: right;
            padding-right: 3px;
        }

        /* div {
            border: 1px solid white;
        } */
    </style>
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="cab">
                    <div style="width: 33%; height: 100%; float: left;">
                        <div style="text-align: center; margin-top:35px;">
                            <label style="font: 12pt;">SECRETARIA MUNICIPAL DE SAUDE</label>
                        </div>
                    </div>
                    <div style="width: 34%; height: 100%; float: left; text-align: center;">
                        <div style="margin-top: 10px;"><img src="img/images.jpg" width="83px" height="83px" /></div>
                    </div>
                    <div style="width: 33%; height: 100%; float: left;">
                        <div style="text-align: center; margin-top:35px;"><label style="font: 12pt;">BOLETIM DE ATENDIMENTO DE URGENCIA</label></div>
                        <div style="width:240px; height: 27px; float: right; margin-top:8px ">N&nbsp;&nbsp;<input style="width: 90%; height: 100%; border: 1px solid white;" type="text" name="distrito"></div>
                    </div>
                </div>
                <div class="cab2">
                    <div style="width:265px; height: 27px; float: left; "><input style="width: 100%; height: 100%; border: 1px solid white;" type="text" name="distrito"></div>
                    <div style="width:144px; height: 27px; float: left; margin-left: 120px "><input style="width: 100%; height: 100%; border: 1px solid white;" type="text" name="distrito"></div>
                    <div style="width:97px; height: 27px; float: left; margin-left: 104px "><input style="width: 100%;  height: 100%; border: 1px solid white;" type="text" name="distrito"></div>
                    <div style="width:100%; height: 27px; float: left; margin-top: 7px;"><input style="width: 100%;  height: 100%; border: 1px solid white;" type="text" name="distrito"></div>
                </div>
                <div class="corpo">
                    <div class="interno">
                        <div><label style="color: white; font: 9pt 'Arial'">IDENTIFICACAO DO PACIENTE</label></div>
                        <div style="width:620px; height: 27px; float: left; "><input style="width: 100%; height: 27px; border: 1px solid white;" type="text" name="distrito"></div>
                        <div style="width:87px; height: 27px; float: left; margin-left: 15px; border: 1px solid white;">
                            <div style="float: left;">
                                <label style="color: white; font-size: 10px;">Sexo</label></div>
                            <div style="margin-left: 11px; float: left;  border: 1px solid white;">
                                <input style="width: 10px; height: 9px; margin-top: -1px; margin-left: 8px;" type="radio" name="sexo" value="m"><label style="font-size: 9px">
                                    <!--masc--></label><br />
                                <input style="width: 10px; height: 9px; margin-left: 8px;" type="radio" name="sexo" value="f"><label style="font-size: 9px">
                                    <!--fem--></label>
                            </div>
                        </div>
                        <div style="width:445px; height: 26px; float: left; margin-top: 6px;"><input style="width: 100%;  height: 100%;  border: 1px solid white;" type="text" name="distrito"></div>
                        <div style="width:260px; height: 26px; float: left; margin-top: 6px; margin-left: 15px;"><input style="width: 100%;  height: 100%;  border: 1px solid white;" type="text" name="distrito"></div>
                        <div style="width:721px; height: 27px; float: left; margin-top: 8px;"><input style="width: 100%;  height: 100%;  border: 1px solid white;" type="text" name="distrito"></div>
                        <div style="width:308px; height: 27px; float: left; margin-top: 8px; "><input style="width: 100%; height: 100%;  border: 1px solid white;" type="text" name="distrito"></div>
                        <div style="width:337px; height: 27px; float: left; margin-left: 7px; margin-top: 8px;"><input style="width: 100%; height: 100%;  border: 1px solid white;" type="text" name="distrito"></div>
                        <div style="width:64px; height: 27px; float: left; margin-left: 4px; margin-top: 8px;"><input style="width: 100%; height: 100%;  border: 1px solid white;" type="text" name="distrito"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>