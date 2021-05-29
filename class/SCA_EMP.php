<?php
/**
 * Class SCA_EMP
 * @author Alejandro Sanchez[AP] (FKGG<3)
 * @Info Esta clase administra SCA_EMP
 *
 */

class SCA_EMP extends Core
{
public $ID;
public $RIF;
public $EMPNAME	;
public $TOKEN;
public $PUBLIC_IP;
public $PRIVATE_IP;
public $URL;
public $ACTIVE;
public $PrimaryUser;
public $IS_SUCURSAL_PRIMARY;
public $IS_SUCURSAL	;
public $ServiceQuery_Version;
public $LAST_SEEN;
public $url_id;
public $IF_EXIST=false;
    /**
     * SCA_EMP constructor.
     * @param $ID
     */
    public function __construct($ID)
    {
        $this->ID = $ID;
        $CON = $this->DETC_DB("SELECT * FROM SCA_EMP WHERE ID='$ID'");
        while ($fila = $CON->fetch(PDO::FETCH_ASSOC)) {
            $this->RIF=$fila['RIF'];
            $this->EMPNAME=$fila['EMPNAME']	;
            $this->TOKEN=$fila['TOKEN'];
            $this->PUBLIC_IP=$fila['PUBLIC_IP'];
            $this->PRIVATE_IP=$fila['PRIVATE_IP'];
            $this->URL=$fila['URL'];
            $this->ACTIVE=$fila['ACTIVE'];
            $this->PrimaryUser=$fila['PrimaryUser'];
            $this->IS_SUCURSAL_PRIMARY=$fila['IS_SUCURSAL_PRIMARY'];
            $this->IS_SUCURSAL	=$fila['IS_SUCURSAL'];
            $this->ServiceQuery_Version=$fila['ServiceQuery_Version'];
            $this->LAST_SEEN=$fila['LAST_SEEN'];
            $this->url_id=$fila['url_id'];
            $this->IF_EXIST=true;

        }

    }
    public function Save(){
        $Blindings=array(
            ":RIF"=>$this->RIF,
            ":EMPNAME"=>$this->EMPNAME,
            ":TOKEN"=>$this->TOKEN,
            ":PUBLIC_IP"=>$this->PUBLIC_IP,
            ":PRIVATE_IP"=>$this->PRIVATE_IP,
            ":URL"=>urlencode($this->URL),
            ":url_id"=>$this->url_id
        );
        if ($this->IF_EXIST == true) {
            $SQL="UPDATE `SCA_EMP` SET `RIF`=:RIF,`EMPNAME`=:EMPNAME,`TOKEN`=:TOKEN,`PUBLIC_IP`=:PUBLIC_IP,`PRIVATE_IP`=:PRIVATE_IP,`URL`=:URL,`PrimaryUser`='$this->PrimaryUser',`IS_SUCURSAL_PRIMARY`='$this->IS_SUCURSAL_PRIMARY',`IS_SUCURSAL`='$this->IS_SUCURSAL',`ServiceQuery_Version`='$this->ServiceQuery_Version',`LAST_SEEN`='$this->LAST_SEEN',`url_id`=:url_id WHERE ID='$this->ID'";
            $CON = $this->DETC_DB_WithBlinding($SQL);
            $CON->bindParam(':RIF', $this->RIF);
            $CON->bindParam(':EMPNAME', $this->EMPNAME);
            $CON->bindParam(':TOKEN', $this->TOKEN);
            $CON->bindParam(':PUBLIC_IP', $this->PUBLIC_IP);
            $CON->bindParam(':PRIVATE_IP', $this->PRIVATE_IP);
            $CON->bindParam(':URL', $this->URL);
            $CON->bindParam(':url_id', $this->url_id);
            $CON->Execute();

        }else{
            $SQL="";
        }
    }
}