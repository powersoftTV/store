
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Изделия</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" media="screen" href="style.css" />
<link rel="stylesheet"	type="text/css" href="bootstrap/css/bootstrap.css">
<?
require_once("admin/baza.php");
require_once("admin/include/myfunctions.php"); 
$_GET[prcl]	= trim($_GET[prcl]);
$_GET[prch]	= trim($_GET[prch]);
if($_GET[prcl] && $_GET[prch] ){
	if($_GET[prcl]=="")$_GET[prcl]=0;
	if($_GET[prch]=="")$_GET[prch]=999999999;
}
$pattern = '/^\d{10}$/'; 
if(preg_match($pattern, $_GET[prcl])) exit("Недопустимые символы");
if(preg_match($pattern, $_GET[prch])) exit("Недопустимые символы");  			   	
if($_GET[prcl]>$_GET[prch]){
	$temp=$_GET[prcl];
	$_GET[prcl]=$_GET[prch];  
	$_GET[prch]=$temp;
}
?>
<style>
   li {
    list-style-type: none; /* Убираем маркеры */
   }
   ul {
    margin-left:10; /* Отступ слева в браузере IE и Opera */
    padding-left: 10; /* Отступ слева в браузере Firefox, Safari, Chrome */
   }
   
  </style>
<script type="text/javascript" src="admin/scripts/jquery-1.9.1.min.js"></script>
<script>
function gosort(){
	var sort=$("#sort").val();
	
	if(sort=="pl") document.location.search="?met=<?=$_GET[met]?>&prb=<?=$_GET[prb]?>&cat=<?=$_GET[cat]?>&prcl=<?=$_GET[prcl]?>&prch=<?=$_GET[prch]?>&wgtl=<?=$_GET[wgtl]?>&wgth=<?=$_GET[wgth]?>&sort=pl";
	if(sort=="ph") document.location.search="?met=<?=$_GET[met]?>&prb=<?=$_GET[prb]?>&cat=<?=$_GET[cat]?>&prcl=<?=$_GET[prcl]?>&prch=<?=$_GET[prch]?>&wgtl=<?=$_GET[wgtl]?>&wgth=<?=$_GET[wgth]?>&sort=ph";
	if(sort=="age") document.location.search="?met=<?=$_GET[met]?>&prb=<?=$_GET[prb]?>&cat=<?=$_GET[cat]?>&prcl=<?=$_GET[prcl]?>&prch=<?=$_GET[prch]?>&wgtl=<?=$_GET[wgtl]?>&wgth=<?=$_GET[wgth]?>";
	
}
function goreset(){
	document.location.search="";
}  
function goproba(){
	var q=$("#prb").val();
	document.location.search="?sort=<?=$_GET[sort]?>&met=<?=$_GET[met]?>&cat=<?=$_GET[cat]?>&prcl=<?=$_GET[prcl]?>&prch=<?=$_GET[prch]?>&wgtl=<?=$_GET[wgtl]?>&wgth=<?=$_GET[wgth]?>&prb="+q;
}  
function gometall(){
	var q=$("#met").val();
	document.location.search="?sort=<?=$_GET[sort]?>&cat=<?=$_GET[cat]?>&prb=<?=$_GET[prb]?>&prcl=<?=$_GET[prcl]?>&prch=<?=$_GET[prch]?>&wgtl=<?=$_GET[wgtl]?>&wgth=<?=$_GET[wgth]?>&met="+q;
}  
function gocategory(){
	var q=$("#cat").val();
	document.location.search="?sort=<?=$_GET[sort]?>&met=<?=$_GET[met]?>&prb=<?=$_GET[prb]?>&prcl=<?=$_GET[prcl]?>&prch=<?=$_GET[prch]?>&wgtl=<?=$_GET[wgtl]?>&wgth=<?=$_GET[wgth]?>&cat="+q;
}  
function goweight(){
	var q=$("#wgtl").val();
	var qq=$("#wgth").val();
	document.location.search="?sort=<?=$_GET[sort]?>&cat=<?=$_GET[cat]?>&met=<?=$_GET[met]?>&prb=<?=$_GET[prb]?>&prcl=<?=$_GET[prcl]?>&prch=<?=$_GET[prch]?>&wgtl="+q+"&wgth="+qq;
}  
function goprice(){
	var q=$("#prcl").val();
	var qq=$("#prch").val();
	document.location.search="?sort=<?=$_GET[sort]?>&cat=<?=$_GET[cat]?>&met=<?=$_GET[met]?>&prb=<?=$_GET[prb]?>&wgtl=<?=$_GET[wgtl]?>&wgth=<?=$_GET[wgth]?>&prcl="+q+"&prch="+qq;
}

