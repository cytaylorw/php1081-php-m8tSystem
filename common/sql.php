<?php
    function dbconnect($host="localhost", $user="root", $password="", $db="qdb")
    {
        $dsn="mysql:host=$host;charset=utf8;dbname=$db";
        $pdo= new PDO($dsn,$user,$password);
        return $pdo;
    }
    
    function filterTableSelect($col, $table, $where=null){
        $sql="SELECT ";
        if(is_array($col)){
            $lastKey=array_keys($col)[count($col)-1];
            foreach($col as $k => $c){
                $sql=$sql.$c;
                if($k !== $lastKey){
                    $sql=$sql.", ";
                }
            }
        }else{
            $sql=$sql.$col;
        }
        $sql=$sql." FROM ".$table;
        if(!empty($where)){
            $sql=$sql." WHERE ".$where;
        }
        return $sql;
    }
?>