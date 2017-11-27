CREATE DATABASE doingsdone CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE doingsdone;

CREATE TABLE users (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  created_at    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  email         CHAR(128) NOT NULL UNIQUE,
  name          CHAR(128) NOT NULL,
  password      CHAR(60) NOT NULL,
  userpic       TEXT DEFAULT NULL,
  is_deleted    TINYINT(1) DEFAULT 0,

  INDEX username (name)
);

CREATE TABLE tasks (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  project_id      INT,
  name            CHAR(128) NOT NULL UNIQUE,
  user_id         INT,
  created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  completed_at    TIMESTAMP DEFAULT NULL,
  is_completed    TINYINT(1) DEFAULT 0,
  deadline        TIMESTAMP DEFAULT NULL,
  is_deleted      TINYINT(1) DEFAULT 0,

  INDEX taskName (name),
  FOREIGN KEY (project_id) REFERENCES projects(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE projects (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  name          CHAR(128) NOT NULL,
  user_id       INT,
  is_deleted    TINYINT(1) DEFAULT 0,

  INDEX projectName (name),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
