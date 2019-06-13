<?php
    //controlador padre
    class Controller{
        function __construct(){
            //Crear las vistas que pertenescan al controlador invocado
            $this->view=new View();   
        }

        function loadModel($model){
            //creando direccion del modelo
            $url='models/'.$model.'model.php';//models/alumnomodel.php
            //validando que el modelo exista
            if(file_exists($url)){
                //si axiste lo llamamos
                require $url;
                $modelName=$model.'Model';
                //instancia de la clase del modelo recibido
                $this->model=new $modelName;
            }
        }
    }

?>