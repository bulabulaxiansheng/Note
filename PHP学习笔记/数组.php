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