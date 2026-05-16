<?php
require "db.php";

$id = $_POST['loginId'];
$pw = $_POST['loginPw'];

try {
    $sql = "SELECT * FROM member WHERE user_id = :user_id AND user_pw = :user_pw";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":user_id", $id);
    $stmt->bindParam(":user_pw", $pw);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "<h1>아이디 : " . htmlspecialchars($id) . "</h1>";
        echo "<h1>비밀번호 : " . htmlspecialchars($pw) . "</h1>";
    } else {
        echo "<script>alert('아이디 또는 비밀번호가 올바르지 않습니다.'); history.back();</script>";
    }

} catch (PDOException $e) {
    echo "DB 오류: " . $e->getMessage();
}
?>