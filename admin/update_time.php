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

$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

if($start_time == NULL || $end_time == NULL){
    die("<script>alert('날짜 데이터를 불러오는 중 오류가 발생하였습니다.'); history.go(-1); </script>");
}

if(!preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2})\:([0-9]{2})\:([0-9]{2})$/", $start_time)){
    die("<script>alert('날짜 형식이 올바르지 않습니다(2020-12-31 00:00:00)'); history.go(-1); </script>");
}

if(!preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2})\:([0-9]{2})\:([0-9]{2})$/", $end_time)){
    die("<script>alert('날짜 형식이 올바르지 않습니다(2020-12-31 00:00:00)'); history.go(-1); </script>");
}

if(!update_time($start_time, $end_time)){
    die("<script>alert('날짜 데이터 업데이트에 오류가 발생하였습니다.'); history.go(-1); </script>");
}

echo "<script>alert('날짜 설정이 완료 되었습니다.'); history.go(-1); </script>";

?>