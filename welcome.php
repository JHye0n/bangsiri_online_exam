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
      <li class="nav-item active">
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
        <div class="card-header"> # 동아리 시험 안내 </div>
        <div class="card-body">
        <div class="col-lg-6">
        <p> 시험 시작 (2020-06-18 18:00) </p>
        <p> 시험 종료 (2020-06-18 20:00) </p>
        <hr>
        <h6> # 시험 안내 및 규칙 </h6>
        <small> 시험 시작은 2020-06-18 12:00:00 PM 에 시작됩니다. <br>
        시험은 "본인"이 응시하셔야 하며, 대리시험 또는 풀이 공유 등의 부정행위를 금지합니다. <br>
        시험 응시는 시험 시작 이후 상단 메뉴(Exam) 에 접속하시면 문제 풀이가 가능합니다. <br>
        시험 비율은 (공통) 코딩 5문제 / (선택) C언어 / Python 각각 5문제 출제 됩니다. </small>
        <hr>
        <h6> # 코드 컴파일러 사용법 </h6>
        <small> 신입생 분들의 좀 더 편리한 시험 환경을 제공하기 위해, <br>
        사이트 내 자체 온라인 컴파일러 서비스를 제공합니다. <br>
        상단 메뉴(Debug) 에 접속하시면 컴파일 창이 표시되는데, <br>
        컴파일 환경(c, python 등) 을 선택 하시고 코드를 입력하신 뒤 <br>
        RUN 버튼을 누르면 코드 실행 결과가 표시됩니다. </small>
        <hr>
        <h6> # 제출 방법 </h6>
        <small> 시험 제출은 상단 메뉴(Submit) 에 접속하셔서, <br>
        파일을 업로드 하신 뒤, 제출 버튼을 눌러주시면 됩니다. <br>
        제출 양식(ex, 학번_이름.zip(압축파일 형식)) <br>
        ex(12345678_엄준식.zip) </small>
        <hr>
        </div>
        </div>
</div><br>
<small class="form-text text-muted"> Copyright 2020 B@ngsiri Platform | Developer By stjhyeon@kakao.com </small>
</div>
</center>
</body>
</html>