<?php 

namespace App\DAO;

use PDO;

abstract class DAO extends PDO {
    protected static $conexion = null;

    public function __construct(/* string $dsn, string $username = null, string $password = null, array $options = null */){
            $dsn = 'mysql:host=' . $_ENV['db']['host'] . ';dbname=' . $_ENV['db']['database'];
            if(self::$conexion == null){
                self::$conexion = new PDO(
                    $dsn,
                    $_ENV['db']['user'],
                    $_ENV['db']['pass'],
                    [
                        PDO::ATTR_PERSISTENT => true, //permite que a conexão fique aberta.
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // coloca os erros em modo de exceção.
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4' //permite emojis no banco hehe
                    ]
                    );
            }
    }
}

?>