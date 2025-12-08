CREATE DATABASE IF NOT EXISTS moodle_db;
CREATE USER IF NOT EXISTS 'moodle_user'@'%' IDENTIFIED BY 'moodle_password';
GRANT ALL PRIVILEGES ON moodle_db.* TO 'moodle_user'@'%';

FLUSH PRIVILEGES;