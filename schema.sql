CREATE DATABASE doingsdone CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE doingsdone;

CREATE TABLE users (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  created_on    DATETIME,
  email         CHAR(128) NOT NULL UNIQUE,
  name          CHAR(128) NOT NULL,
  password      CHAR(60) NOT NULL,
  userpic       CHAR(255) DEFAULT NULL,
  is_deleted    TINYINT(1) DEFAULT 0,

  INDEX username (name)
);

CREATE TABLE tasks (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  project_id      INT,
  name            CHAR(128) NOT NULL UNIQUE,
  user_id         INT,
  created_on      DATETIME NOT NULL,
  completed_on    DATETIME,
  completed       TINYINT(1) DEFAULT 0,
  deadline        DATETIME DEFAULT NULL,
  is_deleted      TINYINT(1) DEFAULT 0,

  INDEX taskName (name)
);

CREATE TABLE projects (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  name          CHAR(128) NOT NULL,
  user_id       INT,
  is_deleted    TINYINT(1) DEFAULT 0,

  INDEX projectName (name)
);
