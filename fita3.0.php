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
 	<h1>Filtre per ciutats</h1>
    <form method="get">
        <label for="ciutat">Nom de la ciutat:</label>
        <input type="text" id="ciutat" name="ciutat">
        <input type="submit" value="Filtrar">
    </form>

    <?php
        $conn = mysqli_connect('localhost','admin','admin123');
        mysqli_select_db($conn, 'world');

        
        if (isset($_GET['ciutat']) && $_GET['ciutat'] != "") {
            $nom = mysqli_real_escape_string($conn, $_GET['ciutat']);
            $consulta = "SELECT * FROM city WHERE Name LIKE '%$nom%';";
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