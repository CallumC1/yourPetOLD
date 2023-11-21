
SQL COMMANDS
```
CREATE TABLE pets (
    pet_id int PRIMARY KEY AUTO_INCREMENT,
    pet_name varchar(50) NOT NULL,
    pet_age varchar(50) NOT NULL,
    pet_breed varchar(50),
    FK_user_id int NOT NULL,
 	FOREIGN KEY (user_id) REFERENCES users(user_id)
);
```