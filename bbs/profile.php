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
            <?php
            $user_name = $_REQUEST['user_name'];
            $pdo = new PDO('mysql::host=127.0.0.1;dbname=bbs;charset=utf8', 'root', '');
            $sql = 'SELECT * FROM user WHERE user_name=:user_name';
            $stmt = $pdo->prepare($sql);
            $stmt -> bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $stmt -> execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            
            <h1><?=$user_name?>さんのプロフィール</h1>
            <p>年齢:<?=$row['age']?></p>
            <p>性別:<?=$row['gender']?></p>
            <p>住んでるところ:<?=$row['prefecture']?></p>
            <p>趣味:<?=$row['hobby']?></p>
        </div>
    </div>
</body>
</html>