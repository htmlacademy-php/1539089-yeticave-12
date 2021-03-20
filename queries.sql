-- Добавление существующего списка категорий

INSERT INTO categories (category_name, symbol_code)
VALUES ('Доски и лыжи', 'boards'),
       ('Крепления', 'attachment'),
       ('Ботинки', 'boots'),
       ('Одежда', 'clothing'),
       ('Инструменты', 'tools'),
       ('Разное', 'other');


-- добавление пользователей

INSERT INTO users (email, registration_date, user_contact, user_name, user_password)
VALUES ('sj@groove.com', NOW(), '88005555535', 'sjfromgroove', '12345'),
       ('tykva@gmail.com', NOW(), 'https://t.me/sakh_TopSecret', 'tykva', '12345');

-- добавление существующего списка лотов

INSERT INTO lots (author_id, category_id, date_create, date_dead, description, image, lot_name, rate_step, start_price, winner_id)
VALUES (1, 1,  NOW(), DATE_ADD(curdate(), INTERVAL 1 MONTH), 'doska', 'img/lot-1.jpg', '2014 Rossignol District Snowboard', 100, 10999, 2),
       (2, 1,  NOW(), DATE_ADD(curdate(), INTERVAL 1 MONTH), 'doska', 'img/lot-2.jpg', 'DC Ply Mens 2016/2017 Snowboard', 100, 159999, NULL),
       (1, 2,  NOW(), '2021-03-19 00:00:00', 'krepi', 'img/lot-3.jpg', 'Крепления Union Contact Pro 2015 года размер L/XL', 100, 8000, NULL),
       (2, 3,  NOW(), DATE_ADD(curdate(), INTERVAL 1 MONTH), 'boty', 'img/lot-4.jpg', 'Ботинки для сноуборда DC Mutiny Charocal', 100, 10999, 2),
       (1, 4,  NOW(), DATE_ADD(curdate(), INTERVAL 1 MONTH), 'kurtka', 'img/lot-5.jpg', 'Куртка для сноуборда DC Mutiny Charocal', 100, 7500, 2),
       (2, 6,  NOW(), DATE_ADD(curdate(), INTERVAL 1 MONTH), 'ochki', 'img/lot-6.jpg', 'Маска Oakley Canopy', 100, 5400, 1);

-- добавление ставок


INSERT INTO rates (rate_date, rate_sum, lot_id, user_id)
VALUES (NOW(), 11099, 1, 2),
       (NOW(), 160099, 2, 1),
       (NOW(), 160199, 2, 1); 


-- получение всех категорий

SELECT * FROM `categories`;

-- получить самые новые, открытые лоты.

SELECT lot_name, start_price, image, category_name, rate_sum
    FROM lots 
    INNER JOIN categories
    ON category_id = categories.id
    LEFT JOIN rates 
    ON rates.id = (
        SELECT ra.id
        FROM rates ra
        WHERE ra.lot_id = lots.id
        ORDER BY ra.rate_sum DESC LIMIT 1
)
WHERE lots.winner_id IS NULL AND date_dead > NOW() ORDER BY date_create;


-- получить лот по его id, так же название категории, к которой он принадлежит

SELECT lot_name, date_create, date_dead, description,image, rate_step, start_price, author_id, winner_id, category_name
    FROM lots
    INNER JOIN categories
    ON lots.category_id = categories.id
WHERE lots.id = 1;

-- Обновить название лота по его id

UPDATE lots SET lot_name = 'Rossignol' WHERE lots.id = 2;

-- Получить список ставок для лота по его id с сортировкой по дате

SELECT rate_date, rate_sum
    FROM rates
    WHERE rates.lot_id = 2
ORDER BY rate_date;

