<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
require_once("admin/baza.php");
$queryall="SELECT * FROM `seo`  WHERE `page`='home'";
$result=mysql_query($queryall)or die(mysql_error());
$row=mysql_fetch_assoc($result);
$max = mysql_query("SELECT MAX(price) FROM `main`  WHERE `active`='1'");
$maxx=mysql_result($max,0);
$min = mysql_query("SELECT MIN(price) FROM `main`  WHERE `active`='1'");
$minn=mysql_result($min,0);
if($_GET[prcl] && $_GET[prcl]!="")	$_GET[prcl]= trim($_GET[prcl]);
else $_GET[prcl]=$minn;
if($_GET[prch] && $_GET[prch]!="")	$_GET[prch]= trim($_GET[prch]);
else $_GET[prch]= $maxx;

$ifnon=false;
$pattern = '([^0-9])';
if(!($_GET[prcl]=="" && $_GET[prch]=="") ){
	if($_GET[prcl]=="")$_GET[prcl]=$minn;
	if($_GET[prch]=="")$_GET[prch]=$maxx;
	$ifnon=true;
}
$_GET[prcl]=preg_replace($pattern,"", $_GET[prcl]);	
$_GET[prch]=preg_replace($pattern,"", $_GET[prch]); 

if(!($_GET[prcl]=="" && $_GET[prch]=="") && !$ifnon ){
	if($_GET[prcl]=="")$_GET[prcl]=$_GET[prch];
	if($_GET[prch]=="")$_GET[prch]=$_GET[prcl];
}
if($_GET[prch]!="" && $_GET[prcl]!=""){	
  	
	if($_GET[prcl]>$_GET[prch])
	{
	$temp=$_GET[prcl];
	$_GET[prcl]=$_GET[prch];  
	$_GET[prch]=$temp;
	}
}
$_GET[wgtl]	= trim($_GET[wgtl]);
$_GET[wgth]	= trim($_GET[wgth]);

if(preg_match($pattern, $_GET[wgtl])){
	unset($_GET[wgtl]);
	exit("Недопустимые символы в весе");
}
if(preg_match($pattern, $_GET[wgth])){
	unset($_GET[wgth]);
	exit("Недопустимые символы в весе");
}
if(!($_GET[wgtl]=="" && $_GET[wgth]=="") ){
	if($_GET[wgtl]=="")$_GET[wgtl]=0;
	if($_GET[wgth]=="")$_GET[wgth]=99999;
}
 			   	
if($_GET[wgtl]>$_GET[wgth]){
	$temp=$_GET[wgtl];
	$_GET[wgtl]=$_GET[wgth];  
	$_GET[wgth]=$temp;
}

?>
<title><?=$row['title'] ?></title>
<meta name="description" content="<?=$row['description'] ?>"/>
<meta name="keywords" content="<?=$row['keywords'] ?>"/>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" 	type="text/css" media="screen" 	href="style.css"/>
<link rel="stylesheet"	type="text/css" media="screen"	href="bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" 	type="text/css" media="screen" 	href="admin/style/fg_membersite1.css"/>
<style type="text/css">
   li {
    list-style-type: none; /* Убираем маркеры */
   }
     ul {
    margin-left:10; /* Отступ слева в браузере IE и Opera */
    padding-left: 10; /* Отступ слева в браузере Firefox, Safari, Chrome */
   }
</style>
<script type="text/javascript" src="admin/scripts/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  
  
