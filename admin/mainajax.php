<?
require_once("baza.php");
require_once("include/membersite_config.php");
function removeDirectory($dir) {
    if ($objs = glob($dir."/*")) {
       foreach($objs as $obj) {
         is_dir($obj) ? removeDirectory($obj) : unlink($obj);
       }
    }
    rmdir($dir);
  }
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
if($_POST[id]){
	$id=$_POST[id];
	$resp=array();
	if($_POST[oper]==del){		
		
		$ress=mysql_query ("DELETE FROM `main` WHERE `id`='$id' ") or die(mysql_error()) ;
			if($ress){
				removeDirectory("uploads/".$id);
				$resp[answerType]="OK";
				$resp[hidden]="";
				}
			else {
				$resp[answerType]="";
				$resp[hidden]="Невозможно удалить.";
				}
			
			
		
	}
	

 echo json_encode($resp);		
}

?>
