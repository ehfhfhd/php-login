<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 보기</title>
</head>
<body>

<?php
include 'db.php';

$idx = $_GET['idx'];

$stmt = $conn->prepare("SELECT title, content, reg_date FROM board WHERE idx = ?");
$stmt->bind_param("i", $idx);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    echo "<h1>" . htmlspecialchars($row['title']) . "</h1>";
    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
    echo "<p>게시일: " . $row['reg_date'] . "</p>";
    echo "<a href='list.php'>목록으로</a> ";
    echo "<a href='delete_post.php?idx=" . $idx . "' onclick='return confirm(\"정말 삭제하시겠습니까?\")'>삭제</a>";    
} else {
    echo "해당 게시글을 찾을 수 없습니다.";
}

$stmt->close();
$conn->close();
?>

</body>
</html>
