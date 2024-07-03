<?php

class Controlador
{
    public function verPagina($ruta)
    {
        if (file_exists($ruta)) {
            require_once $ruta;
        } else {
            echo "El archivo no existe.";
        }
    }
    
}