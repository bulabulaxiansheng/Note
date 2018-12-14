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
  	}//判断一个私有属性是否存在，自动调用这个方法
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
 2、继承中的重载（覆盖）
   在子类中可以写和父类同名的方法

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
  	var $school;
  	//这个方法可以覆盖父类同名名的方法
  	function say(){
  		$this->say();//用这个调用父类的方法产生递归死循环
  		Person::say();//如果父类的名称变了就不好了
  		parent::say();//用这个访问父类被覆盖的方法
  		echo "我所在的学校：{$this->school}<br>";
  	}
  }

  子类想要覆盖父类的构造方法时，为了使子类构造方法的参数随着父类构造方法的改变而改变，要在子类中重新调用一下父类的构造方法
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
  /*
     重点
   */
  class Student extends Person{
  	var $school;
  	function __construct($name,$age,$sex,$school){
  		parent::__construct($name,$age,$sex);
  		$this->school=$school;
  	}
  	//这个方法可以覆盖父类同名名的方法
  	function say(){
  		$this->say();//用这个调用父类的方法产生递归死循环
  		Person::say();//如果父类的名称变了就不好了
  		parent::say();//用这个访问父类被覆盖的方法
  		echo "我所在的学校：{$this->school}<br>";
  	}
  }
  子类只能大于或等于父类的权限，不能小于
3、面向对象常见关键字
  instanceof 判断对象属不属于某各类
  final 在PHP不定义常量，不能修饰成员属性
  可以修饰类————这个类不能去扩展，不能有子类
  可以修饰方法——不让别人修改这个方法
4、static 关键字
  静态成员一旦被加载，只有脚本结束才被释放
  在静态方法里，不能调用非静态成员
  只要能使用静态成员就是用静态成员
  class Person{
  	public $name;
  	public $age;
  	public $sex;
  	public static $country="中国";
  	function __construct($name,$age,$sex){
  		$this->name=$name;
  		$this->age=$age;
  		$this->sex->$sex;
  	}

  	public function say(){

  	}

  	function eat(){

  	}

  	function run(){

  	}
  }

  $p1=new Person("张三",10,"男");
  $p1=new Person("李四",10,"男");
  $p1=new Person("张三",10,"男");
  $p1=new Person("张三",10,"男");
  $p1=new Person("张三",10,"男");
  static 的作用是减少属性不必要的重复，把这一个属性放在静态段里
  只要类名出现，static 属性就加载了
  Person::$country//这有静态的成员属性才能这样访问
  self::$country//self代表自己类的
/*
单态设计模式
 */
防止类在一个程序里调用多次，就好比如防止一个人有多部手机，首先要封杀在外部使用$p=new Person()来实例化多个对象，
把构造函数私有化 private 这样就不能在外部实例化对象了，那外部怎么用这个类呢，就是在内部实例化，创造一个静态方法，
实例化对象;但是在外部多次静态化调用这个方法还是会多次实例化对象,所以要在这个方法里使用条件来筛选，如果$obj 是空的
给他附上实例化的值，如果不为空直接返回，static $obj 则一直在静态里存在不被销毁，调用完方法成员后才被销毁
class Person{
	static $obj=null;
	private function __construct(){

	}
	static function getObj(){
		if(is_null(self::$obj))
			self::$obj=new self;
		return self::$obj;
	}

	function __destruct(){
		echo "######################";
	}

	function say(){
		echo "aaaaaaaaaaaaaaaaaaaaaa";
	}
}

$p=Person::getobj();
$p=Person::getobj();
$p=Person::getobj();
$p=Person::getobj();
$p=Person::getobj();
$p=Person::getobj();
$p->say();
/*
const关键字
 */
PHP用 define()来定义常量
类里面用 const 来定义
常量建议使用大写，不能使用$
常量一定在声明时就给好初值
常量的访问方式和static的访问方式相同，但只能读
class Demo{
	const SEX="男";
	static function say(){
		echo "我的性别是：".self::SEX."<br>";
	}
}
echo Demo::SEX;
Demo::say();
/*
魔术方法
 */
__toString 直接使用echo print printf 输出一个对象引用时，自定调用，将对象形成字符串返回
class Person{
	public $name;
	public $age;
	public $sex;

	function __construct($name,$age,$sex){
		$this->name=$name;
		$this->age=$age;
		$this->sex=$sex;
	}

	function say(){

	}

	function __toString(){
		return "aaaaaaaaaaaaa";
	}
}

$p=new Person("张三",18,"男");
echo $p;
使用clone克隆对象，$p1=clone $p2对相当于在堆内存克隆了一个，$p1=$p2只是把栈内存的地址给了p1，它还是指向的同一个对象,而前面的是在堆内存里直接复制了一个对象
__clone()使用clone时自动调用，和构造方法一样，对新克隆的对象进行初始化
class Person{
	public $name;
	public $age;
	public $sex;

	function __construct($name,$age,$sex){
		$this->name=$name;
		$this->age=$age;
		$this->sex=$sex;
	}

	function say(){

	}

	function __clone(){
		//初始化设置
		$this->name="克隆的张三";//这里的$this代表的是副本的成员属性
	}
}

