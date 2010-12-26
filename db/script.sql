DROP TABLE Messages;
DROP TABLE Themes;
DROP TABLE Users;

CREATE TABLE Messages
(
	id_message  CHAR(18) NOT NULL,
	text  LONGTEXT NULL,
	date  DATETIME NULL,
	id_user  INTEGER NOT NULL,
	id_theme  INTEGER NOT NULL
)
;



ALTER TABLE Messages
	ADD  PRIMARY KEY (id_message,id_user,id_theme)
;



CREATE TABLE Themes
(
	id_theme  INTEGER NOT NULL,
	title  VARCHAR(20) NULL,
	text  VARCHAR(20) NULL,
	date  DATE NULL,
	id_user  INTEGER NOT NULL
)
;



ALTER TABLE Themes
	ADD  PRIMARY KEY (id_theme,id_user)
;



CREATE TABLE Users
(
	id_user  INTEGER NOT NULL,
	name  VARCHAR(20) NULL,
	pswd  VARCHAR(20) NULL
)
;



ALTER TABLE Users
	ADD  PRIMARY KEY (id_user)
;



ALTER TABLE Messages
	ADD FOREIGN KEY R_4 (id_user) REFERENCES Users(id_user)
;


ALTER TABLE Messages
	ADD FOREIGN KEY R_5 (id_theme,id_user) REFERENCES Themes(id_theme,id_user)
;



ALTER TABLE Themes
	ADD FOREIGN KEY R_2 (id_user) REFERENCES Users(id_user)
;

INSERT INTO Users (id_user, name, pswd) VALUES (1, "admin", "sssfff");
INSERT INTO Users (id_user, name, pswd) VALUES (2, "user", "sssfff");
INSERT INTO Themes (id_theme, title, text, id_user) VALUES (1, "Debug theme" , "Theme for debugging", 1);
INSERT INTO Themes (id_theme, title, text, id_user) VALUES (2, "Second theme" , "Theme for menestrelly", 1);
INSERT INTO Messages (id_message, id_user, id_theme, date, text) VALUES (1, 1, 1, "NULL", "Text of first post");
INSERT INTO Messages (id_message, id_user, id_theme, date, text) VALUES (2, 2, 1, "NULL", "Text of first post");
INSERT INTO Messages (id_message, id_user, id_theme, date, text) VALUES (3, 1, 2, "NULL", "Text of first post");
INSERT INTO Messages (id_message, id_user, id_theme, date, text) VALUES (4, 2, 2, "NULL", "Text of first post");
