<?php
    function dbconnect($host="localhost", $user="root", $password="", $db="qdb")
    {
        $dsn="mysql:host=$host;charset=utf8;dbname=$db";
        $pdo= new PDO($dsn,$user,$password);
        return $pdo;
    }
    
    function sqlSelect($col, $table, $where=null){
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
        return $sql.";";;
    }

    function whereEqual($col,$value){
        if(is_array($col)){
            $where=[];
            foreach($col as $key => $c){
                if(!empty($c)){
                    array_push($where,$c."='".$value[$key]."'");
                }
            }
            return implode($where," && ");
        }else{
            return $col."='".$value."'";
        }   
    } 

    function sqlInsert($table,$col,$value){
        $sql="INSERT INTO ".$table."(".implode($col,",").") VALUES (";
        $tmp=[];
        foreach ($value as $v){
            array_push($tmp,"'".$v."'");
        }
        return $sql.implode($tmp,",").");";
    }
?>