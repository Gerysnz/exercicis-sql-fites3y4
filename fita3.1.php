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
 	<h1>Filtre per habitants</h1>
    <form method="get">
        <label for="habitants">Nombre d'habitants:</label>
        <input type="text" id="habitants" name="habitants">
        <input type="text" name="habitants2" id="habitants2">
        <input type="submit" value="Filtrar">
    </form>

    <?php
        $conn = mysqli_connect('localhost','admin','admin123');
        mysqli_select_db($conn, 'world');
        //hacerlo sencillico

        //si existeixen els dos camps i no estan buits hace lo siguiente
        //s no existe minimo o maximo la que falte no se tiene en cuenta

        if (isset($_GET['habitants']) && $_GET['habitants'] != "" && isset($_GET['habitants2']) && $_GET['habitants2'] != "") {
            $minimo = mysqli_real_escape_string($conn, $_GET['habitants']);
            $maximo = mysqli_real_escape_string($conn, $_GET['habitants2']);
            $consulta = "SELECT * FROM city WHERE Population BETWEEN $minimo AND $maximo;";

        } else if (isset($_GET['habitants']) && $_GET['habitants'] != "") {
            $minimo = mysqli_real_escape_string($conn, $_GET['habitants']);
            $consulta = "SELECT * FROM city WHERE Population >= $minimo;";

        } else if (isset($_GET['habitants2']) && $_GET['habitants2'] != "") {
            $maximo = mysqli_real_escape_string($conn, $_GET['habitants2']);
            $consulta = "SELECT * FROM city WHERE Population <= $maximo;";

        } else {
            $consulta = "SELECT * FROM city;";
        }
        $resultat = mysqli_query($conn, $consulta);

        
        

    ?>
   


 
 	<!-- (3.1) aquí va la taula HTML que omplirem amb dades de la BBDD -->
 	<table>
 	<!-- la capçalera de la taula l'hem de fer nosaltres -->
 	<thead><td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td></thead>
 	<?php
 		# (3.2) Bucle while
 		while( $registre = mysqli_fetch_assoc($resultat) )
 		{
 			# els \t (tabulador) i els \n (salt de línia) son perquè el codi font quedi llegible
  
 			# (3.3) obrim fila de la taula HTML amb <tr>
 			echo "\t<tr>\n";
 
 			# (3.4) cadascuna de les columnes ha d'anar precedida d'un <td>
 			#	després concatenar el contingut del camp del registre
 			#	i tancar amb un </td>
 			echo "\t\t<td>".$registre["Name"]."</td>\n";
 			echo "\t\t<td>".$registre['CountryCode']."</td>\n";
 			echo "\t\t<td>".$registre["District"]."</td>\n";
 			echo "\t\t<td>".$registre['Population']."</td>\n";
 
 			# (3.5) tanquem la fila
 			echo "\t</tr>\n";
 		}
 	?>
  	<!-- (3.6) tanquem la taula -->
 	</table>	
 </body>
</html>