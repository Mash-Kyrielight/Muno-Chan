<?php
/*
  $newWord -> 新しく追加する配列
  $hash_ary -> 既存のJSONの配列
  stdClass -> オブジェクトへの型変換でつくられるもの
*/

// 新規会話登録関数
function save($word, $ans) {
	$newWord = array(
	  'word' => $word,
	  'ans' => $ans
	);

	//JSONファイル読み込み／書き込みモードで開く
	$filename = 'dict.json';
	$handle = fopen($filename, 'r');

	//JSONフォーマットから配列に変換して読み込み
	$ary = json_decode(fread($handle, filesize($filename)));
	fclose($handle);

	//stdClass objectを連想配列にキャスト
	foreach($ary as $value){
	  $hash_ary[] = (array)$value;
	}

	// newWord追加
	$output = match_array($hash_ary, $newWord);

	// JSONフォーマットへ変換して書き込み
	$handle = fopen($filename, 'w');
	fwrite($handle,json_encode($output));
	fclose($handle);

	if ($output === 'err') {
		$msg = 'その会話例はすでに登録されています！';
	} else {
		$msg = '';
	}
	
	return $msg;
}

// 最終チェック関数
function match_array($array, $new_array) {
  $i = 0;
  foreach ($array as $value) {
      // wordとansが一致しているものがあれば、そのポインタを$pointに代入
      if ($value['word'] == $new_array['word'] && $value['ans'] == $new_array['ans']) $point = $i;
      $i++;
  }
  if (isset($point)) {
      // 名前がマッチするものがあれば、エラーを格納
      $array = 'err';
  } else {
      // 名前がマッチするものが無ければ、末尾に追加
      $array[] = $new_array;
  }
  return $array;
}

// 事前チェック関数
function checkWord($word) {
  $pass = 'dict.json';
  $json = file_get_contents($pass);
  $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $arr = json_decode($json, true);
  
  if ($arr === null) {
	// そもそもJSONファイルが空ならtrueをリターン
	return true;
  } else {
	foreach ($arr as $value) {
	  // 互いの言葉を小文字に統一して比較
	  if (mb_strtolower($value['word']) === mb_strtolower($word)) {
		// 同じキーが存在した場合
		return false;
	  }
	}
  }
  
  // 連想配列のチェックをクリアした場合
  return true;
}

// JSONファイルすべて展開
function dumpDict() {
  $pass = 'dict.json';
  $json = file_get_contents($pass);
  $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $arr = json_decode($json, true);
  
  if ($arr === null) {
  	  echo 'なんにも登録されていない';
  } else {
	foreach ($arr as $value) {
		echo $value['word'].' : '.$value['ans'].'<br>';
	}
  }
}
?>