<?php require_once 'save.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>会話プログラム | 登録完了</title>
<script src="http://code.jquery.com/jquery-3.0.0.min.js
"></script>
<script src="script.js"></script>
</head>
<body>

<p>会話例を教えてくれてありがとう！</p>

<!-- 登録会話例をすべて表示 -->
<p>登録されている会話集です</p>
<?=dumpDict()?>

<a href="index.php">会話へ戻る</a>

</body>
</html>