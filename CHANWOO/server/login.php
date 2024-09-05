<?php
session_start();
require 'config.php';  // 데이터베이스 연결 설정

// 세션에서 실패 횟수 추적
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// 폼 제출 시 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 사용자 조회
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // 사용자 존재 여부 및 비밀번호 검증
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['login_attempts'] = 0;  // 로그인 성공 시 실패 횟수 초기화
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['login_attempts'] += 1;  // 실패 시 횟수 증가
        $error_message = "잘못된 이메일 또는 비밀번호입니다.";

        // 3회 실패 시 데이터베이스에 기록
        if ($_SESSION['login_attempts'] >= 3) {
            $stmt = $pdo->prepare("INSERT INTO login_failures (email, failed_at) VALUES (?, NOW())");
            $stmt->execute([$email]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
    <style>
       
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php
    if (isset($error_message)) {
        echo "<p class='error'>$error_message</p>";
    }
    ?>

    <!-- 로그인 폼 -->
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>

    <!-- 회원가입 링크 -->
    <div class="signup-link">
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</div>

</body>
</html>