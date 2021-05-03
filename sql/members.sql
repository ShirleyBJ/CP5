CREATE TABLE membre (
    id INT not null primary key AUTO_INCREMENT,
    prenom VARCHAR(25) not null,
    age SMALLINT not null,
    taille DECIMAL(3,2) not null,
    genre VARCHAR(10) not null
) engine INNODB DEFAULT CHARSET UTF8;