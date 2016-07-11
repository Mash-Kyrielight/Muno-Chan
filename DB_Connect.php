<?php
	$s=mysql_connect("localhost","root","") or die("接続に失敗しました。");
	mysql_close($s);
	$word = $_POST["Word"];
	
	mysql_select_db("muno_chan",$s);
	mysql_query("SELECT * FROM dictionary(name,meaning)"); 
?>