/*
创建数据库
 */
CREATE DATABASE t1;
SHOW WARNINGS;//显示数据库警告的原因
SHOW CREATE DATABASE t1;//查看数据库t1的编码方式
CREATE DATABASE IF NOT EXISTS t2 CHARACTER SET gbk;
/*
数据库修改
 */
ALTER DATABASE t2 CHARACTER SET utf8;//更改t2数据库的编码为utf8
/*
删除数据库
 */
DROP DATABASE t1;//删除t1数据库
SHOW DATABASE;//查询存在的数据库
/*
数据类型
 */
整型
TINYINT
SMALLINT
MEDIUMINT
INT
BIGINT
浮点型
FLOAT
DOUBLE
日期时间
YEAR
TIME
DATE
DATETIME
TIMESTAMP
/*
约束
 */
UNIQUE KEY
唯一约束
唯一约束可以保证记录的唯一性
唯一约束的字段可以为空值(NULL)
每张数据表可以存在多个唯一约束
/*
默认约束
 */
default