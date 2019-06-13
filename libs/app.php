<?php
//Referencias
require_once 'controllers/errores.php';
class App
{
    //metodo constructor
    function __construct()
    {
        //Obtener la url
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        //Quitar un caracter innecesario
        $url = rtrim($url, "/");
        //dividir cada parametro a partir del separador /
        $url = explode('/', $url);

        //validar que en el indice 0 de la url exista un controlador
        if (empty($url[0])) {
            $archivoController = 'controllers/main.php';
            require_once $archivoController;
            $controller = new Main();
            //el modelo main
            $controller->loadModel('main');
            $controller->index();
            return false;
        }

        /**
         * Acceder a la api
         */
        if ($url[0] == "api") {
            if (isset($url[1])) {
                if (file_exists('api/' . ucwords($url[1]) . '.php')) {
                    $this->api = ucwords($url[1]);
                    unset($url[1]);
                    require_once 'api/applicationConfig.php';
                    $this->controller2 = 'ApplicationConfig';
                    $this->controller2 = new $this->controller2;
                    $this->controller2->getModelo($this->api);
                    require_once 'api/' . $this->api . '.php';
                }
            }

            //bloque para las demas funciones
        } else {

            //var_dump($url);
            $archivoController = 'controllers/' . $url[0] . '.php';

            //Validando que el controlador ingresado pertenesca a un archivo 
            //de nuestros controladores
            if (file_exists($archivoController)) {
                //controllers/x.php
                //Referencia de la ubicacion del archivo
                require_once $archivoController;
                /*Objeto de la clase del controlador recibido*/
                $controller = new $url[0];
                $controller->loadModel($url[0]);

                //obteniendo la cantidad de parametros de la url en el indice 2 
                //------->>>>url/controlador/metodos/parametros

                $nparam = sizeof($url);
                if ($nparam > 1) {
                    if ($nparam > 2) {
                        $param = [];
                        for ($i = 2; $i < $nparam; $i++) {
                            array_push($param, $url[$i]);
                        }
                        //llamando el metodo recibido con sus parametros
                        $controller->{$url[1]}($param);
                    } else {
                        //llamando el metodo recibido
                        $controller->{$url[1]}();
                    }
                } else {
                    $controller->index();
                }
            } else {
                //La instancia sera del controlador errores
                $controller = new Errores();
            }
        }
    }
}
