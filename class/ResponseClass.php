<?php
/**
 * Class ResponseClass
 * @author Alejandro Sanchez[AP] (FKGG<3)
 * @Info Esta clase permite estruturar el archivo JSON del response
 *
 */

class ResponseClass extends Core
{
    public $Cadena;

    public function __construct()
    {
        $this->Cadena=array();
    }
    public function SendError($codError){
        $ErrorHandle=new ErrorHandle($codError);
        $this->Cadena = array(
            "Response" => $ErrorHandle->ErrorHandler(),
            "Error" => $codError,
            "Last_APP_Version" => $this->LastVersionAPP
        );
    }
    public function SendResponse($Res){
        $this->Cadena = array(
            "Response" => $Res,
            "Error" => 0,
            "Last_APP_Version" => $this->LastVersionAPP

        );
    }
    public function __destruct()
    {
        $this->PrintJSON($this->Cadena);
        // TODO: Implement __destruct() method.
    }

}