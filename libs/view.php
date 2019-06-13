<?php
    class View{
        function render($nombre){
            require 'views/'.$nombre.'.php';
            ///por ej: si la variable $nombre =index se formaria la 
            //ubicacion  ------>>>>>>views/errores/index.php
        }
    }
?>