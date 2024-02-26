
-- PHP: echo password_hash('123456789', PASSWORD_BCRYPT);
TRUNCATE TABLE `ag-admins`;
INSERT INTO `ag-admins` (login_id, login_pw) VALUES ('admin', '$2y$10$H/4AD6Kt3m15LxUZr7aRkenyLTszqYAMrLyiFTeRCXgbZjZd7PG8C');

-- お知らせカテゴリ
TRUNCATE TABLE `ag-news_categories`;
INSERT INTO `ag-news_categories` (id, sort, label, slug) VALUES (1, 1, 'お知らせ', 'cat1');
INSERT INTO `ag-news_categories` (id, sort, label, slug) VALUES (2, 2, '更新情報', 'cat2');
INSERT INTO `ag-news_categories` (id, sort, label, slug) VALUES (3, 3, 'お客様の声', 'cat3');

-- サンプルお知らせ
TRUNCATE TABLE `ag-news`;
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL 15 DAY, 1, 'お知らせサンプル001', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL 14 DAY, 2, 'お知らせサンプル002', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL 13 DAY, 3, 'お知らせサンプル003', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL 12 DAY, 1, 'お知らせサンプル004', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL 11 DAY, 2, 'お知らせサンプル005', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL 10 DAY, 3, 'お知らせサンプル006', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  9 DAY, 1, 'お知らせサンプル007', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  8 DAY, 2, 'お知らせサンプル008', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  7 DAY, 3, 'お知らせサンプル009', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  6 DAY, 1, 'お知らせサンプル010', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  5 DAY, 2, 'お知らせサンプル011', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  4 DAY, 3, 'お知らせサンプル012', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  3 DAY, 1, 'お知らせサンプル013', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  2 DAY, 2, 'お知らせサンプル014', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  1 DAY, 3, 'お知らせサンプル015', 'test1<br>test2<br>test3<br>');
INSERT INTO `ag-news` (published_at, category_id, title, content) VALUES (CURRENT_DATE - INTERVAL  0 DAY, 1, 'コンテンツ確認', 'ダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。<br>文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。<br><br><br>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。<br>量、字間、行間等を確認するために入れています。この文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br><br><br>ダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br><br><br>行間等を確認するために入れています。文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。<br>文字を確認するために入れています。この文章はダミーです。<br>量、字間、行間等を確認するために入れています。');

-- サンプルお知らせ：URLリンク
INSERT INTO `ag-news` (published_at, category_id, title, type, url) VALUES (CURRENT_DATE, 1, 'リンクお知らせAAA', 'url', 'https://google.com');
INSERT INTO `ag-news` (published_at, category_id, title, type, url, is_blank) VALUES (CURRENT_DATE, 3, 'リンクお知らせBBB（別窓）', 'url', 'https://yahoo.jp', TRUE);

-- サンプルお知らせ：PDFリンク
INSERT INTO `ag-news` (published_at, category_id, title, type, pdf_filename) VALUES (CURRENT_DATE, 2, 'PDFお知らせ111', 'pdf', 'ほげほげ.pdf');
INSERT INTO `ag-news` (published_at, category_id, title, type, pdf_filename, is_blank) VALUES (CURRENT_DATE, 1, 'PDFお知らせ222（別窓）', 'pdf', 'ふげふげ.pdf', TRUE);
