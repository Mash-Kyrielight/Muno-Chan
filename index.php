<?php
require_once 'save.php';

if (isset($_POST['teachWord']) && isset($_POST['ans'])) {
  
  $teachWord = htmlspecialchars($_POST['teachWord'], ENT_QUOTES, 'UTF-8');
  $ans = htmlspecialchars($_POST['ans'], ENT_QUOTES, 'UTF-8');
  
  if ($teachWord === '' || $ans === '') {
	$msg = 'なにも教えてくれないの？';
  } else {
	$checkFlag = checkWord($teachWord);
	if ($checkFlag === true) {
	  $msg = save($teachWord, $ans);
	  
	  // $msgが空文字のとき、成功。dict.phpへ飛ばす(飛ばさないといちいち更新しなくてはならない)
	  if ($msg === '') {
	  	header('Location: dict.php');
	  	exit();
	  }
	  
	  
	} else {
	  $msg = 'そのシチュエーションでの解答はすでに知っています';
	}
  }

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>会話プログラム</title>
<script src="http://code.jquery.com/jquery-3.0.0.min.js
"></script>
<script src="script.js"></script>
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<header>
	<h1>Muno-Chan</h1>
</header>
<article>
<img id="muno-chan" src="images/Muno-chan2.png" alt=""/>
<!-- メッセージ表示領域 -->
<div id="msg">
  <p></p>
  <?php if (!empty($msg)) : ?>
    <p><?=htmlspecialchars($msg, ENT_QUOTES, 'UTF-8')?></p>
  <?php endif; ?>
</div>
<div id="conversation">
<!-- javaScriptで会話するフォーム -->
<form action="" name="talk">
  <input type="text" name="myword">
  <input type="button" value="会話する" onClick="reply()">
</form>

<br>
<!-- PHPで会話登録するフォーム -->
<form action="" name="teach" method="post">
  <div id="teach">こう聞かれたら： <input type="text" name="teachWord"></div>
  <div id="teach">こう返す： <input type="text" name="ans"></div>
  <input type="submit" value="返答例を教えてあげる">
</form>

<br>
</div><!--id conversation-->
</article>
<footer>
	<small>&copy; 2016 AI development Muno-Chan</small>
</footer>
</body>
</html>