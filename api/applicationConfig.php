<?php
/**
 * Clase controladora de los servicios 
 */
class ApplicationConfig extends Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET');
        header("Access-Control-Allow-Headers: X-Requested-With");
    }

    /**
     * Obtener el modelo
     */
    public function getModelo($modelo)
    {
        $this->modelo = $modelo;
        $this->loadModel($modelo);
        $this->loadData();
    }

    /**
     * Obtener los datos de la base e incluir el archivo en el que se muestran el json
     */
    public function loadData()
    {
        $datos = $this->model->get();
        include_once 'api/' . $this->modelo . '.php';
    }
}
