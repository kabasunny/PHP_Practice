<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板 - チェック</title>
</head>
<body>
    <?php
    // フォームデータを取得
    $name = htmlspecialchars($_POST['name']);
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $image = $_FILES['image'];

    // エラーメッセージを格納する配列
    $errors = [];

    // 名前のチェック
    if (empty($name)) {
        $errors[] = '名前が入力されていません。';
    }

    // タイトルのチェック
    if (empty($title)) {
        $errors[] = 'タイトルが入力されていません。';
    }

    // 内容のチェック
    if (empty($content)) {
        $errors[] = '内容が入力されていません。';
    }

    // 画像ファイルのチェック
    if ($image['error'] != UPLOAD_ERR_OK) {
        $errors[] = '画像ファイルが正しくアップロードされていません。';
    } else {
        // 画像ファイルをバイナリデータとして読み込む
        $imageData = file_get_contents($image['tmp_name']);
    }

    // エラーがある場合はエラーメッセージを表示
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
        echo '<button onclick="history.back()">戻る</button>';
    } else {
        // エラーがない場合は確認画面を表示
        echo '<h1>確認画面</h1>';
        echo '<p>名前: ' . $name . '</p>';
        echo '<p>タイトル: ' . $title . '</p>';
        echo '<p>内容: ' . nl2br($content) . '</p>';
        echo '<p>画像ファイル名: ' . htmlspecialchars($image['name']) . '</p>';

        echo '<form action="submit.php" method="post" enctype="multipart/form-data">';
        echo '<input type="hidden" name="name" value="' . $name . '">';
        echo '<input type="hidden" name="title" value="' . $title . '">';
        echo '<input type="hidden" name="content" value="' . $content . '">';
        echo '<input type="hidden" name="image" value="' . base64_encode($imageData) . '">';
        echo '<button type="button" onclick="history.back()">戻る</button>';
        echo '<button type="submit">投稿</button>';
        echo '</form>';
    }
    ?>
</body>
</html>
