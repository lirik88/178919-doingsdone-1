<?php
require_once('function.php');

//Объявление переменных
$indexPath = 'templates/index.php';
$layoutPath = 'templates/layout.php';
$modalFormPath = 'templates/modalForm.php';
$title = 'Дела в порядке!';
$required = ['name', 'date', 'project'];
$rules = ['date' => 'isCorrectDate'];
$errors = [];

// массив проектов
$projects = ['Все', 'Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];

//ассоциативный массив с задачами
$tasks = [['item' => 'Собеседование в IT компании',     'date' => '01.06.2018', 'project' => 'Работа',        'complete' => false],
['item' => 'Выполнить тестовое задание',      'date' => '25.05.2018', 'project' => 'Работа',        'complete' => false],
['item' => 'Сделать задание первого раздела', 'date' => '21.04.2018', 'project' => 'Учеба',         'complete' => true],
['item' => 'Встреча с другом',                'date' => '22.04.2018', 'project' => 'Входящие',      'complete' => false],
['item' => 'Купить корм для кота',            'date' => 'Нет',        'project' => 'Домашние дела', 'complete' => false],
['item' => 'Заказать пиццу',                  'date' => 'Нет',        'project' => 'Домашние дела', 'complete' => false]];


//Подключаем шаблон страницы


//Шаблон формы ввода
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	foreach ($_POST as $key => $value) {
		if (in_array($key, $required) && $value === '') {
			$errors[] = $key;
			break;
		}
		if (in_array($key, $rules)) {
			$result = call_user_func($rules[$key], $value);

			if ($result) {
				$errors[] = $key;
			}
		}
	}
	if (count($errors)){
		header('Location: index.php?success=false');
	}
	if (!count($errors)) {
		header('Location: index.php?success=true');
	}
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (isset($_GET) || !count($_GET)) {
		$html = renderTemplate($indexPath, $layoutPath, compact('tasks', 'projects', 'title', $errors));
	}
	if ((isset($_GET['success']) && $_GET['success'] !== true) || isset($_GET['add'])) {
		$overlay = 'overlay';
		$html = renderTemplate($modalFormPath, $layoutPath,
		compact('tasks', 'projects', 'overlay', 'title', $errors));
	}
	if (isset($_GET['success']) && $_GET['success'] === true) {
		$tasks = ['item' => $_POST['name'], 'date' => $_POST['date'], 'project' => $_POST['project'], 'complete' => false];
	}
}





print($html);