$(document).ready(function(){
	$("#cat").val("<?=$_GET[cat]?>");
	$("#met").val("<?=$_GET[met]?>");
	$("#prcl").val("<?=$_GET[prcl]?>");
	$("#prch").val("<?=$_GET[prch]?>");
	$("#prb").val("<?=$_GET[prb]?>");
	$("#wgtl").val("<?=$_GET[wgtl]?>");
	$("#wgth").val("<?=$_GET[wgth]?>");
	
	$(".nav").find("a").click(function(){
		$(".nav .active").removeClass("active");
		$(this).parent().addClass("active");
	});
});
</script>
</head> 

<body> 
<div id="header">
	<div id="header_inside">
			<img src="images/header.jpg" alt="setalpm" width="999" height="222" border="0" usemap="#Map" /><br />																																										
		<ul id="menu">
				<li><a href="index.html" class="but1_active">Домой</a></li>
				<li><a href="index2.html" class="but2">О нас</a></li>
				<li><a href="index2.html" class="but3">Новости</a></li>
				<li><a href="index2.html" class="but4">Услуги</a></li>				
		    	<li><a href="index2.html" class="but5">Контакты</a></li>
		</ul>
	</div>
</div>
<div id="wrapper">
	<div id="content_inside">
		<div id="sidebar">
            	<div class="residential-property-search">
           <?
         /*  $addquery="";
		   if($_GET[cat])$addquery="AND `category_id`= '$_GET[cat]'";
		   if($_GET[met])$addquery="AND `metall_id`= '$_GET[met]'";
		   if($_GET[prb])$addquery="AND `proba_id`= '$_GET[met]'";
		   if($_GET[prcl] || $_GET[prch]){
			   	$_GET[prcl]	= trim($_GET[prcl]);
				$_GET[prch]	= trim($_GET[prch]);
			   	if($_GET[prcl]=="")$_GET[prcl]=0;
				if($_GET[prch]=="")$_GET[prch]=999999999; 
			    $pattern = '/^\d{10}$/'; 
  				if(preg_match($pattern, $_GET[prcl])) exit("Недопустимые символы");
				if(preg_match($pattern, $_GET[prch])) exit("Недопустимые символы");  			   	
			   	if($_GET[prcl]>$_GET[prch]){
					 $temp=$_GET[prcl];
				 	$_GET[prcl]=$_GET[prch];  
				 	$_GET[prch]=$temp;
			   	}
			   	$addquery="AND `price`>= '$_GET[prcl]' AND `price`<= '$_GET[prch]'";
		   }
		   if($_GET[wgtl] || $_GET[wgth]){
			   	$_GET[wgtl]	= trim($_GET[wgtl]);
				$_GET[wgth]	= trim($_GET[wgth]);
			   	if($_GET[wgtl]=="")$_GET[wgtl]=0;
				if($_GET[wgth]=="")$_GET[wgth]=999999999;
			    $pattern = '#[^\s\d]#is'; 
  				if(preg_match($pattern, $_GET[wgtl])) exit("Недопустимые символы");
				if(preg_match($pattern, $_GET[wgth])) exit("Недопустимые символы");  			   	
			   	if($_GET[wgtl]>$_GET[wgth]){
					 $temp=$_GET[wgtl];
				 	$_GET[wgtl]=$_GET[wgth];  
				 	$_GET[wgth]=$temp;
			   	}
			   	$addquery="AND `weight`>= '$_GET[wgtl]' AND `price`<= '$_GET[wgth]'";
		   }
		   $query = "SELECT * FROM `main` WHERE `active`='1'".$addquery;*/
		   $query = "SELECT * FROM `main` WHERE `active`='1'";
		   $result = mysql_query($query) or die('MySql Error' . mysql_error());
		   $category=array();
		   $metall=array();
		   $proba=array();
		   while($row = mysql_fetch_array($result)) {
			   	$flagcategory=false; 
				$flagmetall=false;
				$flagproba=false;
		   		foreach($category as $value){
					if($value==$row[category_id]) $flagcategory=true;
				}
				foreach($metall as $value){
					if($value==$row[metall_id]) $flagmetall=true;
				}
				foreach($proba as $value){
					if($value==$row[proba_id]) $flagproba=true;
				}
				if(!$flagcategory)$category[]=$row[category_id];
				if(!$flagmetall)$metall[]=$row[metall_id];
				if(!$flagproba)$proba[]=$row[proba_id];
			}
		   ?>
		   
		   <form method="post" action="">
                <ul>
                    <li>
                        <ul class="clear">
                            <li>
                                <label>Категория</label>
                                <select id="cat" onChange="gocategory()" name="cat">
                                    <option></option>
								<? foreach($category as $value){ 									
									$query = "SELECT category FROM `category` WHERE `id`='$value'";
									$result = mysql_query($query) or die('MySql Error' . mysql_error());
									$row=mysql_fetch_array($result);?>								
                                    <option value="<?=$value?>"><?=$row[category]?></option>
								<? } ?>
                                </select>    
                            </li>
                           
                        </ul>                        
                    </li>
                    <li>
                        <ul class="clear">
                            <li>
                                <label>Металл</label>
                                <select id="met" onChange="gometall()" name="met">
                                    <option></option>
                               <? foreach($metall as $value){ 
									$query = "SELECT metall FROM `metall` WHERE `id`='$value'";
									$result = mysql_query($query) or die('MySql Error' . mysql_error());
									$row=mysql_fetch_array($result);?>								
                                    <option value="<?=$value?>"><?=$row[metall]?></option>
								<? } ?>
                                </select>    
                            </li>
                           
                        </ul>                        
                    </li>
                    <li>
                        <ul class="clear">
                            <li>
                               	<label>Цена(руб) </label>
                                <table><tr><td>
                                <input id="prcl" type="text" style="width:55px; text-align:center; margin-right:1px; padding-left:0px; padding-right:0px" name="from" value=""></td><td> - </td><td><input id="prch" type="text"  style="width:55px; text-align:center;  margin-left:1px; padding-left:0px; padding-right:0px" name="to" value=""></td><td><input onClick="goprice()" type="button" style="width: 20px; margin-left:3px; margin-bottom:10px" value=">" name="ok" class="gosub"></td></tr></table>
   							</li>
                            
                        </ul>
                        
                    </li>
                   <li>
                        <ul class="clear">
                            <li>
                                <label>Проба</label>
                                <select id="prb" onChange="goproba()" name="prb">
                                    <option></option>
                                  <? foreach($proba as $value){ 
									$query = "SELECT proba FROM `proba` WHERE `id`='$value'";
									$result = mysql_query($query) or die('MySql Error' . mysql_error());
									$row=mysql_fetch_array($result);?>								
                                    <option value="<?=$value?>"><?=$row[proba]?></option>
								<? } ?>
                                </select>    
                            </li>
                           
                        </ul>                        
                    </li>
                    <li>
                        <ul class="clear">
                            <li>
                                <label>Вес</label>
                                <table><tr><td>
                                <input id="wgtl" type="text" style="width:55px; text-align:center;  margin-right:1px; padding-left:0px; padding-right:0px" name="from" value=""></td><td> - </td><td><input id="wgth" type="text"  style="width:55px; text-align:center;  margin-left:1px; padding-left:0px; padding-right:0px" name="to" value=""></td><td><input onClick="goweight()" type="button" style="width: 20px; margin-left:3px; margin-bottom:10px" value=">" name="ok" class="gosub"></td></tr></table>
                            </li>
                           
                        </ul> 
                                              
                    </li>
                    <li>
                        <ul class="clear">
                            <li><br><br>
                             <? if($_GET[cat]||$_GET[met]||$_GET[prb]||$_GET[prcl]||$_GET[prch]||$_GET[wgtl]||$_GET[wgth]){ ?>
                               <input style="width:144px" onClick="goreset()" type="button" value="Сбросить всё" name="reset" class="gosub"> <? } ?>
                            </li>
                           
                        </ul> 
                                              
                    </li>
                 
                </ul>
            
        </div>
		</div>
    	<div id="main_block"> 
        	<div  class="residential-property-search">
    				<ul  class="clear">
        				<li>
                      	<select id="sort" style="width:210px" onChange="gosort()">
						<? if(!$_GET[sort]){ ?>
                        <option selected value="age">Сначала новые</option>
      					<option value="pl">Цена от низкой к высокой</option>
      					<option value="ph">Цена от высокой к низкой</option>
						<? } 
						if($_GET[sort]=="pl"){ ?>
						<option value="age">Сначала новые</option>
      					<option selected value="pl">Цена от низкой к высокой</option>
      					<option value="ph">Цена от высокой к низкой</option>
						<? } 
						if($_GET[sort]=="ph"){ ?>
						<option value="age">Сначала новые</option>
      					<option value="pl">Цена от низкой к высокой</option>
      					<option selected value="ph">Цена от высокой к низкой</option>
						<? } ?>
      					</select>
     					</li>
         			</ul>
			</div>
    		<div id="items">
            
            <!--	<div  id="sorter" >
           
