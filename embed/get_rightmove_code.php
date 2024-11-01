<?php
$rmurl = "http://www.rightmove.co.uk/property-for-sale/search.html?searchLocation=".urlencode($_POST['p'])."&useLocationIdentifier=false&locationIdentifier=&buy=For+Sale";                
$resultPlain = file_get_contents($rmurl);                
$found = preg_match_all('/value="POSTCODE\^([0-9]*)"/', $resultPlain, $pieces);
$locationId = $pieces[1][0];
echo $locationId;