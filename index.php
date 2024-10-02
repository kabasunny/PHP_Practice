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
    </form>
</body>
</html>
