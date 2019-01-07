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
-- 创建表时，设置表、字段编码
/*
显示数据表的结构
 */
describe tdb_goods;
--
use dbtest;
drop table if exists tbtest;
create table tbtest(
id int(10) auto_increment,
user_name varchar(60) CHARACTER SET GBK COLLATE gbk_chinese_ci,
email varchar(60),
PRIMARY key(id)
)CHARACTER SET utf8 COLLATE utf8_general_ci;
-- 修改数据库编码
alter database dbtest CHARACTER SET GBK COLLATE gbk_chinese_ci;
alter database dbtest CHARACTER SET utf8 COLLATE utf8_general_ci;
-- 修改表编码
alter table tbtest character set utf8 COLLATE utf8_general_ci;
-- 修改字段编码
ALTER TABLE tbtest MODIFY email VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci;
-- 查看所有的字符编码
SHOW CHARACTER SET;
-- 查看创建数据库的指令并查看数据库使用的编码
show create database dbtest;
-- 创建数据库时,设置数据库的编码方式 
-- CHARACTER SET:指定数据库采用的字符集,utf8不能写成utf-8
-- COLLATE:指定数据库字符集的排序规则,utf8的默认排序规则为utf8_general_ci（通过show character set查看）
drop database if EXISTS dbtest;
create database dbtest CHARACTER SET utf8 COLLATE utf8_general_ci;
--
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
/*
外键约束
 */
保持数据一致性，完整性
实现一对一或一对多关系
要求：
父表和子表必须使用相同的存储引擎，而且禁止使用临时表
数据表的存储引擎只能是InnoDB
外键和参照列必须具有相似的数据类型。其中数字的长度或是否有符号位必须相同；而字符长度可以不同
外键列和参照列必须创建索引。如果外键列不存在索引的话，MYSQL将自动创建索引
例如：
mysql>CREATE TABLE provinces(
	->id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	->pname VARCHAR(20) NOT NULL
);

mysql>CREATE TABLE users(
	->id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	->username VARCHAR(10) NOT NULL,
	->pid SMALLINT UNSIGNED,
	->FROEIGN KEY (pid) REFERENCES provinces (id)//创建pid参照provinces的省份
);

/*
外键约束的参照操作
 */
1.CASCADE 从父表删除或更新且自动删除或更新子表中匹配的行
2.SET NULL 从父表删除或更新行，并设置子表中的外键列为NULL。如果使用该选项，必须保证子表列没有指定NOT NULL
3.RESTRICT 拒绝对父表的删除或更新操作
4.NO ACTION 标准SQL的关键字，在MySQL中与RESTRICT相同
/*
添加单列
 */
ALTER TABLE users1 ADD  age TINYINT UNSIGNED NOT NULL DEFAULT 10;//在数据表中添加一个列
ALTER TABLE users1 ADD  password TINYINT UNSIGNED NOT NULL AFTER username;//在username这一列后加入password
ALTER TABLE user1 DROP password;

/*
插入语句
 */
INSERT user VALUES();
INSERT user SET col_name;
INSERT user SELECT ......;
/*
更新记录
 */
单表更新
UPDATE users SET age=age+5;//更新表中所有的年龄加5
UPDATE users SET age=age-id,sex=0;
UPDATE users SET age=age+10 WHERE id%2=0;//id为偶数的年龄都加10
/*
删除操作
 */
DELETE FROM users WHERE id=6;
/*
查询表达式
 */
查询字段的顺序会影响结果集的顺序，别名会影响结果集的别名
SELECT id,username FROM users;
SELECT users.id,users.username FROM users;
SELECT id AS userId,username AS uname FROM users;
/*
WHERE语句进行查询
 */

/*
GROUP BY分组
 */
SELECT sex FROM users GROUP BY sex; //按性别进行分组，只有两个结果0，null
/*
分组条件HAVING
 */
SELECT sex,age FROM users GROUP BY 1 HAVING age>35;//条件语句出现age，那么SELECT语句中也必须出现age，除非存在聚合函数
SELECT sex FROM users GROUP BY 1 HAVING count(id)>=2;
/*
分组结果进行排序ORDER BY
 */
SELECT * FROM users ORDER BY id DESC;//根据id进行降序排列
SELECT * FROM users ORDER BY age,id DESC;//根据age默认升序排列，如果age相同，则通过id将序排列
/*
限制记录返回的数量LIMIT
 */
SELECT * FROM users LIMIT 2;
SELECT * FROM users LIMIT 2,2;//记录从2开始选2条
SELECT * FROM users ORDER BY id DESC LIMIT 2,2;
/*
将查询的结果插入数据表INSERT user SELECT ......
 */
