<?php
require_once "class/Conexion.php";
require_once "class/Core.php";
require_once "class/SCA_EMP.php";
require_once "dependecies/xmlapi.php";
require_once "class/DnsSubdominio.php";

$DB= new Conexion();

$FlagConnected=0;
$CON = $DB->DETC_DB("SELECT * FROM SCA_EMP ");
while ($fila = $CON->fetch(PDO::FETCH_ASSOC)) {
    $FlagConnected=1;
}

echo "Estado de la DB: ".    $FlagConnected;
/*
$DnsSub=new DnsSubdominio();

$DnsSub->EMPNAME="ABC";
$DnsSub->SetSubdomain();*/