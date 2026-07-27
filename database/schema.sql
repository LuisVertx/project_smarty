CREATE DATABASE IF NOT EXISTS project
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE project;

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