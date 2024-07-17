<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include '../config/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $sql = "SELECT * FROM posts WHERE id = $post_id";
        $result = $conn->query($sql);

        echo json_encode($result->fetch_assoc());
    } else {
        $sql = "SELECT 
    p.id, 
    p.title, 
    LEFT(p.content, 100) as snippet, 
    p.publish_date, 
    p.image, 
    p.category_id,
    c.name as category_name
FROM 
    posts p
JOIN 
    categories c ON p.category_id = c.id;
";
        $result = $conn->query($sql);

        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }

        echo json_encode($posts);
    }
}
?>
