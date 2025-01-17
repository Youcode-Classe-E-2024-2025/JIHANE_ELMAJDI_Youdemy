<?php
class Database {
    private $host = 'localhost';  
    private $db_name = 'youdemy'; 
    private $username = 'root';   
    private $password = '';   
    private $conn;

    
    public function getConnection() {
        $this->conn = null;

        try {
          
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
         
            $this->conn = new PDO($dsn, $this->username, $this->password);
         
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie";
        } catch (PDOException $exception) {
            
            echo "Erreur de connexion à la base de données: " . $exception->getMessage();
        }

        return $this->conn;
    }
  
}

?>
