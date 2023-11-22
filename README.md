
SQL COMMANDS
```
CREATE TABLE users (
    user_id int PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(50) NOT NULL,
    last_name varchar(50) NOT NULL,
    email varchar(150) NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    user_roles VARCHAR(50) DEFAULT 'user' NOT NULL
);
```

```
CREATE TABLE pets (
    pet_id int PRIMARY KEY AUTO_INCREMENT,
    pet_name varchar(50) NOT NULL,
    pet_type varchar(50),
    pet_breed varchar(50),
    pet_age int NOT NULL,
    pet_created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FK_user_id int NOT NULL,
 	FOREIGN KEY (FK_user_id) REFERENCES users(user_id)
);
```