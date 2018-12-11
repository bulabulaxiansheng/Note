<?php
1、面向对象是以功能来划分问题，而不是步骤（也就是说执行的计划和功能是分开的，功能是对象，我想用的时候就调用它）。
2、class BoyFriend{
	//变量（成员属性）
	public $name="gaoluofeng";//在类的成员属性前面必须有修饰词，如果不知道是用什么修饰词，就使用var
	public $age=24;
	public $sex="男";
	//函数（成员方法）
	function doFan(){
		return "做饭功能";
	}

	function doJw(){
		return "做家务的功能";
	}
}
3、实例化对象
  $bf1=new BoyFriend();
  $bf2=new BoyFriend();
  访问类里的属性和方法
  echo $bf1->sex."<br>";
  echo $bf2->height."<br>";
  给类里的属性赋值
  $bf1->name="张三";
  $bf2->name="李四";
4、对象里的方法调用自己的属性和方法时，只能用$this->name或