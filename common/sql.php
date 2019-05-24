<?php
    class sql{

        public $pdo;
        public $table;
        public $action;
        public $selects = array();
        public $inserts = array();
        public $updates = array();
        public $wheres = array();
        public $groups = array();
        public $orders = array();
        public $sql;

        function __construct($table=null) {
            $this->table = $table;
        }

        public function dbconnect($db="qdb",$host="localhost",$port=null, $user="root", $password=""){
            if(isset($_COOKIE["dbconfig"])){
                $dbconfig=unserialize($_COOKIE["dbconfig"]);
                if(isset($dbconfig["dbhost"])){
                    $host=$dbconfig["dbhost"];
                }
                if(isset($dbconfig["dbport"])){
                    $port=$dbconfig["dbport"];
                }
                if(isset($dbconfig["dbuser"])){
                    $user=$dbconfig["dbuser"];
                }
                if(isset($dbconfig["dbpassword"])){
                    $password=$dbconfig["dbpassword"];
                }
                if(isset($dbconfig["dbname"])){
                    $db=$dbconfig["dbname"];
                }
            }
            if(empty($port)){
                $dsn="mysql:host=$host;charset=utf8;dbname=$db";
            }else{
                $dsn="mysql:host=$host;port=$port;charset=utf8;dbname=$db";
            }
            try{
                $this->pdo= new PDO($dsn,$user,$password);
                return $this;
            }catch(PDOException $e){
                return false;
            }
            
        }

        public function buildSelect(){
            if(isset($this->selects)){
                $this->sql="SELECT ".implode(",",$this->selects)." FROM ".$this->table;
                return $this;
            }else{
                return false;
            }
        }

        public function buildWhere($condition="equal",$operator=null){
            if(isset($this->sql)){
                if(isset($this->wheres)){
                    if((trim($condition) == "=") || (strtolower($condition) == "equal")){
                        foreach($this->wheres as $key => $value){
                            if(!empty($value))$where[]=$key."='".$value."'";
                        }
                    }else if((strtolower($condition) == "like")){
                        foreach($this->wheres as $key => $value){
                            if(!empty($value))$where[]=$key." LIKE '%".$value."%'";
                        }
                    }
                    if(empty($operator)){
                        $this->sql=$this->sql." WHERE ".$where[0];
                    }else{
                        $this->sql=$this->sql." WHERE ".implode(" ".strtoupper(trim($operator))." ",$where);
                    }
                    return $this;                
                }else{
                    return false;
                }
            }
        }

        public function buildGroupBy(){

            if(isset($this->groups) && isset($this->sql)){
                $this->sql=$this->sql." GROUP BY ".implode(",",$this->groups);
                return $this;
            }else{
                return false;
            }

        }

        public function buildOrderBy(){
            if(isset($this->orders) && isset($this->sql)){
                $this->sql=$this->sql." ORDER BY ".implode(",",$this->orders);
                return $this;
            }else{
                return false;
            }
        }

        public function buildInsert(){
            if(isset($this->inserts)){
                $this->sql="INSERT INTO ".$this->table."(".implode(array_keys($this->inserts),",").
                    ") VALUES ('".implode(array_values($this->inserts),"','")."')";
                return $this;
            }else{
                return false;
            }
        }

        public function buildUpdate(){
            if(isset($this->updates)){
                foreach($this->updates as $key => $value){
                    $set[]=$key."='".$value."'";
                }
                $this->sql="UPDATE ".$this->table." SET ".implode(", ",$set);
                return $this;
            }else{
                return false;
            }
        }

        public function buildDelete(){
            $this->sql="DELETE FROM ".$this->table;
            return $this;
        }

        public function query(){
            return $this->pdo->query($this->sql);
        }
    }

    function dbconnect($host="localhost", $user="root", $password="", $db="qdb")
    {
        $dsn="mysql:host=$host;charset=utf8;dbname=$db";
        $pdo= new PDO($dsn,$user,$password);
        return $pdo;
    }

    function sqlArray($col,$value,$old=null){
        $array=[];
        if(is_array($col)){
            foreach($col as $key => $c){
                if(!empty($value[$key])){
                    if(empty($old) || $value[$key]!=$old[$c]){
                        $array[$c]=$value[$key];
                    }
                }
            }
            
        }else{
            $array[$col]=$value;
        }  
        return $array; 
    }

    function testPDO($value){
        $sql= new sql("user");
        if(!empty($value["dbname"])){
            $db=$value["dbname"];
        }else{
            $db="qdb";
        }
        if(!empty($value["dbport"])){
            $port=$value["dbport"];
        }else{
            $port=null;
        }
        if(!empty($value["dbhost"])){
            $host=$value["dbhost"];
        }else{
            $host="localhost";
        }
        if(!empty($value["dbuser"])){
            $user=$value["dbuser"];
        }else{
            $user="root";
        }
        if(!empty($value["dbpassword"])){
            $password=$value["dbpassword"];
        }else{
            $password="";
        }
        return ($sql->dbconnect($db,$host,$port,$user,$password))?true:false;
    }
?>