<ul style="margin-left:170px" class="nav nav-pills">
<? 
	/*$destsort=$_SERVER['PHP_SELF']."?met=".$_GET[met]."&prb=".$_GET[prb]."&prcl=".$_GET[prcl]."&prch=".$_GET[prch]."&wgtl=".$_GET[wgtl]."&wgth=".$_GET[wgth]."&cat=".$_GET[cat];
	if($_GET[sort]){
	
		if($_GET[sort]=="pl"){ ?>
			<li  class="active"><a href="<?=$destsort?>&sort=pl">Цена от низкой к высокой</a></li>  
  			<li><a href="<?=$destsort?>&sort=ph">Цена от высокой к низкой</a></li>
  			<li ><a href="<?=$destsort?>">Сначала новые</a></li>
	<?	}
		if($_GET[sort]=="ph"){ ?>
			<li><a href="<?=$destsort?>&sort=pl">Цена от низкой к высокой</a></li>  
  			<li class="active"><a href="<?=$destsort?>&sort=ph">Цена от высокой к низкой</a></li>
  			<li ><a href="<?=$destsort?>">Сначала новые</a></li>
	<?	}
	}
  else{ ?>
	<li><a href="<?=$destsort?>&sort=pl">Цена от низкой к высокой</a></li>  
  	<li><a href="<?=$destsort?>&sort=ph">Цена от высокой к низкой</a></li>
  	<li class="active" ><a href="<?=$destsort?>">Сначала новые</a></li>
<? }*/?>

