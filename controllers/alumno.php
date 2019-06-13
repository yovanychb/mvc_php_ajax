<?php
    class Alumno extends Controller{
        //metodo constructor
        function __construct(){
            parent::__construct();
            $this->view->alumnos=[];
            //$this->view->alumno="";
        }
        //metodo que muestra la interfaz inicial a la llamada del controlador
        function index(){
            $alumnos=$this->model->get();
            $this->view->alumnos=$alumnos;
            $this->view->render('alumno/index');
        }

        //metodo para nuevo registro
        function nuevo(){
            $this->view->render('alumno/nuevo');
        }

        //metodo que ingresara el registro
        function insert(){
           //Declarar variables para recibir los datos del formuario nuevo
           $nombre=$_POST['nombre']; 
           $apellido=$_POST['apellido'];
           $telefono=$_POST['telefono'];

           echo $this->model->insert(['nombre'=>$nombre,'apellido'=>$apellido,'telefono'=>$telefono]);
           //$this->index();
           
        }


        //metodo eliminar
        function delete($dato=null){
            $id=$dato[0];
            echo $this->model->delete($id);
            
        }

        //metodo para obtener un registro
        function getById($dato=null){
            $id=$dato[0];
            $alumno=$this->model->getById($id);
            session_start();
            $_SESSION['id_Alumno']=$alumno->id;
            echo json_encode($alumno);
        }

        /**
         * Metodo para actualizar
         */
        function update(){
            session_start();
            $id=$_SESSION['id_Alumno'];
            $nombre=$_POST['nombreU'];
            $apellido=$_POST['apellidoU'];
            $telefono=$_POST['telefonoU'];

            //Destruir la sesion
            unset($_SESSION['id_Alumno']);
            
            /**
             * Escribir "1" si se reslizo la accion en la base de datos
            */
            echo $this->model->update(['id'=>$id,'nombre'=>$nombre,'apellido'=>$apellido,'telefono'=>$telefono]);
           
        }

    }
?>