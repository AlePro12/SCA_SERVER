<?php
require_once "class/Conexion.php";
require_once "class/Core.php";
require_once "class/SCA_EMP.php";
require_once "class/SCA_USERS.php";
require_once "class/ErrorHandle.php";
require_once "class/ResponseClass.php";
require_once "class/DnsSubdominio.php";
$Core = new Core();
$ResponseClass=new ResponseClass();
$Core->headers();
//get vars
$TOKEN = $Core->GetParameterRESTGET("TOKEN");
$PUBLIC_IP = $Core->GetParameterRESTGET("PUBLIC_IP");
$PRIVATE_IP = $Core->GetParameterRESTGET("PRIVATE_IP");
$STATUS = $Core->GetParameterRESTGET("STATUS");
//end get
$IDEMP = $Core->GetIdByToken($TOKEN);
if ($IDEMP !== "NO"){
    $SCA_EMP=new SCA_EMP($IDEMP);
    $SCA_EMP->LAST_SEEN=$Core->mysqltime();
    if ($SCA_EMP->IF_EXIST!==False ){

    if ($SCA_EMP->PUBLIC_IP !== $PUBLIC_IP){
        $SCA_EMP->PUBLIC_IP = $PUBLIC_IP;
    }
    if ($SCA_EMP->PRIVATE_IP !== $PRIVATE_IP){
        $SCA_EMP->PRIVATE_IP = $PRIVATE_IP;
    }
    if ($SCA_EMP->URL == ""){
        $DnsSub=new DnsSubdominio();
        $DnsSub->EMPNAME=$Core->MD5E($SCA_EMP->EMPNAME);
        $DnsSub->domain=$Core->MD5E($SCA_EMP->EMPNAME).".scala-soft.com.ve";
        $DDNSReturn =$DnsSub->SetSubdomain();
        $DDNSReturn = json_decode($DDNSReturn);
        $DDNS_ID = $DDNSReturn->data->id;
        if ($DDNS_ID !== ""){
            $ResponseClass->SendResponse(array(
               "URL_Renew"=>"https://scala-soft.com.ve/cpanelwebcall/".$DDNS_ID,
                "URL"=>"https://".$Core->MD5E($SCA_EMP->EMPNAME).".scala-soft.com.ve",
                "DEBUG_INFO"=>$DDNS_ID
            ));
            $SCA_EMP->url_id=$DDNS_ID;
            $SCA_EMP->URL="https://".$Core->MD5E($SCA_EMP->EMPNAME).".scala-soft.com.ve";
            $SCA_EMP->Save();
        }else{
            $ResponseClass->SendError(03);
        }
    }else{
        $ResponseClass->SendResponse(array(
            "URL_Renew"=>"https://scala-soft.com.ve/cpanelwebcall/".$SCA_EMP->url_id,
            "URL"=>$SCA_EMP->URL
        ));
        $SCA_EMP->Save();
    }


    }else{
        $ResponseClass->SendError(02);
    }
}else{
    $ResponseClass->SendError(01);

}


