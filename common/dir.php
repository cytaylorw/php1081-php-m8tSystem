<?php
    $contentDir = ['common', 'manage', 'report'];
    $dir = explode('/',str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']));
    unset($dir[(count($dir)-1)]);
    unset($dir[0]);

    function getRootR($contentDir,$dir){
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

    function getDirR($dir_name,$contentDir,$dir){
        if(in_array($dir_name,$dir)){
            return getRootR($contentDir,$dir).$dir_name."/";
        }else{
            echo $dir_name.' is not in the array of $contentDir.';
        }
    }

    function dirDepth($contentDir,$dir){
        $count=0;
        foreach($contentDir as $c){
            if(in_array($c,$dir)) $count++;
        }
        return $count;
    }
?>