mysql->CREATE TABLE test(
	->id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	->username VARCHAR(20)
);
INSERT test(username) SELECT username FROM users WHERE age>=30;
/*
子查询
 */
子查询指嵌套在查询内部，且必须始终出现在圆括号内。
子查询可以包含多个关键字或条件，如DISTINCT,GROUP BY,ORDER BY,LIMIT,函数等
子查询的外层查询可以是:SELECT,INSERT,UPDATE,SET,或DO。
子查询可以返回标量、一行、一列或子查询
/*
比较运算符子查询
 */
SELECT AVG(goods_price) FROM tdb_goods;//查询价格的平均值
SELECT ROUND(AVG(goods_price),2) FROM tdb_goods;//价格四舍五入，保留小数点后两位
SELECT goods_id,goods_name,goods_price FROM tdb_goods WHERE goods_price>=5636.36;
//上面两个语句合并在一起进行子查询
SELECT goods_id,goods_name,goods_price FROM tdb_goods WHERE goods_price>=(SELECT ROUND(AVG(goods_price),2) FROM tdb_goods);
//查询超极本的价格
SELECT goods_price FROM tdb_goods WHERE goods_cate='超极本';
//查询那些商品的价格大于这些超极本
/*
ANY大于或小于任何一个数都行,等于任意值，ALL大于最大值，小于最小值，不等于任意值，SOME和ANY一样
 */
SELECT goods_id,goods_name,goods_price FROM tdb_goods WHERE (ALL(SELECT goods_price FROM tdb_goods WHERE goods_cate='超极本'));
/*
使用[NOT]IN的子查询
 */
=ANY运算符与IN等效
!=ALL或<>ALL运算符与NOT IN等效;
/*
使用[NOT] EXISTS的子查询
 */
如果子查询返回任何行，EXISTS将返回TRUE;否则为FALSE
/*
使用INSERT...SELECT插入记录
 */
SELECT goods_cate FROM tdb_goods GROUP BY goods_cate;//查询商品分类的名字
//商品分类插入另外一个表
INSERT INTO tdb_goods_cates(cate_name) SELECT goods_cate FROM tdb_goods GROUP BY goods_cate;
/*
多表更新
 */
多表更新要进行连接
UPDATE tdb_goods INNER JOIN tdb_goods_cates ON goods_cate=cate_name SET goods_cate=cate_id;
/*
CREATE...SELECT
 */
SELECT brand_name FROM tdb_goods GROUP BY brand_name;
CREATE TABLE tdb_goods_brands(
	brand_id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	brand_name VARCHAR(40) NOT NULL
)SELECT brand_name FROM tdb_goods GROUP BY brand_name;
UPDATE tdb_goods INNER JOIN tdb_goods_brands ON brand_name=brand_name SET brand_name=brand_id;//这样不行，brand_name含义迷糊不清
UPDATE tdb_goods AS g INNER JOIN tdb_goods_brands AS b ON g.brand_name=b.brand_name SET g.brand_name=b.brand_id;
/*
修改表的结构
 */
ALTER TABLE tdb_goods CHANGE goods_cate cate_id SMALLINT UNSIGNED NOT NULL,
CHANGE brand_name brand_id SMALLINT UNSIGNED NOT NULL;
/*
将商品代表的数字由文字表示出来
 */
内连接INNER JOIN
SELECT goods_id,goods_name,cate_name FROM tdb_goods INNER JOIN tdb_goods_cates ON tdb_goods.cate_id=tdb_goods_cates.cate_id;
外链接OUTER JOIN
SELECT goods_id,goods_name,cate_name FROM tdb_goods LEFT OUTER JOIN tdb_goods_cates ON tdb_goods.cate_id=tdb_goods_cates.cate_id;
右外链接
SELECT goods_id,goods_name,cate_name FROM tdb_goods RIGHT OUTER JOIN tdb_goods_cates ON tdb_goods.cate_id=tdb_goods_cates.cate_id;
/*
三张表做链接
 */
SELECT goods_id,goods_name,cate_name,brand_name,goods_price FROM tdb_goods AS G INNER JOIN tdb_goods_cates AS c ON g.cate_id=c.cate_id INNER JOIN tdb_goods_brands AS b ON g.brand_id=b.brand_id;
/*
无限极分类表设计
 */
