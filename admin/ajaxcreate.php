<?
require_once("baza.php");
require_once("include/membersite_config.php");
//$_POST[selcategory]=kkkkkkk;
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
//$_POST[edit]=40;
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break; 
    }
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}
function imagerotateEquivalent($srcImg, $angle, $bgcolor = 0 , $ignore_transparent = 0) {
    function rotateX($x, $y, $theta){
        return $x * cos($theta) - $y * sin($theta);
    }
    function rotateY($x, $y, $theta){
        return $x * sin($theta) + $y * cos($theta);
    }

    $srcw = imagesx($srcImg);
    $srch = imagesy($srcImg);

    //Normalize angle
    $angle %= 360;
    //Set rotate to clockwise
    $angle = -$angle;

    if($angle == 0) {
        if ($ignore_transparent == 0) {
            imagesavealpha($srcImg, true);
        }
        return $srcImg;
    }

    // Convert the angle to radians
    $theta = deg2rad ($angle);

    //Standart case of rotate
    if ( (abs($angle) == 90) || (abs($angle) == 270) ) {
        $width = $srch;
        $height = $srcw;
        if ( ($angle == 90) || ($angle == -270) ) {
            $minX = 0;
            $maxX = $width;
            $minY = -$height+1;
            $maxY = 1;
        } else if ( ($angle == -90) || ($angle == 270) ) {
            $minX = -$width+1;
            $maxX = 1;
            $minY = 0;
            $maxY = $height;
        }
    } else if (abs($angle) === 180) {
        $width = $srcw;
        $height = $srch;
        $minX = -$width+1;
        $maxX = 1;
        $minY = -$height+1;
        $maxY = 1;
    } else {
        // Calculate the width of the destination image.
        $temp = array (rotateX(0, 0, 0-$theta),
        rotateX($srcw, 0, 0-$theta),
        rotateX(0, $srch, 0-$theta),
        rotateX($srcw, $srch, 0-$theta)
        );
        $minX = floor(min($temp));
        $maxX = ceil(max($temp));
        $width = $maxX - $minX;

        // Calculate the height of the destination image.
        $temp = array (rotateY(0, 0, 0-$theta),
        rotateY($srcw, 0, 0-$theta),
        rotateY(0, $srch, 0-$theta),
        rotateY($srcw, $srch, 0-$theta)
        );
        $minY = floor(min($temp));
        $maxY = ceil(max($temp));
        $height = $maxY - $minY;
    }

    $destimg = imagecreatetruecolor($width, $height);
        $bg2 = imagecolorallocate($destimg, 255, 0, 255);
        imagecolortransparent($destimg,$bg2);
        
/*    if ($ignore_transparent == 0) {
        imagefill($destimg, 0, 0, imagecolorallocatealpha($destimg, 255,255, 255, 127));
        imagesavealpha($destimg, true);
    }*/

    // sets all pixels in the new image
    for($x=$minX; $x<$maxX; $x++) {
        for($y=$minY; $y<$maxY; $y++) {
            // fetch corresponding pixel from the source image
            $srcX = round(rotateX($x, $y, $theta));
            $srcY = round(rotateY($x, $y, $theta));
            if($srcX >= 0 && $srcX < $srcw && $srcY >= 0 && $srcY < $srch) {
                $color = imagecolorat($srcImg, $srcX, $srcY );
            } else {
                $color = $bgcolor;
            }
            imagesetpixel($destimg, $x-$minX, $y-$minY, $color);
        }
    }
        imagecolortransparent($destimg, imagecolorallocate($destimg, 0, 0, 0));
    return $destimg;
}
function turn($turn_image, $image, $degrees){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	
		$newImage = imagerotateEquivalent($source, $degrees, 0);
	//$newImage =$source;
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$turn_image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$turn_image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$turn_image);  
			break; 
    }
	chmod($turn_image, 0777);
	return $turn_image;
}

