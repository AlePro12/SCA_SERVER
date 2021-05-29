<?php
/**
 * Class Conexion
 * @author Alejandro Sanchez[AP] (FKGG<3) & DETCSOFT
 * @Info Esta clase establece conexion con la base de datos
 *
 * @Nota: Algunas funciones son heredadas de una clase padre llamada ConexionDetc.
 */

class Conexion
{

    public $DBNAME = "SCALA_SERVER";
    public $DBUSER = "SCALASERVER";
    public $DBPASS = 'R}a$B6YyE%S2';
    public $DBHOST = "localhost";
    public $DBC;

    public function __construct()
    {
        $this->DB_Connect();
    }
    public function DB_Connect()
    {
        try {
            $dsn = "mysql:host=$this->DBHOST;dbname=$this->DBNAME";
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $dbh = new PDO($dsn, $this->DBUSER, $this->DBPASS);
        } catch (PDOException $e) {
         //   echo $e;
        }
        // Con un el método PDO::setAttribute
        try {
            $dsn = "mysql:host=$this->DBHOST;dbname=$this->DBNAME";
            $dbh = new PDO($dsn, $this->DBUSER, $this->DBPASS);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
           // echo $e;

        }
        $this->DBC =  $dbh;
        return $dbh;
    }
    public function DETC_DB($SQL){
        if ($this->DBC == ""){
            $this->DB_Connect();
        }
        $stmtus = $this->DBC->prepare($SQL);
        $stmtus->Execute();
        return $stmtus;
    }
    public function DETC_DB_WithBlinding($SQL){
        if ($this->DBC == ""){
            $this->DB_Connect();
        }
        $stmtus = $this->DBC->prepare($SQL);
        return $stmtus;
    }
    public function DETC_DB_BlindingDinamic($SQL,$Blindings){
        if ($this->DBC == ""){
            $this->DB_Connect();
        }
        $i=0;
        $PRINTBIND="";
        $stmtus = $this->DBC->prepare($SQL);
        foreach ($Blindings as $blindKey=>$blind){
            //echo $blindKey ."=>".$blind;
            $stmtus->bindParam($blindKey,$blind);
         //   $VAR_TMPD='$blind'.$i;
          //  echo $$VAR_TMPD;
          //  $$VAR_TMPD=$blind;
           // $PRINTBIND.= '$stmtus->bindParam("'.$blindKey.'",'.$$VAR_TMPD.');';
          //  echo $PRINTBIND;

            $i++;
        }
        //eval($PRINTBIND);
        $stmtus->Execute();
        return $stmtus;
    }
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->DBC =  null;

    }
}