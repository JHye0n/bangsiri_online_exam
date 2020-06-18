<?php

require_once __DIR__ . '/../lib/userlib.php';

session_start();

$session = $_SESSION['name'];

$is_login = login_check($session);

if(!$is_login){
    die("<script>alert('로그인이 필요한 서비스 입니다.'); location.href='/index'; </script>");
}

if($is_login['is_admin'] != 'true'){
    die("<script>alert('접근 권한이 없습니다.'); location.href='/welcome'; </script>");
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
  <a class="navbar-brand" href="/welcome">B@ngsiri</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index">관리(홈)</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="config_user">관리(유저)</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="config_challenge">관리(문제)</a>
      </li>
    </ul>
  </div>
</nav><br>
<!-- page start -->
<center>
<div class="col-lg-8">
<div class="card">
        <div class="card-header"> # 어드민 대시보드 </div>
        <div class="card-body">
        <div class="col-lg-8">
        <?php $result = view_user(); ?>
        <table class="table table-striped-light">
            <thead>
                <tr>
                    <th> 이름 </th>
                    <th> 학번 </th>
                    <th> 선택 분야 </th>
                    <th> 가입일 </th>
                    <th> 계정 설정 </th>
                    <th> 
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_array($result)){?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['scnum'];?></td>
                    <?php if($row['category'] === 'lan_c') { ?>
                      <td> C언어 </td>
                    <?php } ?>
                    <?php if($row['category'] === 'lan_python') { ?>
                      <td> Python </td>
                    <?php } ?>
                    <td><?php echo $row['time'];?></td>
                    <td><a href="del_user?idx=<?php echo $row['idx'];?>"><button type="button" class="btn btn-danger btn-sm">삭제</button></a></td>
                </tr>
            </tbody>
        <?php } ?>
        </table>
        </div>
        </div>
</div><br>
<small class="form-text text-muted"> Copyright 2020 B@ngsiri Platform | Developer By stjhyeon@kakao.com </small>
</div>
</center>
</body>
</html>