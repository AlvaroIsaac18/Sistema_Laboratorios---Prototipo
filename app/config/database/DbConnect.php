<?php

    namespace App\config\database;

    abstract class DbConnect {

        
        private $localhost;   
        private $user;        
        private $password;    
        private $Database;    

    
        protected $con;

       
        public function __construct(){
            $this->localhost = "localhost";       
            $this->user = "root";                
            $this->password = "31574578.s";     // CAMBIAR EN SUS EQUIPOS
            $this->Database = "laboratorios";   // La base de datos debe llamarse "laboratorios" para evitar conflictos
        }

        protected function connect(){
            try{
              
                $this->con = new \PDO(
                    "mysql:host={$this->localhost};dbname={$this->Database}",
                    $this->user,
                    $this->password
                );

               
                $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

              

            }catch(\PDOException $e){
                
                die("Error de conexión: {$e->getMessage()}");
            }
        }
    }

?>