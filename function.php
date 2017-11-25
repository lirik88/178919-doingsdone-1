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

//Функция валидации даты
function isCorrectDate ($date) {
	$aDate_parts = explode("-", $date);

	if (checkdate(
	$aDate_parts[1], // Month
	$aDate_parts[2], // Day
	$aDate_parts[0] // Year
	)
	) {
		return true;
	}
	return false;
}