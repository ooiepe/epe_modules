<?php
$owlxml = file_get_contents($_GET["owlfile"]); // return the owl doc
echo $owlxml;
?>