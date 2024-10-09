<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板 - 投稿完了</title>
</head>

<body>
    <?php
    try {
        $dsn = 'mysql:dbname=php_practice;host=localhost;charset=utf8';
        $user = 'root';
        $password = ''; // XAMPPのデフォルトではパスワードは空

        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = htmlspecialchars($_POST['name']);
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $image = isset($_FILES['image']) ? file_get_contents($_FILES['image']['tmp_name']) : null;

        $sql = 'INSERT INTO posts (name, title, content, image, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)';
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$name, $title, $content, $image]);

        $dbh = null;

        echo '<h1>投稿完了</h1>';
        echo '<p>投稿が完了しました。</p>';
        echo '<p>名前: ' . $name . '</p>';
        echo '<p>タイトル: ' . $title . '</p>';
        echo '<p>内容: ' . nl2br($content) . '</p>';
        echo '<p>画像ファイル名: ' . htmlspecialchars($_FILES['image']['name'] ?? 'なし') . '</p>';
        echo '<button onclick="window.location.href=\'index.php\'">最初の画面に戻る</button>';
    } catch (PDOException $e) {
        echo 'データベース接続に失敗しました: ' . $e->getMessage();
    }
    ?>

</body>

</html>