<?= $this->extend("plantillas/layout2zonas"); ?>

<?= $this->section("principal"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitante</title>
</head>

<body>
    <div class="row">
        <?php
            $ultimoSegmento = explode('/', current_url());
            $ultimoSegmento = end($ultimoSegmento);
        ?>

        <!-- Lineas y horiarios -->
        <!-- <php if ($ultimoSegmento == 'lineasHorarios'): ?> -->
        <?php if (isset($ciudadesOrg)): ?>
            <?php echo view('v_horarios'); ?>
        <!-- Tarifas -->
        <?php elseif ($ultimoSegmento == 'tarifas'): ?>
            <?php echo view('v_tarifas'); ?>
        <!-- Instrucciones/Bienvenida -->
        <?php else: ?>
            <div>
                <h1>Bienvenidos</h1>
                <p><b>Hola!</b> Estas en modo visitante 'sin sesión' <br>
                    Puedes consultar los horarios, rutas y tarifas de autobuses.</p>
                </p>
            </div>
        <?php endif; ?>
    </div>

<!-- 


    <div class="row">
        <div class="col-md-3">



            <div class="boxHorariosHome MT20">
                <h3>Consulta de horarios</h3>

                <div class="contCampos">
                    <p>
                        <label for="fecha_txt">Fecha</label>
                        <input class="inputFecha" type="text" name="fecha_txt" id="fecha_txt" readonly="readonly" onclick="toggleCal();return false;">
                    </p>

                    <div id="calendarios" style="display: none;">
                        <div class="boxCals">

                            <div class="boxCalMes">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="calMesName">Diciembre</td>
                                        </tr>
                                        <tr>
                                            <td class="contDias">
                                                <table class="table tablaMes">
                                                    <tbody>
                                                        <tr>
                                                            <th class="diaName">L</th>
                                                            <th class="diaName">M</th>
                                                            <th class="diaName">X</th>
                                                            <th class="diaName">J</th>
                                                            <th class="diaName">V</th>
                                                            <th class="diaName">S</th>
                                                            <th class="diaName">D</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="diasOff" id="d_2024-12-01">1</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="diasOff" id="d_2024-12-02">2</td>
                                                            <td class="diasOff" id="d_2024-12-03">3</td>
                                                            <td class="diasOff" id="d_2024-12-04">4</td>
                                                            <td class="diasOff" id="d_2024-12-05">5</td>
                                                            <td class="diasOff" id="d_2024-12-06">6</td>
                                                            <td class="diasOff" id="d_2024-12-07">7</td>
                                                            <td class="diasOff" id="d_2024-12-08">8</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="diasOff" id="d_2024-12-09">9</td>
                                                            <td class="diasOff" id="d_2024-12-10">10</td>
                                                            <td class="diasOff" id="d_2024-12-11">11</td>
                                                            <td class="diasOff" id="d_2024-12-12">12</td>
                                                            <td class="diasOff" id="d_2024-12-13">13</td>
                                                            <td class="diasOff" id="d_2024-12-14">14</td>
                                                            <td class="diasOff" id="d_2024-12-15">15</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="diasOff" id="d_2024-12-16">16</td>
                                                            <td class="diasOff" id="d_2024-12-17">17</td>
                                                            <td class="diasOff" id="d_2024-12-18">18</td>
                                                            <td class="diasOff" id="d_2024-12-19">19</td>
                                                            <td class="diasOff" id="d_2024-12-20">20</td>
                                                            <td class="diasOff" id="d_2024-12-21">21</td>
                                                            <td class="diasOff" id="d_2024-12-22">22</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="diasOff" id="d_2024-12-23">23</td>
                                                            <td class="diasOff" id="d_2024-12-24">24</td>
                                                            <td class="diasOff" id="d_2024-12-25">25</td>
                                                            <td class="diasOff" id="d_2024-12-26">26</td>
                                                            <td class="diasOff" id="d_2024-12-27">27</td>
                                                            <td class="diasOff" id="d_2024-12-28">28</td>
                                                            <td class="diasOff" id="d_2024-12-29">29</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="diasC diaHoy seleccionado" id="d_2024-12-30" onclick="changeDia(this.id);">30</td>
                                                            <td class="diasC" id="d_2024-12-31" onclick="changeDia(this.id);">31</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="boxCalMes">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="calMesName">Enero</td>
                                        </tr>
                                        <tr>
                                            <td class="contDias">
                                                <table class="table tablaMes">
                                                    <tbody>
                                                        <tr>
                                                            <th class="diaName">L</th>
                                                            <th class="diaName">M</th>
                                                            <th class="diaName">X</th>
                                                            <th class="diaName">J</th>
                                                            <th class="diaName">V</th>
                                                            <th class="diaName">S</th>
                                                            <th class="diaName">D</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="diasC" id="d_2025-01-01" onclick="changeDia(this.id);">1</td>
                                                            <td class="diasC" id="d_2025-01-02" onclick="changeDia(this.id);">2</td>
                                                            <td class="diasC" id="d_2025-01-03" onclick="changeDia(this.id);">3</td>
                                                            <td class="diasC" id="d_2025-01-04" onclick="changeDia(this.id);">4</td>
                                                            <td class="festivo" id="d_2025-01-05" onclick="changeDia(this.id);">5</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="diasC" id="d_2025-01-06" onclick="changeDia(this.id);">6</td>
                                                            <td class="diasC" id="d_2025-01-07" onclick="changeDia(this.id);">7</td>
                                                            <td class="diasC" id="d_2025-01-08" onclick="changeDia(this.id);">8</td>
                                                            <td class="diasC" id="d_2025-01-09" onclick="changeDia(this.id);">9</td>
                                                            <td class="diasC" id="d_2025-01-10" onclick="changeDia(this.id);">10</td>
                                                            <td class="diasC" id="d_2025-01-11" onclick="changeDia(this.id);">11</td>
                                                            <td class="festivo" id="d_2025-01-12" onclick="changeDia(this.id);">12</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="diasC" id="d_2025-01-13" onclick="changeDia(this.id);">13</td>
                                                            <td class="diasC" id="d_2025-01-14" onclick="changeDia(this.id);">14</td>
                                                            <td class="diasC" id="d_2025-01-15" onclick="changeDia(this.id);">15</td>
                                                            <td class="diasC" id="d_2025-01-16" onclick="changeDia(this.id);">16</td>
                                                            <td class="diasC" id="d_2025-01-17" onclick="changeDia(this.id);">17</td>
                                                            <td class="diasC" id="d_2025-01-18" onclick="changeDia(this.id);">18</td>
                                                            <td class="festivo" id="d_2025-01-19" onclick="changeDia(this.id);">19</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="diasC" id="d_2025-01-20" onclick="changeDia(this.id);">20</td>
                                                            <td class="diasC" id="d_2025-01-21" onclick="changeDia(this.id);">21</td>
                                                            <td class="diasC" id="d_2025-01-22" onclick="changeDia(this.id);">22</td>
                                                            <td class="diasC" id="d_2025-01-23" onclick="changeDia(this.id);">23</td>
                                                            <td class="diasC" id="d_2025-01-24" onclick="changeDia(this.id);">24</td>
                                                            <td class="diasC" id="d_2025-01-25" onclick="changeDia(this.id);">25</td>
                                                            <td class="festivo" id="d_2025-01-26" onclick="changeDia(this.id);">26</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="diasC" id="d_2025-01-27" onclick="changeDia(this.id);">27</td>
                                                            <td class="diasC" id="d_2025-01-28" onclick="changeDia(this.id);">28</td>
                                                            <td class="diasC" id="d_2025-01-29" onclick="changeDia(this.id);">29</td>
                                                            <td class="diasC" id="d_2025-01-30" onclick="changeDia(this.id);">30</td>
                                                            <td class="diasC" id="d_2025-01-31" onclick="changeDia(this.id);">31</td>
                                                            <td class="dias">&nbsp;</td>
                                                            <td class="dias">&nbsp;</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <p>
                        <label for="origenSel">Origen</label>
                    </p>
                    <div class="custom-select">
                        <select class="select" id="origenSel" name="origenSel" onchange="loadDestinos();">
                            <option value="0">Seleccione origen</option>
                            <option value="3">ABADIÑO</option>
                            <option value="130">AEROPUERTO BILBAO</option>
                            <option value="12">ALEGIA</option>
                            <option value="15">ANDOAIN</option>
                            <option value="7">ANTZUOLA</option>
                            <option value="24">ARETXABALETA</option>
                            <option value="26">ARLABAN</option>
                            <option value="23">ARRASATE-MONDRAGON</option>
                            <option value="43">ARROIABE</option>
                            <option value="84">ATXONDO</option>
                            <option value="10">BEASAIN</option>
                            <option value="6">BERGARA</option>
                            <option value="1">BILBAO</option>
                            <option value="20">DONOSTIA-SAN SEBASTIAN</option>
                            <option value="45">DURANA</option>
                            <option value="2">DURANGO</option>
                            <option value="19">EIBAR</option>
                            <option value="5">ELGETA</option>
                            <option value="21">ELGOIBAR</option>
                            <option value="4">ELORRIO</option>
                            <option value="18">ERMUA</option>
                            <option value="25">ESKORIATZA</option>
                            <option value="173">EZKIO-ITXASO</option>
                            <option value="174">IKAZTEGIETA</option>
                            <option value="176">ITSASONDO</option>
                            <option value="39">LANDA</option>
                            <option value="16">LASARTE</option>
                            <option value="27">LEGAZPI</option>
                            <option value="175">LEGORRETA</option>
                            <option value="126">LEINTZ GATZAGA</option>
                            <option value="44">MENDIBIL</option>
                            <option value="32">OÑATI</option>
                            <option value="11">ORDIZIA</option>
                            <option value="9">ORMAIZTEGI</option>
                            <option value="33">SAN PRUDENTZIO</option>
                            <option value="22">SORALUZE-PLACEN</option>
                            <option value="13">TOLOSA</option>
                            <option value="42">ULLIBARRI GAMBOA</option>
                            <option value="14">VILLABONA</option>
                            <option value="30">VITORIA-GASTEIZ</option>
                            <option value="220">ZARAUTZ</option>
                            <option value="8">ZUMARRAGA-URRETXU</option>
                        </select>
                    </div>
                    <p></p>

                    <p>
                        <label for="destinoSel">Destino</label>
                    </p>
                    <div class="custom-select">
                        <select class="select" id="destinoSel" name="destinoSel" onchange="loadHorariosReset();">
                            <option value="0">Seleccione destino</option>
                            <option value="23">ARRASATE-MONDRAGON</option>
                            <option value="6">BERGARA</option>
                            <option value="20">DONOSTIA-SAN SEBASTIAN</option>
                            <option value="19">EIBAR</option>
                            <option value="32">OÑATI</option>
                            <option value="33">SAN PRUDENTZIO</option>
                            <option value="220">ZARAUTZ</option>
                        </select>
                    </div>
                    <p></p>
                </div>

                <p class="infoPeque">Los horarios de paso y las horas de llegada a destino son orientativos, pudiendo sufrir variaciones.<br>
                    Horarios sujetos a posibles modificaciones en días festivos de lunes a sábado, sus visperas y posteriores.</p>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-9">
            <h2 class="titSeccion">Consulta de horarios</h2>

            <div id="cajaResultados" style="display:none;min-height:300px;">
                <div id="divResultados" style="min-height:300px;"></div>
            </div>


            <div id="divNavidad" class="ventana well" style="display:none;">
                <div class="btClose hidden"><a href="#" onclick="cerrarVentana('divNavidad');return false;">x</a></div>
                <div class="innerVentana">
                    <h4 class="titVentana">Aviso.</h4>
                    <p id="txt_24_31">Con motivo de las fiestas navideñas los días 24 y 31 de Diciembre los servicios sufrirán variaciones en los horarios de salida de los últimos servicios.<br>
                        Consulte los horarios para los días 25 de diembre y 1 de enero.
                        <br>
                        FELIZ NAVIDAD Y PROSPERO AÑO NUEVO.
                    </p>
                    <p id="txt_25_1">Día 25 de Diciembre y 01 de Enero:<br>
                        Consulte los horarios para los días 25 de diembre y 1 de enero.
                        <br>
                        FELIZ NAVIDAD Y PROSPERO AÑO NUEVO.
                    </p>
                </div>
            </div>
            <div id="divHelp">
                <p>Para realizar una consulta sobre una línea seleccione, en primer lugar, la fecha en la que realizará el recorrido. Pulsando en el icono cuadrado bajo la palabra "fecha", aparecerán en pantalla los calendarios correspondientes al mes en curso y al siguiente. Seleccione la fecha que desee simplemente pulsando sobre ella.</p>

                <p class="MT20">A continuación, seleccione la localidad de origen en el menú desplegable y, para finalizar, seleccione, del mismo modo, la localidad de destino.</p>

                <p class="MT20">La respuesta del sistema es automática en función de los datos que ha facilitado permitiéndole, al mismo tiempo, obtener información adicional sobre las opciones de retorno para ese trayecto -pulse "ver vuelta"-, opciones de viaje para el día anterior y posterior al seleccionado -pulse "ver día anterior" o "ver día siguiente"- así como las paradas intermedias del trayecto -pulsando sobre el icono de la derecha de cada trayecto-.</p>

                <p class="MT20">Por último, puede imprimir estos resultados pulsando sobre el icono de la impresora en la cabecera de la página o sobre el texto "imprimir resultados" al pie de la misma. Recuerde que cuando haya múltiples resultados a su consulta, estos aparecerán en varias páginas consecutivas.</p>
            </div>



        </div>
    </div> -->

</body>

</html>

<?= $this->endSection(); ?>