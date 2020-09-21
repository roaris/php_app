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
            <h1>BBSにようこそ！</h1>
            <?=$message?>
            <form class='form' action='login.php' method='post'>
                <div class='form-group'>
                    <label class='control-label'>ユーザー名</label>
                    <input class='form-control' type='text' name='user_name'><br>
                </div>
                <div class='form-group'>
                    <label class='control-label'>パスワード</label>
                    <input class='form-control' type='text' name='password'>
                </div>
                <button class='btn btn-primary' type='submit'>ログイン</button>
            </form>
            <br>
            <a href='create.php'>アカウント作成</a>
        </div>
    </div>
</body>
</html>