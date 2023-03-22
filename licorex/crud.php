<?php
require_once 'connection.php'; //llamada a la clase connection que pertenece a otro archivo
abstract class Crud extends Connection
{
    private $table;
    private $pdo;

    public function __construct($table) //metodo mágico y llamada a la tabla donde realizaremos el crud
    {
        $this->table=$table; //compartimos la tabla con toda la clase
        $this->pdo=parent::conexion(); //agregamos la conexion
    }
    public function getAll()  //obtener todos los registros de la tabla que especificamos
    {
        try{
        $stm=$this->pdo->prepare("SELECT * FROM $this->table");  //enviamos plantilla de la sentencia al servidor de la bd
        $stm->execute();    
        return $stm-> fetchAll(PDO::FETCH_OBJ); //obtenemos los datos que se obtienen de la consulta, recibimos un objeto
        }catch(PDOException $e){    //por si se produce un error en la consulta
            echo $e->getMessage();
        }
    }

    public function getById($id)  //obtener solo un dato en especifico, el id
    {
        try{
        $stm=$this->pdo->prepare("SELECT * FROM $this->table WHERE id=?");  
        $stm->execute(array($id));    
        return $stm-> fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $e){ 
            echo $e->getMessage();
        }
    }

    public function delete($id)  //para eliminar
    {
        try{
        $stm=$this->pdo->prepare("DELETE * FROM $this->table WHERE id=?");  
        $stm->execute(array($id));
        }catch(PDOException $e){ 
            echo $e->getMessage();
        }
    }
    //Como este es un CRUD general no podemos implementar Create y Update, ya que son pora datos en especifico, los obtendremos directamente en la clase
    abstract function create();
    abstract function update();

}
 
?>