<?php
session_start();
$time = $_SERVER['REQUEST_TIME'];
$timeout_duration = 300;


function checkSessionExpire($time,$sname,$timeout_duration){
    $expire=false;
    if (!isset($_SESSION[$sname]) || (($time - $_SESSION[$sname]) > $timeout_duration) ){
        $expire=true;
    }
    $_SESSION[$sname] = $time;
    return $expire;
}

function clearSession(){
    if(!empty($_SESSION)){
        foreach( array_keys($_SESSION) as $key){
            unset($_SESSION[$key]);
        }
    }
}
?>