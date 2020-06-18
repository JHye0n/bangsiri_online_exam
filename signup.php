<?php

require_once __DIR__ . '/lib/userlib.php';

$name = $_POST['name'];
$scnum = $_POST['scnum'];
$category = $_POST['category'];
$password = $_POST['password'];
$submit = "미제출";
$is_admin = "false";
$time = date('Y-m-d H:i:s');

if($name == NULL || $scnum == NULL || $category == NULL || $password == NULL){
    die("<script>alert('빈칸을 입력해주세요.'); history.go(-1); </script>");
}

if(preg_match("/[^0-9]/", $scnum)){
    die("<script>alert('학번은 숫자만 입력할 수 있습니다.'); history.go(-1); </script>");
}

if(findusername($name)){
    die("<script>alert('이미 가입된 사용자 입니다.'); history.go(-1); </script>");
}

if(findusernum($scnum)){
    die("<script>alert('이미 가입된 사용자 입니다.'); history.go(-1); </script>");
}

if(!signup($name, $scnum, $category, $password, $submit, $is_admin, $time)){
    die("<script>alert('회원가입에 오류가 발생하였습니다.'); history.go(-1); </script>");
}

echo "<script>alert('{$name} 님 회원가입에 성공하였습니다.'); location.href='index'; </script>";

?>