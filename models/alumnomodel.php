<?php
    //Incluyendo la referencia de nuestro modelo alumno
    include_once 'models/alumnos.php';
    class AlumnoModel extends Model{
        public function __construct(){
            parent::__construct();
        }

        //metodo que permitira ingresar un registro a la bd
        function insert($data){
           try{
                $query=$this->db->conn()->prepare("INSERT INTO ALUMNO (NOMBRE,APELLIDO,TELEFONO) VALUES (:nombre,:apellido,:telefono)");
                $query->execute(['nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono']]);
                return true;
           }catch(PDOException $e){
                return false;
           }
        }

        //metodo que permitira obtener registros de la bd
        function get(){
           $items=[];

           try{
                $query=$this->db->conn()->query("SELECT*FROM ALUMNO");
                while($row=$query->fetch()){
                    //creo objeto de la clase alumnos
                    $item=new Alumnos();

                    $item->id=$row['id_Alumno'];
                    $item->nombre=$row['nombre'];
                    $item->apellido=$row['apellido'];
                    $item->telefono=$row['telefono'];
                    array_push($items,$item);
                }
                return $items;
           }catch(PDOException $e){
                return [];
           }
        }
        //metodo delete
        function delete($id){
            $query=$this->db->conn()->prepare("DELETE FROM ALUMNO WHERE id_Alumno=:id");
            try{
                $query->execute(['id'=>$id]);
                return true;
            }catch (PDOException $e){
                return false;
            }
        }

        //detalle de un registro
        function getById($id){
            $item=new Alumnos();
            $query=$this->db->conn()->prepare('SELECT*FROM ALUMNO WHERE id_Alumno=:id');
            try{
                $query->execute(['id'=>$id]);
                while($row=$query->fetch()){
                    $item->id=$row['id_Alumno'];
                    $item->nombre=$row['nombre'];
                    $item->apellido=$row['apellido'];
                    $item->telefono=$row['telefono'];
                }
                return $item;
           }catch(PDOException $e){
                return [];
           }
        }


        //metodo update
        public function update($item){
            $query=$this->db->conn()->prepare('UPDATE ALUMNO SET nombre=:nombre,apellido=:apellido,telefono=:telefono WHERE id_Alumno=:id');
            try{
                $query->execute(['id'=>$item['id'],
                                 'nombre'=>$item['nombre'],
                                 'apellido'=>$item['apellido'],
                                 'telefono'=>$item['telefono']
                                 ]);
                return true;
           }catch(PDOException $e){
                return false;
           }
        }
    }
?>