<?php 
    class Registre{
        private static $dbHost = "localhost";
        private static $dbUser = "root";
        private static $dbName = "jiramaCodeBase";
        private static $dbPassword = "";
        private static $connexion = null;

        public static function connect(){
            try{
                self::$connexion = new PDO("mysql:host=" . self::$dbHost. "; dbname=".self::$dbName, self::$dbUser, self::$dbPassword);
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
    
            return self::$connexion;
        }

        public static function disconnect(){
            self::$connexion == null;
        }
    }
?>