<!--jQuery UI Slider - Range slider-->
  
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
 
  <script>
  
	$(function() {
		$('#prcl').change(function() {
			var prch=$('#prch').val();
			var prcl=$('#prcl').val();
			if(prcl=="" || prcl*1<<?=$minn?>){
				prcl=<?=$minn?>;
				$('#prcl').val(prcl);
				$('#slider_price').slider("values",0,prcl);
			}
			if(prch=="" || prch*1><?=$maxx?>){
				prch=<?=$maxx?>;
				$('#prch').val(prch);
				$('#slider_price').slider("values",1,prch);
			}
			if(prcl*1><?=$maxx?>){
				var low=$('#prch').val();
				var high=<?=$maxx?>;
				$('#prch').val(high);
				$('#prcl').val(low);
				$('#slider_price').slider("values",0,low);
				$('#slider_price').slider("values",1,high);
				var prch=high;
				var prcl=low;
			}
			if(prch*1<<?=$minn?>){
				var low=<?=$minn?>;
				var high=$('#prcl').val();
				$('#prch').val(high);
				$('#prcl').val(low);
				$('#slider_price').slider("values",0,low);
				$('#slider_price').slider("values",1,high);
				var prch=high;
				var prcl=low;
			}
			if(prcl*1>prch*1){
				var low=$('#prch').val();
				var high=$('#prcl').val();
				$('#prch').val(high);
				$('#prcl').val(low);
				$('#slider_price').slider("values",0,low);
				$('#slider_price').slider("values",1,high);
			}
			var val = $(this).val();
			$('#slider_price').slider("values",0,val);
	});
		
	$('#prch').change(function() {
		var prch=$('#prch').val();
		var prcl=$('#prcl').val();
		if(prcl=="" || prcl*1<<?=$minn?>){
			prcl=<?=$minn?>;
			$('#prcl').val(prcl);
		}
		if(prch=="" || prch*1><?=$maxx?>){
			prch=<?=$maxx?>;
			$('#prch').val(prch);
			$('#slider_price').slider("values",1,prch);
		}
		if(prcl*1><?=$maxx?>){
				var low=$('#prch').val();
				var high=<?=$maxx?>;
				$('#prch').val(high);
				$('#prcl').val(low);
				$('#slider_price').slider("values",0,low);
				$('#slider_price').slider("values",1,high);
				var prch=high;
				var prcl=low;
		}
		if(prch*1<<?=$minn?>){
			var low=<?=$minn?>;
			var high=$('#prcl').val();
			$('#prch').val(high);
			$('#prcl').val(low);
			$('#slider_price').slider("values",0,low);
			$('#slider_price').slider("values",1,high);
			var prch=high;
			var prcl=low;
		}
		if(prcl*1>prch*1){
				var low=$('#prch').val();
				var high=$('#prcl').val();
				$('#prch').val(high);
				$('#prcl').val(low);
				$('#slider_price').slider("values",0,low);
				$('#slider_price').slider("values",1,high);
			}
		var val1 = $(this).val();
		$('#slider_price').slider("values",1,val1);
	});	
		
		
		$( "#slider_price" ).slider({
			range: true,
			min:<?=$minn?>,
			max:<?=$maxx?>,
			values: [ <?=$_GET[prcl]?>, <?=$_GET[prch]?> ],
			slide: function( event, ui ) {
				//Поле минимального значения
				$( "#prcl" ).val(ui.values[ 0 ]);
				//Поле максимального значения
				$("#prch").val(ui.values[1]);			}
		});
		//Записываем значения ползунков в момент загрузки страницы
		//То есть значения по умолчанию
		$( "#prcl" ).val($("#slider_price").slider( "values", 0 ));
		$( "#prch" ).val($("#slider_price").slider( "values", 1 ));
	});
	
	
	
	
	
  </script>
  
