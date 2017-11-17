<?php
//Функция подключения шаблона
function renderTemplate (string $viewPath, string $layoutPath, array $list){
	$html = '';
	if (!empty($viewPath) && file_exists($viewPath) && !empty($layoutPath) && file_exists($layoutPath)){
		ob_start();
		extract($list);
		include($viewPath);
		$content = ob_get_contents();
		ob_clean();
		include($layoutPath);
		$html = ob_get_contents();
		ob_end_clean();
	}
	return $html;
}
//Функция подчсчета задач в проекте
function getNumberOfTasks(array $tasks, string $project) {
	$result = 0;
	if ($project === 'Все') {
		return count($tasks);
	}
	foreach ($tasks as $task) {
		if ($task['project'] === $project) {
			$result++;
		}
	}
	return $result;
}
//Функция проверяет соответствует ли задача выбранному проекту
function getTasks(string $project, array $projects) {
	if (isset($_GET['id']) && $projects[$_GET['id']] !== $project) {
		return false;
	}
	return true;
}