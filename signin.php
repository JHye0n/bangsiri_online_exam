<?php

require_once __DIR__ . '/lib/userlib.php';

session_start();

$scnum = $_POST['scnum'];
$password = hash('sha512',$_POST['password']);

if($scnum == NULL || $password == NULL){
    die("<script>alert('빈칸을 입력해주세요.'); history.go(-1); </script>");
}

if(preg_match("/[^0-9]/", $scnum)){
    die("<script>alert('학번은 숫자만 입력할 수 있습니다.'); history.go(-1); </script>");
}

$result = signin($scnum, $password);

if(!$result){
    die("<script>alert('학번 또는 비밀번호가 올바르지 않습니다.'); history.go(-1); </script>");
}

$_SESSION['name'] = $result['name'];

echo "<script>alert('{$_SESSION[name]} 님 환영합니다.'); location.href='welcome'; </script>";

?>