<script type="text/javascript">
function gosort(){
	
	var sort=$("#sort").val();
	
	var cat=$("#cat").val();
	if(cat!="") cat="cat="+cat+"\u0026" ;
	
	var met=$("#met").val();
	if(met!="") met="met="+met+"\u0026" ;
	
	var prb=$("#prb").val();
	if(prb!="") prb="prb="+prb+"\u0026" ;
	
	var wgtl=$("#wgtl").val();
	if(wgtl!="") wgtl="wgtl="+wgtl+"\u0026" ;
	
	var wgth=$("#wgth").val();
	if(wgth!="") wgth="wgth="+wgth+"\u0026" ;
		
	var prcl=$("#prcl").val();
	if(prcl!="") prcl="prcl="+prcl+"\u0026" ;
	
	var prch=$("#prch").val();
	if(prch!="") prch="prch="+prch+"\u0026" ;
	
	if(sort=="pl") document.location.search="?"+met+prb+cat+prcl+prch+wgtl+wgth+"sort=pl";
	if(sort=="ph") document.location.search="?"+met+prb+cat+prcl+prch+wgtl+wgth+"sort=ph";
	if(sort=="age") document.location.search="?"+met+prb+cat+prcl+prch+wgtl+wgth+"sort=age";
	
}
function goreset(){
	var sort=$("#sort").val();
	if(window.sort) sort="sort="+sort ;
	else sort="sort="+$("#hsort").val();	
	document.location.search=sort;
}
function goresetprc(){
	var sort=$("#sort").val();
	if(window.sort) sort="sort="+sort ;
	else sort="sort="+$("#hsort").val();	
	
	var cat=$("#cat").val();
	if(cat!="") cat="cat="+cat+"\u0026" ;
	
	var met=$("#met").val();
	if(met!="") met="met="+met+"\u0026" ;
	
	var prb=$("#prb").val();
	if(prb!="") prb="prb="+prb+"\u0026" ;
	
	var wgtl=$("#wgtl").val();
	if(wgtl!="") wgtl="wgtl="+wgtl+"\u0026" ;
	
	var wgth=$("#wgth").val();
	if(wgth!="") wgth="wgth="+wgth+"\u0026" ;
		
	document.location.search="?"+met+prb+cat+wgtl+wgth+sort;
}  
function goresetwgt(){
	var sort=$("#sort").val();
	if(window.sort) sort="sort="+sort ;
	else sort="sort="+$("#hsort").val();	
	
	var cat=$("#cat").val();
	if(cat!="") cat="cat="+cat+"\u0026" ;
	
	var met=$("#met").val();
	if(met!="") met="met="+met+"\u0026" ;
	
	var prb=$("#prb").val();
	if(prb!="") prb="prb="+prb+"\u0026" ;
	
	var prcl=$("#prcl").val();
	if(prcl!="") prcl="prcl="+prcl+"\u0026" ;
	
	var prch=$("#prch").val();
	if(prch!="") prch="prch="+prch+"\u0026" ;
		
	document.location.search="?"+met+prb+cat+prcl+prch+sort;
}  

function gogo(){	
	var wgtl=$("#wgtl").val();
	if(wgtl!="") wgtl="wgtl="+wgtl+"\u0026";	
	var wgth=$("#wgth").val();
	if(wgth!="") wgth="wgth="+wgth+"\u0026";	
	var cat=$("#cat").val();
	if(cat!="") cat="cat="+cat+"\u0026";	
	var prb=$("#prb").val();
	if(prb!="") prb="prb="+prb+"\u0026";
	var sort=$("#sort").val();
	if(window.sort) sort="sort="+sort ;
	else sort="sort="+$("#hsort").val();	
	var met=$("#met").val();
	if(met!="") met="met="+met+"\u0026";
	var prcl=$("#prcl").val();
	if(prcl!="") prcl="prcl="+prcl+"\u0026";
	var prch=$("#prch").val();
	if(prch!="") prch="prch="+prch+"\u0026";
	document.location.search="?"+cat+met+prb+prcl+prch+wgtl+wgth+sort;
}  

$(document).ready(function(){
	
	var sort=$("#sort").val();
	if(!window.sort) sort=$("#hsort").val();
	
	
	$('#prcl').bind("change keyup input click", function() {
    if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }
});
$('#prch').bind("change keyup input click", function() {
    if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }
});

