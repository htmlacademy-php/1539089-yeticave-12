-- Добавление существующего списка категорий

INSERT INTO categories (category_name, symbol_code)
VALUES ('Доски и лыжи', 'boards');

INSERT INTO categories (category_nam
e, symbol_code)
VALUES ('Крепления', 'attachment');

INSERT INTO categories (category_name, symbol_code)
VALUES ('Ботинки', 'boots');

INSERT INTO categories (category_name, symbol_code)
VALUES ('Одежда', 'clothing');

INSERT INTO categories (category_name, symbol_code)
VALUES ('Инструменты', 'tools');

INSERT INTO categories (category_name, symbol_code)
VALUES ('Разное', 'other');

-- добавление пользователей

INSERT INTO users
SET email = 'sj@groove.com', registration_date = NOW(), user_contact = '88005555535',
user_name = 'sjfromgroove', user_password = '12345';
INSERT INTO users
SET email = 'tykva@gmail.com', registration_date = NOW(), user_contact = 'https://t.me/sakh_TopSecret', 
user_name = 'tykva', user_password = '12345';

-- добавление существующего списка лотов

INSERT INTO lots
SET author_id = 1, category_id = 1, date_create = NOW(), date_dead = DATE_ADD(curdate(), INTERVAL 1 MONTH), description = 'doska',
image = 'img/lot-1.jpg', lot_name = '2014 Rossignol District Snowboard', rate_step = 100,
start_price = 10999, winner_id = 2;

INSERT INTO lots
SET author_id = 2, category_id = 1, date_create = NOW(), date_dead = DATE_ADD(curdate(), INTERVAL 1 MONTH), description = 'doska',
image = 'img/lot-2.jpg', lot_name = 'DC Ply Mens 2016/2017 Snowboard', rate_step = 100,
start_price = 159999 , winner_id = 1;

INSERT INTO lots
SET author_id = 1, category_id = 2, date_create = NOW(), date_dead = DATE_ADD(curdate(), INTERVAL 1 MONTH), description = 'krepi',
image = 'img/lot-3.jpg', lot_name = 'Крепления Union Contact Pro 2015 года размер L/XL', rate_step = 100,
start_price = 8000, winner_id = 2;

INSERT INTO lots
SET author_id = 2, category_id = 3, date_create = NOW(), date_dead = DATE_ADD(curdate(), INTERVAL 1 MONTH), description = 'boty',
image = 'img/lot-4.jpg', lot_name = 'Ботинки для сноуборда DC Mutiny Charocal', rate_step = 100,
start_price = 10999, winner_id = 1;

INSERT INTO lots
SET author_id = 1, category_id = 4, date_create = NOW(), date_dead = DATE_ADD(curdate(), INTERVAL 1 MONTH), description = 'kurtka',
image = 'img/lot-5.jpg', lot_name = 'Куртка для сноуборда DC Mutiny Charocal', rate_step = 100,
start_price = 7500, winner_id = 2;

INSERT INTO lots
SET author_id = 2, category_id = 6, date_create = NOW(), date_dead = DATE_ADD(curdate(), INTERVAL 1 MONTH), description = 'ochki',
image = 'img/lot-6.jpg', lot_name = 'Маска Oakley Canopy', rate_step = 100,
start_price = 5400, winner_id = 1;


-- добавление ставок


INSERT INTO rates
SET rate_date = NOW(), rate_sum = 11099, lot_id = 1, user_id = 2;

INSERT INTO rates
SET rate_date = NOW(), rate_sum = 160099, lot_id = 2, user_id = 1;


-- получение всех категорий

SELECT * FROM `categories`;

-- получить самые новые, открытые лоты.

SELECT lot_name, start_price, image, category_name, winner_id, rate_sum
    FROM lots 
    INNER JOIN categories
    ON category_id = categories.id

    LEFT JOIN rates 
    ON lots.id = rates.lot_id 
WHERE lots.winner_id IS NULL ORDER BY date_create;


-- получить лот по его id, так же название категории, к которой он принадлежит

SELECT lot_name, category_name
    FROM lots
    INNER JOIN categories
    ON lots.category_id = categories.id
WHERE lots.id = 1;

-- Обновить название лота по его id

UPDATE lots SET lot_name = 'Rossignol' WHERE lots.id = 2;

-- Получить список ставок для лота по его id с сортировкой по дате

SELECT rate_date, rate_sum, lot_name, user_name
    FROM rates
    INNER JOIN lots
    ON lot_id = lots.id

    INNER JOIN users
    ON rates.user_id = users.id
    WHERE lots.id = 2
ORDER BY rate_date;

