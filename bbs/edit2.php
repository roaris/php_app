<?php
$pdo = new PDO('mysql::host=127.0.0.1;dbname=bbs;charset=utf8', 'root', '');
$sql = 'UPDATE user SET age=:age, gender=:gender, hobby=:hobby, prefecture=:prefecture WHERE user_name=:user_name';
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(':age', $_REQUEST['age'], PDO::PARAM_INT);
$stmt -> bindValue(':gender', $_REQUEST['gender'], PDO::PARAM_STR);
$stmt -> bindValue(':hobby', $_REQUEST['hobby'], PDO::PARAM_STR);
$stmt -> bindValue(':prefecture', $_REQUEST['prefecture'], PDO::PARAM_STR);
$stmt -> bindValue(':user_name', $_REQUEST['user_name'], PDO::PARAM_STR);
$stmt -> execute();

$message = 'プロフィールを更新しました';
require_once 'edit.php';