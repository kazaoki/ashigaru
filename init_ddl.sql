-- Project Name : sample
-- Date/Time    : 2021/08/23 17:09:38
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

-- ログインセッション
--* BackupToTempTable
drop table if exists login_sessions cascade;

--* RestoreFromTempTable
create table login_sessions (
  id int(11) auto_increment not null comment 'ID'
  , created_at timestamp default CURRENT_TIMESTAMP not null comment '作成日時'
  , updated_at datetime default NULL comment '更新日時'
  , status smallint(2) default 1 not null comment '状態'
  , login_id VARCHAR(32) comment 'ログインID'
  , access_ip text comment 'アクセスIP'
  , session_id char(32) comment 'セッションID'
  , constraint login_sessions_PKC primary key (id)
) comment 'ログインセッション' ;

create index status
  on login_sessions(status);

-- 管理者
--* BackupToTempTable
drop table if exists admins cascade;

--* RestoreFromTempTable
create table admins (
  id int(11) auto_increment not null comment 'ID'
  , created_at timestamp default CURRENT_TIMESTAMP not null comment '作成日時'
  , updated_at datetime default NULL comment '更新日時'
  , status smallint(2) default 1 not null comment '状態'
  , login_id VARCHAR(32) not null comment 'ログインID'
  , login_pw VARCHAR(255) not null comment 'ログインパスワード'
  , constraint admins_PKC primary key (id)
) comment '管理者' ;

create index status
  on admins(status);

create unique index login_id
  on admins(login_id);

