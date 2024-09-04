<?php
session_start();

// MySQL 연결 정보
$servername = "localhost";
$username = "root"; // 개인이 설정한 MySQL 이름 입력
$password = "Lthoo369!@"; // 개인이 설정한 MySQL 비밀번호 입력
$dbname = "scuhistory";

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_email = $_POST['email'];
    $input_password = $_POST['password'];

    // SQL 쿼리
    $sql = "SELECT username FROM users WHERE email = '$input_email' AND password = '$input_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 로그인 성공
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        # echo "로그인 성공! 환영합니다, " . $_SESSION['username'];
    } else {
        // 로그인 실패
        echo "잘못된 이메일 또는 비밀번호입니다.";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>3조 - 보안의 역사 / PBL4 - 간단한 로그인 기능이 포함된 PHP 페이지 작성</title>
        <link rel="stylesheet" href="index.css">
        <!--멀티타이핑 JS 파일 연동-->
    </head>
<body>
    <div class = "mainbox">
        <p class="title">3조 - 보안의 역사 / PBL4 - 간단한 로그인 기능이 포함된 PHP 페이지 작성</p>
            <div class="container">
                <span class="text sec-text"></span>
            </div>
            <br>
                <script type="text/javascript" src="typing.js"></script>
            <form method="POST" action="">
                <label for="email">이메일:</label>
                <input type="email" name="email" id="email" required><br> <br>
                <label for="password">비밀번호:</label>
                <input type="password" name="password" id="password" required><br> <br>
                <button type="submit" class="loginbtn">로그인</button>
            </form>

            <hr class="linestyle">
            <?php
                echo "로그인 성공! 환영합니다, " . $_SESSION['username'];
            ?>
    </div>
</body>
</html>