$('#wgtl').bind("change keyup input click", function() {
    if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }
});
$('#wgth').bind("change keyup input click", function() {
    if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }
});
	$("#cat").val("<?=$_GET[cat]?>");
	$("#met").val("<?=$_GET[met]?>");
	$("#prb").val("<?=$_GET[prb]?>");
	$("#wgtl").val("<?=$_GET[wgtl]?>");
	$("#wgth").val("<?=$_GET[wgth]?>");	
	$("#prcl").val("<?=$_GET[prcl]?>");
	$("#prch").val("<?=$_GET[prch]?>");
	
	if ($("#prcl").val()==0)$("#prcl").val("");
	if ($("#prch").val()==999999)$("#prch").val("");
	if ($("#wgtl").val()==0)$("#wgtl").val("");
	if ($("#wgth").val()==99999)$("#wgth").val("");
});
</script>
</head> 

<body> 

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




<div id="header">
	<div id="header_inside">
			<img src="images/header.jpg" alt="setalpm" width="999" height="222" border="0" usemap="#Map" /><br />																																									
		<ul id="menu">
				<li><a href="index.php" class="but1_active">Домой</a></li>
				<li><a href="about.php" class="but2">О нас</a></li>
				<li><a href="news.php" class="but3">Новости</a></li>
				<li><a href="services.php" class="but4">Услуги</a></li>				
		    	<li><a href="company.php" class="but5">Контакты</a></li>
		</ul>
	</div>
