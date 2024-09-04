<?php
session_start();

// MySQL 연결 정보
$servername = "localhost";
$username = "root";
$password = "Yourpasswd1!";
$dbname = "scuhistory";

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // SQL 쿼리
    $sql = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 로그인 성공
        $_SESSION['username'] = $input_username;
        echo "로그인 성공! 환영합니다, " . $input_username;
    } else {
        // 로그인 실패
        echo "잘못된 사용자 이름 또는 비밀번호입니다.";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 페이지</title>
</head>
<body>
    <h2>로그인</h2>
    <form method="POST" action="">
        <label for="username">아이디:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">비밀번호:</label>
        <input type="password" name="password" id="password" required><br>
        <button type="submit">로그인</button>
    </form>
</body>
</html>
