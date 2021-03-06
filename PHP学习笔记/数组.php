<?php
/*
array()数组的声明
 */
function demo(){
	return array("one","two","three");
}

$arr=demo();
echo '<br>';

echo demo()[1];//不用调用函数赋值，直接加中括号索引
/*
switch用法
 */
1、里面的变量只允许整型和字符串
switch($floor){
	case 1:
	case 11:
	case 111:
	case 1111:
		echo "这是第一层<br>";
	break;

	case 2:
		echo "这是第二层<br>";
		break;
}
/*
for和foreach遍历数组
 */
/*
list(),each(),while循环遍历数组
 */
//list
$str="张三_李四";
list($name,$pro)=explode("_",$str);
echo $name.'<br>';
echo $pro.'<br>';
//each
1、返回的值是一个数组，有4个固定元素，而且下标也是固定的 1(值) value(值) 0(下标) key(下标)
2、只处理当前的元素，将当前的元素转为数组信息，处理完后，指针向下一个元素移动
3、如果指针已在结束位置，echo()将返回假
$arr=["one"=>"妹子","峰哥","第三者"];
while($tmp=each($arr)){
	print_r($tmp);
	echo '<br>';
}

$arr=["one"=>"妹子","峰哥","第三者"];
while(list($key,$val)=each($arr)){//虽然each的返回值里有四个元素，但是list只接受关联数组0,1.....，所以可以得到返回值和键
	echo "{$key}=>{$val}<br>";
}
/*
指针
 */
$arr=array("妹子","峰哥","观众","小四","地方");
echo "当前的位置，第一个:".key($arr)."=>".current($arr)."<br>";
next($arr);//指针下移
end($arr);//最后一个
prev($arr);//上一个
reset($arr);//回到最初位置
/*
超全局数组
 */
$_SERVER
$_ENV
$_GET//接受用户通过URL向服务器传的参数
$_POST//接受用户通过http协议向服务器传的参数
$_REQUEST//
$_FILES
$_COOKIE
$_SESSION
$GLOBALS
<a href="demo.php?action[]=add&action[]=mod&id=5&name=admin">测试页面</a>

<form action="demo.php?age=aaaaa" method="post">
	username:<input type="text" name="name[]"/><br>
	username:<input type="text" name="name[]"/><br>
	username:<input type="text" name="name[]"/><br>
	age:<input type="text" name="age"/><br>
	age:<input type="text" name="sex"/><br>
	<input type="submit" name="sub" value="提交">
</form>
$_GET和$_POST也可以传递数组
/*
数组的查询函数（键值操作）
 */
array_key_exists();//检查数组里是否有指定的键名或索引
isset();//检测变量是否已设置并且非 NULL 
array_keys();//返回数组中部分的或所有的键名 
in_array();//检查数组中是否存在某个值
array_search();//在数组中搜索给定的值，如果成功则返回首个相应的键名
array_flip();//交换数组中的键和值,有可能出现值相同，换过来键名相同的数组，那么后面的会覆盖前面的
array_reverse();//返回单元顺序相反的数组
1、isset()和 array_key_exists()的却别在于：
	$lamp=array("hello"=>null);
	isset($lamp);//将会返回假
	array_key_exists($lamp);//将会返回真
/*
统计元素个数和唯一性的函数
 */
count();//count($arr,1);计算子数组
array_count_values();//返回一个数组： 数组的键是 array 里单元的值； 数组的值是 array 单元的值出现的次数。
array_unique();//移除数组中重复的值
/*
array_filter()回调函数
 */
function myfun($value){
	if($value>=0)
		return true;
	else
		return false;
}
var_dump(array_filter($arr,"myfun"));

var_dump(array_filter($arr,function($value){
	return !($value%2==0);
}));
/*
array_walk()
 */
$arr=array(1,2,3,4,5);
function myfun(&$value){
	$value=$value*$value;
}
array_walk($arr,"myfun");
/*
array_map()
 */
$brr=array("one","two","three","five");
$arr=array(1,2,3,4,5);
function myfun($v,$bv){
	return $v*$v*$v;
}
$rarr=array_map("myfun",$arr,$brr);
/*
PHP中的冒泡
 */
$arr=array(0,1,2,3,4,5,6,7,8,9);
//从大到小的排序
$len=count($arr);
for($i=0;$i<$len-1;$i++){
	for($j=0;$j<$len-1-$i;$j++){
		if($arr[$j]<$arr[$j+1]){
			$tmp=$arr[$j];
			$arr[$j]=$arr[$j+1];
			$arr[$j+1]=$tmp;
		}
	}
}
/*
数组的拆分、合并、分解与结合
 */
array_slice();//取出一段数组
array_splice();//删除一段数组，并用其他取代
array_combine();//创建一个数组，用一个数组的值作为其键名，另一个数组的值作为其值
array_merge();//合并一个或多个数组
array_intersect(array1, array2)//计算数组的交集
array_diff()//计算数组的差集
$a=array("a","b","c");
$b=array(10,11,12);

$c=$a+$b;
var_dump($c);//下标相同会覆盖

/*
数组与数据结构
 */
array_push();//压入栈，后进先出
array_pop();//弹出
array_unshift();//排队的形式，后进后出
array_shift();//排队的形式，后进先出

array_rand();//随机出来一个下标
shuffle();//随机打乱数组
array_sum();//计算数组的和
range();
array_fill();