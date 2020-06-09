<!-- Etape 4 : Eviter d'effectuer une écriture si l'un des champs n'est pas saisi. -->
<?php
    // récupération des données du formulaire
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['statut'])) {
        $nom= $_POST['nom'];	
        $prenom= $_POST['prenom'];
        $statut= $_POST['statut'];
        $date= $_POST['date'];

        EcritureData($nom, $prenom, $statut, $date);
        lireContenu();
    }
    else {
        echo "Un des paramètres est vides";
    }
    
    
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>TD2-SIN 2020</title>
		<style type="text/css"></style>
	</head>
	<body>
        <form action="" method ="POST">
            <input type="text" name="nom" value="">
            <input type="text" name="prenom" value="">
            <input type="text" name="statut" value="">
            <input type="text" name="date" value="0000-00-00">
            <input type="submit" value="Envoyer">
        </form>
 
    </body>
  
</html>

<?php

// Fonction d'ajout
function EcritureData($nom, $prenom, $statut, $date) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "td1";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset('utf8');
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	// ajout d'une entité
	$sql = "INSERT INTO famille_tbl (nom, prenom, statut, date) VALUES ('$nom', '$prenom', '$statut', '$date')";
	$result = $conn->query($sql);

	$conn->close();  
}

// consultation des données
function lireContenu() {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "td1";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset('utf8');
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	// lecture des données (TD1)
	$sql = "select * from famille_tbl";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo $row["nom"]. "  " . $row["prenom"]. "   (" . $row["statut"]."),    date de naissance : " . $row["date"]."<br>";
		}
	} else {
		echo "0 results";
	}	
	$conn->close();  
}
?>



