<?php

$getURL = $_GET["owlfile"];
$owlxml = '';


if (substr($getURL, 0, 7) == 'http://') {
	$owlxml = get_url_contents('http://' . substr($getURL, 7)); // return the owl doc
} elseif (substr($getURL, 0, 8) == 'https://') {
	$owlxml = get_url_contents('https://' . substr($getURL, 8)); // return the owl doc
}

echo $owlxml;



function get_url_contents($url){
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
}

?>