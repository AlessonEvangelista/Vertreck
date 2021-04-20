<?php

    namespace App\Models;

    abstract class Sql
    {
        public $conn;

        public function __construct()
        {
            session_start();
            $this->conn = new \PDO(DBDRIVE.':host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }

        public function validAction()
        {
            if( !$_SESSION['nome'] ) {
                $_SESSION['message'] = 'É necessário estar logado para realizar essa ação';
                return false;
            }
            if( $_SESSION['tipo'] !== "1" && $_SESSION['tipo'] !== "4" ) {
                $_SESSION['message'] = 'É necessário ser Administrador para realizar essa ação';
                return false;
            }

            return true;
        }
    }