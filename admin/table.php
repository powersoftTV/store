<?
require_once("baza.php");
require_once("include/membersite_config.php");
/*if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}*/

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction 
if(!$sidx) $sidx=1;

$totalrows = isset($_REQUEST['totalrows']) ? $_REQUEST['totalrows']: false;
if($totalrows) {
	$limit = $totalrows;
}
/*$filters = $_GET['filters'];
$search = $_GET['_search'];

    $where = "";
$filters=urldecode($filters);
if(($search==true) &&($filters != "")) {


        $filters = json_decode($filters,true);
        $where = " where ";
        $whereArray = array();
      
	   $rules = $filters[rules];
       $groupOperation = $filters[groupOp];
		
       foreach($rules as $rule) {

            $fieldName = $rule[field];
            $fieldData = $rule[data];
            switch ($rule[op]) {
           case "eq":
                $fieldOperation = " = '".$fieldData."'";
                break;
           case "ne":
                $fieldOperation = " != '".$fieldData."'";
                break;
           case "lt":
                $fieldOperation = " < '".$fieldData."'";
                break;
           case "gt":
                $fieldOperation = " > '".$fieldData."'";
                break;
           case "le":
                $fieldOperation = " <= '".$fieldData."'";
                break;
           case "ge":
                $fieldOperation = " >= '".$fieldData."'";
                break;
           case "nu":
                $fieldOperation = " = ''";
                break;
           case "nn":
                $fieldOperation = " != ''";
                break;
           case "in":
                $fieldOperation = " IN (".$fieldData.")";
                break;
           case "ni":
                $fieldOperation = " NOT IN '".$fieldData."'";
                break;
           case "bw":
                $fieldOperation = " LIKE '".$fieldData."%'";
                break;
           case "bn":
                $fieldOperation = " NOT LIKE '".$fieldData."%'";
                break;
           case "ew":
                $fieldOperation = " LIKE '%".$fieldData."'";
                break;
           case "en":
                $fieldOperation = " NOT LIKE '%".$fieldData."'";
                break;
           case "cn":
                $fieldOperation = " LIKE '%".$fieldData."%'";
                break;
           case "nc":
                $fieldOperation = " NOT LIKE '%".$fieldData."%'";
                break;
            default:
                $fieldOperation = "";
                break;
                }
            if($fieldOperation != "") $whereArray[] = $fieldName.$fieldOperation;
        }
        if (count($whereArray)>0) {
            $where .= join(" ".$groupOperation." ", $whereArray);
        } else {
            $where = "";
        }
    }
*/
$SQL = "SELECT * FROM main ";
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
$count = mysql_num_rows($result);
if ($limit<0) $limit = $count;
if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
$SQL = "SELECT * FROM main ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());

$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$resultcat=mysql_query("SELECT * FROM `category` WHERE `id`= '$row[category_id]'") or die(mysql_error());
	 $rowcat=mysql_fetch_array($resultcat);
	 
	 $resultmet=mysql_query("SELECT * FROM `metall` WHERE `id`= '$row[metall_id]'") or die(mysql_error());
	 $rowmet=mysql_fetch_array($resultmet); 
	 
	  $resultvst=mysql_query("SELECT * FROM `vstavka` WHERE `id`= '$row[vstavka_id]'") or die(mysql_error());
	 $rowvst=mysql_fetch_array($resultvst);
	 
	  $resultprob=mysql_query("SELECT * FROM `proba` WHERE `id`= '$row[proba_id]'") or die(mysql_error());
	 $rowprob=mysql_fetch_array($resultprob); 
	 
	 $resultraz=mysql_query("SELECT * FROM `razmer` WHERE `id`= '$row[razmer_id]'") or die(mysql_error());
	 $rowraz=mysql_fetch_array($resultraz);
	 
	 if($row[active]==1) $status="активно";
	 else $status="неактивно";
	 
    $responce->rows[$i]['id']=$row[id];
    $responce->rows[$i]['cell']=array($row[id],$row[artikul],$status,$rowcat[category],$rowmet[metall],$rowprob[proba],$rowraz[razmer],$rowvst[vstavka],$row[weight],$row[price],$row[description],$row[notes],$row[date_created],$row[date_updated],$row[edit]);
    $i++;
}        
echo json_encode($responce);

?>
