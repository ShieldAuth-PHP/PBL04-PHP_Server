<?php
session_start();
require 'config.php';  // 데이터베이스 연결 설정

// 폼 제출 시 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // 비밀번호 해시화

    // 이메일 중복 확인
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $error_message = "이미 등록된 이메일입니다.";
    } 
  
    else {
        // 사용자 정보 삽입
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $password])) {
            echo "<script>
                alert('환영합니다! 회원가입이 완료되었습니다.');
                window.location.href = 'login.php';
            </script>";
            exit();
        } else {
            $error_message = "회원가입 실패. 다시 시도해주세요.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <title>Signup</title>
    <style>
       
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Signup</h2>

    <?php
    if (isset($error_message)) {
        echo "<p class='error'>$error_message</p>";
    }
    ?>

    <form action="signup.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Signup">
    </form>
</div>

</body>
</html>