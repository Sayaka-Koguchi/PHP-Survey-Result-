<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信画面</title>
</head>
<body>
    <form action="write.php" method="post">
    名前：<input type="text" name="name"><br>    
    Email：<input type="text" name="email"><br>
    好きな商品：<select name="item">
    <option value="商品A">商品A</option>
    <option value="商品B">商品B</option><
    <option value="商品C">商品C</option>
    <option value="商品D">商品D</option>
    <option value="商品E">商品E</option>
    </select><br>
    <p>オススメ度：<br>
    <input type="radio" name="recomend" value="オススメしたい">オススメしたい
    <input type="radio" name="recomend" value="どちらでもない">どちらでもない
    <input type="radio" name="recomend" value="オススメしたくない">オススメしたくない
    </p>
    <p></p>コメント：<br>
    <textarea name="memo" cols="15" rows="3"></textarea>
    </p>
    <button type="submit">送信</button>
</form>

</body>
</html>