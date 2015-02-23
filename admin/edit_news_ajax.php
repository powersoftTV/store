<?
require_once("baza.php");
require_once("include/membersite_config.php");
/*if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
*/ 
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$sidx) $sidx =1;

$totalrows = isset($_REQUEST['totalrows']) ? $_REQUEST['totalrows']: false;
if($totalrows) {
	$limit = $totalrows;
}

$result = mysql_query("SELECT COUNT(*) AS count FROM pages");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if ($limit<0) $limit = $count;
if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit;
$SQL = "SELECT * FROM pages  ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query( $SQL ) or die("Could not execute query.".mysql_error());
$et = ">";
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$story=$_POST[story];
$story_sthtml=htmlspecialchars($story);
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	
	$responce->rows[$i]['id']=$row[id];
    $responce->rows[$i]['cell']=array($row[id],$row[active],$row[story_name],$row[story_sthtml],$row[story],$row[description],$row[date_created],$row[date_updated],$row[datepicker]);
    $i++;
}        
echo json_encode($responce);
	