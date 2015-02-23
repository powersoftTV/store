<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
require_once("admin/baza.php");
$queryall="SELECT * FROM `seo`  WHERE `page`='news'";
$result=mysql_query($queryall)or die(mysql_error());
$row=mysql_fetch_assoc($result);
?>
<title><?=$row['title'] ?></title>
<meta name="description" content="<?=$row['description'] ?>"/>
<meta name="keywords" content="<?=$row['keywords'] ?>"/>
<link rel="stylesheet" type="text/css" media="screen" href="style.css" />
<link rel="stylesheet"	type="text/css" href="bootstrap/css/bootstrap.css"/>

<script type="text/javascript"	src="admin/scripts/jquery-1.9.1.min.js"></script>
<style type="text/css">
   li {
    list-style-type: none; /* Убираем маркеры */
   }
     ul {
    margin-left:10; /* Отступ слева в браузере IE и Opera */
    padding-left: 10; /* Отступ слева в браузере Firefox, Safari, Chrome */
   }
</style>
<?
function mypagesnew($num,$page,$pages, $dest){?>
<table align="center">
<tr> <?
	 if($page==1){?>
         	 <td>
<ul style="margin-left:0"  >	
<li ><a style="margin-right:30px">Страница <?=$page?> из <?=$pages?> </a> <a>&lt;&lt;&lt;</a></li>
</ul>
</td>
         <? }
		 else {
			 ?>
             <td>
<ul >	
<li ><a style="margin-right:30px">Страница <?=$page?> из <?=$pages?> </a> <a href="<?=$dest?>p=<?=$page-1?>"><<<</a></li>
</ul>
</td>
         	
         <? }
		
		 for($i=1;$i<$pages+1;$i++){
			 
			 if($pages<12){
				 if($i==$page){ ?>
                 	<td>
					<ul >	
					 <li><h2><a style="display:block; height:100%"><?=$i ?></a></h2></li>
                     </ul>
					</td>
                 <? ; }
				 else {?>
                 <td>
<ul >	
<li ><a href="<?=$dest?>p=<?=$i?>"><?=$i ?></a></li>
</ul>
</td>
				 	
				 <? }
			  }
			  else {				  
				  if($page<7){
					if($i==$page){ ?>
                 	<td>
					<ul >	
					 <li><h2><a style="display:block; height:100%"><?=$i ?></a></h2></li>
                     </ul>
					</td>
                 <? ; }
					if(($i==1 && $i!=$page) || ($i==$pages && $page!=$pages) || ($i<10 && $i!=$page)){?>
                    <td>
<ul >	
<li ><a href="<?=$dest?>p=<?=$i?>"><?=$i ?></a></li>
</ul>
</td>
				 	 	<?	}
					if(($i==$page+4 && ($page+4 < $pages) && $page>5) || ($pages>10 && $i==10)){ ?>
                 	<td>
					<ul >	
					 <a>...</a>
                     </ul>
					</td>
                 <? ; }				 					 	
				 	}
				  elseif($page>$pages-6){
					 if($i==$page){ ?>
                 	<td>
					<ul >	
					 <li><h2><a style="display:block; height:100%"><?=$i ?></a></h2></li>
                     </ul>
					</td>
                 <? ; }
					if(($i==1 && $i!=$page) || ($i==$pages && $page!=$pages) || ($i>$pages-9 && $i!=$page)){?>
                       <td>
<ul >	
<li ><a href="<?=$dest?>p=<?=$i?>"><?=$i ?></a></li>
</ul>
</td>
				 	 	<?	}
					if(($i==$page-4 && ($page-4 < $pages) && $page<$pages-9) || ($pages>10 && $i==1)){ ?>
                 	<td>
					<ul >	
					 <a>...</a>
                     </ul>
					</td>
                 <? ; }				 	
				 	}	
				  else {
					if($i==$page){ ?>
                 	<td>
					<ul >	
					<li><h2><a style="display:block; height:100%"><?=$i ?></a></h2></li>
                     </ul>
					</td>
                 <? ; }		
					if(($i==1 && $i!=$page) || ($i==$pages && $page!=$pages) || ($i>$page-4 && $i<$page+4 && $i!=$page)){?>
                     <td>
<ul >	
<li ><a href="<?=$dest?>p=<?=$i?>"><?=$i ?></a></li>
</ul>
</td>
				 		 	<? }				 
					if(($i==$page+3 && ($page+4 < $pages)) || ($i==$page-4) && ($page-4 > 1)){ ?>
                 	<td>
					<ul >	
					 <a>...</a>
                     </ul>
					</td>
                 <? ; }				 	
				 	  }
			  	}
		 }
		 if($page==$pages ||$page>$pages-1){?>
           <td>
<ul >	
<li ><a > >>></a></li>
</ul>
</td>
         <? ;}
		 else { 
		  ?>
          <td>
<ul >	
<li ><a href="<?=$dest?>p=<?=$page+1 ?>"> >>></a></li>
</ul>
</td>
        
         <? } ?>
         </tr>
</table> <?
} 
			 ?>			
