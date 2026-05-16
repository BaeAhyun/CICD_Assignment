<?php require "db.php"; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>회원관리</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <main class="admin-page">
    <section class="admin-card">
      <div class="admin-header">
        <div>
          <h1>회원관리</h1>
          <p class="desc">사이트에 가입한 회원 목록을 확인하는 관리자 페이지 예시입니다.</p>
        </div>
        <a class="small-link" href="login.html">로그인 페이지</a>
      </div>

      <table class="member-table">
        <thead>
          <tr>
            <th>번호</th>
            <th>아이디</th>
            <th>이름</th>
            <th>이메일</th>
            <th>가입일</th>
            <th>관리</th>
          </tr>
        </thead>
        <tbody>
        <?php
          try {
              $sql = "SELECT user_id, user_name, user_email, user_reg_datetime
                      FROM member
                      ORDER BY user_reg_datetime ASC";
              $stmt = $pdo->prepare($sql);
              $stmt->execute();
              $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

              if (count($members) > 0) {
                  $no = 1;
                  foreach ($members as $row) {
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['user_id']) ?></td>
            <td><?= htmlspecialchars($row['user_name']) ?></td>
            <td><?= htmlspecialchars($row['user_email']) ?></td>
            <td><?= htmlspecialchars($row['user_reg_datetime']) ?></td>
            <td>
              <button class="table-btn edit" type="button">수정</button>
              <form action="delete_user.php" method="post" style="display:inline;">
                <input type="hidden" name="userId" value="<?= htmlspecialchars($row['user_id']) ?>">
                <button class="table-btn delete" type="submit">삭제</button>
              </form>
            </td>
          </tr>
        <?php
                  }
              } else {
                  echo '<tr><td colspan="6">등록된 회원이 없습니다.</td></tr>';
              }
          } catch (PDOException $e) {
              echo '<tr><td colspan="6">DB 오류: ' . $e->getMessage() . '</td></tr>';
          }
        ?>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>