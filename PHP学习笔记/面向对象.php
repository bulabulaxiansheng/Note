<?php
/*
面向对象的基础，对象的实例化，$this的运用，function __construct和function __destruct魔术函数的运用
 */
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
4、对象里的方法调用自己的属性和方法时，只能用$this->name或$this->doJw()
5、构造方法
  对象创建之后，第一个自动调用的方法
  方法名称比较特殊，可以和类名相同名的方法
  class BoyFriend{
	//变量（成员属性）
	public $name="gaoluofeng";//在类的成员属性前面必须有修饰词，如果不知道是用什么修饰词，就使用var
	public $age=24;
	public $sex="男";
	//析构方法
	function __construct($name,$age,$sex="男"){
		$this->name=$name;
		$this->age=$age;
		$this->sex=$sex;
	}
	//函数（成员方法）
	function doFan(){
		return "{$this->name}有做饭功能";
	}

	function doJw(){
		return "{$this->name}有做家务的功能";
	}
}
  $bf1=new BoyFriend("张三",28,"男");
  echo $bf1->doFan;

6、析构方法
  $bf1=null;释放对象
  function __destruct(){

  }//对象被释放后最后调用的方法，例如关闭文件，释放结果集
7、复习
  class Person{
  	//成员属性
  	var $name;
  	var $age;
  	var $sex;

  	//构造方法
  	function __construct($name="",$age=0,$sex="男"){
  		$this->name=$name;
  		$this->age=$age;
  		$this->sex=$sex;
  	}
  	//成员方法
  	function say(){
  		echo "我的名字是：{$this->name}.我的年龄是：{$this->age}.我的性别是：{$this->sex}.<br>";
  	}
  	function run(){

  	}
  	function eat(){

  	}
  	//析构方法
  	function __destruct(){
  		echo "再见:{$this->name}<br>";
  	}
  }
  $p1=new Person("妹子",20,"女");
  echo $p1->name;
  $p1->say();
  /*
  面向对象的封装
   */
  1、