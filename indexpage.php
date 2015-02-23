<?
session_start(); 
require_once("admin/baza.php");
require_once("include/membersite_config.php");
if(!$_GET[id]){
	$fgmembersite->RedirectToURL("index.php");
   			 exit;
}
$query_pag_data = "SELECT * FROM `main` WHERE `id`='$_GET[id]'";
$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
$row = mysql_fetch_array($result_pag_data);
if (mysql_num_rows($result_pag_data) == 0){
	$fgmembersite->RedirectToURL("index.php");
   			 exit;
}
$query_category = "SELECT category FROM `category` WHERE `id`='$row[category_id]'";
$result_category = mysql_query($query_category) or die('MySql Error' . mysql_error());
$row_category = mysql_fetch_array($result_category);
$query_metall = "SELECT metall FROM `metall` WHERE `id`='$row[metall_id]'";
$result_metall = mysql_query($query_metall) or die('MySql Error' . mysql_error());
$row_metall = mysql_fetch_array($result_metall);
$query_proba = "SELECT proba FROM `proba` WHERE `id`='$row[proba_id]'";
$result_proba = mysql_query($query_proba) or die('MySql Error' . mysql_error());
$row_proba = mysql_fetch_array($result_proba);
$query_razmer = "SELECT razmer FROM `razmer` WHERE `id`='$row[razmer_id]'";
$result_razmer = mysql_query($query_razmer) or die('MySql Error' . mysql_error());
$row_razmer = mysql_fetch_array($result_razmer);
$query_vstavka = "SELECT vstavka FROM `vstavka` WHERE `id`='$row[vstavka_id]'";
$result_vstavka = mysql_query($query_vstavka) or die('MySql Error' . mysql_error());
$row_vstavka = mysql_fetch_array($result_vstavka);
if(!$row_vstavka=="")$vst="вставка: ".$row_vstavka[vstavka];
if(!$row_razmer=="")$raz=", размер: ".$row_razmer[razmer];

if(!$row['active']==true ){
	if(!$fgmembersite->CheckLogin())
		{
    		$fgmembersite->RedirectToURL("admin/login.php");
   			 exit;
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$row['teg_title'] ?></title>
<meta name="description" content="<?=$row['meta_description'] ?>"/>
<meta name="keywords" content="<?=$row['meta_keywords'] ?>"/>

<link rel="stylesheet" type="text/css" media="screen" href="style.css" />
<link rel="stylesheet"	type="text/css" href="bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="lib/jquery.ad-gallery.css"/>

<script type="text/javascript"	src="admin/scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="lib/jquery.ad-gallery.js"></script>

<link rel="stylesheet" href="include/fancyBox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="include/fancyBox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" href="include/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="include/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
 
<script type="text/javascript">

 $(function() {
    var galleries = $('.ad-gallery').adGallery({update_window_hash: false});  
   
   });
</script>
<script type="text/javascript">
$(document).ready(function() {
	$(".ad-gallery").on("click", ".ad-image", function() {
		var biglink=$(".ad-image").find("img").attr("src");
		$('a[href="'+biglink+'"][charset="utf-8"]').removeAttr("rel");
	});
});	

	$(".fancybox").fancybox({
			helpers:  {
        		thumbs : {
            		width: 50,
            		height: 50
        		}
    		},
		});
</script>		
		
		
	


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
		    	<li><a href="company.php" class="but5">Контакты</a></li>
			</ul>
		</div>
	</div>
    <div id="wrapper">
    	<div id="content_inside">
			<div id="main_block" style="width:670px" class="style1">
				<div  style="height:450px" id="item">
            		<div id="gallery" class="ad-gallery">
                			<div class="ad-image-wrapper"></div>
                			<div class="ad-controls"></div>
                			<div class="ad-nav">
                    			<div class="ad-thumbs">
                  					<ul class="ad-thumb-list">
                                    
        							<?	if($_GET[id]) $dir="admin/uploads/".$_GET[id] ;
										if(!$row['image'])	{
											$mainimg="admin/images/noimage.jpg";
											$mainimgbig="admin/images/noimage.jpg";
										}
				 						else {
											$mainimg=$dir."/ready/".$row['image'];
											$mainimgbig=$dir."/".$row['image'];
										}
									?>
                                   
									<li><a charset="utf-8" class="fancybox" rel="group"  href="<?=$mainimgbig?>"><img src="<?=$mainimg?>"  alt="<?=$row_category[category]?>, <?= $row_metall[metall]?> <?= $row_proba[proba]?>"/></a></li>
        							<?	
									if (is_dir($dir)) {
            								if ($dh = opendir($dir)) {
                								while (($file = readdir($dh)) !== false) { 
                    								if (is_file($dir."/".$file) && $file!=$row['image']){?>
                 										<li><a charset="utf-8" class="fancybox" rel="group" href="<?=$dir?>/<?=$file?>"><img src="<?=$dir?>/ready/<?=$file?>" alt="<?=$row_category[category]?>, <?= $row_metall[metall]?> <?= $row_proba[proba]?>" /></a></li>
                 										<? $i++;}
                									}
            										closedir($dh);
           										}
        								}?>
                   					</ul>
                  				</div>
                			</div>
            			</div>
        		</div>
			</div>
 		   	<div id="sidebar" style="width:270px; padding:10px 0 0 0 ">
            	<h1 style="color:#F00"><?=$row['price']." руб." ?></h1>
            	<p><b><?=$row_category[category]." ".$raz ?></b></p>
            	<p><b><?=$row_metall[metall]." ".$row_proba[proba]." пробы, ".$row['weight']."гр."?></b></p>
            	<p><b><?=$vst?></b></p>
            	<p><b>Артикул: <?=$row['artikul'] ?></b></p><br />
            	<p><?=$row['description'] ?></p>
 			</div>
            <div id="toolbox">
          <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_16x16_style">
<a class="addthis_button_facebook"></a>
<a class="addthis_button_odnoklassniki_ru"></a>
<a class="addthis_button_vk"></a>
<a class="addthis_button_twitter"></a>
<a class="addthis_button_google_plusone_share"></a>
<a class="addthis_button_linkedin"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50784ee46b8cc603"></script>
<!-- AddThis Button END -->


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
