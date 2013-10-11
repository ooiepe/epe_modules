<?php

$getURL = $_GET["owlfile"];
$owlxml = '';

if (substr($getURL, 0, 7) == 'http://') {
	$owlxml = file_get_contents('http://' . substr($getURL, 7)); // return the owl doc
} elseif (substr($getURL, 0, 8) == 'https://') {
	$owlxml = file_get_contents('https://' . substr($getURL, 8)); // return the owl doc
}

echo $owlxml;

?>