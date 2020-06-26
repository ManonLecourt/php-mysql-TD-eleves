<?php

function inserer () {
   	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "td3b";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset('utf8');
    
    global $ipcidr, $macadd, $salle, $ref;
   
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	// ajout d'une entité
	$sql = "INSERT INTO parc (ip, salle, mac, ref) VALUES ('$ipcidr', '$salle', '$macadd', '$ref')";
    //echo $sql;
	$result = $conn->query($sql);

    //$result->close();
	$conn->close();  
}
    
   


function afficher () {
    
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "td3b";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset('utf8');
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	// lecture des données (TD1)
	$sql = "select * from parc";
	$result = $conn->query($sql);
    global $res;
    $res ="<table border='1'>";
    $res.="<caption>Liste des PC du lycée</caption>";
    $res.= "<tr><th>Id</th><th>IP</th><th>Salle</th><th>Mac</th><th>Référence</th>";
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			// echo $row["id"]."\t".$row["ip"]."\t". $row["salle"]."\t".$row["ref"]."<br>";
            $res.= "<tr>"."<td>".$row["id"]."</td><td>".$row["ip"]."</td><td>". $row["salle"]."</td><td>".$row["mac"]."</td><td>".$row["ref"]."</td>"."</tr>";
		}
        
        $res.="</table>";
	} else {
		echo "0 results";
	}	
	$conn->close();   
    
}


function supprimer () {
   	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "td3b";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset('utf8');
    
    global $ipcidr, $macadd, $salle, $ref;
   
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	// ajout d'une entité
	$sql = "DELETE FROM parc where ip='$ipcidr'";
    //echo $sql;
	$result = $conn->query($sql);

    //$result->close();
	$conn->close();  
}
    

function calculer () {
  // inputs
   global $inputip, $maskbis, $inputip2, $inputcidr, $inputcidr2;
   
   // outputs
   global $subnetaddress, $starthost, $broadcastaddress, $endhost, $numofhosts,$samenetwork, $subsizebits, $hostsizebits, $CIDR;
    
    $x = 32-(int)($inputcidr);
    $y = 32-(int)($inputcidr2);
	$inputmask=$maskbis;
	
	if ($x >= 1 && $x <=24) {
		$inputmask=toIP(0xFFFFFFFF << $x);
		$sminput='';

		$inputmask2=toIP(0xFFFFFFFF << $y);
	}
    
	if (checkInput($inputip)==false || checkInput($inputmask)==false) {
        $starthost="ERROR";
		return false;
	}
    

	$ip = explode(".", $inputip);  
	$ip2 = explode(".", $inputip2);

	$masque = explode(".", $inputmask);
	$masque2 = explode(".", $inputmask2);
    
	$mask = (int)($masque[0]) << 24 | (int)($masque[1]) << 16 | (int)($masque[2]) << 8 | (int)($masque[3]);
	$mask2 = (int)($masque2[0]) << 24 | (int)($masque2[1]) << 16 | (int)($masque2[2]) << 8 | (int)($masque2[3]);

	$CIDR = 0;
	$m = $mask;
	if (sizeof($masque) == 4) {
        for ($i = 0; $i < 32; $i++) {
            if (($m & 0x01) == 0x00) $CIDR++;
            else break;
            $m = $m >> 1;
        }
    }
       
	$IP = (int)($ip[0]) << 24 | (int)($ip[1]) << 16 | (int)($ip[2]) << 8 | (int)($ip[3]);
    $IP2=0; // second address : in case it is void or wrong
	if (sizeof($ip2)==4) $IP2 = (int)($ip2[0]) << 24 | (int)($ip2[1]) << 16 | (int)($ip2[2]) << 8 | (int)($ip2[3]);


	// network address
	$adrN = $IP & $mask;
    
    $subsizebits = 32 - $CIDR;
	$hostsizebits = $CIDR;
    
    $subnetaddress = toIP($adrN);

	// network address 2
	$adrN2 = $IP2 & $mask2;
	
	// first address
	$adrFirst = $adrN + 1;
	$starthost = toIP($adrFirst);

	// boroadcast address
	$adrDiff = $adrN | ~$mask;
	$broadcastaddress = toIP($adrDiff);

	// last address
	$adrLast = $adrDiff - 1;
	$endhost = toIP($adrLast);

	// hosts number
	$numofhosts = pow(2, $CIDR) - 2;

	// address included ?
	$samenetwork = ($adrN===$adrN2)?'oui':'non';
}    

function toIP($data) {
	$ret = ($data >> 24 & 0xFF).".".($data >> 16 & 0xFF).".".($data >> 8 & 0xFF).".".($data & 0xFF);
	return $ret;
}

function checkInput($ipp) {
	$expectedChars = '0123456789.';
	$dot = 0;
	$i = 0;
	for ($i = 0; $i < strlen($ipp); $i++) {
		if (strpos($expectedChars, $ipp[$i]) == -1) break;
		if ($ipp[$i] == '.') $dot++;
	}
    $noip =($dot == 3) && ($i == strlen($ipp));
	return $noip;
}

function randomIP() {
    global $inputip, $inputcidr, $inputip2, $inputcidr2;
    
	$x1=rand(0,255);
	$x2=rand(0,255);
	$inputip = '192.168.'.$x1.'.'.$x2;
	$inputcidr=rand(8,30);
	
	// for second address
	$x1=rand(0,255);
	$x2=rand(0,255);
	$inputip2 = '192.168.'.$x1.'.'.$x2;
	$inputcidr2=rand(8,30);
}

?>
