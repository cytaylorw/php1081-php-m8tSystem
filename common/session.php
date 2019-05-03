<?php
session_start();
$time = $_SERVER['REQUEST_TIME'];

function checkEmployeeExpire($time){
    return checkSessionExpire($time,'EMPLOYEE_LAST_QUERY',300);
}


function checkSessionExpire($time,$sname,$timeout_duration){
    $expire=false;
    if (!isset($_SESSION[$sname]) || ($time - $_SESSION[$sname]) > $timeout_duration) {
        $expire=true;
    }
    $_SESSION[$sname] = $time;
    return $expire;
}
?>