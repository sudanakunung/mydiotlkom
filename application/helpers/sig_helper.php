<?php

function genSignature($anyString, $saltBase64) {

	if($saltBase64 == null){
		return null;
	}
	
    $byteSig = $anyString;
	$byteSalt = base64_decode($saltBase64);
	$result = array();
	$resultLen = 0;
	$sigLonger = false;
	$byteSaltLen = strlen($byteSalt);
	$byteSigLen = strlen($byteSig);

	//Create buffer for longest string
	if ($byteSigLen >= $byteSaltLen) {
	    $sigLonger = true;
	    $resultLen = $byteSigLen;
	} else {
	    $sigLonger = false;
	    $resultLen = $byteSaltLen;
	}

	$b1;
	$b2;
	$r;

	for ($i = 0; $i < $resultLen; $i++) {
	    if ($sigLonger) {
	        $b1 = $byteSig[$i];
	        $b2 = $byteSalt[$i % $byteSaltLen];
	    } else {
	        $b1 = $byteSig[$i % $byteSigLen];
	        $b2 = $byteSalt[$i];
	    }
	    $r = ($b1 ^ $b2);
	    $result[$i] = $r;
	}

	$res = trim(base64_encode(implode($result)));
	return $res;

	// if($saltBase64 == null){
	// 	return null;
	// }

	// $byteSig = $anyString;
	// $byteSalt = base64_decode($saltBase64);

	// $byteSig_lenght = strlen($byteSig);
	// $byteSalt_lenght = strlen($byteSalt);

	// $resultLen = 0;
	// $result = [];

	// if ($byteSig_lenght >= $byteSalt_lenght) {
	//     $sigLonger = true;
	//     $resultLen = $byteSig_lenght;
	// } else {
	//     $sigLonger = false;
	//     $resultLen = $byteSalt_lenght;
	// }

	// for ($i=0; $i < $resultLen; $i++) {
	// 	if ($sigLonger) {
	//         $b1 = $byteSig[$i];
	//         $b2 = $byteSalt[$i % $byteSalt_lenght];
	//     } else {
	//         $b1 = $byteSig[$i % $byteSig_lenght];
	//         $b2 = $byteSalt[$i];
	//     }

	//     $r = $b1 ^ $b2;

	//     $result[$i] = $r;
	// }

	// return base64_encode(trim(implode($result)));
}