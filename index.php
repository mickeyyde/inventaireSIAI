<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <link href="./style/style.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="./ressource/BYES.png" />
        <script src='./js/index.js'></script>
        <script type="text/javascript">

             var objRequete = new XMLHttpRequest;

             function fRetour() {
				if (objRequete.readyState==4 && objRequete.status==200) { 
                    try {
                        obj=JSON.parse(objRequete.responseText);
                        tableUpdate();
                    } catch (e) {
                        alert("pb parsing. Voir l'erreur dans la console si possible");
                        console.error("Parsing error:-( :", e);
                    }
				}
			}
			
			function fAction() {
                    var param = document.getElementById('recherche').value;
					objRequete.open('get','./include/API_ListeMat.php?recherche='+String(param.toUpperCase()),true);	
                    objRequete.onreadystatechange = fRetour;		
                    objRequete.send(null);									
					return true; 
			 }
        </script>
	</head>
	<body onload="fAction();">
    <?php include("./include/header.php");?>
			<h1>Inventaire du SIAI (étagères du grenier)</h1><br>
            <div id="global">
                <input type="text" id="recherche" size="30">
                <button onclick="fAction();">Rechercher</button>
            </div>


            
            <br><br>
			<Table Border=1 class="tabcenter" id="tableauref">
				<tr>
                    <th><b>Détail</b></th>
                    <th><b>Designation</b></th>
					<th><b>Marque</b></th>
                    <th><b>Reference</b></th>
                    <th><b>Quantite</b></th>
                </tr>
                <tr>
                    <td class="jstr">Cette référence ne correspond à rien dans la BDD.</td>
                </tr>
			</table>
	</body>
</html>