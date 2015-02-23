<?
require_once("baza.php");
$cat=$_GET[cat];
$cat_id=$cat."_id";
if($_POST[id]){
	$id=$_POST[id];
	$resp=array();
	if($_POST[oper]==del){		
		$result=mysql_query("SELECT * FROM `main` WHERE `$cat_id`='$id'");
		$total=mysql_num_rows($result);
		if(!$total) {
			$ress=mysql_query ("DELETE FROM `$cat` WHERE `id`='$id' ") or die(mysql_error()); 
			if($ress){
				$resp[answerType]="OK";
				$resp[hidden]="";
				}
			else {
				$resp[answerType]="";
				$resp[hidden]="Невозможно удалить.";
				}
			
			
		}
		else {
			$resp[answerType]="";
			$resp[hidden]="Невозможно удалить. Запись используется";
		}
		
	}
	if($_POST[$cat]){
		$input_text=$_POST[$cat];
		$input_text	= trim($input_text);
		$input_text = htmlspecialchars($input_text);
		$input_text = mysql_escape_string($input_text);
		if(mb_strwidth($input_text, 'UTF-8')<60){
			if($input_text=="" ||$input_text==" ") {
				$resp[answerType]="";
				$resp[hidden]="Используются недопустимые символы или пустая строка";
				}
			else {
				$result=mysql_query("SELECT * FROM `$cat` WHERE `$cat`  LIKE '$input_text'");
				$total=mysql_num_rows($result);
				$row=mysql_fetch_array($result);
				if($total && $row[id]!= $id) {
					$resp[answerType]="";
					$resp[hidden]="Запись существует.";
				}
				else {
					$rees=mysql_query ("UPDATE `$cat` SET `$cat`= '$input_text'   WHERE `id`='$id'") or die(mysql_error());
					if($rees){
						$resp[answerType]="OK";
						$resp[hidden]="";
						}
					else {
						$resp[answerType]="";
						$resp[hidden]="Не удалось записать.";
						}
					}
	 			
				}
			}
		else {
			$resp[answerType]="";
			$resp[hidden]="Слишком много символов.";
		}
	}
 echo json_encode($resp);		
}
if($_POST[oper]==add){
	$resp=array();
	if($_POST[$cat]){
		$input_text=$_POST[$cat];
		$input_text	= trim($input_text);
		$input_text = htmlspecialchars($input_text);
		$input_text = mysql_escape_string($input_text);
		if(mb_strwidth($input_text, 'UTF-8')<60){
			if($input_text=="" ||$input_text==" ") {
				$resp[answerType]="";
				$resp[hidden]="Используются недопустимые символы или пустая строка";
				$resp[id]="";
				}
			else {
				$result=mysql_query("SELECT * FROM `$cat` WHERE `$cat`  LIKE '$input_text'");
				$total=mysql_num_rows($result);
				$row=mysql_fetch_array($result);
				if($total) {
					$resp[answerType]="";
					$resp[hidden]="Запись существует.";
					$resp[id]="";
				}
				else {
					$rees=mysql_query ("INSERT INTO $cat($cat) VALUES('$input_text')") or die(mysql_error());
					$id=mysql_insert_id();
					if($rees){
						$resp[answerType]="OK";
						$resp[hidden]="";
						$resp[id]=$id;
						}
					else {
						$resp[answerType]="";
						$resp[hidden]="Не удалось записать.";
						$resp[id]="";
						}
					}
	 			
				}
			}
		else {
			$resp[answerType]="";
			$resp[hidden]="Слишком много символов.";
			$resp[id]="";
		}
	}
 echo json_encode($resp);	
	
}
?>
