<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
require_once("admin/baza.php");
$queryall="SELECT * FROM `seo`  WHERE `page`='company'";
$result=mysql_query($queryall)or die(mysql_error());
$row=mysql_fetch_assoc($result);
?>
<title><?=$row['title'] ?></title>
<meta name="description" content="<?=$row['description'] ?>"/>
<meta name="keywords" content="<?=$row['keywords'] ?>"/>
<link rel="stylesheet" type="text/css" media="screen" href="style.css" />
<link rel="stylesheet"	type="text/css" href="bootstrap/css/bootstrap.css"/>

<script type="text/javascript"	src="admin/scripts/jquery-1.9.1.min.js"></script>

</head>
<body style="height:1100px"> 
<div id="header">
		<div id="header_inside">
			<img src="images/header.jpg" alt="setalpm" width="999" height="222" border="0" usemap="#Map" /><br />																																										
		  <ul id="menu">
				<li><a href="index.php" class="but1">Домой</a></li>
				<li><a href="about.php" class="but2">О нас</a></li>
				<li><a href="news.php" class="but3">Новости</a></li>
				<li><a href="services.php" class="but4">Услуги</a></li>				
		    	<li><a href="company.php" class="but5_active">Контакты</a></li>
			</ul>
		</div>
	</div>
    <div id="wrapper">
    	<div id="content_inside">
			<div id="main_block" style="width:1000px">
			   	<?  
				$about=file_get_contents('company.html');
				echo $about;
				?>
        	</div>
 	
		</div>
    </div>
  	<div id="footer">
        <div id="footer_inside">
            <ul class="footer_menu">
                <li><a href="index.php">Домой</a>|</li>
                <li><a href="about.php">О нас</a>|</li>
                <li><a href="news.php">Новости</a>|</li>
                <li><a href="services.php">Услуги</a>|</li>
                <li><a href="company.php">Контакты</a></li>
            </ul>
            <br /><br />
        </div> 
	</div>  
</body>
</html>
