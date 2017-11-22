<?php
require_once('function.php');

//Объявление переменных
$indexPath = 'templates/index.php';
$layoutPath = 'templates/layout.php';
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$name = $_POST['name'] ?? '';
	$project = $_POST['project'] ?? '';
	$date = $_POST['date'] ?? '';

	if (isset($_FILES['preview'])) {
		$file_name = $_FILES['preview']['name'];
		$file_path = __DIR__ . '/';

		move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_name);
	}


	foreach ($_POST as $key => $value) {
		if (in_array($key, $required) && $value == '') {
			$errors[] = $key;
			break;
		}
		if (in_array($key, $rules)) {
			$result = call_user_func($rules['key'], $value);
			if (!$result) {
				$errors[] = $key;
			}
		}
	}
	if (count($errors)) {
		$_GET['add'] = true;
	}
	if (!count($errors)) {
		array_unshift($tasks, ['item' => $name, 'date' => $date, 'project' => $project, 'complete' => false]);
	}
}

print renderTemplate($indexPath, $layoutPath, compact('tasks', 'projects', 'title', 'errors'));
