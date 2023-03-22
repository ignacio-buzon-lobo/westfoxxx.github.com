<?php
require_once 'crud.php';
class Usuario extends crud
{
    private $usuario_id;
    private $nombre;
    private $email;
    private $password;
    private $fecha_creacion;
    const TABLE='usuarios';
    private $pdo;
    public function __construct()
    {
        parent::__construct(self::TABLE);
        $this->pdo=parent::conexion();
    }

    public function __set($name,$value){    //agregar un dato
        $this->$name=$value;
    }
    public function __get($name){    //obtener un dato
        return $this->$name;
    }

    public function create(){
        try{
        $stm=$this->pdo->prepare("INSERT INTO ".self::TABLE." (nombre, email, password) VALUES (?,?,?)");
        $stm->execute(array($this->nombre,$this->email,$this->password));
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function update(){
        try{
        $stm=$this->pdo->prepare("UPDATE ".self::TABLE." SET nombre=?, email=?, password=? WHERE usuario_id=?");
        $stm->execute(array($this->nombre,$this->email,$this->password,$this->usuario_id));  
        }catch(PDOException $e){   
            echo $e->getMessage();
        } 
    }

}


?>