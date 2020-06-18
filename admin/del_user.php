<?php

session_start();

require_once __DIR__ . '/../lib/userlib.php';

$session = $_SESSION['name'];

$is_login = login_check($session);

if(!$is_login){
    die("<script>alert('로그인이 필요한 서비스 입니다.'); location.href='/index'; </script>");
}

if($is_login['is_admin'] != 'true'){
    die("<script>alert('접근 권한이 없습니다.'); location.href='/welcome'; </script>");
}

$idx = $_GET['idx'];

if(preg_match("/[^0-9]/i", $idx)){
    die("<script>alert('사용자 데이터를 불러오는 중 오류가 발생하였습니다.'); history.go(-1); </script>");
}

if($idx == NULL){
    die("<script>alert('사용자 데이터를 불러오는 중 오류가 발생하였습니다.'); history.go(-1); </script>");
}

if(!del_user($idx)){
    die("<script>alert('사용자 데이터를 삭제하는 중 오류가 발생하였습니다.'); history.go(-1); </script>");
}

echo "<script>alert('사용자 삭제가 완료되었습니다.'); location.href='config_user'; </script>";

?>