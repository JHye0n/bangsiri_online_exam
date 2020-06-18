<?php

require_once __DIR__ . '/lib/userlib.php';

session_start();

$session = $_SESSION['name'];

$is_login = login_check($session);

if(!$is_login){
  die("<script>alert('로그인이 필요한 서비스 입니다.'); location.href='index'; </script>");
}

$time = time_check();
$date = date('Y-m-d H:i:s');
$start_time = $time['start_time'];
$end_time = $time['end_time'];

if($start_time >= $date){
    die("<script>alert('시험 시작 시간이 아닙니다. 2020-06-18 18:00'); location.href='welcome'; </script>");
}

if($end_time <= $date){
    die("<script>alert('시험이 종료되었습니다.'); location.href='welcome'; </script>");
}

if($is_login['submit'] === '제출'){
    die("<script>alert('이미 시험을 제출 하셨습니다.'); location.href='welcome'; </script>");
}

?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
        <meta charset="utf-8">
        <title> B@ngsiri : 온라인 시험 플랫폼 </title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
        <!-- JS MODULE -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="welcome">B@ngsiri</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="welcome">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="debug">Debug</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="exam">Exam</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="submit">Submit</a>
      </li>
    </ul>
    <span class="navbar-text">
      <a href="user"><i class="fas fa-user-cog"></i></a>
    </span>
  </div>
</nav><br>
<!-- page start -->
<center>
<div class="col-lg-8">
<?php
$count = 0;
if($is_login['is_admin'] === 'true'){
  $result = all_challenge();
}else{
  $select_category = $is_login['category'];
  $result = view_challenge($select_category); 
}
while($row = mysqli_fetch_array($result)){?>
<div class="accordion">
  <div class="card">
    <div class="card-header" id="heading<?php echo $count;?>">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $count;?>" aria-expanded="true" aria-controls="collapse<?php echo $count;?>">
        <?php if($row['category'] === 'all'){?>
          <div class="card-header"> # 공통 문제(<?php echo $row['title'];?>) </div>
        <?php }else if($row['category'] === 'lan_c'){?>
          <div class="card-header"> # C언어 문제(<?php echo $row['title'];?>) </div>
        <?php }else if($row['category'] === 'lan_python'){?>
          <div class="card-header"> # Python 문제(<?php echo $row['title'];?>) </div>
        <?php } ?>
        </button>
      </h2>
    </div><br>
    <div id="collapse<?php echo $count;?>" class="collapse hide" aria-labelledby="heading<?php echo $count;?>">
      <div class="card-body">
        <p style="text-align:left;"><?php echo nl2br($row['content']); ?></p>
        <hr>
        <?php if($row['filename'] != 'NULL'){?>
          <img src="/uploads/<?php echo $row['filename'];?>" height="450">
        <?php } ?>
      </div>
    </div>
  </div>
<?php
$count += 1; } ?>
<small class="form-text text-muted"> Copyright 2020 B@ngsiri Platform | Developer By stjhyeon@kakao.com </small>
</center>
</div>
</body>
</html>