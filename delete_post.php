<?php
include 'db.php';

if (isset($_GET['idx'])) {
    $idx = $_GET['idx'];

    $stmt = $conn->prepare("DELETE FROM board WHERE idx = ?");
    $stmt->bind_param("i", $idx);
    $stmt->execute();
    $stmt->close();
}

header("Location: list.php");
$conn->close();
?>
