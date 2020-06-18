<?php
session_start();
session_unset();
die("<script>alert('로그아웃이 완료되었습니다.'); location.href='index'; </script>");
?>