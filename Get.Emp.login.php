<?php

require_once "class/Conexion.php";
require_once "class/Core.php";
require_once "class/SCA_EMP.php";
require_once "class/SCA_USERS.php";
require_once "class/ErrorHandle.php";
require_once "class/ResponseClass.php";
$ResponseClass=new ResponseClass();
$Core = new Core();
$Core->headers();
//Variables Obtenidas por GET
$USER = $Core->GetParameterRESTGET("USER");
$PASS = $Core->GetParameterRESTGET("PASS");
//VAR END
if ($USER || $PASS !== "Emply") {
    $Validacion = $Core->ValidateUser($USER, $PASS);
    if ($Validacion !== "NO") {
        $SCA_USERS = new SCA_USERS($Validacion);
        $SCA_EMP = new SCA_EMP($SCA_USERS->EMP);
        if ($SCA_EMP->IF_EXIST == true) {
            if ($SCA_EMP->ACTIVE == 1) {
                if ($SCA_EMP->URL !== "") {
                    $SCA_USERS->LAST_LOGIN=$Core->mysqltime();
                    $ResponseClass->SendResponse(array(
                        "EMPNAME" => $SCA_EMP->EMPNAME,
                        "RIF" => $SCA_EMP->RIF,
                        "TOKEN" => $SCA_EMP->TOKEN,
                        "URL" => $SCA_EMP->URL,
                        "PUBLIC_IP" => $SCA_EMP->PUBLIC_IP,
                        "PRIVATE_IP" => $SCA_EMP->PRIVATE_IP,
                        "IS_SUCURSAL" => $SCA_EMP->IS_SUCURSAL,
                        "ServiceQuery_Version" => $SCA_EMP->ServiceQuery_Version,
                        "IS_SUCURSAL_PRIMARY" => $SCA_EMP->IS_SUCURSAL_PRIMARY
                    ));
                }else{
                    $ResponseClass->SendError(14);
                }
            } else {
                $ResponseClass->SendError(13);
            }
        } else {
         $ResponseClass->SendError(12);
        }
    } else {
        $ResponseClass->SendError(11);
    }
}else{
    $ResponseClass->SendError(10);
}