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

$title = htmlspecialchars($_POST['title'],ENT_QUOTES);
$content = htmlspecialchars($_POST['content'], ENT_QUOTES);
$category = $_POST['category'];
$file = $_FILES['file'];
$filename = $file['name'];
$tmp_filename = $file['tmp_name'];

if(!isset($title) || !isset($content) || !isset($category) || !isset($file)){
    die("<script>alert('데이터를 불러오는 중 오류가 발생하였습니다.); history.go(-1); </script>");
}

if($filename != NULL){

    $type_extension = end(explode('.', strtolower($filename)));

    if($type_extension != 'jpg' && $type_extension != 'png' && $type_extension != 'gif'){
        die("<script>alert('허용된 업로드 확장자가 아닙니다.'); history.go(-1); </script>");
    }
    
    $upload_dir = "../uploads/" . $filename;
    
    move_uploaded_file($tmp_filename, $upload_dir);
    
    if(!add_challenge($title, $content, $category, $filename)){
        die("<script>alert('문제 저장에 오류가 발생하였습니다.'); history.go(-1); </script>");
    }
        
    echo "<script>alert('문제 저장에 성공하였습니다.'); location.href='config_challenge'; </script>";

}else{

$filename = "NULL";

if(!add_challenge($title, $content, $category, $filename)){
    die("<script>alert('문제 저장에 오류가 발생하였습니다.'); history.go(-1); </script>");
}
    
echo "<script>alert('문제 저장에 성공하였습니다.'); location.href='config_challenge'; </script>";

}

?>