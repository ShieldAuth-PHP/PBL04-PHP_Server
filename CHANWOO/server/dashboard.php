<?php
// 세션 시작
session_start();

// 로그인하지 않은 사용자는 접근할 수 없도록 설정
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// 데이터베이스 연결 파일 포함
require 'config.php';

?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>3조 - 보안의 역사 / PBL4 - 간단한 로그인 기능이 포함된 PHP 페이지 작성</title>
        <link rel="stylesheet" href="css/dashboard.css">
        <!--멀티타이핑 JS 파일 연동-->
    </head>
<body>
    <div class= "mainbox">
        <p class="title">3조 - 보안의 역사 / PBL4 - 간단한 로그인 기능이 포함된 PHP 페이지 작성</p>
            <div class="container">
                <span class="text sec-text"></span>
            </div>
            <br>
                <script type="text/javascript" src="js/typing.js"></script>

            <hr class="linestyle">
            <?php
    echo "로그인 성공! 환영합니다. 
    <h1 style='font-size:48px; color:#D2B48C;'>".$_SESSION['username']."님"."</h1>";
    echo "<h1 style='font-size:48px; color:#00FFFF;'>".$_SESSION['username']."님"."</h1>";
    echo "<h1 style='font-size:48px; color:#800080;'>".$_SESSION['username']."님"."</h1>";
?>

        <div class="centerDiv">
           <a href="logout.php" class="logoutBtn">로그아웃</a> 
        </div>
</body>
</html>