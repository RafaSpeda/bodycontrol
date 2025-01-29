<?php 

class DB { 
    // Configurações com o DB
    private $driver = "mysql";
    private $host = "localhost";
    private $user = "root";
    private $senha = "";
    private $db = "academia";
    private $obj;

    //tenta conectar
    private function conectar(){
        try {
            $con = new PDO("{$this->driver}:host={$this->host};dbname={$this->db}",
                "{$this->user}",
                "{$this->senha}",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );

            return $con;
        
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    // Executa SQL
    public function executeSQL($sql, array $params = null){
        try {
            $this->obj = $this->conectar()->prepare($sql);

            if ($params != null){
                foreach ($params as $key => $value) {
                    $this->obj->bindValue($key, $value);
                }
            }

            return $this->obj->execute();
        } catch (PDOException $e) {
            die("Erro ao executar SQL: " . $e->getMessage());
        }
    }

    public function listData(){
        return $this->obj->fetchAll();
    }
}
?>
