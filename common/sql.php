<?php
    function dbconnect($host="localhost", $user="root", $password="", $db="qdb")
    {
        $dsn="mysql:host=$host;charset=utf8;dbname=$db";
        $pdo= new PDO($dsn,$user,$password);
        return $pdo;
    }
    
?>