<?php

// デバック用。すべてのエラーを表示 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ファイルを変数に格納
$filename = "data/data.csv";

// ファイル読み込み前に変数の初期化
$totalScore = 0;
$dataCount = 0;

// fopenでファイルを開く（"r"読み取りモード）
$fp = fopen($filename,"r");

// レコメンドの文字列を数値にマッピング
$recomendMapping = array(
    "オススメしたくない" => -1,
    "どちらでもない" => 0,
    "オススメしたい" => 1

);

// whileで行末までループ。feof 関数でファイルの最後まで達しているか判定
while(($data = fgetcsv($fp)) !== false){
    // データが正しく読み込まれた場合のみ処理を続行
    if(is_array($data)){
    // implode関数を使用して配列を文字列に変換して出力
echo implode(",",$data)."<br>";

// fgetsでファイルを読み込み、変数に格納→csv読み込みのためfgetcsvに変更。
// $data =  fgetcsv($fp);

// ファイルを読み込んだ変数を出力
// echo $data."<br>";
// fgetcsvを使用すると、CSVファイルの各行が配列として読み込まれる


// 商品とオススメ度を取得
$item = $data[2];
$recomend = $data[3];



// オススメ度を数値に変換
if(isset($recomendMapping[$recomend])){
    // 変数がセットされているか、NULLではないかを確認
    $score = intval($recomendMapping[$recomend]);

}else{
    $score = 0; // 未定義のレコメンドの場合は0にする
}

// 商品ごとのスコアを累計
if(isset($rating[$item])){
    $rating[$item] += $score;
    
}else{
    $rating[$item] = $score;
}

// 合計スコアと商品数を更新
$totalScore += $score;
$dataCount++;

// デバッグ用：現在の累積スコアを出力
echo "商品: " . $item . " スコア: " . $score . " 累積スコア: " . $rating[$item] . "<br>";

    }

}


// fcloseでファイルを閉じる
fclose($fp);

// デバッグ用：最終的な累積スコアを出力
echo "<pre>";
print_r($rating);
echo "</pre>";

// 最大スコアの商品を確認
$maxItems = []; //初期化
$maxScore = PHP_INT_MIN; // 最小の整数値で初期化



foreach($rating as $item => $score){
    echo "Checking item: $item with score: $score<br>"; // デバッグ出力

    if($score > $maxScore){
        $maxItems = [$item]; // 新しい最大スコアを見つけたら、配列をリセット
        $maxScore = $score;
        echo "New max found. Item: $item, Score: $maxScore<br>"; // デバッグ出力
    }elseif($score == $maxScore){
        $maxItems[] = $item; // 同点の場合、配列に追加
        echo "Tied for max. Item: $item, Score: $maxScore<br>"; // デバッグ出力
    } 

}



// 平均スコアの計算
$averageScore = $dataCount > 0 ? $totalScore / $dataCount : 0;


// デバッグ用：最終的な最大スコアとアイテムを出力
echo "Max Items (outside loop): " . implode(", ", $maxItems) . "<br>";
echo "Max Score (outside loop): " . $maxScore . "<br>";

// 結果を表示
if(!empty($maxItems)){
    echo "一番人気： ". implode(", ", $maxItems) ." "." "."合計スコア： ".$maxScore. "<br>";
    echo "全体の平均スコア： "  .number_format($averageScore, 2). "<br>"; // 小数点第2位まで表示
    echo "総データ数： " .$dataCount; 
}else{
    echo "データなし";
}

// デバック用。出力バッファをフラッシュ
ob_end_flush();

?>