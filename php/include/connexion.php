<?php
require '/fonctions.php';
$bd = connexionPDO();
$categories = recuperation($bd,'*','categories');
?>