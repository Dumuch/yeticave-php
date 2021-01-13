USE yeticave;
CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, email CHAR(128), password CHAR(64), lots_id CHAR(128), avatar_url CHAR(128));
CREATE TABLE lots (id INT AUTO_INCREMENT PRIMARY KEY, name CHAR(128), category_id CHAR(10), description text, preview_url CHAR(128), rates_id CHAR(128));
CREATE TABLE rates (id INT AUTO_INCREMENT PRIMARY KEY, user CHAR(128), price INT(10), date_rate DATETIME);
