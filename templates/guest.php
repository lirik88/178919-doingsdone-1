<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="body-background <?= ($login) ? 'overlay' : '' ?>"><!--class="overlay"-->
	<h1 class="visually-hidden">Дела в порядке</h1>
	<div class="page-wrapper">
		<div class="container">
			<header class="main-header">
				<a href="#">
					<img src="../img/logo.png" width="153" height="42" alt="Логитип Дела в порядке">
				</a>

				<div class="main-header__side">
					<a class="main-header__side-item button button--transparent" href="index.php?action=login">Войти</a>
				</div>
			</header>
			<div class="content">
				<section class="welcome">
					<h2 class="welcome__heading">«Дела в порядке»</h2>

					<div class="welcome__text">
						<p>«Дела в порядке» — это веб приложение для удобного ведения списка дел. Сервис помогает пользователям не забывать о предстоящих важных событиях и задачах.</p>

						<p>После создания аккаунта, пользователь может начать вносить свои дела, деля их по проектам и указывая сроки.</p>
					</div>

					<a class="welcome__button button" href="#">Зарегистрироваться</a>
				</section>
			</div>
		</div>
	</div>
