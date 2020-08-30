CREATE DATABASE articles;
CREATE USER 'article_user'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON articles.* TO 'article_user'@'localhost';