$p=new Person("张三",18,"男");
$p1=clone $p;
__call()魔术方法
在调用的对象中，方法不存在时，自动调用的方法
有两个参数，调用的不存在的方法名，第二个参数，调用这个不存在的方法参数
class Person{
	public $name;
	public $age;
	public $sex;

	public $marr=array("aaa","bbb","ccc","ddd");

	function __call($method,$args){
		if(in_array($method, $this->marr)){
			echo $args[0]."<br>";
		}else{
			echo "你调用的方法{$method}()不存在！<br>";
		}
	}
}

$p=new Person("张三",10,"男");
$p->aaa("aaaaaaaaaaaa");
$p->bbb("bbbbbbbbbbbb");
$p->ccc("cccccccccccc");
/*
对象串行化（序列化）
 */
把对象转化为字符串是串行化
将字符串转回对象是反串行化
注意（串行化的时机）：
将对象在网络中传输
讲对象长时间保存
$str=serialize($p) 把对象进行串行化
file_put_contents("objstr.txt", $str); 将串行好的字符串保存在文件中

$str=file_get_contents("objstr.txt"); 读出文件的字符串
$p=unserialize($str); 反串行化形成对象
作用：把对象串行化后，放到一个文件里，这样多个PHP可以共用，就不用实例化了
function __sleep() 在串行化时，自动调用的方法，可以设置需要串行化的属性，返回一个数组，在这个数组里的属性会被串行化
function __wakeup() 对串行化回来的对象进行初始化
class Person{
	public $name;
	public $age;
	public $sex;

	public $marr=array("aaa","bbb","ccc","ddd");

	function __sleep(){
		return array("name","age");//只串行化$age和$name
	}

	function __wakeup(){
		$this->age=12;
	}

	function __call($method,$args){
		if(in_array($method, $this->marr)){
			echo $args[0]."<br>";
		}else{
			echo "你调用的方法{$method}()不存在！<br>";
		}
	}
}

$p=new Person("张三",10,"男");
$str=serialize($p);
$p1=unserialize($str);
/*
JSON格式
 */
$arr=array("name"=>"zhangsan","age"=>10,"sex"="男");
//串行化
$str=json_encode($arr);
//反串行化
$parr=json_decode($str);//默认转化为对象
$parr->name;
$parr=json_decode($str,true);//第二个参数true,再将序列化转化为数组
echo $parr['name'];
/*
eval()函数，解析并执行PHP代码
 */
$str="echo 'abc';";
eval($str);//解析$str字符串的PHP代码
$arr=array("one"=>1,"two"=>"222222","three"=>333);
$a=var_export($arr,true);//把数组赋值给$a，$a是字符串
$a=eval('$b='.var_export($arr,true).";");
var_dump($b);//$b是数组
/*
__set_state()魔术方法
 */
在使用 var_export() 这个方法时，自动调用这个魔术方法
class Person{
	var $name;
	var $age;
	var $sex;

	function __construct($name,$age,$sex){
		$this->name=$name;
		$this->age=$age;
		$this->sex=$sex;
	}

	static function __set_state($arr){ //这个函数必须是static的
		$p=new Person("李四",30,"女");
		return $p;
	}
}

$p=new Person("张三",20,"男");

eval('$b='.var_export($p,true).";");

var_dump($b);
/*
__invoke()
 */
class Person{
	var $name;
	var $age;
	var $sex;

	function __construct($name,$age,$sex){
		$this->name=$name;
		$this->age=$age;
		$this->sex=$sex;
	}

	function __invoke(){
		echo "在对象引用后自动调用这个方法";
	}
}

$p=new Person("张三",20,"男");
$p();//自动调用__invoke这个方法
/*
__callstatic() 使用静态类调用不存在的方法时，自定调用这个方法
 */
class Person{
	var $name;
	var $age;
	var $sex;

	function __construct($name,$age,$sex){
		$this->name=$name;
		$this->age=$age;
		$this->sex=$sex;
	}

	static function __callStatic($method,$args){//使用静态类调用不存在的方法时，自定调用这个方法
		echo "你调用的静态方法{$method}不存在";
	}
}

$p=new Person("张三",20,"男");
Person::hello();
/*
__autoload()魔术方法
 */
只要加载类的时候，就会自动调用
function __autoload($classname){
	include strtolower($classname).".class.php";
}
/*
抽象方法的作用
抽象类的作用
 */
1、抽象方法
定义：如果一个方法没有方法体（一个方法，不使用"{}",直接使用分号结束），则这个方法就是抽象方法
一、声明一个方法，不使用{}，而直接分号结束
二、如果是抽象方法，必须使用 abstract;
2、抽象类
一、如果一个类中有一个方法时抽象方法，则这个类就是抽象类
二、如果声明一个抽象类，必须用 abstract 来修饰这个类
注意：
  只要使用 abstract 修饰的类，就是抽象类
  抽象类中可以有抽象方法
abstract class Person{
	//抽象方法
	abstract function say();
}
抽象类不能创建对象
如果看见抽象类，就必须写这个类的子类，将抽象类的抽象方法覆盖（加上方法体）
子类必须全部实现（覆盖重写）抽象方法，这个子类才能创建对象，如果只实现部分，父类还有抽象方法没有覆盖，那么子类必须是抽象类
3、抽象方法的作用就是规定子类的规则，功能交给子类