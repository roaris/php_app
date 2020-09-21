<?php
$user_name = $_REQUEST['user_name'];
$input_password = $_REQUEST['password'];
    
$pdo = new PDO('mysql:host=127.0.0.1;dbname=bbs;charset=utf8', 'root', '');
$sql = 'SELECT password FROM user WHERE user_name=:user_name';
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt -> execute();
    
$password = $stmt->fetch(PDO::FETCH_ASSOC)['password'];

if ($user_name=='') {
    $message = 'ユーザー名を入力してください';
    require_once 'index.php';
}
else if ($input_password=='') {
    $message = 'パスワードを入力してください';
    require_once 'index.php';
}
else if ($input_password!=$password) {
    $message = 'ユーザー名かパスワードが違います';
    require_once 'index.php';
}
else require_once 'bbs.php';