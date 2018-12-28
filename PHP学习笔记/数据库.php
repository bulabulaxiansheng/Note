<?php
/*
PDO对象
 */
try{
	$dsn='mysql:host=localhost;dbname='
}catch(PDOException $e){
	echo "error:".$e->getMessage().'<br>';
	exit();
}