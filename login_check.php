<?php
include 'db.php'; // db.php 파일 포함

$id = $_GET["id"];
$passwd = $_GET["passwd"];

$stmt = $conn->prepare("SELECT * FROM login WHERE id = ? AND password = ?");
$stmt->bind_param("ss", $id, $passwd);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("location: list.php");
} else {
    echo "<script>
            alert('아이디 또는 비밀번호가 잘못되었습니다.');
            window.location.href = 'index.html';
          </script>";
}
?>