</head>
<body style="height:1100px"> 
<div id="header"> 
		<div id="header_inside">
			<img src="images/header.jpg" alt="setalpm" width="999" height="222" border="0" usemap="#Map" /><br />																																										
		  <ul id="menu">
				<li><a href="index.php" class="but1">Домой</a></li>
				<li><a href="about.php" class="but2">О нас</a></li>
				<li><a href="news.php" class="but3_active">Новости</a></li>
				<li><a href="services.php" class="but4">Услуги</a></li>				
		    	<li><a href="company.php" class="but5">Контакты</a></li>
			</ul>
		</div>
	</div>
 
    <div id="wrapper">
    	<div id="content_inside">
			<div id="main_block" style="width:1000px">
          
    <? $num=5; 
			if($_GET[p]){
				$page=$_GET[p];
				$start=$num*$page-$num;
				
			}
			else {
				$page=1;
				$start=0;
			}
 if(!$_GET['search'])
 {
   ?>	 
     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <input type="text" name="search" value=""/>
    <input type="submit" title="Найти в новостях" name="submit" value="Найти" class="gosub" style="width: 60px; margin-bottom:9px; margin-left:3px; height:30px"/>
     </form> 
	<?
$a=mysql_query("SELECT * FROM `pages`  WHERE `active`='Активно' AND DATE(datepicker)<= DATE(NOW())")or die(mysql_error());
   $total=mysql_num_rows($a);
   $pages=ceil ($total/$num);			
   $start=$num*$page-$num;
   $dest=$_SERVER['PHP_SELF']."?";  
   $limit = mysql_query("SELECT * FROM `pages` WHERE `active`='Активно' AND DATE(datepicker)<= DATE(NOW()) ORDER BY DATE(datepicker) DESC, `date_created` DESC LIMIT $start, $num")or die(mysql_error());?>
   
<table align="center">	
<? while($result=mysql_fetch_assoc( $limit)){ 	
   $id=$result[id];
	?>  
		<tr>
        <td>
       
		<? echo  '<h2 align="center" style="color:#003F4F">'.$result[story_name].'</h2><p align="center"> '.$result[datepicker].'</p>'; ?>
        <? echo $result[story]; ?>
        
		</td> 
		</tr>
       <tr><td>
		<hr/>
        </td></tr>
  <?
	}?> 
</table>
<?  
  if($total>$num) mypagesnew($num,$page,$pages, $dest);          
 }
 else 
 {
	ini_set(magic_quotes_gpc,0);
	mysql_query("REPAIR TABLE `pages` QUICK");
	$search=$_GET['search'];
	$search = trim($search);
	$search = stripslashes($search);
	$search = htmlspecialchars($search);
	$search = mb_substr($search, 0, 128, 'utf-8');
	$search_hilights = preg_replace("/ +/", " ", $search);	
	$tempp=explode(" ",	$search_hilights);
	$temp=array();
	foreach($tempp as $f){
			if(mb_strlen($f,'UTF-8') > 2) $temp[]=$f;
			}
	$search_hilights=implode(" ", $temp);
	$search=mysql_real_escape_string($search_hilights);
	if($_GET['submit']=="Найти"){
		$query = "SELECT * FROM pages WHERE   `active`='Активно' AND DATE(datepicker)<= DATE(NOW())  AND (story_name  LIKE '%". str_replace(" ", "%' OR story_name LIKE '%", $search). "%' OR story_sthtml LIKE '%". str_replace(" ", "%' OR story_sthtml LIKE '%", $search). "%') ORDER BY DATE(datepicker) DESC, `date_created` DESC";}
	if(mb_strlen($search,'UTF-8') >2){
		$result=mysql_query ($query) or die(mysql_error());
		$total=mysql_num_rows($result); 
		$pages=ceil($total/$num);?>
		<table align="left"><tr><td> 
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" >
		<input type="text" name="search" value="<?=$search?>"/>
		<input type="submit" title="Найти в новостях" name="submit" value="Найти" class="gosub" style="width: 60px; margin-bottom:9px; margin-left:3px; height:30px"/>
		</form>
		</td>
		<td width="700px"> 
        <? if($total){?>
		<p style="font-size:0.8em;margin-left:10px; font-weight:bold">Результаты запроса: <?=$total?></p>
        <? }
		else { ?>
        	<p style="font-size:0.8em;margin-left:10px; font-weight:bold">По Вашему запросу ничего не найдено </p>
            <? } ?>
		</td>
		</tr>
		</table>
		<br/><br/>
		<? 	if($total>$num){
			if($_GET['submit']){
				$result=mysql_query( "SELECT * FROM pages WHERE   `active`='Активно' AND DATE(datepicker)<= DATE(NOW())  AND (story_name  LIKE '%". str_replace(" ", "%' OR story_name LIKE '%", $search). "%' OR story_sthtml LIKE '%". str_replace(" ", "%' OR story_sthtml LIKE '%", $search). "%') ORDER BY DATE(datepicker) DESC, `date_created` DESC LIMIT $start,$num") or die(mysql_error());}
			}?>
			<table align="center">
			<?  	
			while($row=mysql_fetch_array($result))
				{ 
					$rowarray=explode(" ",$row['story']);
					$i=0;
					foreach($rowarray as $e){		
						foreach($temp as $f){				
							if(mb_strrichr($e,$f,true,'utf-8')!==false){
								$skizb=mb_strrichr($e,$f,true,'utf-8');
								$verch=mb_strrichr($e,$f,false,'utf-8');
								$sovpadenie=mb_substr($e,mb_strlen($skizb,'utf-8'),mb_strlen($f,'utf-8'),'utf-8');				
								$ostatok=mb_substr($e,mb_strlen($skizb,'utf-8')+ mb_strlen($f,'utf-8'),mb_strlen($e,'utf-8')-mb_strlen($skizb,'utf-8')- mb_strlen($f,'utf-8'),'utf-8');
								$sovpadenie="<span style='background-color:#C7C7C7'>".$sovpadenie."</span>";
								$rowarray[$i]=$skizb.$sovpadenie.$ostatok;
							}
						}
						$i++;	
					}
					$row['story']= implode(" ",$rowarray);
					
					$rowarray=explode(" ",$row['story_name']);
					$i=0;
					foreach($rowarray as $e){		
						foreach($temp as $f){				
							if(mb_strrichr($e,$f,true,'utf-8')!==false){
								$skizb=mb_strrichr($e,$f,true,'utf-8');
								$verch=mb_strrichr($e,$f,false,'utf-8');
								$sovpadenie=mb_substr($e,mb_strlen($skizb,'utf-8'),mb_strlen($f,'utf-8'),'utf-8');				
								$ostatok=mb_substr($e,mb_strlen($skizb,'utf-8')+ mb_strlen($f,'utf-8'),mb_strlen($e,'utf-8')-mb_strlen($skizb,'utf-8')- mb_strlen($f,'utf-8'),'utf-8');
								$sovpadenie="<span  style='background-color:#C7C7C7'>".$sovpadenie."</span>";
								$rowarray[$i]=$skizb.$sovpadenie.$ostatok;
							}
						}
						$i++;	
					}
					$row['story_name']= implode(" ",$rowarray);
					?>    
				
				<tr>
						<td>
					   
						<? echo  '<h2 align="center" style="color:#003F4F">'.$row[story_name].'</h2><p align="center"> '.$row[datepicker].'</p>'; ?>
						<? echo $row[story]; ?>
						
						</td> 
						</tr>
					   <tr><td>
						<hr/>
						</td></tr>
				
				<?
				}
				?>
			</table> 	
			<?
			$dest="news.php?search=".$_GET['search']."&submit=".$_GET['submit']."&";
			if($total>$num)mypagesnew($num,$page,$pages, $dest);
}
	else { ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <input type="text" name="search" value=""/>
    <input type="submit" title="Найти в новостях" name="submit" value="Найти" class="gosub" style="width: 60px; margin-bottom:9px; margin-left:3px; height:30px"/>
     </form> 
<table align="center">	
 <tr>
  	<td width="700px"> 
     
        	<p style="font-size:1em;margin-left:10px; font-weight:bold">Строка поиска содержит менее 3 символов, в связи с чем поиск был приостановлен.</p>
       
		</td>
  </tr>
</table>  
<? 
}
 }
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
