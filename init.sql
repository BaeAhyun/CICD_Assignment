CREATE DATABASE IF NOT EXISTS my_site
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE my_site;

CREATE TABLE IF NOT EXISTS member (
  user_id           VARCHAR(50)  NOT NULL,
  user_pw           VARCHAR(255) NOT NULL,
  user_name         VARCHAR(50)  NOT NULL,
  user_email        VARCHAR(100) NOT NULL,
  user_reg_datetime DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id)
);