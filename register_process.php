<?php
require "db.php";

$userId    = $_POST['userId'];
$userName  = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userPw    = $_POST['userPw'];

try {
    $sql = "INSERT INTO member (user_id, user_pw, user_name, user_email, user_reg_datetime)
            VALUES (:user_id, :user_pw, :user_name, :user_email, NOW())";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":user_pw", $userPw);
    $stmt->bindParam(":user_name", $userName);
    $stmt->bindParam(":user_email", $userEmail);
    $stmt->execute();

    echo "<script>alert('회원가입이 완료되었습니다.'); location.href='login.html';</script>";

} catch (PDOException $e) {
    echo "<script>alert('회원가입 실패: " . $e->getMessage() . "'); history.back();</script>";
}
?>