<?php
    class Errores extends Controller{
        function __construct(){
            parent::__construct();
            //$this->view->sms='Archivo no encontradfo :-( XD';
            $this->view->render('errores/index');
        }
    }
?>