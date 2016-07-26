'use strict'; // 厳格な文法を要求するモード

// 返答用関数
function reply() {
	
	var img = [
	"images/Muno-chan2.png",
	"images/Muno-chan3.png",
	"images/Muno-chan.png"
	];
	
	
	
	var myword = talk.myword.value;
  
  // テキストが空の場合
  if (myword === "") {
	$("#msg").html("何も喋らないの？");
	$("img").attr("src",img[0]);

  // テキストに言葉が入っている場合
  } else {
  
	  // 辞書を取得してdataに格納し、処理
	  $.getJSON("dict.json", function(data) {

		// 辞書を見て、キーと合致する要素(返答)をリターン
		var i = 0;
		for (; i<data.length; i++) {
			console.log(data[i].word + " " + data[i].ans);
			// 両方の言葉を小文字に統一して比較
			if ((data[i].word).toLowerCase() === myword.toLowerCase()) {
				$("#msg").html(data[i].ans);
				$("img").attr("src",img[1]);
				break;
			}
		}
		
		// 辞書に言葉が登録されていなかった場合
		if (i === data.length) {
			$("#msg").html("何言っているか聞き取れませんでした");
			$("img").attr("src",img[0]);
		}
	  });
  
  }

}