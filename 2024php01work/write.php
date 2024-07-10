<?php
$name = $_POST["name"];
$email = $_POST["email"];
$item = $_POST["item"];
$recomend = $_POST["recomend"];
$memo = $_POST["memo"];
$c = ",";
$str = $name.$c.$email.$c.$item.$c.$recomend.$c.$memo;

$file = fopen("data/data.csv","a"); //"a":追加(Add) "r":読み込み(Read)
fwrite($file,$str."\n"); // "\n"：テキスト内での改行のみ。ブラウザ上では改行されない。
fclose($file);

header("Location: index.php"); //リダイレクト関数、exitとセット。
exit;

?>

