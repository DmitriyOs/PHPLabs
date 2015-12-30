DROP DATABASE IF EXISTS CarShop;
CREATE DATABASE CarShop;
Use CarShop;
CREATE TABLE Car
(
	id int NOT NULL AUTO_INCREMENT,
    brand varchar(50) NOT NULL,
    color varchar(50) NOT NULL,
    date varchar(50) NOT NULL,
    price int NOT NULL,
    percent int,
    PRIMARY KEY(id)
);
CREATE TABLE Owner
(
	id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    adress varchar(50) NOT NULL,
    phone varchar(50) NOT NULL,
    PRIMARY KEY(id)
);
CREATE TABLE Buyer
(
	id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    adress varchar(50) NOT NULL,
    phone varchar(50) NOT NULL,
    PRIMARY KEY(id)
);
COMMIT;