<?php

$valid_id = "minhyuk";
$valid_pw = "password1234";

// GET 요청으로 로그인 페이지 출력
if ($_SERVER["REQUEST_METHOD"] == "GET") {
?>
    <form action="login.php" method="POST">
        <label for="id">ID:</label><br>
        <input type="text" id="id" name="id"><br><br>
        <label for="pw">Password:</label><br>
        <input type="password" id="pw" name="pw"><br><br>
        <input type="submit" value="Login">
    </form>
<?php
}
// POST 요청 처리
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // POST 방식으로 전달된 ID와 PW를 변수에 저장
    $input_id = $_POST['id'];
    $input_pw = $_POST['pw'];

    // ID와 PW 확인
    if ($input_id == $valid_id && $input_pw == $valid_pw) {
        echo "<p style='color:green;'>로그인 성공!</p>";
        echo "ID: " . htmlspecialchars($input_id) . "<br>";
        echo "PW: " . htmlspecialchars($input_pw) . "<br>";
    } else {
        echo "<p style='color:red;'>로그인 실패. ID 또는 비밀번호가 잘못되었습니다.</p>";
        echo '<a href="login.php">다시 로그인</a>';
    }
}
?>