//数据表自身连接
SELECT s.type_id,s.type_name,p.type_name FROM tdb_goods_types AS s LEFT JOIN tdb_goods_types AS p ON s.parent_id=p.type_id;
SELECT p.type_id,p.type_name,s.type_name FROM tdb_goods_types AS p LEFT JOIN tdb_goods_types AS s ON s.parent_id=p.type_id;
SELECT p.type_id,p.type_name,s.type_name FROM tdb_goods_types AS p LEFT JOIN tdb_goods_types AS s ON s.parent_id=p.type_id GROUP BY p.type_name ORDER BY p.type_id;
SELECT p.type_id,p.type_name,count(s.type_name) child_name FROM tdb_goods_types AS p LEFT JOIN tdb_goods_types AS s ON s.parent_id=p.type_id GROUP BY p.type_name ORDER BY p.type_id;
/*
多表的删除
 */
SELECT goods_id,goods_name FROM tdb_goods GROUP BY goods_name HAVING count(goods_name)>=2;
DELETE t1 FROM tdb_goods AS t1 LEFT JOIN (SELECT goods_id,goods_name FROM tdb_goods GROUP BY goods_name HAVING count(goods_name)>=2) AS t2 ON t1.goods_name=t2.goods_name WHERE t1.goods_id>t2.goods_id;
/*
字符函数
 */
--CONCAT字符连接
将两个字段的信息连接在一起
SELECT CONCAT(first_name,last_name) AS fullname FROM test;
--CONCAT_WS()使用指定的分隔符进行字符连接
SELECT CONCAT_WS('|','A','B','C');
--FORMAT数字格式化
SELECT FORMAT(12560.75,2);
--LOWER()将字符转化为小写
SELECT LOWER('MySQL');
--UPPER()将字符转换为大写
LEFT('MySQL',2)--获取字符串的前2个字符
RIGHT('MySQL',2)--获取后两个字符
LENGTH()--获取字符串的长度
LTRIM()--删除字符左边的空格
RTRIM()--删除字符右边的空格
TRIM()--删除字符两边的空格
SELECT TRIM(LEADING '?' FROM '??MySQL???');--删除??MySQL???前边的?号
SELECT TRIM(TRAILING '?' FROM '??MySQL???');--删除??MySQL???后边的?号
SELECT TRIM(BOTH '?' FROM '??MySQL???');--删除??MySQL???两边的?号
--删除中间的?
SELECT REPLACE('??My??SQL???','?','');替换?都为空字符串
--SUBSTRING截取字符串
SELECT SUBSTRING('MySQL',3);
--LIKE
SELECT * FROM test WHERE first_name LIKE '%o%';
--告诉1后边的%不需要通配符解析了
SELECT * FROM test WHERE first_name LIKE '%1%%' ESCAPE '1';
--%代表的是任意字符，_代表的是任意一个字符
/*
数值运算符函数
 */
--CEIL()向上取整
--FLOOR()向下取整
--DIV 整数除法
--MOD 取余数
--POWER(3,3) 3的3次方
--ROUND(3.652,2)保留小数点后两位
--TRUNCATE(125.89,1) 输出125.8
--BETWEEN...AND... 
SELECT 15 BETWEEN 1 AND 22;
SELECT 35 NOT BETWEEN 1 AND 22;
--IN()
SELECT 10 IN(5,10,15,20);
SELECT 10 NOT IN(5,10,15,20);
--NULL
SELECT '' IS NULL;
SELECT 0 IS NULL;
SELECT * FROM test WHERE first_name IS NULL;
/*
日期时间函数
 */
--NOW()当前日期和时间
SELECT NOW();
--CURDATE()当前日期
SELECT CURDATE();
--CURTIME()当前时间
SELECT CURTIME();
--DATE_ADD()日期变化
SELECT DATE_ADD('2014-3-12',INTERVAL 365 DAY);加365天
SELECT DATE_ADD('2014-3-12',INTERVAL -365 DAY);减365天
SELECT DATE_ADD('2014-3-12',INTERVAL 1 YEAR);加1年
SELECT DATE_ADD('2014-3-12',INTERVAL 3 WEEK);加一个星期
--DATEDIFF()日期差值
SELECT DATEDIFF('2013-3-12','2014-3-12');两个日期相差多少天
--DATE_FORMAT()日期格式化
SELECT DATE_FORMAT('2014-3-12','%m/%d/%Y');
/*
信息函数
 */
--CONNECTION_ID() 连接ID
SELECT CONNECTION_ID();
--DATEBASE() 当前数据库
SELECT DATEBASE();
--LAST_INSERT_ID()最后插入的id
SELECT LAST_INSERT_ID();
--USER() 当前用户
--VERSION()版本信息