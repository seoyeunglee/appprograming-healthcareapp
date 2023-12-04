<?php
// 데이터베이스 연결 정보
$servername = "localhost"; // 서버 주소
$username = "korea"; // 데이터베이스 사용자 이름
$password = "1234"; // 데이터베이스 비밀번호
$dbname = "test"; // 데이터베이스 이름

// POST로 전송된 데이터 받기
$loginId = $_POST['loginId'];
$loginPw = $_POST['loginPw'];

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 비밀번호 해싱 (추가 보안을 위해 사용자 비밀번호를 해싱하여 저장하는 것이 좋습니다.)
$hashed_loginPw = password_hash($loginPw, PASSWORD_DEFAULT);

// SQL 쿼리 작성 및 실행
$sql = "INSERT INTO Login (loginId, loginPw) VALUES ('$loginId', '$hashed_loginPw')";

if ($conn->query($sql) === TRUE) {
    echo "로그인이 완료되었습니다.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>