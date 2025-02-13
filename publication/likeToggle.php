<?php
session_start();
require_once "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pub_id"])) {
    $pubId = intval($_POST["pub_id"]);
    $userId = $_SESSION["user_id"];

    $result = $conn->query("SELECT * FROM likes WHERE pub_id = $pubId AND user_id = $userId");

    if ($result->num_rows > 0) {
        $conn->query("DELETE FROM likes WHERE pub_id = $pubId AND user_id = $userId");
    } else {
        $conn->query("INSERT INTO likes (pub_id, user_id) VALUES ($pubId, $userId)");
    }

    $likeCount = $conn->query("SELECT COUNT(*) as count FROM likes WHERE pub_id = $pubId")->fetch_assoc()['count'];

    echo json_encode(['likeCount' => $likeCount]);
}
?>
