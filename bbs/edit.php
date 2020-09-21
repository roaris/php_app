<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='utf-8'>
    <title>BBS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type=text/css>
		div#main {
			padding: 30px;
			background-color: #efefef;
		}
	</style>
</head>

<body>
    <div class='container'>
        <div id='main'>
            <h1>プロフィール編集</h1>
            <?=$message?>
            <?php
            $user_name = $_REQUEST['user_name'];
            $pdo = new PDO('mysql::host=127.0.0.1;dbname=bbs;charset=utf8', 'root', '');
            $sql = 'SELECT * FROM user WHERE user_name=:user_name';
            $stmt = $pdo->prepare($sql);
            $stmt -> bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $stmt -> execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $age = $row['age'];
            $gender = $row['gender'];
            $hobby = $row['hobby'];
            $prefecture = $row['prefecture'];
            ?>
            <form class='form' action='edit2.php?user_name=<?=$user_name?>' method='post'>
                <label>年齢</label>
                <input type='number' name='age' value=<?=$age?>><br>
                <label>性別</label>
                <?php if ($gender=='') { ?>
                    <input type='radio' name='gender' value='男'>男
                    <input type='radio' name='gender' value='女'>女<br>
                <?php } ?>
                <?php if ($gender=='男') { ?>
                    <input type='radio' name='gender' value='男' checked='checked'>男
                    <input type='radio' name='gender' value='女'>女<br>
                <?php } ?>
                <?php if ($gender=='女') { ?>
                    <input type='radio' name='gender' value='男'>男
                    <input type='radio' name='gender' value='女' checked='checked'>女<br>
                <?php } ?>
                <label class='control-label'>趣味</label>
                <input class='form-control' type='text' name='hobby' value=<?=$hobby?>><br>
                <label>住んでるところ</label>
                <select name='prefecture'>
                    <?php $prefecture_array = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県',
                    '群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県','石川県',
                    '福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県',
                    '和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県',
                    '佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県'); ?>
                    <?php foreach ($prefecture_array as $pref) { ?>
                        <?php if ($pref==$prefecture) { ?>
                            <option name=<?=$pref?> selected><?=$pref?></option>
                        <?php } ?>
                        <?php if ($pref!=$prefecture) { ?>
                            <option name=<?=$pref?>><?=$pref?></option>
                        <?php } ?>
                    <?php } ?>
                </select><br>
                <button class='btn btn-primary' type='submit'>更新</button>
            </form>
            <br>
            <a href='bbs.php?user_name=<?=$user_name?>'>戻る</a>
        </div>
    </div>
</body>
</html>