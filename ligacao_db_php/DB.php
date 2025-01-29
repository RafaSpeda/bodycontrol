<?php 

class DB { 
    private $driver = "mysql",
     $host = "localhost",
     $user = "root",
    $senha = "",
    $db = "MercadoDB",
    $obj ;

    /**
     * Método que faz a conexão
     * 
     * @return objeto PDO conexão PDO
     */

    private function conectar(){

        try {
            $con = new \PDO("{$this->driver}:host={$this->host};dbname={$this->db}",
            "{$this->user}",
            "{$this->senha}");
            $con->exec("SET NAMES utf8");

            return $con;
        
        } catch(PDOException $e){
            exit();
        }

        
    }
/**
 * Faz a consulta
 * 
 * @param String $sql
 * @return Objeto
 */
    public function executeSQL($sql, array $params = null){

        var_dump($params);
        $this->obj = $this->conectar()->prepare($sql);

        if ($params != null){
            foreach ($params as $key => $value){;
            $this->obj->bindValue($key,$value);
            }
        }

        return $this->obj->execute();
    }

    /**
     * Lista os dados retornados
     * 
     * @return array com dados da consulta
     */
    public function listData(){
        return $this->obj->fetchAll();
    }

}
?>