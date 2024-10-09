<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(๑ ิټ ิ) 掲示板 (ง´◉ᾥ◉ )</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1> (ง´◉ᾥ◉ )  掲示板  ☜( 。ਊ°) </h1>
    <form action="submit.php" method="post" enctype="multipart/form-data">
    <!-- 名前入力欄 -->
    <div class="form-group">
        <label for="name">名前：</label>
        <input type="text" id="name" name="name" required>
    </div>
    <!-- タイトル入力欄 -->
    <div class="form-group">
        <label for="title">タイトル：</label>
        <input type="text" id="title" name="title" required>
    </div>
    <!-- 内容入力欄 -->
    <div class="form-group">
        <label for="content">内容：</label>
        <textarea id="content" name="content" rows="5" required></textarea>
    </div>
    <!-- 画像ファイルの入力欄 -->
    <div class="form-group">
        <label for="image">画像：</label>
        <input type="text" id="image-filename" readonly>
        <input type="file" id="image" name="image" accept="image/*" onchange="document.getElementById('image-filename').value = this.files[0].name;">
        <button type="button" onclick="document.getElementById('image').click();">参照</button>
    </div>
    <!-- 取消ボタンと投稿ボタン -->
    <div class="buttons">
        <button type="reset">取消</button>
        <button type="submit">投稿</button>
    </div>
    <p>当サイトは、ダークWebではありませんので悪しからず。</p>
</form>


    <div class="separator"></div>

    <h2>投稿一覧</h2>
    <?php
    try {
        $dsn = 'mysql:dbname=php_practice;host=localhost;charset=utf8';
        $user = 'root';
        $password = ''; // XAMPPのデフォルトではパスワードは空

        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM posts ORDER BY id DESC';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="post">';
            echo '<p>名前: ' . htmlspecialchars($row['name']) . '</p>';
            echo '<p>タイトル: ' . htmlspecialchars($row['title']) . '</p>';
            echo '<p>内容: ' . nl2br(htmlspecialchars($row['content'])) . '</p>';
            echo '<p>画像: <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="画像" /></p>';
            echo '<p>投稿日時: ' . htmlspecialchars($row['created_at']) . '</p>';
            echo '<form action="delete.php" method="post">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="delete-button">削除</button>';
            echo '</form>';
            echo '</div>';
        }

        $dbh = null;
    } catch (PDOException $e) {
        echo 'データベース接続に失敗しました: ' . $e->getMessage();
    }
    ?>
</body>
</html>

