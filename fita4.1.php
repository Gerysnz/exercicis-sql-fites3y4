
<html>
 <head>
     <title>Exemple de lectura de dades a MySQL</title>
     <style>
         body{
         }
         table,td {
             border: 1px solid black;
             border-spacing: 0px;
         }
     </style>
 </head>
 
 <body>
     <h1>Filtre per continent</h1>
    <form method="get">
        <label for="continent">Selecciona un continent:</label>
        <select id="continent" name="continent">
            <?php
                $conn = mysqli_connect('localhost','admin','admin123');
                mysqli_select_db($conn, 'world');

                // Obtenir llistat de continents
                $continents = mysqli_query($conn, "SELECT DISTINCT Continent FROM country;");
                while ($fila = mysqli_fetch_assoc($continents)) {
                    $continent = $fila['Continent'];
                    echo "<option value=\"$continent\">$continent</option>";
                }
              
            ?>
        </select>
        <input type="submit" value="Filtrar">
    </form>

    <?php
     //aquii se muestra el ffiltro de continente

     if (isset($_GET['continent'] ) && $_GET['continent'] != "") {
        //REVISAR ESTA LINEA 41
        $continent = mysqli_real_escape_string($conn, $_GET['continent']);
        $consulta = "SELECT city.Name, city.CountryCode, city.District, city.Population 
                     FROM city 
                     JOIN country ON city.CountryCode = country.Code 
                     WHERE country.Continent = '$continent';";
    } else {
        $consulta = "SELECT city.Name, city.CountryCode, city.District, city.Population 
                     FROM city 
                     JOIN country ON city.CountryCode = country.Code;";
     }
        $resultat = mysqli_query($conn, $consulta);

        echo "<table>";
            echo "<tr><th>Nom ciutat</th><th>CountryCode</th><th>District</th><th>Població</th></tr>";
                while ($fila = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>{$fila['Name']}</td>";
                    echo "<td>{$fila['CountryCode']}</td>";
                    echo "<td>{$fila['District']}</td>";
                    echo "<td>{$fila['Population']}</td>";
                    echo "</tr>";
                }
            echo "</table>";

    ?>

   

</body>
</html>