function AutoCropImage($thumb_image_name, $image, $ratio){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	if($imagewidth/$imageheight<=$ratio){
		$width=$imagewidth;
		$height=$imagewidth/$ratio;
		$xstart=0;
		$ystart=($imageheight-$height)/2;		
	}
	else {
		$width=$imageheight*$ratio;
		$height=$imageheight;
		$xstart=($imagewidth-$width)/2;
		$ystart=0;
	}
	$newImage = imagecreatetruecolor($width,$height);
	imagecopyresampled($newImage,$source,0,0,$xstart,$ystart,$width,$height,$width,$height);
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break; 
    }
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}
function ScaleImage($thumb_image_name, $image, $scale){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	$width=$imagewidth/$scale;
	$height=$imageheight/$scale;
	$newImage = imagecreatetruecolor($width,$height);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,0,0,$width,$height,$imagewidth,$imageheight);
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break; 
    }
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}

if ($_POST[selcategory]){	
	if($_POST[description]){
		$_POST[description] = strip_tags($_POST[description]);
		$_POST[description]	= trim($_POST[description]);
		$_POST[description] = htmlspecialchars($_POST[description]);
		$_POST[description] = mysql_escape_string($_POST[description]);
		$_POST[description] = mb_substr($_POST[description], 0,200, 'UTF-8');
	}
	if($_POST[notes]){
		$_POST[notes] = strip_tags($_POST[notes]);
		$_POST[notes] = trim($_POST[notes]);
		$_POST[notes] = htmlspecialchars($_POST[notes]);
		$_POST[notes] = mysql_escape_string($_POST[notes]);
		$_POST[notes] = mb_substr($_POST[notes], 0,200, 'UTF-8');
	}
	if($_POST[tegtitle]){
		$_POST[tegtitle] = strip_tags($_POST[tegtitle]);
		$_POST[tegtitle] = trim($_POST[tegtitle]);
		$_POST[tegtitle] = htmlspecialchars($_POST[tegtitle]);
		$_POST[tegtitle] = mysql_escape_string($_POST[tegtitle]);
		$_POST[tegtitle] = mb_substr($_POST[tegtitle], 0,140, 'UTF-8');
	}
	if($_POST[metadescription]){
		$_POST[metadescription] = strip_tags($_POST[metadescription]);
		$_POST[metadescription]	= trim($_POST[metadescription]);
		$_POST[metadescription] = htmlspecialchars($_POST[metadescription]);
		$_POST[metadescription] = mysql_escape_string($_POST[metadescription]);
		$_POST[metadescription] = mb_substr($_POST[metadescription], 0,140, 'UTF-8');
	}
	if($_POST[metakeywords]){
		$_POST[metakeywords] = strip_tags($_POST[metakeywords]);
		$_POST[metakeywords] = trim($_POST[metakeywords]);
		$_POST[metakeywords] = htmlspecialchars($_POST[metakeywords]);
		$_POST[metakeywords] = mysql_escape_string($_POST[metakeywords]);
		$_POST[metakeywords] = mb_substr($_POST[metakeywords], 0,140, 'UTF-8');
	}
	if($_POST[weight]){
		$_POST[weight] = strip_tags($_POST[weight]);
		$_POST[weight] = trim($_POST[weight]);
		$_POST[weight] = htmlspecialchars($_POST[weight]);
		$_POST[weight] = mysql_escape_string($_POST[weight]);
		$_POST[weight] = mb_substr($_POST[weight], 0,10, 'UTF-8');
	}
	if($_POST[price]){
		$_POST[price] = strip_tags($_POST[price]);
		$_POST[price] = trim($_POST[price]);
		$_POST[price] = htmlspecialchars($_POST[price]);
		$_POST[price] = mysql_escape_string($_POST[price]);
		$_POST[price] = mb_substr($_POST[price], 0,10, 'UTF-8');
	}
	
	if($_POST[hidden]){	
		if($_POST[uveren]){	
		mysql_query("UPDATE main SET   `active`='$_POST[selactive]', `price`='$_POST[price]', `metall_id`='$_POST[metall]',`category_id`='$_POST[selcategory]',`proba_id`='$_POST[proba]',`description`='$_POST[description]', `vstavka_id`='$_POST[vstavka]' , `razmer_id`='$_POST[razmer]' , `notes`='$_POST[notes]',`teg_title`='$_POST[tegtitle]',`meta_description`='$_POST[metadescription]',`meta_keywords`='$_POST[metakeywords]', `weight`='$_POST[weight]' WHERE `id`='$_POST[hidden]'") or die(mysql_error());
		$id=$_POST[hidden];	
		$_SESSION['id']=$id;
		$q = mysql_query("SELECT * FROM main WHERE `id`='$id' ");
		$res = mysql_fetch_assoc($q);
		}
		else $res[uveren]=true;
	}
	else {
		mysql_query("INSERT INTO main (razmer_id, notes,active,proba_id,category_id,price,description,vstavka_id,metall_id,teg_title,meta_description,meta_keywords, weight ) VALUES('$_POST[razmer]','$_POST[notes]','$_POST[selactive]','$_POST[proba]','$_POST[selcategory]','$_POST[price]','$_POST[description]', '$_POST[vstavka]','$_POST[metall]','$_POST[tegtitle]','$_POST[metadescription]','$_POST[metakeywords]', '$_POST[weight]')") or die(mysql_error());	 
		$id=mysql_insert_id();		
		$_SESSION['id']=$id;
		$artikul="c".$_POST[selcategory]."-".$id;
		$q =mysql_query("SELECT * FROM main WHERE `id`='$id' ");
		$res = mysql_fetch_assoc($q);
		$dateee=$res['date_updated'];
		mysql_query("UPDATE main SET `artikul`='$artikul', `date_created`='$dateee'  WHERE `id`='$id'")or die(mysql_error());
		$q = mysql_query("SELECT * FROM main WHERE `id`='$id' ");
		$res = mysql_fetch_assoc($q);
		@mkdir("uploads/".$id);
		@mkdir("uploads/".$id."/ready");
		}
	
echo json_encode($res);
}
if ($_POST[edit]){
		$id=$_POST[edit];
		$maintable = mysql_query("SELECT * FROM main WHERE `id`='$id' ");
		$main = mysql_fetch_assoc($maintable);
		echo json_encode($main);
}
if($_POST[upload]){
	$_SESSION['id']=$_POST[id];
	$path="uploads/".$_POST[id];
	$dir = $path."/";
	$valid=array("gif","png","jpg","PNG","JPG","JPEG", "GIF","jpeg");
	$filessize=array();
	$filetime=array();
	
 	if (is_dir($dir)) {
  		if ($dh = opendir($dir)) {
	  		while (($file = readdir($dh)) !== false) {
		  		if(filetype($dir . $file)==file){
			 		$exten = substr($file,1 + strrpos($file, "."));
			 		if(in_array($exten, $valid)){
				 		$ft=filectime($dir.$file);
						 $filetime[$file]=$ft;
						 list($imagewidth, $imageheight, $imageType) = getimagesize($dir.$file);
						 if($imagewidth>1001 || $imageheight>1001){
							$scale=$imagewidth/1000;
							ScaleImage($dir.$file, $dir.$file, $scale);
						 }
						if(!file_exists ($dir."ready/".$file)){
							AutoCropImage($dir."ready/".$file,$dir.$file,1.33);
							list($imagewidth, $imageheight, $imageType) = getimagesize($dir."ready/".$file);
							if($imagewidth>250){
								$scalethumb=$imagewidth/200;
								ScaleImage($dir."ready/".$file, $dir."ready/".$file, $scalethumb);
								}
							}
				  		}
			
					}
 	 		}closedir($dh);
 		 }
	}
	$filename=array();
	arsort($filetime,SORT_NUMERIC);
	foreach($filetime as $file => $value){
		$filename[]=$file;
	}
	$filezzzz=$filename[0];
$q = mysql_query("SELECT `image` FROM main WHERE `id`='$_POST[id]' ");
$res = mysql_fetch_assoc($q);

if($res[image]=="") mysql_query("UPDATE main SET `image`='$filezzzz'  WHERE `id`='$_POST[id]'")or die(mysql_error());
$ress=mysql_query("SELECT `image` FROM main WHERE `id`='$_POST[id]' ");
$res = mysql_fetch_assoc($ress);
$mydata=array();
$mydata[files]=$filename;
$mydata[main]=$res[image];
$mydata[id]=$_POST[id];
header("Content-Type: text/plain");
echo json_encode($mydata);
}
if($_POST[del]){
	$_SESSION['id']=$_POST[itemid];
	$dir = "uploads/".$_POST[itemid]."/";
	if(file_exists($dir.$_POST[del])) $res1=unlink($dir.$_POST[del]);
	if(file_exists($dir."ready/".$_POST[del])) $res1=unlink($dir."ready/".$_POST[del]);

echo json_encode(true);
}
if($_POST[makemain]){
	$_SESSION['id']=$_POST[id];
	$path="uploads/".$_POST[id];
	$dir = $path."/";
	$valid=array("gif","png","jpg","PNG","JPG","JPEG", "GIF","jpeg");
	$filessize=array();
	$filetime=array();
	
 	if (is_dir($dir)) {
  		if ($dh = opendir($dir)) {
	  		while (($file = readdir($dh)) !== false) {
		  		if(filetype($dir . $file)==file){
			 		$exten = substr($file,1 + strrpos($file, "."));
			 		if(in_array($exten, $valid)){
				 		$ft=filectime($dir.$file);
						 $filetime[$file]=$ft;
				  		}
			
					}
 	 		}closedir($dh);
 		 }
	}
	$filename=array();
	arsort($filetime,SORT_NUMERIC);
	foreach($filetime as $file => $value){
		$filename[]=$file;
	}

mysql_query("UPDATE main SET `image`='$_POST[makemain]'  WHERE `id`='$_POST[id]'")or die(mysql_error());
$ress=mysql_query("SELECT `image` FROM main WHERE `id`='$_POST[id]' ");
$res = mysql_fetch_assoc($ress);
$mydata=array();
$mydata[files]=$filename;
$mydata[main]=$res[image];
$mydata[id]=$_POST[id];
header("Content-Type: text/plain");
echo json_encode($mydata);
}
if ($_POST['rot']){
	
	if($_POST['direction']== 'rigth')
	turn("uploads/".$_POST[id]."/".$_POST[rot],"uploads/".$_POST[id]."/".$_POST[rot], 90);
	if($_POST['direction']== 'left')
	turn("uploads/".$_POST[id]."/".$_POST[rot],"uploads/".$_POST[id]."/".$_POST[rot], 270);
	AutoCropImage("uploads/".$_POST[id]."/ready/".$_POST[rot],"uploads/".$_POST[id]."/".$_POST[rot],1.33);
	list($imagewidth, $imageheight, $imageType) = getimagesize("uploads/".$_POST[id]."/ready/".$_POST[rot]);
	if($imagewidth>250){
		$scalethumb=$imagewidth/200;
		ScaleImage("uploads/".$_POST[id]."/ready/".$_POST[rot], "uploads/".$_POST[id]."/ready/".$_POST[rot], $scalethumb);
			}
	echo json_encode(true);
}
if ($_POST['name']){
	$x1 = $_POST["x1"];
	$y1 = $_POST["y1"];
	$x2 = $_POST["x2"];
	$y2 = $_POST["y2"];
	$w = $_POST["w"];
	$h = $_POST["h"];
	$id=$_POST["id"];
	$name=$_POST['name'];
	$source="uploads/".$id."/".$name;
	$destination="uploads/".$id."/ready/".$name;
	$cropped = resizeThumbnailImage($destination, $source,$w,$h,$x1,$y1,1);
	list($imagewidth, $imageheight, $imageType) = getimagesize($destination);
	if($imagewidth>250){
		$scalethumb=$imagewidth/200;
		ScaleImage($destination, $destination, $scalethumb);
			}
	echo json_encode(true);
}