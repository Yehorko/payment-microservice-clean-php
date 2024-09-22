DROP TABLE IF EXISTS users;
CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255),
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS orders;
CREATE TABLE orders(
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions(
    id INT NOT NULL AUTO_INCREMENT,
    order_id  INT NOT NULL,
    currency CHAR(3),
    amount FLOAT,
    request_data TEXT,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS wallets;
CREATE TABLE wallets(
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT,
    balance INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);


INSERT INTO users(id, email) VALUES(1, 'patrik@gmail.com');


INSERT INTO orders(id, user_id) VALUES('12345', 1);
INSERT INTO orders(id, user_id) VALUES('12346', 1);
INSERT INTO orders(id, user_id) VALUES('12347', 1);

INSERT INTO wallets(id, user_id, balance) VALUES('12347', 1, 0);