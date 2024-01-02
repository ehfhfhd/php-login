<?php

$host = 'localhost';
$db_id = 'root'; 
$db_pw = 'toor'; 
$db = 'goorm';

$conn = new mysqli($host, $db_id, $db_pw, $db);

if ($conn->connect_error) {
    die("연결실패: " . $conn->connect_error);
}


    $id = $_GET["id"];
    $passwd = $_GET["passwd"];

    $stmt = $conn->prepare("SELECT * FROM login WHERE id = ? and password = ?");
    $stmt->bind_param("ss", $id, $passwd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("location: login_success.html");
    } else {
        echo "<script>
                alert('아이디 또는 비밀번호가 잘못되었습니다.');
                window.location.href = 'login.html';
              </script>";
    }

?>
