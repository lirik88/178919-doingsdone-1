# Существующий список проектов
INSERT INTO
  projects (name, user_id)
VALUES
  ('Входящие', 1),
  ('Учеба', 1),
  ('Работа', 1),
  ('Домашние дела', 1),
  ('Авто', 1);

# Существующий список пользователей
INSERT INTO
  users (created_on, email, name, password, userpic)
VALUES
  ('2017-11-26', 'ignat.v@gmail.com', 'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', '/img/user-pic.jpg'),
  ('2017-11-26', 'kitty_93@li.ru', 'Леночка', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', NULL),
  ('2017-11-26', 'warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', NULL);

# Список задач
INSERT INTO
  tasks (project_id, name, user_id, created_on, deadline, completed_on, completed)
VALUES
  (3, 'Собеседование в IT-компании', 1, '2017-11-26', '2018-06-01', NULL, 0),
  (3, 'Выполнить тестовое задание', 1, '2017-11-26', '2018-05-18', NULL, 0),
  (2, 'Сделать задание первого раздела', 1, '2017-11-26', '2018-04-21', NULL, 0),
  (1, 'Встреча с другом', 1, '2017-11-26', '2018-04-22', '2017-11-26', 1),
  (4, 'Купить корм для кота', 1, '2017-11-26', NULL, NULL, 0),
  (4, 'Заказать пиццу', 1, '2017-11-26', NULL, NULL, 0);

# получить список из всех проектов для одного пользователя;
SELECT id, name FROM projects WHERE user_id = 1 ORDER BY id;

# получить список из всех задач для одного проекта;
SELECT * FROM tasks WHERE project_id = 3 ORDER BY deadline;

# пометить задачу как выполненную;
UPDATE tasks SET completed_on = CURDATE(), completed = 1 WHERE id = 5;

# получить все задачи для завтрашнего дня;
SELECT * FROM tasks WHERE deadline = NOW() + INTERVAL 1 DAY;

# обновить название задачи по её идентификатору.
UPDATE tasks SET name = 'Заказать вкусную пиццу' WHERE id = 6;
