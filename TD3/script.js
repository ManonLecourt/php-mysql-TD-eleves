// const calculer = document.querySelector("input[type=button]");

// calculer.addEventListener('click', calcIP);

// form = document.querySelector("form");


function toIP(data) {
	var str = (data >> 24 & 0xFF).toString() + "." +
		(data >> 16 & 0xFF).toString() + "." + (data >> 8 & 0xFF).toString() + "." + (data & 0xFF).toString();

	return str;
}


function randomIP(form) {
	
	let x1=Math.floor(Math.random() * Math.floor(256));
	let x2=Math.floor(Math.random() * Math.floor(256));
	var iprandom = "192.168."+x1+"."+x2;
	form.ipinput.value = iprandom;
	var randomcidr=Math.floor(Math.random() * (31 - 8) + 8);
	form.cidrinput.value = randomcidr;

	// for second address
	x1=Math.floor(Math.random() * Math.floor(256));
	x2=Math.floor(Math.random() * Math.floor(256));
	iprandom = "192.168."+x1+"."+x2;
	form.ipinput2.value = iprandom;
	randomcidr=Math.floor(Math.random() * (31 - 8) + 8);
	form.cidrinput2.value = randomcidr;

	return true;
}


function calcIP(form) {

	const inputip = (form.ipinput.value);
	const maskbis = (form.sminput.value);
	const inputip2 = (form.ipinput2.value);
	const inputcidr= (form.cidrinput.value);
	const inputcidr2= (form.cidrinput2.value);
	var inputmask2="";

	var x = 32-parseInt(inputcidr);
	var y = 32-parseInt(inputcidr2);
	var inputmask=maskbis;
	console.log(inputmask);

	if (x >= 1 && x <=24) {

		inputmask=toIP(0xFFFFFFFF << x);
		form.sminput.value="";

		inputmask2=toIP(0xFFFFFFFF << y);
			
		// console.log(inputmask);
	}
	
	// console.log(inputmask);

	if (checkInput(inputip)==false || checkInput(inputmask)==false) {
		alert("Input Error\nInput example:\n192.168.10.10 for ip\n255.255.255.0 for the mask \nTry again");
			return false;
		}

	var ip = inputip.split('.');
	var ip2 = inputip2.split('.');

	var masque = inputmask.split('.');
	var masque2 = inputmask2.split('.');
	
	var mask = parseInt(masque[0]) << 24 | parseInt(masque[1]) << 16 | parseInt(masque[2]) << 8 | parseInt(masque[3]);
	var mask2 = parseInt(masque2[0]) << 24 | parseInt(masque2[1]) << 16 | parseInt(masque2[2]) << 8 | parseInt(masque2[3]);

	var CIDR = 0;
	var m = mask;
	if (masque.length == 4) for (i = 0; i < 32; i++) {
		if ((m & 0x01) == 0x00) CIDR++;
		else break;
		m = m >> 1;
	}

	var IP = parseInt(ip[0]) << 24 | parseInt(ip[1]) << 16 | parseInt(ip[2]) << 8 | parseInt(ip[3]);
	var IP2 = parseInt(ip2[0]) << 24 | parseInt(ip2[1]) << 16 | parseInt(ip2[2]) << 8 | parseInt(ip2[3]);

	form.subsizebits.value = 32 - CIDR;
	form.hostsizebits.value = CIDR;

	// network address
	var adrN = IP & mask;
	form.subnetaddress.value = toIP(adrN);

	// network address 2
	var adrN2 = IP2 & mask2;
	console.log(toIP(adrN2), toIP(adrN));
	var sameAddress=(adrN==adrN2);

	// first address
	var adrFirst = adrN + 1;
	form.starthost.value = toIP(adrFirst);

	// boroadcast address
	var adrDiff = adrN | ~mask;
	form.broadcastaddress.value = toIP(adrDiff);

	// last address
	var adrLast = adrDiff - 1;
	form.endhost.value = toIP(adrLast);

	// hosts number
	var nb = Math.pow(2, CIDR) - 2;
	form.numofhosts.value = nb;

	// hosts number
	form.samenetwork.value = sameAddress?"oui":"non";
}

function checkInput(ipp) {
	var expectedChars = "0123456789.";
	var dot = 0;
	var i = 0;
	for (i = 0; i < ipp.length; i++) {
		if (expectedChars.indexOf(ipp.charAt(i)) === -1) break;
		if (ipp.charAt(i) == '.') dot++;
	}
	//console.log(dot, i);
	return (dot == 3) && (i == ipp.length);
}
