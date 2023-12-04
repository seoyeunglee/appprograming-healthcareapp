<?php
session_start();

// 데이터베이스 연결 정보
$servername = "localhost"; // 서버 주소
$username = "korea"; // 데이터베이스 사용자 이름
$password = "1234"; // 데이터베이스 비밀번호
$dbname = "test"; // 데이터베이스 이름

// POST로 전송된 데이터 받기
$loginId = $_POST['loginId'];
$loginPw = $_POST['loginPw'];

// 간단한 유효성 검사
if (empty($loginId) || empty($loginPw)) {
    echo 'fail'; // 아이디 또는 비밀번호가 입력되지 않은 경우
    exit();
}

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 쿼리 작성 및 실행
$sql = "SELECT * FROM signup WHERE id = '$loginId'";
$result = $conn->query($sql);

// 사용자가 존재하는지 확인
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($loginPw, $row['password'])) {
        $_SESSION['signup'] = $loginId;
        echo 'success'; // 로그인 성공
    } else {
        echo 'fail'; // 비밀번호 불일치
    }
} else {
    echo 'fail'; // 사용자가 존재하지 않음
}

// 데이터베이스 연결 종료
$conn->close();
?>
