<?php
/*
时间戳
 */
date_default_timezone_set("PRC");//设置时区
$t=time()-7*24*60*60;
echo date("Y-m-d H:i:s",time())."<br>";
echo date("Y-m-d H:i:s",$t)."<br>";