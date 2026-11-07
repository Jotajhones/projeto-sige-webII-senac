<?php

class Conexao {
    private static $instancia;

    public static function getConexao() {
        if (!isset(self::$instancia)) {
            $host = 'localhost';
            $dbname = 'sige_db';
            $usuario = 'root';
            $senha = ''; 

            self::$instancia = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);

            self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instancia;
    }
}