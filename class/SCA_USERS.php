<?php
/**
 * Class SCA_USERS
 * @author Alejandro Sanchez[AP] (FKGG<3)
 * @Info Esta clase administra SCA_USERS
 *
 */

class SCA_USERS extends Core
{
public $ID;
public $EMP;
public $USER;
public $PASS;
public $USNAME;
public $LASTNAME;
public $TLF;
public $EMAIL;
public $LAST_LOGIN;
public $DEVICE;
public $IP_LASTLOGIN;
public $IS_EXIST=false;
    /**
     * SCA_USERS constructor.
     * @param $ID
     */
    public function __construct($ID)
    {
        $this->ID = $ID;
        $CON = $this->DETC_DB("SELECT * FROM SCA_USERS WHERE ID='$ID'");
        while ($fila = $CON->fetch(PDO::FETCH_ASSOC)) {
            $this->EMP=$fila['EMP'];
            $this->USER=$fila['USER'];
            $this->PASS=$fila['PASS'];
            $this->USNAME=$fila['USNAME'];
            $this->LASTNAME=$fila['LASTNAME'];
            $this->TLF=$fila['TLF'];
            $this->EMAIL=$fila['EMAIL'];
            $this->LAST_LOGIN=$fila['LAST_LOGIN'];
            $this->DEVICE=$fila['DEVICE'];
            $this->IP_LASTLOGIN=$fila['IP_LASTLOGIN'];
            $this->IS_EXIST=true;
        }
    }
    public function Save(){
        $Blindings=array(
            ":EMP"=>$this->EMP,
            ":USER"=>$this->USER,
            ":PASS"=>$this->PASS,
            ":USNAME"=>$this->USNAME,
            ":LASTNAME"=>$this->LASTNAME,
            ":TLF"=>$this->TLF,
            ":EMAIL"=>$this->EMAIL,
            ":LAST_LOGIN"=>$this->LAST_LOGIN
        );
        if ($this->IS_EXIST == true) {
            $SQL="UPDATE `SCA_USERS` SET `EMP`=:EMP,`USER`=:USER,`PASS`=:PASS,`USNAME`=:USNAME,`LASTNAME`=:LASTNAME,`TLF`=:TLF,`EMAIL`=:EMAIL,`LAST_LOGIN`=:LAST_LOGIN,`DEVICE`=:DEVICE,`IP_LASTLOGIN`=:IP_LASTLOGIN WHERE ID='$this->ID'";
        }else{
            $SQL="INSERT INTO `SCA_USERS`(`ID`, `EMP`, `USER`, `PASS`, `USNAME`, `LASTNAME`, `TLF`, `EMAIL`, `LAST_LOGIN`, `DEVICE`, `IP_LASTLOGIN`) VALUES (null,:EMP,:USER,:PASS,:USNAME,:LASTNAME,:TLF,:EMAIL,:LAST_LOGIN,:DEVICE,:IP_LASTLOGIN)";
        }
        $this->DETC_DB_BlindingDinamic($SQL, $Blindings);
    }
}
