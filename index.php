<?php
require_once('function.php');

//Объявление переменных
$indexPath = 'templates/index.php';
$layoutPath = 'templates/layout.php';
$title = 'Дела в порядке!';
$required = ['name', 'date', 'project'];
$rules = ['date' => 'isCorrectDate'];
$errors = [];
$addForm = $_POST['addForm'] ?? [];


// массив проектов
$projects = ['Все', 'Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];

//ассоциативный массив с задачами
$tasks = [['item' => 'Собеседование в IT компании',     'date' => '01.06.2018', 'project' => 'Работа',        'complete' => false],
['item' => 'Выполнить тестовое задание',      'date' => '25.05.2018', 'project' => 'Работа',        'complete' => false],
['item' => 'Сделать задание первого раздела', 'date' => '21.04.2018', 'project' => 'Учеба',         'complete' => true],
['item' => 'Встреча с другом',                'date' => '22.04.2018', 'project' => 'Входящие',      'complete' => false],
['item' => 'Купить корм для кота',            'date' => 'Нет',        'project' => 'Домашние дела', 'complete' => false],
['item' => 'Заказать пиццу',                  'date' => 'Нет',        'project' => 'Домашние дела', 'complete' => false]];



//Выводим 404 при неправильном id
if (count($_GET) && !isset($projects[$_GET['id']])) {
	header('HTTP/1.0 404 Not Found', true, 404);
	die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
					compact('tasks', 'projects', 'title', 'errors', 'addForm'));
