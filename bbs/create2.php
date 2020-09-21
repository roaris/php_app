<?php
$user_name = $_REQUEST['user_name'];
$password = $_REQUEST['password'];

$pdo = new PDO('mysql::host=127.0.0.1;dbname=bbs;charset=utf8', 'root', '');
$sql = 'SELECT COUNT(*) FROM user WHERE user_name=:user_name';
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(':user_name', $user_name);
$stmt -> execute();
$already_exist = $stmt->fetch(PDO::FETCH_ASSOC)['COUNT(*)']>0;

if ($user_name=='') {
    $message = 'ユーザー名は1文字以上でなければいけません';
    require_once 'create.php';
}
elseif ($password=='') {
    $message = 'パスワードは1文字以上でなければいけません';
    require_once 'create.php';
}
elseif ($already_exist) {
    $message = 'このユーザー名は既に登録されており使用できません';
    require_once 'create.php';
}
else {
    $sql = 'INSERT INTO user(user_name, password) VALUES (:user_name, :password)';
    $stmt = $pdo->prepare($sql);
    $stmt -> bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $stmt -> bindValue(':password', $password, PDO::PARAM_STR);
    $stmt -> execute();
    $message = 'アカウントを作成しました';
    require_once 'index.php';
}

