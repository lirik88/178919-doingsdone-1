<?php
//Объявляем переменные
$indexPath = 'templates/index.php';
$layoutPath = 'templates/layout.php';
$title = 'Дела в порядке!';
$login = false;
$isGuest = true;
$errors = [];
$required = ['email', 'password'];

session_start();

require_once('function.php');
require_once('data.php');
require_once('userdata.php');


//Выводим 404 при неправильном id
if (count($_GET)){
	if(isset($_GET['id']) && !isset($projects[$_GET['id']])) {
		header('HTTP/1.0 404 Not Found', true, 404);
		die();
	}
}

if (isset($_SESSION['user'])) {
	$isGuest = false;
}
else {
	if (isset($_GET['login'])){
		$login = true;
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'login') {
	$get_data = $_POST;
	foreach ($required as $value) {
		if (!array_key_exists($value, $get_data) || empty($get_data[$value])) {
			$errors[$value] = true;
		}
	}

	$user = searchUserByEmail($get_data['email'], $users);

	if ($user) {
		if (password_verify($get_data['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		} else {
			$errors['password'] = true;
		}
	} else {
		$errors['email'] = true;
	}

	if (empty($errors)) {
		header('Location: index.php');
	} else {
	}
}


print renderTemplate($indexPath, $layoutPath,
	compact('tasks', 'projects', 'title', 'login', 'isGuest', 'errors'));