<?php
/**
 * Class Core
 * @author Alejandro Sanchez[AP] (FKGG<3)
 * @Info Clase Core de el servidor de scala mobile
 *
 */

class Core extends Conexion
{

    public $LastVersionAPP="1.0";

    /**
     * Core constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('America/Caracas');
    }

    public function MD5E($str){
      return  md5($str);
    }

    public function headers(){
     header('Content-Type: application/json; charset=utf-8');
     header('Access-Control-Allow-Origin: *');
     header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
     header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    }

    /**
     * @param $USER &Usuario
     * @param $PASS &Clave
     * @Info Esta Funcion verifica si las credenciales de acceso son correctas
     * @return String = 'NO' si no existe o el ID del usuario si existe
     */
    public function ValidateUser($USER, $PASS){
        $USER= strtoupper($USER);
        $PASS=$this->MD5E($PASS);
        $Exits = "NO";
        $CON = $this->DETC_DB_WithBlinding("SELECT * FROM SCA_USERS WHERE USER=:USER AND PASS=:PASS ");
        $CON->bindParam(':USER', $USER);
        $CON->bindParam(':PASS', $PASS);
        $CON->Execute();
        while ($fila = $CON->fetch(PDO::FETCH_ASSOC)) {
        $Exits = $fila['ID'];
        }
        return $Exits;
    }
    public function mysqltime(){
        $mysqltime = date ('Y-m-d H:i:s');
        return $mysqltime;
    }
    public function GetIdByToken($Token){
        $Exits = "NO";
        $Binding=array(
            ":Token"=>$Token
        );
        $CON = $this->DETC_DB_BlindingDinamic("SELECT * FROM SCA_EMP WHERE TOKEN=:Token  ",$Binding);
        while ($fila = $CON->fetch(PDO::FETCH_ASSOC)) {
            $Exits = $fila['ID'];
        }
        return $Exits;
    }
    public function GetParameterRESTGET($key){
        $Parametro=@$_GET[$key];
        if ($Parametro == ""){
            $Parametro = "Emply";
        }
        //Limpieza de datos
        $Parametro= $this->SanitizeStr($Parametro);
        return $Parametro;
    }
    public function SanitizeStr($str){
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }
    public function PrintJSON($arrayPrint){
        $JSON=json_encode($arrayPrint);
        echo $JSON;
    }

}