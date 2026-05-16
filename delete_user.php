<?php
require "db.php";

$userId = $_POST['userId'];

try {
    $sql = "DELETE FROM member WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();

    echo "<script>location.href='admin_users.php';</script>";

} catch (PDOException $e) {
    echo "<script>alert('삭제 실패: " . $e->getMessage() . "'); history.back();</script>";
}
?>