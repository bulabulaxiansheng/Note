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
  1、private 私有化封装函数,外面就不能调用，但对象中的其他成员可以使用
  2、属性的封装比方法的封装还有用
  3、可以用方法中的过程来改变成员属性，就好比如给手机充电，需要特定的电压和电流
  4、封装的魔术方法 __get(),__set(),__isset(),__unset()

    __get() 直接访问私有属性时，直接调用，不是私有属性不直接调用，一个参数
    class Person{
  	//成员属性
  	private $name;
  	private $age;
  	private $sex;

  	//构造方法
  	function __construct($name="",$age=0,$sex="男"){
  		$this->name=$name;
  		$this->age=$age;
  		$this->sex=$sex;
  	}
  	function __get($pro){
  		echo "******************";
  		return $this->$pro;//调用私有属性时，自动调用这个函数，相当于$this->name,$this->age,$this->sex;相当于得到了私有属性
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
  echo $p1->name."<br>";输出*****************
  echo $p1->age."<br>";输出*****************
  echo $p1->sex."<br>";输出****************

  __set()是在直接设置私有属性时直接自动调用，两个参数 
   class Person{
  	//成员属性
  	private $name;
  	private $age;
  	private $sex;

  	//构造方法
  	function __construct($name="",$age=0,$sex="男"){
  		$this->name=$name;
  		$this->age=$age;
  		$this->sex=$sex;
  	}
  	function __get($pro){
  		echo "******************";
  		return $this->$pro;//调用私有属性时，自动调用这个函数，相当于$this->name,$this->age,$this->sex;相当于得到了私有属性
  	}
  	function __set($name,$value){
  		$this->$name=$value;
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
  $p1=new Person("妹子"，88，"女");
  $p1->name="张三";
  $p1->age=18;
  $p1->sex="女";//设置值，自动调用__set()，改变私有属性
  echo $p1->name."<br>";输出*****************
  echo $p1->age."<br>";输出*****************
  echo $p1->sex."<br>";输出****************
  
  __set()的应用实例
  function __set($name,$value){
  	if($name=="age"){
  		if($value<0||$value>100){
  			return;
  		}
  	}
  }
 5、__isset()和__unset()的使用
  class Person{
  	//成员属性
  	private $name;
  	private $age;
  	private $sex;

  	//构造方法
  	function __construct($name="",$age=0,$sex="男"){
  		$this->name=$name;
  		$this->age=$age;
  		$this->sex=$sex;
  	}
  	function __isset($proname){
  		echo "########";
  		if($proname=="age"){
  			return false;
  		}//不能判断年龄是否存在
  		return isset($this->$proname);
  	}//判断一个私有属性是否存在是，自动调用这个方法
  	function __unset($proname){
  		if($proname!=="age"){
  			unset($this->$proname);
  		}
  	}//删除一个私有属性时，自动调用unset
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
  $p1=new Person("妹子"，88，"女");
  unset($p1->name);
  if(isset($p1->name)){
  	echo "这个对象中的name是存在的属性<br>";
  }else{
  	echo "对象p1中不存在name属性";
  }
  /*
  PHP类的继承
   */
  1、子类使用extends继承父类，可以把父类的所有属性都继承过来
    private 属性是私有的，只能自己用，子类不能使用
    protected 这个是保护权限，只能自己和子类用，外边不能用
    public 公开权限，都可以用
    class Person{
    var $name;
    var $age;
    var $sex;

    function __construct($name,$age,$sex){
    	$this->name=$name;
    	$this->age=$age;
    	$this->sex=$sex;
    }

    function say(){
    	echo "我的名字是：{},我的年龄是：{},我的性别是：{}";
    }

    function eat(){

    }

    function run(){

    }
  }
    class Student extends Person{
  	/*var $name;
  	var $age;
  	var $sex;*/
  	var $school;

  	/*function __construct(){

  	}

  	function say(){

  	}

  	function eat(){

  	}

  	function run(){

  	}

  	function student(){

  	}*/
  }

    class Teacher extends Student{
    /*var $name;
    var $age;
    var $sex;*/
    var $company;
    
    /*function __construct(){

    }

    function say(){

    }

    function eat(){

    }

    function run(){

    }

    function teach(){

    }*/
  }