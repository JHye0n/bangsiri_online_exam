<?php

require_once __DIR__ . '/dbconfig.php';

function signin($scnum, $password){
    global $db;
    $query = "SELECT * FROM `bangsiri_user` where `scnum` = ? AND `password` = ?";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 'is', $scnum, $password);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_array($result);
}

function signup($name, $scnum, $category, $password, $submit, $is_admin, $time){
    global $db;
    $query = "INSERT INTO `bangsiri_user` (`name`,`scnum`,`category`,`password`,`submit`,`is_admin`,`time`) VALUE (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 'sisssss', $name, $scnum, $category, hash('sha512',$password), $submit, $is_admin, $time);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    return $exec;
}

function login_check($session){
    global $db;
    $query = "SELECT * FROM `bangsiri_user` where `name` = ?";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 's', $session);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_array($result);
}

function findusername($name){
    global $db;
    $query = "SELECT name FROM `bangsiri_user` where `name` = ?";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 's', $name);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_array($result);
}

function findusernum($scnum){
    global $db;
    $query = "SELECT scnum FROM `bangsiri_user` where `scnum` = ?";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 'i', $scnum);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_array($result);
}

function updateuser($submit, $session){
    global $db;
    $query = "UPDATE `bangsiri_user` set `submit` = ? WHERE `name` = ?";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 'ss', $submit, $session);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    return $exec;
}

function view_user(){
    global $db;
    $query = "SELECT * FROM `bangsiri_user` order by `category` desc";
    $stmt = mysqli_prepare($db,$query);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

function add_challenge($title, $content, $category, $filename){
    global $db;
    $query = "INSERT INTO `bangsiri_challenge` (`title`,`content`,`category`,`filename`) VALUE (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 'ssss', $title, $content, $category, $filename);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    return $exec;
}

function del_user($idx){
    global $db;
    $query = "DELETE FROM `bangsiri_user` where `idx` = ?";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 'i', $idx);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    return $exec;
}

function del_challenge($idx){
    global $db;
    $query = "DELETE FROM `bangsiri_challenge` where `idx` = ?";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 'i', $idx);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    return $exec;
}

function view_challenge($select_category){
    global $db;
    $query = "SELECT * FROM `bangsiri_challenge` where `category`= 'all' OR `category`=trim('{$select_category}')";
    $result = mysqli_query($db,$query);
    return $result;
}

function all_challenge(){
    global $db;
    $query = "SELECT * FROM `bangsiri_challenge` order by `category` asc";
    $stmt = mysqli_prepare($db,$query);
    $exec = mysqli_stmt_execute($stmt);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

function time_check(){
    global $db;
    $query = "SELECT * FROM `bangsiri_time`";
    $result = mysqli_fetch_array(mysqli_query($db,$query));
    return $result;
}

function update_time($start_time, $end_time){
    global $db;
    $query = "UPDATE `bangsiri_time` set `start_time` = ? , `end_time` = ?";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt, 'ss', $start_time, $end_time);
    if($exec === false){
        die("<script>alert('오류가 발생하였습니다.'); location.href='/index'; </script>");
    }
    return $exec;
}
?>