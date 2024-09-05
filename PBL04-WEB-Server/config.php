<?php
$host = '127.0.0.1';  // MySQL 서버 주소
$db = 'scuhistory';    // 데이터베이스 이름
$user = 'root';       // MySQL 사용자
$pass = ''; // MySQL 비밀번호
$charset = 'utf8mb4'; // 문자 인코딩 설정

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);  // 데이터베이스 연결 생성
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());  // 예외 처리
}
?>
