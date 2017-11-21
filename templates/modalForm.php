<?php
$name = htmlentities($_POST['name']) ?? '';
$date = htmlentities($_POST['date']) ?? '';

?>
<div class="modal">
	<button class="modal__close" type="button" name="button">Закрыть</button>

	<h2 class="modal__heading">Добавление задачи</h2>

	<form class="form"  action="index.php" method="post">
		<div class="form__row">

			<?php if (isset($errors)) : ?>
				<p class="form__message"><?= (in_array('name', $errors)) ? "Заполните это поле" : ''; ?></p>
			<?php endif; ?>

			<label class="form__label" for="name">Название <sup>*</sup></label>

			<input class="form__input" type="text" name="name" id="name" value="<?= $name; ?>" placeholder="Введите название">
		</div>

		<div class="form__row">

			<?php if (isset($errors)) : ?>
				<p class="form__message"><?= (in_array('project', $errors)) ? "Заполните это поле" : ''; ?></p>
			<?php endif; ?>

			<label class="form__label" for="project">Проект <sup>*</sup></label>

			<select class="form__input form__input--select" name="project" id="project">
				<?php foreach ($projects as $project) : ?>
					<?php if ($project !== 'Все') : ?>
						<option value="<?=  $project; ?>"
							<?php if (isset($_POST['project']) && $_POST['project'] === $project)
									{print("selected");} ?>>
							<?= $project; ?>
						</option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form__row">

			<?php if (isset($errors)) : ?>
				<p class="form__message"><?= (in_array('date', $errors)) ? "Заполните это поле" : ''; ?></p>
			<?php endif; ?>

			<label class="form__label" for="date">Дата выполнения</label>

			<input class="form__input form__input--date" type="date" name="date" id="date" value="<?= $date; ?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
		</div>

		<div class="form__row">
			<label class="form__label" for="preview">Файл</label>

			<div class="form__input-file">
				<input class="visually-hidden" type="file" name="preview" id="preview" value="">

				<label class="button button--transparent" for="preview">
					<span>Выберите файл</span>
				</label>
			</div>
		</div>

		<div class="form__row form__row--controls">
			<input class="button" type="submit" name="" value="Добавить">
		</div>
	</form>
</div>