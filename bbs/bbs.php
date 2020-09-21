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
            $pdo = new PDO('mysql::host=127.0.0.1;dbname=bbs;charset=utf8', 'root', '');
            if (isset($_REQUEST['user_name'])) $user_name = $_REQUEST['user_name'];
            if (isset($_REQUEST['content'])) {
                date_default_timezone_set('Asia/Tokyo');
                $now = date('Y-m-d H:i:s');
                $sql = 'INSERT INTO post(user_name, content, posted_at) VALUES (:user_name, :content,"'.$now.'")';
                $stmt = $pdo->prepare($sql);
                $stmt -> bindValue(':user_name', $user_name, PDO::PARAM_STR);
                $stmt -> bindValue(':content', $_REQUEST['content'], PDO::PARAM_STR);
                $stmt -> execute();
            }
            ?>
            
            <h1>ようこそ、<?=$user_name?>さん</h1>
            <p><a href='edit.php?user_name=<?=$user_name?>'>プロフィールを編集する</a></p>
            
            <h2>投稿する</h2>
            <form class='form' action='bbs.php' method='post'>
                <input type='hidden' name='user_name' value=<?=$user_name?>>
                <div class='form-group'>
                    <input class='form-control' type='text' name='content'>
                </div>
                <button class='btn btn-primary' type='submit'>投稿</button>
            </form>
            
            <h2>検索する</h2>
            <form class='form' action='bbs.php' method='get'>
                <input type='hidden' name='user_name' value=<?=$user_name?>>
                <div class='form-group'>
                    <input class='form-control' type='text' name='keyword'>
                </div>
                <button class='btn btn-primary' type='submit'>検索</button>
            </form>
            
            <h2>投稿一覧</h2>
            <?php
            if (isset($_REQUEST['keyword'])) {
                $sql = 'SELECT * FROM post WHERE content LIKE :keyword ORDER BY posted_at DESC';
                $stmt = $pdo->prepare($sql);
                $stmt -> bindValue(':keyword', '%'.$_REQUEST['keyword'].'%', PDO::PARAM_STR);
            }
            else {
                $sql = 'SELECT * FROM post ORDER BY posted_at DESC';
                $stmt = $pdo->prepare($sql);
            }
            $stmt -> execute();
            ?>
            <table class='table table-striped'>
                <tr>
                    <th>ユーザー名</th>
                    <th>投稿内容</th>
                    <th>投稿日時</th>
                </tr>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><a href='profile.php?user_name=<?=$row['user_name']?>'><?=$row['user_name']?></a></td>
                    <td><?=$row['content']?></td>
                    <td><?=$row['posted_at']?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
