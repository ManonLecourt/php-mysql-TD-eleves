<?php
   
    include "script.php";
    
    if(isset($_POST['inserer'])) {
        $ipcidr = $_POST['ipcidr'];
        $salle= $_POST['salle'];
        $macadd = $_POST['macadd'];
        $ref= $_POST['ref'];
        if (!empty($_POST['ipcidr']) && !empty($_POST['macadd'])) {
            inserer();
        }
    }
    if(isset($_POST['afficher'])) {   
        afficher();
    }
    
    if(isset($_POST['supprimer'])) { 
        $ipcidr = $_POST['ipcidr'];
        if (!empty($_POST['ipcidr'])) {
            supprimer();
        }
    }
?>

<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Parc info Reaumur</title>
	<link href="style.css" rel="stylesheet" />
</head>

<body>
	<header>
		<!--don't remove-->
	</header>
	<main>
		<div class="logo">
			<div class="image">Lycée Réaumur</div>
			<h1>ReaumurTech.com</h1>
			<h4>GESTION DE PARC INFORMATIQUE.</h4>
		</div>
		<div class=menu></div>
		<!--don't remove-->
		<div class="content">
			<h1>Gestion de parc informatique</h1>
            
			<form method="post" action="">
				<div class="formfield">
					<p>TD3 PHP/MySQL SIN. Reste à faire : update, particular select, display ip network, compare two IP</p>
					<div class="leftright">
						<div class="enter">
							<p>Entrez les données d'une station de travail</p>

							<div>
								<span>Adresse IP/cidr*</span>
								<input type="text" name="ipcidr" 
                                value="<?php echo (isset($ipcidr)? $ipcidr:''); ?>" 
                                size="20" maxlength="20" tabindex="1">
							</div>

							<div>
								<span>Salle</span>
								<input type="text" name="salle" 
                                value="<?php echo (isset($salle)?$salle:''); ?>" 
                                size="5" maxlength="5" tabindex="2">
							</div>

							<div>
								<span>MAC*</span>
								<input type="text" name="macadd" 
                                value="<?php echo (isset($macadd)?$macadd:''); ?>" 
                                size="20" maxlength="20" tabindex="2">
							</div>

							<div>
								<span>Ref</span>
								<input type="text" name="ref" 
                                value="<?php echo (isset($ref)?$ref:''); ?>" 
                                size="15" maxlength="15" tabindex="4">
							</div>

							<div id="btn">
                                <input type="submit" name="inserer" value="inserer">
                                <input type="submit" value="supprimer" name="supprimer">
                                <input type="submit" name="afficher" value="afficher" >
							</div>

						</div>
						<div></div>
						<div class="results">
							<h2></h2>
                            
							<div>
                                <?php echo (isset($res)?$res:'');?>
                            </div>
                            
						</div>
					</div>
				</div>
			</form>
		</div>
		<footer>&copy;SIN 2020</footer>
	</main>
</body>

</html>
