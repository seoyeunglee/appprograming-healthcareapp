<?php
$servername = "localhost";
$username = "korea";
$password = "1234";
$dbname = "test";

$name = $_POST['name'];
$id = $_POST['id'];
$pw = $_POST['pw'];
$email = $_POST['email'];
$kg = $_POST['kg'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

$sql = "INSERT INTO Signup (`name`, `id`, `pw`, `email`, `kg`) VALUES ('$name', '$id', '$hashed_pw', '$email', '$kg')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
