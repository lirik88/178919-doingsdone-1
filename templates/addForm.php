
<div class="modal">
	<button class="modal__close" type="button" name="button">Закрыть</button>

	<h2 class="modal__heading">Добавление задачи</h2>

	<form class="form"  action="index.php" method="post" enctype="multipart/form-data">
		<div class="form__row">

			<label class="form__label" for="name">Название <sup>*</sup></label>

			<input class="form__input
									<?php if (in_array('name', $errors)) : ?>
								        form__input--error
							        <?php endif; ?>
			" type="text" name="name" id="name" value="<?= $name; ?>" placeholder="Введите название">

			<?php if (in_array('name', $errors)) : ?>
				<p class="form__message">Заполните это поле</p>
			<?php endif; ?>
		</div>

		<div class="form__row">

			<label class="form__label" for="project">Проект <sup>*</sup></label>

			<select class="form__input form__input--select
									<?php if (in_array('project', $errors)) : ?>
								        form__input--error
							        <?php endif; ?>
			" name="project" id="project">
				<?php foreach ($projects as $project) : ?>
					<?php if ($project !== 'Все') : ?>
						<option value="<?= $project; ?>"
							<?php if (isset($_POST['project']) && $_POST['project'] === $project)
									{print("selected");} ?>>
							<?= $project; ?>
						</option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>

			<?php if (in_array('project', $errors)) : ?>
				<p class="form__message">Выберите проект</p>
			<?php endif; ?>
		</div>

		<div class="form__row">

			<label class="form__label" for="date">Дата выполнения</label>

			<input class="form__input form__input--date
									<?php if (in_array('date', $errors)) : ?>
								        form__input--error
							        <?php endif; ?>
			" type="date" name="date" id="date" value="<?= $date ?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">

			<?php if (in_array('date', $errors)) : ?>
				<p class="form__message">Введите дату в формате ДД.ММ.ГГГГ</p>
			<?php endif; ?>
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