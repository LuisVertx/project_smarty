-- ==========================================
-- Project Blog SQL Dump
-- ==========================================

DROP DATABASE IF EXISTS project;

CREATE DATABASE project
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE project;

-- ==========================================
-- TABLES
-- ==========================================

CREATE TABLE categories
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    title VARCHAR(255) NOT NULL,

    description TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posts
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    image VARCHAR(255),

    title VARCHAR(255) NOT NULL,

    description TEXT,

    content LONGTEXT NOT NULL,

    views INT DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE post_category
(
    post_id INT NOT NULL,

    category_id INT NOT NULL,

    PRIMARY KEY(post_id, category_id),

    FOREIGN KEY(post_id)
        REFERENCES posts(id)
        ON DELETE CASCADE,

    FOREIGN KEY(category_id)
        REFERENCES categories(id)
        ON DELETE CASCADE
);

CREATE INDEX idx_posts_created
ON posts(created_at);

CREATE INDEX idx_posts_views
ON posts(views);

CREATE INDEX idx_post_category_post
ON post_category(post_id);

CREATE INDEX idx_post_category_category
ON post_category(category_id);

-- ==========================================
-- DATA
-- ==========================================

INSERT INTO categories
(id, title, description)
VALUES

(
1,
'PHP',
'Статьи по PHP и backend-разработке'
),

(
2,
'MySQL',
'Работа с базами данных MySQL'
),

(
3,
'Docker',
'Контейнеризация приложений'
);

INSERT INTO posts
(id, image, title, description, content, views, created_at)
VALUES

(
1,
'php.jpg',
'Основы PHP 8',
'Введение в современный PHP',
'PHP 8 значительно улучшил производительность языка и добавил множество современных возможностей. В этой статье рассматриваются ключевые изменения новой версии, типизация, атрибуты и рекомендации по написанию чистого кода.',
120,
'2026-07-01 10:00:00'
),

(
2,
'php.jpg',
'PDO и безопасные запросы',
'Работа с базой данных через PDO',
'PDO является стандартным способом взаимодействия PHP с различными СУБД. Использование подготовленных выражений защищает приложение от SQL-инъекций и делает код переносимым.',
350,
'2026-07-05 12:15:00'
),

(
3,
'php.jpg',
'MVC архитектура',
'Разделение логики приложения',
'Архитектура MVC разделяет приложение на модели, представления и контроллеры. Благодаря этому код становится проще поддерживать, тестировать и масштабировать.',
980,
'2026-07-10 09:30:00'
),

(
4,
'mysql.jpg',
'Индексы MySQL',
'Как ускорить запросы',
'Индексы существенно ускоряют поиск данных в таблицах. Однако неправильное использование индексов может привести к замедлению операций записи.',
740,
'2026-07-12 14:20:00'
),

(
5,
'mysql.jpg',
'JOIN запросы',
'Связи между таблицами',
'JOIN позволяет объединять данные сразу из нескольких таблиц. В статье рассматриваются INNER JOIN, LEFT JOIN и другие виды соединений.',
560,
'2026-07-15 16:10:00'
),

(
6,
'mysql.jpg',
'Оптимизация SQL',
'Повышение производительности базы',
'Оптимизация SQL-запросов начинается с анализа плана выполнения и правильного проектирования структуры базы данных.',
1250,
'2026-07-20 11:00:00'
),

(
7,
'docker.jpg',
'Docker для PHP',
'Первый PHP-контейнер',
'Docker позволяет быстро развернуть единое окружение разработки независимо от операционной системы разработчика.',
820,
'2026-07-18 15:00:00'
),

(
8,
'docker.jpg',
'Docker Compose',
'Управление сервисами проекта',
'Docker Compose позволяет запускать несколько связанных контейнеров одной командой, значительно упрощая разработку.',
1430,
'2026-07-22 13:40:00'
),

(
9,
'docker.jpg',
'Dockerfile',
'Создание собственных образов',
'Dockerfile описывает последовательность сборки собственного Docker-образа и позволяет автоматизировать процесс развертывания.',
670,
'2026-07-27 18:00:00'
);

INSERT INTO post_category
(post_id, category_id)
VALUES

(1,1),
(2,1),
(3,1),

(4,2),
(5,2),
(6,2),

(7,3),
(8,3),
(9,3);

-- ==========================================
-- END
-- ==========================================