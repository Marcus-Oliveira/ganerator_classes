<?php

$myfile = fopen("app_structure.json", "r") or die("Unable to open file!");
$decodedFile = json_decode(fread($myfile,filesize("app_structure.json")), true);
fclose($myfile);

echo "Structure<pre>";
var_dump($decodedFile["classes"]);
echo "</pre>";

?>