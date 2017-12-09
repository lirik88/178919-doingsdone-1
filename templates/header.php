<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body><!--class="overlay"-->
<h1 class="visually-hidden">Дела в порядке</h1>

	<div class="page-wrapper">
		<div class="container container--with-sidebar">

			<header class="main-header">
				<a href="#">
					<img src="img/logo.png" width="153" height="42" alt="Логотип Дела в порядке">
				</a>

				<div class="main-header__side">
					<a class="main-header__side-item button button--plus" href="#">Добавить задачу</a>

					<div class="main-header__side-item user-menu">
						<div class="user-menu__image">
							<img src="img/user-pic.jpg" width="40" height="40" alt="Пользователь">
						</div>

						<div class="user-menu__data">
							<p>Константин</p>

							<a href="logout.php">Выйти</a>
						</div>
					</div>
				</div>
			</header>

			<div class="content">
				<section class="content__side">
					<h2 class="content__side-heading">Проекты</h2>

					<nav class="main-navigation">
						<ul class="main-navigation__list">
							<?php for($i = 0; $i < count($projects); $i++) : ?>
								<li class="main-navigation__list-item <?= ($i === 0) ? "main-navigation__list-item--active" : ""; ?>">
									<a class="main-navigation__list-item-link" href="
										<?= ($i !== 0) ? "index.php?id=$i" : 'index.php'; ?>">
										<?= $projects[$i] ?></a>
									<span class="main-navigation__list-item-count"><?= getNumberOfTasks($tasks, $projects[$i]) ?></span>
								</li>
							<?php endfor; ?>
						</ul>
					</nav>

					<a class="button button--transparent button--plus content__side-button" href="#">Добавить проект</a>
				</section>

				<?= $content; ?>

			</div>
		</div>
	</div>