

-- PHP: echo password_hash('123456789', PASSWORD_BCRYPT);
INSERT INTO `admins` (login_id, login_pw) VALUES ('admin', '$2y$10$H/4AD6Kt3m15LxUZr7aRkenyLTszqYAMrLyiFTeRCXgbZjZd7PG8C');
-- PHP: echo password_hash('123456789', PASSWORD_BCRYPT);
INSERT INTO `admins` (login_id, login_pw) VALUES ('q1-admin', '$2y$10$VnGhWpwhMOf8wCwHCi9Xa.ZS.gMSPlvTg6Qd8K63jQqxcYqQYGKY6');


-- お知らせカテゴリ
INSERT INTO news_categories (id, sort, label, slug) VALUES (1, 1, 'お知らせ', 'cat1');
INSERT INTO news_categories (id, sort, label, slug) VALUES (2, 2, '更新情報', 'cat2');
INSERT INTO news_categories (id, sort, label, slug) VALUES (3, 3, 'お客様の声', 'cat3');

-- サンプルお知らせ
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 1, 'お知らせサンプル001', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 2, 'お知らせサンプル002', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 3, 'お知らせサンプル003', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 1, 'お知らせサンプル004', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 2, 'お知らせサンプル005', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 3, 'お知らせサンプル006', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 1, 'お知らせサンプル007', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 2, 'お知らせサンプル008', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 3, 'お知らせサンプル009', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 1, 'お知らせサンプル010', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 2, 'お知らせサンプル011', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 3, 'お知らせサンプル012', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 1, 'お知らせサンプル013', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 2, 'お知らせサンプル014', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 3, 'お知らせサンプル015', 'test1\ntest2\ntest3\n');
INSERT INTO news (published_at, category_id, title, content) VALUES (CURRENT_TIMESTAMP, 1, 'コンテンツ確認', 'ダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。<br>文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。<br><br><br>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。<br>量、字間、行間等を確認するために入れています。この文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br><br><br>ダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br><br><br>行間等を確認するために入れています。文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。<br>文字を確認するために入れています。この文章はダミーです。<br>量、字間、行間等を確認するために入れています。');

-- サンプルお知らせ：URLリンク
INSERT INTO news (published_at, category_id, title, type, url) VALUES (CURRENT_TIMESTAMP, 1, 'リンクお知らせAAA', 'url', 'https://google.com');
INSERT INTO news (published_at, category_id, title, type, url, is_blank) VALUES (CURRENT_TIMESTAMP, 3, 'リンクお知らせBBB（別窓）', 'url', 'https://yahoo.jp', TRUE);

-- サンプルお知らせ：PDFリンク
INSERT INTO news (published_at, category_id, title, type, pdf_filename) VALUES (CURRENT_TIMESTAMP, 2, 'PDFお知らせ111', 'pdf', 'ほげほげ.pdf');
INSERT INTO news (published_at, category_id, title, type, pdf_filename, is_blank) VALUES (CURRENT_TIMESTAMP, 1, 'PDFお知らせ222（別窓）', 'pdf', 'ふげふげ.pdf', TRUE);
