<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn-edit, .btn-delete {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<form action="list.php" method="get">
    <input type="text" name="search" placeholder="검색어">
    <input type="submit" value="검색">
</form>

<table>
    <thead>
        <tr>
            <th>글 번호</th>
            <th>글 제목</th>
            <th>작성 시간</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'db.php';

        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;
        $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

        $sql = "SELECT SQL_CALC_FOUND_ROWS idx, title, reg_date FROM board ";
        if ($search) {
            $sql .= "WHERE title LIKE '%$search%' ";
        }
        $sql .= "ORDER BY idx DESC LIMIT {$start}, {$perPage}";
        $result = $conn->query($sql);

        $total = $conn->query("SELECT FOUND_ROWS() as total")->fetch_assoc()['total'];
        $pages = ceil($total / $perPage);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idx'] . "</td>";
            echo "<td><a href='view_post.php?idx=" . $row['idx'] . "'>" . $row['title'] . "</a></td>";
            echo "<td>" . $row['reg_date'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<div class="pagination">
    <?php
    for ($i = 1; $i <= $pages; $i++) {
        echo "<a href='?page=$i&search=$search'>$i</a> ";
    }
    ?>
</div>

<a href="write.html">글쓰기</a>

</body>
</html>
