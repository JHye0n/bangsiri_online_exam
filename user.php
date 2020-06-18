<?php

require_once __DIR__ . '/lib/userlib.php';

session_start();

$session = $_SESSION['name'];

$is_login = login_check($session);

if(!$is_login){
  die("<script>alert('로그인이 필요한 서비스 입니다.'); location.href='index'; </script>");
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
      <li class="nav-item">
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
<div class="card">
        <div class="card-header"> # 내 정보 </div>
        <div class="card-body">
        <div class="col-lg-6">
        <table class="table table-striped-light">
            <thead>
                <tr>
                    <th> 이름 </th>
                    <th> 학번 </th>
                    <th> 선택 분야 </th>
                    <th> 제출 여부 </th>
                </tr>
            </thead>
            <tbody>
                    <td><?php echo $is_login['name'];?></td>
                    <td><?php echo $is_login['scnum'];?></td>
                    <?php if($is_login['category'] === 'lan_c') { ?>
                      <td> C언어 </td>
                    <?php } ?>
                    <?php if($is_login['category'] === 'lan_python') { ?>
                      <td> Python </td>
                    <?php } ?>
                    <td><?php echo $is_login['submit'];?></td>
            </tbody>
        </table><br>
        <a href="logout">로그아웃</a>
        </div>
        </div>
</div><br>
<small class="form-text text-muted"> Copyright 2020 B@ngsiri Platform | Developer By stjhyeon@kakao.com </small>
</div>
</center>
</body>
</html>