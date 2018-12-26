<?php
strlen();//统计字符串长度
字符串可以像数组一样，通过下标来访问每个字符，但不是数组
$str="hello";
echo $str[0].$str[1]."<br>";
echo $str{0}.$str{1}."<br>";
/*
字符串的截取
 */
$str="hello world";
$str1="妹子你好";

echo substr($str,0,7)."<br>";//处理单字节的
echo mb_substr($str1,0,7,"utf-8")."<br>";//处理多字节的
