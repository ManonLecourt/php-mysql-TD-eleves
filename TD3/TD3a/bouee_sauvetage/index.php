<?php
   
    include "script.php";
    
    if(isset($_POST['calculer'])) {
        $inputip = $_POST['ipinput'];
        $maskbis = $_POST['sminput'];
        $inputip2 = $_POST['ipinput2'];
        $inputcidr= $_POST['cidrinput'];
        $inputcidr2= $_POST['cidrinput2'];
        calculer();
    }
    if(isset($_POST['random'])) {   
        randomIP();
    }
    
    if(isset($_POST['raz'])) { 
     // keep it anyway
    }
?>

<html lang="en">

<head>
	<meta charset="utf-8">
	<title>ipCalc Reaumur</title>
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
			<h4>Votre calculatrice en ligne des sous-réseaux IP (v4).</h4>
		</div>
		<div class=menu></div>
		<!--don't remove-->
		<div class="content">
			<h1>Calculatrice IP</h1>
            
			<form method="post" action="">
				<div class="formfield">
					<p>Cette calculatrice IP a pour but de faciliter la gestion des masques réseaux dans une
						infrastructure. Donc, si vous avez une adresse IP et un masque réseau, quel que soit son
						format, vous pouvez utiliser la calculatrice générale ci-dessous, et ainsi vérifier si 2
						adresses sont bien dans le même réseau ou non, et par conséquent si elles peuvent utiliser
						la même gateway ou non, les mêmes accès réseaux.... (texte de www.hobbesworld.com)
					</p>
					<div class="leftright">
						<div class="enter">
							<p>Entrez l'adresse IP et son masque</p>

							<div>
								<span>Adresse IP</span>
								<input type="text" name="ipinput" 
                                value="<?php echo (isset($inputip)? $inputip:''); ?>" 
                                size="15" maxlength="15" tabindex="1">
							</div>

							<div>
								<span>CIDR ?</span>
								<input type="text" name="cidrinput" 
                                value="<?php echo (isset($inputcidr)?$inputcidr:''); ?>" 
                                size="2" maxlength="2" tabindex="2">
							</div>

							<div>
								<span>... ou Masque</span>
								<input type="text" name="sminput" size="15" maxlength="15" tabindex="2">
							</div>

							<div class="net">
								<span>Adresse IP-2(optionnel)</span>
								<input type="text" name="ipinput2" 
                                value="<?php echo (isset($inputip2)?$inputip2:''); ?>" 
                                size="15" maxlength="15" tabindex="4">

								<span>CIDR 2</span>
								<input type="text" name="cidrinput2" 
                                value="<?php echo (isset($inputcidr2)?$inputcidr2:''); ?>" 
                                size="2" maxlength="2" tabindex="2">
							</div>

							<div id="btn">
                                <input type="submit" name="calculer" value="calculer">
                                <input type="submit" value="raz" name="raz">
                                <input type="submit" name="random" value="random" >
							</div>

						</div>
						<div></div>
						<div class="results">
							<p>Résultats</p>
                            
							<div>
								<span>Première adresse disponible</span>
								<input type="text" value="<?php echo (isset($starthost)?$starthost:'')?>" name="starthost" size="15" maxlength="15">
							</div>

							<div>
								<span>Dernière adresse disponible</span>
								<input type="text" value="<?php echo (isset($endhost)?$endhost:'')?>" name="endhost" size="15" maxlength="15">
							</div>

							<div>
								<span>Nombre d'adresses disponibles</span>
								<input type="text" value="<?php echo (isset($numofhosts)?$numofhosts:'')?>" name="numofhosts" size="9" maxlength="15">
							</div>

							<div class="net">
								<span>Adresse réseau</span>
								<input type="text" value="<?php echo (isset($subnetaddress)?$subnetaddress:'')?>" name="subnetaddress" size="15" maxlength="15">
							</div>

							<div>
								<span>Adresse de diffusion</span>
								<input type="text" value="<?php echo (isset($broadcastaddress)?$broadcastaddress:'') ?>" name="broadcastaddress" size="15" maxlength="15">
							</div>

							<div>
								<span>Portée des adresses réseau</span>
								<input type="text" value="<?php echo (isset($subsizebits)?$subsizebits:'')?>" name="subsizebits" size="2" maxlength="2"> Bits
							</div>

							<div>
								<span>Portée des adresses hôtes</span>
								<input type="text" value="<?php echo (isset($hostsizebits)?$hostsizebits:'')?>" name="hostsizebits" size="2" maxlength="2"> Bits
							</div>

							<div>
								<span>2ème adresse incluse ?</span>
								<input type="text" value="<?php echo (isset($samenetwork)?$samenetwork:'')?>" name="samenetwork" size="10" maxlength="10">
							</div>

						</div>
					</div>
				</div>
			</form>
		</div>
		<footer>&copy;SIN 2020</footer>
	</main>
	<!-- <script src="script.js"></script> -->
</body>

</html>