</ul>

</div>-->
            <?
			$num=6; 
			if($_GET[p]){
				$page=$_GET[p];
				$start=$num*$page-$num;
			}
			else {
				$page=1;
				$start=0;
			}
			
			$addquery="";
		   	if($_GET[cat])$addquery.="AND `category_id`= '$_GET[cat]'";
		   	if($_GET[met])$addquery.="AND `metall_id`= '$_GET[met]'";
		   	if($_GET[prb])$addquery.="AND `proba_id`= '$_GET[prb]'";
		   	if($_GET[prcl] || $_GET[prch]) $addquery.="AND `price`>= '$_GET[prcl]' AND `price`<= '$_GET[prch]'";
		    if($_GET[wgtl] || $_GET[wgth]) $addquery.="AND `weight`>= '$_GET[wgtl]' AND `weight`<= '$_GET[wgth]'";
			$queryall="SELECT * FROM `main`  WHERE `active`='1'".$addquery;
			
			$result=mysql_query($queryall)or die(mysql_error());
			$res = mysql_num_rows($result);  
			$pages=ceil ($res/$num);
			$dest=$_SERVER['PHP_SELF']."?met=".$_GET[met]."&prb=".$_GET[prb]."&prcl=".$_GET[prcl]."&prch=".$_GET[prch]."&wgtl=".$_GET[wgtl]."&wgth=".$_GET[wgth]."&cat=".$_GET[cat]."&";
			$start=$num*$page-$num;
			if($_GET[sort]){
				$dest=$dest."sort=".$_GET[sort]."&";
				if($_GET[sort]=="ph") $query_pag_data = $queryall." ORDER BY price DESC LIMIT $start, $num";
				if($_GET[sort]=="pl") $query_pag_data = $queryall." ORDER BY price LIMIT $start, $num";
			}
			else $query_pag_data = $queryall." ORDER BY date_created DESC LIMIT $start, $num";
			//mypagesnew($num,$page,$pages,$dest); 			
			$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
			$i=0; ?>
            <table><tr>
			<? while ($row = mysql_fetch_array($result_pag_data)) { 
				$query_category = "SELECT category FROM `category` WHERE `id`='$row[category_id]'";
				$result_category = mysql_query($query_category) or die('MySql Error' . mysql_error());
				$row_category = mysql_fetch_array($result_category);
				$query_metall = "SELECT metall FROM `metall` WHERE `id`='$row[metall_id]'";
				$result_metall = mysql_query($query_metall) or die('MySql Error' . mysql_error());
				$row_metall = mysql_fetch_array($result_metall);
				$query_proba = "SELECT proba FROM `proba` WHERE `id`='$row[proba_id]'";
				$result_proba = mysql_query($query_proba) or die('MySql Error' . mysql_error());
				$row_proba = mysql_fetch_array($result_proba);
			?>
				<td><a href='index2porc.php'><div class='item'><span><?=$row['price']?> руб.</span><br><p align="" style="margin-left:20px; margin-top:10px"><?=$row_metall[metall]?> <?=$row_proba[proba]?>, <?=$row_category[category]?>, <?=$row['weight']?> гр.</p><img style="width:180px" src='admin/uploads/<?=$row['id']?>/ready/<?=$row['image']?>' width='180'/></div></a></td>
				<? $i++;
				if($i==3){
					$i=0; ?>
					</tr><tr>
				 <? }
    

 }?> 
</tr></table></div><br>
<? 
mypagesnew($num,$page,$pages,$dest); ?>			
            
            </div>
		</div>			     
	</div>
</div>
<div id="footer">
	<div id="footer_inside">
		<ul class="footer_menu">
			<li><a href="index.html">Домой</a>|</li>
			<li><a href="index2.html">О нас</a>|</li>
			<li><a href="index2.html">Новости</a>|</li>
			<li><a href="index2.html">Услуги</a>|</li>
			<li><a href="index2.html">Контакты</a></li>
		</ul>
        <br /><br />
</div> 
</div>  
 

	
	
  
</body>
</html>
