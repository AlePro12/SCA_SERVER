<?php


class ErrorHandle
{
public $CodError;

public function __construct($codError){
    $this->CodError=$codError;
}


    public function ErrorHandler(){
        switch ($this->CodError){
            //Server
            case 01:
                return "Token Inexistente";
                break;
            case 02:
                return "Error Interno";
                break;
            case 03:
                return "No se pudo crear subdominio";
                break;

            //Login
            case 10:
                return "Parametros Invalidos";
                break;
            case 11:
                return "Usuario Invalido";
                break;
            case 12:
                return "Error Empresa Invalida";
                break;
            case 13:
                return "Acceso Denegado";
                break;
            case 14:
                return "Servidor no configurado";
                break;
            default:
                return "No definido";
                break;
        }
    }
}