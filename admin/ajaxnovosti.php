<?
require_once("baza.php");
/*$_POST['oper']="edit";
$_POST[id]=114;   
$data="2013-09-09";
$_POST[story_name]="test";  */
if($_POST[story_name]){
		$_POST[story_name] = strip_tags($_POST[story_name]);
		$_POST[story_name]	= trim($_POST[story_name]);
		$_POST[story_name] = htmlspecialchars($_POST[story_name]);
		$_POST[story_name] = mysql_escape_string($_POST[story_name]);
		$_POST[story_name] = mb_substr($_POST[story_name], 0,200, 'UTF-8');
}
if($_POST[description]){
		$_POST[description] = strip_tags($_POST[description]);
		$_POST[description]	= trim($_POST[description]);
		$_POST[description] = htmlspecialchars($_POST[description]);
		$_POST[description] = mysql_escape_string($_POST[description]);
		$_POST[description] = mb_substr($_POST[description], 0,200, 'UTF-8');
	}
if($_POST[datepicker]){
		$_POST[datepicker] = strip_tags($_POST[datepicker]);
		$_POST[datepicker]	= trim($_POST[datepicker]);
		$_POST[datepicker] = htmlspecialchars($_POST[datepicker]);
		$_POST[datepicker] = mysql_escape_string($_POST[datepicker]);
		$_POST[datepicker] = mb_substr($_POST[datepicker], 0,20, 'UTF-8');
	}
if($_POST[story]){
		$_POST[story] = mb_substr($_POST[story], 0,4000, 'UTF-8');
	}
	if($_POST['oper']=='edit'){  
		
		$id=$_POST[id];
		$story=$_POST[story];
		$story_sthtml =strip_tags($story);
		$story_sthtml = trim($story_sthtml);
		$story_sthtml = htmlspecialchars($story_sthtml);
		$story_sthtml = mysql_escape_string($story_sthtml);
		
		$res=mysql_query("UPDATE  pages SET  `active`='$_POST[active]',`description`='$_POST[description]',`story_name`='$_POST[story_name]',`story`='$_POST[story]',`story_sthtml`='$story_sthtml',`datepicker`='$_POST[datepicker]' WHERE `id`='$id'") or die(mysql_error());
		
			}
			
	if($_POST['oper']=='add') {
		$story=$_POST[story];
		$story_sthtml=strip_tags($story);
		
		mysql_query("INSERT INTO pages (active,description,story_name,story,story_sthtml,datepicker) VALUES('$_POST[active]','$_POST[description]','$_POST[story_name]','$_POST[story]','$story_sthtml','$_POST[datepicker]')") or die(mysql_error());	 
		$id=mysql_insert_id();		
		$_SESSION['id']=$id;
		$q =mysql_query("SELECT * FROM pages WHERE `id`='$id' ");
		$res = mysql_fetch_assoc($q);
		$dateee=$res['date_updated'];
		mysql_query("UPDATE pages SET  `date_created`='$dateee'  WHERE `id`='$id'")or die(mysql_error());
		$q = mysql_query("SELECT * FROM pages WHERE `id`='$id' ");
		$res = mysql_fetch_assoc($q);
		}
	
$q = mysql_query("SELECT * FROM pages WHERE `id`='$id'");
$res = mysql_fetch_assoc($q);

if($_POST['oper']=='del'){
	$id=$_POST[id];
	
	$res=mysql_query ("DELETE FROM `pages` WHERE `id`='$id' ") or die(mysql_error()) ;
			
echo json_encode($res);
}

 
	
