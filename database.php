<?php

class DataBase {

    public $connection;
    public function __construct($config, $username = "root", $password = ""){
       
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        // $dsn  = "mysql:host={$config['host']};dbname={$config['dbname']};port={$config['port']};charset={$config['charset']}";
        $this->connection = new PDO($dsn, $username , $password ,[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    public function query($query,$params = []){
        $statment = $this->connection->prepare($query);
        $statment->execute($params);
        return $statment;
       
    }

    public function migrate() {
        // Create users table
        $this->connection->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");

        // Create posts table
        $this->connection->exec("CREATE TABLE IF NOT EXISTS posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=INNODB;");
    }
}

// Run migration if this file is accessed directly
if (php_sapi_name() === 'cli' || isset($_GET['migrate'])) {
    $config = require __DIR__ . '/config.php';
    $db = new DataBase($config['database']);
    $db->migrate();
    echo "Migration completed. Tables are set up.";
}