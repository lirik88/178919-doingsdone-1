<?php

//Объявляем переменные
$indexPath = 'templates/index.php';
$layoutPath = 'templates/layout.php';
$title = 'Дела в порядке!';
$login = false;
$isGuest = true;
$errors = [];
$required = ['name', 'date', 'project', 'email', 'password'];
$rules = ['date' => 'isCorrectDate'];
$addForm = $_POST['addForm'] ?? [];
$show_complete_tasks = '';


session_start();

require_once('function.php');
require_once('data.php');
require_once('userdata.php');





if (count($_GET)) {
	if (isset($_GET['id']) && !isset($projects[$_GET['id']])) {
		header('HTTP/1.0 404 Not Found', true, 404);
		die();
	}

	if (isset($_GET['show_completed'])) {
		setcookie('show_completed', $_GET['show_completed']);
		header("Location: /");
	}
}
if (isset($_COOKIE['show_completed'])) {
	$show_complete_tasks = ($_COOKIE['show_completed'] == 1) ? 'checked' : '';

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
	} 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'add') {
	foreach ($required as $field) {
		if (!isset($_POST['addForm'][$field])) {
			$errors[] = $field;
		}
	}
	foreach ($_POST['addForm'] as $key => $value) {
		if (in_array($key, $required) && $value == '') {
			$errors[] = $key;
		}
		if (in_array($key, $rules)) {
			$result = call_user_func($rules['key'], $value);
			if (!$result) {
				$errors[] = $key;
			}
		}
	}

	if (isset($_FILES['preview'])) {
		$file_name = $_FILES['preview']['name'];
		$file_path = __DIR__ . '/';
		move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_name);

		if ($_FILES['preview']['size'] > 0 && !is_uploaded_file($_FILES['preview']['tmp_name'])) {
			$errors[] = 'file';
		}
	}


	if (!count($errors)) {
		array_unshift($tasks, ['item' => $addForm['name'], 'date' => $addForm['date'], 'project' => $addForm['project'], 'complete' => false]);
	}
}
// Вывод шаблона
print renderTemplate($indexPath, $layoutPath,
					compact('tasks', 'projects', 'title', 'errors', 'login', 'isGuest', 'addForm'));

