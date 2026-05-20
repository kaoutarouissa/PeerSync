<?php
class Connection{
public function connect(){
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="Peersync";
  

      try {
             $pdo = new PDO(
                "mysql:host=" . $servername . ";dbname=" . $dbname,
                $username,
                $password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
   
}
}
?>