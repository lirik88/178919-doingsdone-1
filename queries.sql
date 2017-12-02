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
  users (email, name, password, userpic)
VALUES
  ('ignat.v@gmail.com', 'Игнат', MD5('ug0GdVMi'), '/img/user-pic.jpg'),
  ('kitty_93@li.ru', 'Леночка', MD5('daecNazD'), NULL),
  ('warrior07@mail.ru', 'Руслан', MD5('oixb3aL8'), NULL);

# Список задач
INSERT INTO
  tasks (project_id, name, deadline, completed_at, is_completed)
VALUES
  (3, 'Собеседование в IT-компании', '2018-06-01', NULL, 0),
  (3, 'Выполнить тестовое задание', '2018-05-18', NULL, 0),
  (2, 'Сделать задание первого раздела', '2018-04-21', NULL, 0),
  (1, 'Встреча с другом', '2018-04-22', '2017-11-26', 1),
  (4, 'Купить корм для кота', NULL, NULL, 0),
  (4, 'Заказать пиццу', NULL, NULL, 0);

# получить список из всех проектов для одного пользователя;
SELECT id, name FROM projects WHERE user_id = 1 ORDER BY id;

# получить список из всех задач для одного проекта;
SELECT * FROM tasks WHERE project_id = 3 ORDER BY deadline;

# пометить задачу как выполненную;
UPDATE tasks SET completed_at = CURDATE(), is_completed = 1 WHERE id = 5;

# получить все задачи для завтрашнего дня;
SELECT * FROM tasks WHERE deadline = NOW() + INTERVAL 1 DAY;

# обновить название задачи по её идентификатору.
UPDATE tasks SET name = 'Заказать вкусную пиццу' WHERE id = 6;
