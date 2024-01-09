<?php
include 'db.php';

$title = $_POST['title'];
$content = $_POST['content'];
$reg_date = date("Y-m-d H:i:s"); // 현재 날짜와 시간

$stmt = $conn->prepare("INSERT INTO board (title, content, reg_date) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $content, $reg_date);
$stmt->execute();

header("Location: list.php");

$stmt->close();
$conn->close();
?>

