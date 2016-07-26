<?php require_once 'save.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>会話プログラム | 登録完了</title>
<script src="http://code.jquery.com/jquery-3.0.0.min.js">
</script>
<script src="script.js"></script>
</head>
<body>
<header>
	<h1>Muno-Chan</h1>
</header>
<br><br><br>
<article>
<p id="dict">会話例を教えてくれてありがとう！</p>

<!-- 登録会話例をすべて表示 -->
<p id="dict2">登録されている会話集です</p>
<p id="dict2"><?=dumpDict()?></p>

<a href="index.php">会話へ戻る</a>
</article>
<footer>
	<small>&copy; 2016 AI development Muno-Chan</small>
</footer>
</body>
</html>