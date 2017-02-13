CREATE DATABASE project;
use project;
CREATE TABLE add_img
(
id INT(11),
file TEXT,
time datetime,
name  VARCHAR(200)
);
CREATE TABLE notification
(
user1 VARCHAR(200),
user2 VARCHAR(200),
type VARCHAR(200),
time datetime,
read1 INT(11)
);
CREATE TABLE profile
(
id INT(11),
file TEXT,
name VARCHAR(200),
time  datetime
);
CREATE TABLE users
(
id INT(10),
name VARCHAR(200),
email VARCHAR(400),
password VARCHAR(400)
);