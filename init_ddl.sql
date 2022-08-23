-- Project Name : sample
-- Date/Time    : 2022/08/24 6:15:25
-- Author       : kazaoki
-- RDBMS Type   : MySQL
-- Application  : A5:SQL Mk-2

/*
  << 注意！！ >>
  BackupToTempTable, RestoreFromTempTable疑似命令が付加されています。
  これにより、drop table, create table 後もデータが残ります。
  この機能は一時的に $$TableName のような一時テーブルを作成します。
  この機能は A5:SQL Mk-2でのみ有効であることに注意してください。
*/

-- お知らせ
--* BackupToTempTable
drop table if exists `ag-news` cascade;

--* RestoreFromTempTable
create table `ag-news` (
  id int(11) auto_increment not null comment 'ID'
  , created_at timestamp default CURRENT_TIMESTAMP not null comment '作成日時'
  , updated_at datetime default NULL comment '更新日時'
  , deleted_at datetime comment '削除日時'
  , status smallint(2) default 1 not null comment '状態'
  , published_at datetime not null comment '公開日時'
  , title text not null comment 'タイトル'
  , content text comment '本文'
  , category_id int(11) not null comment 'カテゴリID'
  , type enum('entry','pdf','url') default 'entry' not null comment '記事タイプ'
  , url text comment 'リンク先URL'
  , is_blank boolean comment 'リンク先は別窓か:記事タイプが pdf または url のとき時のみ有効'
  , pdf_filename text comment 'アップロードPDFファイル名'
  , constraint `ag-news_PKC` primary key (id)
) comment 'お知らせ' ;

create index status
  on `ag-news`(status);

-- お知らせカテゴリ
--* BackupToTempTable
drop table if exists `ag-news_categories` cascade;

--* RestoreFromTempTable
create table `ag-news_categories` (
  id int(11) auto_increment not null comment 'ID'
  , created_at timestamp default CURRENT_TIMESTAMP not null comment '作成日時'
  , updated_at datetime default NULL comment '更新日時'
  , deleted_at datetime comment '削除日時'
  , status smallint(2) default 1 not null comment '状態'
  , sort smallint not null comment 'ソート'
  , label text not null comment 'ラベル'
  , slug varchar(32) not null comment 'スラッグ'
  , constraint `ag-news_categories_PKC` primary key (id)
) comment 'お知らせカテゴリ' ;

create index status
  on `ag-news_categories`(status);

-- ログインセッション
--* BackupToTempTable
drop table if exists `ag-login_sessions` cascade;

--* RestoreFromTempTable
create table `ag-login_sessions` (
  id int(11) auto_increment not null comment 'ID'
  , created_at timestamp default CURRENT_TIMESTAMP not null comment '作成日時'
  , updated_at datetime default NULL comment '更新日時'
  , status smallint(2) default 1 not null comment '状態'
  , login_id VARCHAR(32) comment 'ログインID'
  , access_ip text comment 'アクセスIP'
  , session_id char(32) comment 'セッションID'
  , constraint `ag-login_sessions_PKC` primary key (id)
) comment 'ログインセッション' ;

create index status
  on `ag-login_sessions`(status);

-- 管理者
--* BackupToTempTable
drop table if exists `ag-admins` cascade;

--* RestoreFromTempTable
create table `ag-admins` (
  id int(11) auto_increment not null comment 'ID'
  , created_at timestamp default CURRENT_TIMESTAMP not null comment '作成日時'
  , updated_at datetime default NULL comment '更新日時'
  , status smallint(2) default 1 not null comment '状態'
  , login_id VARCHAR(32) not null comment 'ログインID'
  , login_pw VARCHAR(255) not null comment 'ログインパスワード'
  , constraint `ag-admins_PKC` primary key (id)
) comment '管理者' ;

create index status
  on `ag-admins`(status);

create unique index login_id
  on `ag-admins`(login_id);

