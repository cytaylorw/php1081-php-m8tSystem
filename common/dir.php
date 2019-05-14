<?php
    $contentDir = ['common', 'manage', 'report','js','layout','account'];
    $dir = explode('/',str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']));
    $file = $dir[(count($dir)-1)];
    unset($dir[(count($dir)-1)]);
    unset($dir[0]);

    function getRootR(){
        global $contentDir,$dir;
        $depth=dirDepth($contentDir,$dir);
        if($depth == 0){
            return './';
        }else{
            $path='';
            do{
              $path=$path."../";
              $depth--; 
            }while($depth>0);
            return $path;
        }
    }

    function getDirR($dir_name){
        global $contentDir,$dir;
        if(in_array($dir_name,$dir)){
            return "./";
        }else{
            return getRootR($contentDir,$dir).$dir_name."/";            
        }
    }

    function dirDepth(){
        global $contentDir,$dir;
        $count=0;
        foreach($contentDir as $c){
            if(in_array($c,$dir)) $count++;
        }
        return $count;
    }
?>