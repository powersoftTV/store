
<?php

$db = mysql_connect ("powersofttv.ipagemysql.com","admin_sun","Power2013");  
        mysql_select_db ("sun",$db);
		if(!$db){die('Ошибка соединения: ' . mysql_error());}
		$time=time();
		//echo $time."<br>";
		$timezone = "Asia/Yerevan"; 
		date_default_timezone_set('Asia/Yerevan');
		$time2=time();
		//echo $time2."<br>";
		$timenew=$time2-$time;
		$t=date("P",$timenew);
		//echo $t;
		//echo "Asia/Yerevan:".date("Y-m-d h:iA");
		mysql_query("SET SESSION time_zone = '$t'")or die(mysql_error());
		mysql_query("SET CHARACTER SET utf8");
?>
