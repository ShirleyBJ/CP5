CREATE TABLE users(
	uid SMALLINT PRIMARY KEY AUTO_INCREMENT,
	pseudo VARCHAR(20) NOT NULL,
	mail VARCHAR(255) NOT NULL UNIQUE,
	pass VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=UTF8;