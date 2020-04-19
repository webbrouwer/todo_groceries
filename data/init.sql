CREATE DATABASE todo_groceries;

use todo_groceries;

CREATE TABLE groente_fruit (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	item TEXT NOT NULL,
	date TIMESTAMP
);

CREATE TABLE vleeswaren_beleg (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	item TEXT NOT NULL,
	date TIMESTAMP
);

CREATE TABLE huishouden (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	item TEXT NOT NULL,
	date TIMESTAMP
);

CREATE TABLE overig (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	item TEXT NOT NULL,
	date TIMESTAMP
);

/**
*
VARCHAR(X)
Case: user name, email, country, subject, password

TEXT
Case: messages, emails, comments, formatted text, html, code, images, links

MEDIUMTEXT
Case: large json bodies, short to medium length books, csv strings

LONGTEXT
Case: textbooks, programs, years of logs files, harry potter and the goblet of fire, scientific research logging
*
*/`