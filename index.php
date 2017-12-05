<?php
require_once('function.php');

$login = false;
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
if (count($_GET)){
	if(isset($_GET['id']) && !isset($projects[$_GET['id']])) {
		header('HTTP/1.0 404 Not Found', true, 404);
		die();
	}
	if (isset($_GET['action'])){
		if ($_GET['action'] === 'login'){
			$login = true;
		}
	}
}


//Подключаем шаблон страницы
$indexPath = 'templates/index.php';
$layoutPath = 'templates/layout.php';
$title = 'Дела в порядке!';

$html = renderTemplate($indexPath, $layoutPath, compact('tasks', 'projects', 'title', 'login'));

print($html);