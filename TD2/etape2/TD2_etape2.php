<!-- Etape 2 : Lecture de la base de données avec formulaire :
si la date saisie est 0000-00-00, afficher le contenu de la base de données sinon 
afficher juste ce qui vient d'être saisi (voir étape 1)-->
<!DOCTYPE html>
<html>
    <head>
        <title>TD 2 - PHP/MySQL</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style2.css"/>
        </head>
    <body>
        <h2>TD 2 - PHP/MySQL</h2>
        <h5>LECOURT Manon TSTI2D1</h5>
<h4>Etape 2 - Lecture de la base de données avec formulaire :
si la date saisie est 0000-00-00, afficher le contenu de la base de données sinon 
afficher juste ce qui vient d'être saisi.</h4>

        <form action="" method ="POST">
            <input type="text" name="nom" placeholder ="Nom"/></br>
            <input type="text" name="prenom" placeholder ="Prénom"/></br>
            <input type="text" name="statut" placeholder ="Statut familial"/></br>
            <input type="text" name="date" placeholder ="Date de naissance"/></br>
            <input type="submit"/>
        </form>
        <?php
            // récupération des données du formulaire
            $nom= $_POST['nom'];    
            $prenom= $_POST['prenom'];
            $statut= $_POST['statut'];
            $date= $_POST['date'];
            //afficher les données ici dans des div 
            echo '<p>'.'Votre nom : '. $nom .'</br>'.'Votre prénom : '. $prenom.'</br>'.'Votre statut : '. $statut .'</p>';

            // si la date est 0000-00-00 on affiche le contenu de la tables
            // sinon on affiche la valeur saisie
            if ($date==="0000-00-00") {
                lireContenu();
            }
            else echo '<p>'. 'Votre date de naissance : '.$date.'</p>';
  
function lireContenu() {
   
    // Create connection
    try{
$conn = new PDO('mysql:host=localhost;dbname=famille;charset=utf8', 'root', 'root');
    $conn->set_charset('utf8');
    
    // Check connection
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
    
    // lecture de toutes les données (TD1)
    $sql = 'SELECT * FROM famille_tbl';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
           echo $nom . $prenom  .'('.$statut.'),'.'date de naissance :' . $date.'<br>';
        }
    } else {
        echo "0 result";
    }   
    $conn->close();  
}
        ?>