</div>
<div id="content_inside">
	<div id="sidebar">
    	<div id='fg_membersite'>
          <form method="post" action="">
                <ul>
                    <li>
                        <ul class="clear">
                            <li>
                                <label>Категория</label>
                                <select class="gosel" onchange="gogo()" id="cat"  name="cat">
                                    <option value="">Все</option>
								<?  $add="";
									$add.=" AND main.active=1";
									if($_GET[met]=="")$add.="";
									else $add.=" AND main.metall_id=$_GET[met]";
									if($_GET[prb]=="")$add.="";
									else $add.=" AND main.proba_id=$_GET[prb]";
									$query="SELECT DISTINCT category.category,category.id FROM  category,main WHERE main.category_id=category.id ".$add;
									$result = mysql_query($query) or die('MySql Error' . mysql_error());
										while($row=mysql_fetch_array($result)){?>
											<option value="<?=$row[id]?>"> <?=$row[category]?></option>
										 <? } ?> 
									
									
                                	</select>   
                            </li>
                           
                        </ul>                        
                    </li>
                    <li>
                        <ul class="clear">
                            <li>
                                <label>Металл</label>
                                <select class="gosel" id="met" onchange="gogo()" name="met">
                                    <option value="">Все</option>
                              <?  	$add="";
							  		$add.=" AND main.active=1";
									if($_GET[cat]=="")$add.="";
									else $add.=" AND main.category_id=$_GET[cat]";
									if($_GET[prb]=="")$add.="";
									else $add.=" AND main.proba_id=$_GET[prb]";
									$query="SELECT DISTINCT metall.metall,metall.id FROM  metall,main WHERE  main.metall_id=metall.id " .$add;
								  	$result = mysql_query($query) or die('MySql Error' . mysql_error());
									while($row=mysql_fetch_array($result)){?>
									<option value="<?=$row[id]?>"> <?=$row[metall]?></option>
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
                                <input id="prcl" type="text" style="width:55px; text-align:center; margin-right:1px; padding-left:0px; padding-right:0px" name="from" value="" />
                                </td><td> - </td><td><input id="prch" type="text"  style="width:55px; text-align:center;  margin-left:1px; padding-left:0px; padding-right:0px" name="to" value=""/></td>
                                <td valign="top"><input onclick="gogo()" type="button" style="width: 20px; margin-left:3px; height:26px" value=">" name="ok" class="gosub" /></td></tr></table>
   							</li>
                        </ul>
                   </li>
                   <li>
                   	<ul class="clear">
                   		<li><div id="slider_price"></div></li>
                    </ul>
                   </li>
                   </br>
                    <li>
                    	<ul class="clear">
                        </ul>
                    </li>
                    <li>
                        <ul class="clear">
                            <li>
                             <? if($_GET[prcl]||$_GET[prch]){ ?>
                               <input style="width:144px" onclick="goresetprc()" type="button" value="Сбросить цену" name="reset" class="gosub" /> <? } ?>
                            </li>
                           
                        </ul> 
                                              
                    </li>
                   <li>
                        <ul class="clear">
                            <li>
                                <label>Проба</label>
                                <select class="gosel" id="prb" onchange="gogo()" name="prb">
                                    <option value="">Все</option>
                                  <? $add="";
								  	$add.=" AND main.active=1";	
									if($_GET[cat]=="")$add.="";
									else $add.=" AND main.category_id=$_GET[cat]";
									if($_GET[met]=="")$add.="";
									else $add.=" AND main.metall_id=$_GET[met]";
									$query="SELECT DISTINCT proba.proba,proba.id FROM  proba,main WHERE  main.proba_id=proba.id " .$add;
								  	$result = mysql_query($query) or die('MySql Error' . mysql_error());
									while($row=mysql_fetch_array($result)){?>
									<option value="<?=$row[id]?>"> <?=$row[proba]?></option>
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
                                <input id="wgtl" type="text" style="width:55px; text-align:center;  margin-right:1px; padding-left:0px; padding-right:0px" name="from" value="" /></td><td> - </td><td><input id="wgth" type="text"  style="width:55px; text-align:center;  margin-left:1px; padding-left:0px; padding-right:0px" name="to"  value="" /></td><td valign="top"><input onclick="gogo()" type="button" style="width: 20px; margin-left:3px; height:26px" value=">" name="ok" class="gosub" /></td></tr></table>
                            </li>
                           
                        </ul> 
                                              
                    </li>
                    <li>
                        <ul class="clear">
                            <li>
                             <? if($_GET[wgtl]||$_GET[wgth]){ ?>
                               <input style="width:144px" onclick="goresetwgt()" type="button" value="Сбросить вес" name="reset" class="gosub"> <? } ?>
                            </li>
                           
                        </ul> 
                                              
                    </li>
                    <li>
                        <ul class="clear">
                            <li><br />
                             <? if($_GET[cat]||$_GET[met]||$_GET[prb]||$_GET[prcl]||$_GET[prch]||$_GET[wgtl]||$_GET[wgth]){ ?>
                               <input style="width:144px; height:30px" onclick="goreset()" type="button" value="Сбросить всё" name="reset" class="gosub"> <? } ?>
                            </li>
                           
                        </ul> 
                                              
                    </li>
                 
                </ul>
        </form>
        
       </div>	
	</div>
     
        <div id='my_membersite' style="float:left; width:752px; height:45px">	
           
           
           <? $num=9; 
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
			$start=$num*$page-$num;
			if($_GET[sort]){
				$dest=$dest."sort=".$_GET[sort]."&";
				if($_GET[sort]=="ph") $query_pag_data = $queryall." ORDER BY price DESC LIMIT $start, $num";
				if($_GET[sort]=="pl") $query_pag_data = $queryall." ORDER BY price LIMIT $start, $num";
				if($_GET[sort]=="age") $query_pag_data = $queryall." ORDER BY date_created DESC LIMIT $start, $num";
			}
			else $query_pag_data = $queryall." ORDER BY date_created DESC LIMIT $start, $num";
			$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
			
		    if (mysql_num_rows($result_pag_data) == 0) {?>
                    <table height="400px" align="center"><tr><td> <?
    				 echo '<h4 align="center" class="alert-error">' . "Ничего не найдено" . '</h4>'; 
					 	if($_GET[sort]){?>
                   			<input type="hidden" id="hsort" value="<?=$_GET[sort]?>"/>
                        <? }
						else { ?>
                        	<input type="hidden" id="hsort" value="age"/>
                        <? }
                   	exit; }
			else {						
					$count = mysql_num_rows($result); { ?>
                    <table align="right"><tr><td> 
					<p style="font-size:0.8em; font-weight:bold">Всего найдено <?=$count?></p>
					<? }
					} ?>
                    </td><td width="195px">
                    </td><td><ul style="padding-top:10px; padding-right:5px" class="clear">
                
        				<li >
                      	<select   class="gosel" id="sort" style="width:200px" onchange="gosort()">
						<? if(!$_GET[sort] || $_GET[sort]=="age"){ ?>
                        <option selected="selected" value="age">Сначала новые</option>
      					<option value="pl">Цена от низкой к высокой</option>
      					<option value="ph">Цена от высокой к низкой</option>
						<? } 
						if($_GET[sort]=="pl"){ ?>
						<option value="age">Сначала новые</option>
      					<option selected="selected" value="pl">Цена от низкой к высокой</option>
      					<option value="ph">Цена от высокой к низкой</option>
						<? } 
						if($_GET[sort]=="ph"){ ?>
						<option value="age">Сначала новые</option>
      					<option value="pl">Цена от низкой к высокой</option>
      					<option selected="selected" value="ph">Цена от высокой к низкой</option>
						<? } ?>
      					</select>
     					</li>
         			</ul>
                    </td></tr></table>
				</div>
                <div id="main_block">
                <div id="items">
                     <table><tr>
		<? $i=0; $j=0;	
		while ($row = mysql_fetch_array($result_pag_data)) { 
				$query_category = "SELECT category FROM `category` WHERE `id`='$row[category_id]'";
				$result_category = mysql_query($query_category) or die('MySql Error' . mysql_error());
				$row_category = mysql_fetch_array($result_category);
				$query_metall = "SELECT metall FROM `metall` WHERE `id`='$row[metall_id]'";
				$result_metall = mysql_query($query_metall) or die('MySql Error' . mysql_error());
				$row_metall = mysql_fetch_array($result_metall);
				$query_proba = "SELECT proba FROM `proba` WHERE `id`='$row[proba_id]'";
				$result_proba = mysql_query($query_proba) or die('MySql Error' . mysql_error());
				$row_proba = mysql_fetch_array($result_proba);
				$i++; 
				if($j==3){
					$j=0; ?>
					<tr>
				 <? }
				 if(!$row['image'])	$mainimg="admin/images/noimage.jpg";
				 else $mainimg="admin/uploads/".$row['id']."/ready/".$row['image'];
			?>
            
            
				<td><div onclick="location.href='indexpage.php?id=<?=$row['id']?>';" class='item'><span><?=$row['price']?> руб.</span><p style="margin-left:20px"><?=$row_metall[metall]?> <?=$row_proba[proba]?>, <?=$row_category[category]?>, <?=$row['weight']?> гр.</p><a style="display:block" href='indexpage.php?id=<?=$row['id']?>'><img style="width:210px; height:158px" src='<?=$mainimg?>' alt="<?=$row_metall[metall]?> <?=$row_proba[proba]?>, <?=$row_category[category]?>, <?=$row['weight']?> гр." /></a></div></td>
        
            
				<? 
				if($i==3){
					$i=0; ?>
					</tr>
				 <? }
   			 $j++;

 }?> 
</table></div>
		<br />
<? 
$param="";
if($_SERVER['QUERY_STRING']=="")$dest=$_SERVER['PHP_SELF']."?";
else {
	if($_GET[sort])$param=$param."sort=".$_GET[sort]."&";
	if($_GET[cat])$param=$param."cat=".$_GET[cat]."&";
	if($_GET[met])$param=$param."met=".$_GET[met]."&";
	if($_GET[prcl])$param=$param."prcl=".$_GET[prcl]."&";
	if($_GET[prch])$param=$param."prch=".$_GET[prch]."&";
	if($_GET[prb])$param=$param."prb=".$_GET[prb]."&";
	if($_GET[wgtl])$param=$param."wgtl=".$_GET[wgtl]."&";
	if($_GET[wgth])$param=$param."wgth=".$_GET[wgth]."&";
	$dest=$_SERVER['PHP_SELF']."?".$param;
	}

mypagesnew($num,$page,$pages,$dest); ?>			
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
