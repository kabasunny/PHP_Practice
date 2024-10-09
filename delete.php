<?php
try {
    $dsn = 'mysql:dbname=php_practice;host=localhost;charset=utf8';
    $user = 'root';
    $password = ''; // XAMPPのデフォルトではパスワードは空

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = (int)$_POST['id'];

    $sql = 'DELETE FROM posts WHERE id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);

    $dbh = null;

    // 削除後、投稿一覧ページにリダイレクト
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    echo 'データベース接続に失敗しました: ' . $e->getMessage();
}
