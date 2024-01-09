<?php
$host = 'localhost';
$db_id = 'root'; 
$db_pw = 'toor'; 
$db_name = 'goorm';

$conn = new mysqli($host, $db_id, $db_pw, $db_name);
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}
?>
