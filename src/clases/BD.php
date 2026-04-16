<?php
class BD
    {
        private static ?PDO $connection = null;

        private static $host = '127.0.0.1';
        private static $db = 'agencia';
        private static $user = 'root';
        private static $pass = '';

        public static function getInstancia(): PDO
        {
            if (self::$connection === null) {
                try {
                    self::$connection = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db, self::$user, self::$pass);
                } catch (PDOException $e) {
                    die('Error de conexión: ' . $e->getMessage());
                }
            }

            return self::$connection;
        }
    }
?>