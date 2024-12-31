<h1>Tarifas</h1>
<br><br>
<div class="row">
    <table class="table">
        <tbody>
            <tr>
                <th class="headerTH">Recorrido</th>
                <th class="headerTH">Trifa</th>
                <th class="headerTH">Reservar</th>

            </tr>
        <?php
            // var_dump($datosTarifas);
            foreach ($datosTarifas as $tarifa) {
                // echo "<div class='tarjeta'>";
                // echo "<h3>$tarifa->ciudad_origin → $tarifa->ciudad_destino</h3>";
                // echo "<p>Tarifa: $tarifa->tarifa €</p>";
                // echo "<button>Reservar</button>";
                // echo "</div>";
                echo "<tr>";
                    echo "<td class='casillas'>";
                        $tarifa->ciudad_origin . " → " . $tarifa->ciudad_destino;
                    echo "</td>";

                    echo "<td class='casillas'>";
                    
                    echo "</td>";

                    echo "<td class='casillas'>";
                        echo "<button>Reservar</button>";
                    echo "</td>";
                echo "</tr>";
            }

        ?>
        </tbody>
    </table>
</div>