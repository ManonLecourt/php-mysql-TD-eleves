<?php

function calculer () {
  // inputs
   global $inputip, $maskbis, $inputip2, $inputcidr, $inputcidr2;
   
   // outputs
   global $subnetaddress, $starthost, $broadcastaddress, $endhost, $numofhosts,$samenetwork, $subsizebits, $hostsizebits, $CIDR;
    
    $x = __;
    $y = __;
	$inputmask=__;
	
	if (__) {
		$inputmask=__;
		$sminput='';

		$inputmask2=__;
	}
    
	if (checkInput($inputip)==false || checkInput($inputmask)==false) {
        $starthost="ERROR";
		return false;
	}
    

	$ip = __  
	$ip2 = __

	$masque = __
	$masque2 = __
    
	$mask = __
	$mask2 = __

	$CIDR = 0;
	$m = __;
	if (__ == 4) {
        for ($i = 0; $i < 32; $i++) {
            if (($m & 0x01) == 0x00) $CIDR++;
            else break;
            $m = $m >> 1;
        }
    }
       
	$IP = __
    $IP2=0; // second address : in case it is void or wrong
	if (sizeof($ip2)==4) $IP2 = __


	// network address
	___
    
    __
	__
    
    __

	// network address 2
	___
	
	// first address
	___

	// boroadcast address
	___

	// last address
	___

	// hosts number
	___

	// address included ?
	___
}    

function toIP($data) {
	$ret = ($data >> 24 & 0xFF).".".($data >> 16 & 0xFF).".".($data >> 8 & 0xFF).".".($data & 0xFF);
	___;
}

function checkInput($ipp) {
	__
	__
	__
	for (_____) {
		if (strpos($expectedChars, $ipp[$i]) == -1) break;
		if ($ipp[$i] == '.') $dot++;
	}
    $noip =($dot == 3) && ($i == strlen($ipp));
	return $noip;
}

function randomIP() {
    global $inputip, $inputcidr, $inputip2, $inputcidr2;
    
	$x1=__
	$x2=__
	$inputip =___ 
	$inputcidr=____
	
	//for second address
	$x1=___
	$x2=___
	$inputip2 =___ 
	$inputcidr2=___
}

?>
