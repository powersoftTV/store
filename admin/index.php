<?
session_start();
require_once("include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
	echo("<script>location.href = 'login.php';</script>");
	exit;
}
require_once("baza.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>панель администратора</title>

<link rel="stylesheet"	type="text/css"	media="screen"	href="style/karen.css" />
<link rel="stylesheet"	type="text/css" media="screen"	href="style/fg_membersite.css" />
<link rel="stylesheet"	type="text/css" media="screen"	href="style/pwdwidget.css" />
<link rel="stylesheet"	type="text/css"	media="screen"	href="style/fineuploader.css" />

<link rel="stylesheet" type="text/css" media="screen" 	href="css/overcast/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" 	href="css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" media="screen"	href="css/jquery.arcticmodal-0.3.css" />
<link rel="stylesheet" type="text/css" media="screen"	href="style/css/imgareaselect-default.css" />


<script type="text/javascript"	src="scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript"	src="scripts/gen_validatorv4.js" ></script>
<script type="text/javascript"	src="scripts/pwdwidget.js"></script>
<script type="text/javascript"	src="scripts/jquery.form.js"></script>
<script type="text/javascript"	src="scripts/jquery.fineuploader-3.3.1.js" ></script>
<script type="text/javascript"	src="js/i18n/grid.locale-ru.js" ></script>
<script type="text/javascript"	src="js/jquery.jqGrid.min.js" ></script>
<script type="text/javascript"	src="js/jquery.arcticmodal-0.3.min.js" ></script>
<script type="text/javascript" 	src="scripts/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript" 	src="tinymce/tinymce.min.js"></script>
<script type="text/javascript"	src="ckeditor/ckeditor.js"></script>
<script type="text/javascript"	src="ckeditor/adapters/jquery.js"></script>
<script type="text/javascript"	src="scripts/jquery-ui-1.10.2.custom.min.js"></script>

<script type="text/javascript">
  
<!--cancel-->
function cancel(){
	var ankap=(Math.random());
	var val = $('#name').val();
	var i = $('#ident').val();
	var id=$("#hidden").val();
	var main=$("#main").val();
	$('#img-' + i).imgAreaSelect({remove: true });
	 if(main=='false'){
     $('#'+i+'').html('<table class="table table-striped table-bordered  table-condensed"><tr><td><img width="200px" src="uploads/'+id+'/ready/'+ val + '?salt='+ankap+'" alt="' + val + '"/></td><td width="150px"><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+false+','+i+')">повернуть налево</a><br /><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+false+','+i+')">повернуть направо</a><br /><a href="javascript:void(0)" onClick="edit(\''+ val + '\','+false+','+i+')">миниатюра</a><br /><a href="javascript:void(0)" onClick="del(\''+ val + '\','+i+')" >удалить</a><br/><a href="javascript:void(0)" onClick="makemain(\''+ val + '\','+i+')" >сделать главной</a></td></tr></table>');  }
	 else {
		 $('#'+i+'').html('<table id="mainimage" class="table table-striped table-bordered  table-condensed"><tr><td><img width="200px" src="uploads/'+id+'/ready/'+ val + '?salt='+ankap+'" alt="' + val + '" title="' + val + '"/></td><td width="150px"><a class="mylink"  href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+true+','+i+')">повернуть налево</a><br /><a class="mylink" href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+true+','+i+')">повернуть направо</a><br /><a class="mylink" href="javascript:void(0)" onClick="edit(\''+ val + '\','+true+','+i+')">миниатюра</a><br /><h2 id="mainimage">Главная</h2></td></tr></table>');
	 }
}		

<!--crop-->
function crop(){
	var ankap=(Math.random());
	if(!$('#x2').val()) alert('выделите область');
	else{
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		var val = $('#name').val();
		var i = $('#ident').val();
		var main=$("#main").val();
		var id=$("#hidden").val();
		
		$('#img-' + i).imgAreaSelect({remove: true });
		$('#'+i+'').html('<img width="150px" src="images/gif-loader.gif" alt="loader"/>');
 $.ajax({ 
		  type: "POST",
		  url: "ajaxcreate.php",
		  dataType: "json",
		
		 data: {
			  	 x1: x1,
				 x2: x2,
				 y1: y1,
				 y2: y2,
				 w: w,
				 h: h,
				 name: val,
				 id:$("#hidden").val() 
				},
		success: function(data)
		  {
		 if(main=='false'){
     $('#'+i+'').html('<table class="table table-striped table-bordered  table-condensed"><tr><td><img width="200px" src="uploads/'+id+'/ready/'+ val + '?salt='+ankap+'" alt="' + val + '"/></td><td width="150px"><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+false+','+i+')">повернуть налево</a><br /><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+false+','+i+')">повернуть направо</a><br /><a href="javascript:void(0)" onClick="edit(\''+ val + '\','+false+','+i+')">миниатюра</a><br /><a href="javascript:void(0)" onClick="del(\''+ val + '\','+i+')" >удалить</a><br/><a href="javascript:void(0)" onClick="makemain(\''+ val + '\','+i+')" >сделать главной</a></td></tr></table>');  }
	 else {
		 $('#'+i+'').html('<table id="mainimage" class="table table-striped table-bordered  table-condensed"><tr><td><img width="200px" src="uploads/'+id+'/ready/'+ val + '?salt='+ankap+'" alt="' + val + '" title="' + val + '"/></td><td width="150px"><a class="mylink"  href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+true+','+i+')">повернуть налево</a><br /><a class="mylink"  href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+true+','+i+')">повернуть направо</a><br /><a class="mylink" href="javascript:void(0)" onClick="edit(\''+ val + '\','+true+','+i+')">миниатюра</a><br /><h2 id="mainimage">Главная</h2></td></tr></table>');
	 }
			}
		})
}
}
<!--rotate-->
function rot(val,d,main,i){
	var ankap=(Math.random());
	var id=$("#hidden").val();
	$('#'+i+'').html('<img width="150px" src="images/gif-loader.gif" alt="loader"/>');
	
	$.ajax({ 
		  type: "POST",
		  url: "ajaxcreate.php",
		  dataType: "json",
		
		 data: {
			  		 rot: val, 
					 direction: d,
					 id:$("#hidden").val()
				},
		success: function(data)
		  {
	
	 if(main==false){
     $('#'+i+'').html('<table class="table table-striped table-bordered  table-condensed"><tr><td><img width="200px" src="uploads/'+id+'/ready/'+ val + '?salt='+ankap+'" alt="' + val + '"/></td><td width="150px"><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+false+','+i+')">повернуть налево</a><br /><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+false+','+i+')">повернуть направо</a><br /><a href="javascript:void(0)" onClick="edit(\''+ val + '\','+false+','+i+')">миниатюра</a><br /><a href="javascript:void(0)" onClick="del(\''+ val + '\','+i+')" >удалить</a><br/><a href="javascript:void(0)" onClick="makemain(\''+ val + '\','+i+')" >сделать главной</a></td></tr></table>');  }
	 else {
		 $('#'+i+'').html('<table id="mainimage" class="table table-striped table-bordered  table-condensed"><tr><td><img  width="200px" src="uploads/'+id+'/ready/'+ val + '?salt='+ankap+'" alt="' + val + '" title="' + val + '"/></td><td width="150px"><a class="mylink"  href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+true+','+i+')">повернуть налево</a><br /><a class="mylink" href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+true+','+i+')">повернуть направо</a><br /><a class="mylink"  href="javascript:void(0)" onClick="edit(\''+ val + '\','+true+','+i+')">миниатюра</a><br /><h2 id="mainimage">Главная</h2></td></tr></table>');
	 }
 	}
	})
}

<!--edit-->
function edit(val,main,i){
	var ankap=(Math.random());
	var id=$("#hidden").val();
		$('#'+i+'').html('<br/><div class="btn-group"><input type="hidden" name="x1" value="" id="x1"/><input type="hidden" name="main" value="" id="main"/><input type="hidden" name="y1" value="" id="y1"/><input type="hidden" name="x2" value="" id="x2"/><input type="hidden" name="y2" value="" id="y2"/><input type="hidden" name="w" value="" id="w"/><input type="hidden" name="h" value="" id="h"/><input type="hidden" name="name" value="" id="name"/><input type="hidden" name="ident" value="" id="ident"/><button class="btn" onclick="crop()">обрезать</button><button class="btn" onclick="cancel()">отменить</button></div><br/><img id="img-'+i+'"  onload="imgselect(\''+i+'\')" src="uploads/'+id+'/' + val + '?a='+ankap+'" alt="' + val + '">');

$('#img-' + i).imgAreaSelect({aspectRatio: "4:3", handles: true, onSelectEnd: function (img, selection) {
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
	        } });
	
$('#ident').val(i);	
$('#name').val(val);
$('#main').val(main);
			};
<!--makemain-->
function makemain(val, i){
	var ankap=(Math.random());
	$.ajax({ 
		  
		  type: "POST",
		  url: "ajaxcreate.php",
		  dataType: "json",
		
		 data: {
			  	 makemain:val,
				 id:$("#hidden").val()
				 },
		
		success: function(data)
		  {
		$('#111').empty();
		jQuery.each(data.files,function(i,val) {
	 if(val!==data.main){
     $('#111').append('<div id="'+i+'"><table class="table table-striped table-bordered  table-condensed"><tr><td><img width="200px" src="uploads/'+data.id+'/ready/'+ val + '?a='+ankap+'" alt="' + val + '?a='+ankap+'"></td><td width="150px"><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+false+','+i+')">повернуть налево</a><br /><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+false+','+i+')">повернуть направо</a><br /><a href="javascript:void(0)" onClick="edit(\''+ val + '\','+false+','+i+')">миниатюра</a><br /><a href="javascript:void(0)" onClick="del(\''+ val + '\','+i+')" >удалить</a><br/><a href="javascript:void(0)" onClick="makemain(\''+ val + '\','+i+')" >сделать главной</a></td></tr></table><div>');  }
	 else {
		 $('#111').append('<div id="'+i+'"><table id="mainimage" class="table table-striped table-bordered  table-condensed"><tr><td><img width="200px" src="uploads/'+data.id+'/ready/'+ val + '?a='+ankap+'" alt="' + val + '" title="' + val + '"></td><td width="150px"><a class="mylink" href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+true+','+i+')">повернуть налево</a><br /><a class="mylink"  href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+true+','+i+')">повернуть направо</a><br /><a class="mylink"  href="javascript:void(0)" onClick="edit(\''+ val + '\','+true+','+i+')">миниатюра</a><br /><h2 id="mainimage">Главная</h2></td></tr></table><div>');
	 }
     });
	
			}
			});
}
<!--delete-->
function del(val, i){
	var ankap=(Math.random());
	var itemid =$("#hidden").val();
	if(confirm("Вы уверены?")){
	$('#img-' + i).attr('src', 'images/ajax-loader.gif');
		$.ajax({ 
		  type: "POST",
		  url: "ajaxcreate.php",
		  dataType: "json",
		
		 data: {
			  	 del: val, 
				 itemid: itemid	
				},
		success: function(data) 
		  {		
		 $('#'+i+'').empty();
		} 
		})
	}
}
<!--edititem-->
function edititem(id){
	
	$.ajax({ 
		  
		  type: "POST",
		  url: "ajaxcreate.php",
		  dataType: "json",
		
		 data: {
			  	 edit:id,
				 
				 },
		
		success: function(data)
		  {
	$("#title").val(data.artikul);
	$("#sozdano").val(data.date_created);
	$("#upd").val(data.date_updated);
	$("#description").val(data.description);
	$("#notes").val(data.notes);
	$("#selcategory").val(data.category_id);
	$("#vstavka").val(data.vstavka_id);
	$("#metall").val(data.metall_id);
	$("#proba").val(data.proba_id);
	$("#razmer").val(data.razmer_id);
	$("#price").val(data.price);
	$("#weight").val(data.weight);
	$("#selactive").val(data.active);
	
	$("#hidtegtitle").val(data.teg_title);
	$("#hidmetadescription").val(data.metadescription);
	$("#hidmetakeywords").val(data.metakeywords);
									
	$("#tegtitle").val(data.teg_title);
	$("#metadescription").val(data.meta_description);
	$("#metakeywords").val(data.meta_keywords);
	
	$("#hiddescription").val(data.description);
	$("#hidnotes").val(data.notes);
	$("#hidprice").val(data.price);
	$("#hidweight").val(data.weight);					
	$("#hiddataupd").val(data.date_updated);
	$("#hiddatacrt").val(data.date_created);
	$("#hidselcategory").val(data.category_id);
	$("#hidvstavka").val(data.vstavka_id);
	$("#hidmetall").val(data.metall_id);
	$("#hidproba").val(data.proba_id);
	$("#hidrazmer").val(data.razmer_id);
	$("#hidselactive").val(data.active);
	
	$("#hidden").val(id);
	$("#btn0").val("изменить");	
	$("#filelimit-fine-uploader").css("visibility", "visible");	
	$("#111").css("visibility", "visible");
	$("#messages").css("visibility", "visible");
	$("#edit").css("visibility", "visible");
	$("#seo").css("visibility", "visible");
	$('#111').empty();
		fulltable();
		}
			});
	
}
<!--upload-->

function fulltable(){
	var ankap=(Math.random());
	$.ajax({ 
		  
		  type: "POST",
		  url: "ajaxcreate.php",
		  dataType: "json",
		
		 data: {
			  	 upload:true,
				 id:$("#hidden").val()
				 },
		
		success: function(data)
		  {
		$('#111').empty();
		jQuery.each(data.files,function(i,val) {
	 if(val!==data.main){
     $('#111').append('<div id="'+i+'"><table class="table table-striped table-bordered  table-condensed"><tr><td><img width="200px" src="uploads/'+data.id+'/ready/'+ val + '?salt='+ankap+'" alt="' + val + '"/></td><td width="150px"><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+false+','+i+')">повернуть налево</a><br /><a href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+false+','+i+')">повернуть направо</a><br /><a href="javascript:void(0)" onClick="edit(\''+ val + '\','+false+','+i+')">миниатюра</a><br /><a href="javascript:void(0)" onClick="del(\''+ val + '\','+i+')" >удалить</a><br/><a href="javascript:void(0)" onClick="makemain(\''+ val + '\','+i+')" >сделать главной</a></td></tr></table><div>');  }
	 else {
		 $('#111').append('<div id="'+i+'"><table id="mainimage"  class="table table-striped table-bordered  table-condensed"><tr><td><img width="200px" src="uploads/'+data.id+'/ready/'+ val + '?salt='+ankap+'" alt="' + val + '" title="' + val + '"/></td><td width="150px"><a  class="mylink" href="javascript:void(0)" onClick="rot(\''+ val + '\',\'left\','+true+','+i+')">повернуть налево</a><br /><a class="mylink"  href="javascript:void(0)" onClick="rot(\''+ val + '\',\'rigth\','+true+','+i+')">повернуть направо</a><br /><a class="mylink"  href="javascript:void(0)" onClick="edit(\''+ val + '\','+true+','+i+')">миниатюра</a><br /><h2 id="mainimage">Главная</h2></td></tr></table><div>');
	 }
     });
	
			}
			});
}
function cattable(cat,rus){
	var cattable=cat+"table";
	var pager=cat+"pager";
	jQuery("#"+cattable).jqGrid({
	url:'tablecat.php?cat='+cat,
	datatype: "json",
	editurl:'tableajax.php?cat='+cat,
	cellEdit : false,	
	height: 'auto',
	width: 600,
   	colNames:['id',rus, 'обновлено' ,''],
   	colModel:[
   		{name:'id',index:'id', width:40, hidden: true},
		{name:cat,index:cat, width:100,editable:true,editrules:{required:true}},
		{name:'update',index:'update', width:100},
		{name: 'myname', sortable:false,search:false,resize:false,width:30, formatter:'actions',
			formatoptions:{
				  keys: true,
				  editformbutton: true,
                  editOptions: {
                       afterSubmit: function (server, postdata) {
							var response = eval('('+server.responseText+')'); 
          					success = false;
          					if(response.answerType == 'OK'){
                				success = true;
								$('#'+cattable).jqGrid("setGridParam", {datatype: 'json'}).trigger("reloadGrid");
								$(".ui-icon-closethick").trigger('click');
							};
								
							return [success,response.hidden]
                        }
                    },
					
					delOptions: {
						afterSubmit: function (server, postdata) {
							var response = eval('('+server.responseText+')'); 
          					success = false;
          					if(response.answerType == 'OK'){
                				success = true;
          						};
     						return [success,response.hidden]
                        }
					}
				}
			}			
   	],
   	rowNum:10,
	rowTotal: -1,
   	rowList:[10,20,50],
   	pager: '#'+pager,
   	sortname: 'id',
  	viewrecords: true,
	loadonce:true,
	ignoreCase: true,
   	mtype: "GET",
	rownumbers: true,
	gridview: true,	
    sortorder: "desc",
    caption:rus,	
	async: false,
	loadComplete: function() {
		 jQuery("#"+cattable).jqGrid('navGrid','#'+pager,{edit:false,add:false,del:false,search:false,refresh:true});
		 jQuery("#"+cattable).jqGrid('filterToolbar',{stringResult:true, searchOnEnter:true, defaultSearch:"cn"});	
		}
	});
}
$(document).ready(function(){
	
	$( 'textarea#editor1' ).ckeditor();
	$( 'textarea#editor2' ).ckeditor();
	$( 'textarea#editor3' ).ckeditor();
	$( 'textarea#editnews' ).ckeditor();
    $('#error1').arcticmodal();
	$('#error2').arcticmodal();
	$('#error3').arcticmodal();
	$('#error4').arcticmodal();
	$('#error5').arcticmodal();
	$('#error6').arcticmodal();
<!--categorytable-->
cattable("category","категория");
<!--metalltable-->
cattable("metall","металл");
<!--vstavkatable-->
cattable("vstavka","вставка");
<!--probatable-->
cattable("proba","проба");
<!--razmertable-->
cattable("razmer","размер");
<!--newstable-->
<!--edit_news-->
function ab_afterShowForm(ids){ 
	if( CKEDITOR.instances.story )
    {
		try {
         	CKEDITOR.instances.story.destroy(true);
        } catch(e) {
            CKEDITOR.remove( 'story' );
        }
    }
    CKEDITOR.replace( 'story',{height: 300,});
    selID = $('#catdnd').getGridParam('selrow'); // get selected row
    if( !($('a#pData').is(':hidden') || $('a#nData').is(':hidden') && selID==null))
    { 
        va = $('#catdnd').getRowData(selID);
        CKEDITOR.instances.story.setData( va['story'] );
    }
};
function ab_beforeSubmit(data)
{
    data['story'] = CKEDITOR.instances.story.getData();
	try {
         	CKEDITOR.instances.story.destroy(true);
        } catch(e) {
            CKEDITOR.remove( 'story' );
        }
	return [true];
};
function ab_afterclickPgButtons(whichbutton, formid, rowid)
{
    va = $('#catdnd').getRowData(rowid);
	CKEDITOR.instances.story.setData( va['story'] );
};


<!--edit_news java-->

getColumnIndexByName = function (grid, columnName) {
   var cm = grid.jqGrid('getGridParam', 'colModel'), i, l = cm.length;
      for (i = 0; i < l; i++) {
         if (cm[i].name === columnName) {
            return i; // return the index
         }
     }
  return -1;
},
jQuery("#custbut").jqGrid({        
   	url:'edit_news_ajax.php?q=2',
	datatype: "json", 
	editurl:'ajaxnovosti.php?q=2',
	height: 'auto',
	width: 1200,
	rowheight: 30,
	colNames:['id','Статус','Название новости ','Новость','','заметка','создано', 'обновлено','date',''],
   	colModel:[
   		{name:'id',index:'id',width:40,editable:false}, 
		{name:'active',index:'active',width:110,editable:true,editrules:{required:true},edittype:"select",
		editoptions:{value:"Активно:Активно;Неактивно:Неактивно"}},
		{name:'story_name',index:'story_name', width:150,editable:true,editrules:{required:true},editoptions:{size:121}},
		{name:'story_sthtml',index:'story_sthtml', width:150},
   		{name:'story',index:'story', width:150,hidden: true,width:150,editable:true,edittype:"textarea",editrules:{edithidden:true}},
		{name:'description',index:'description', width:150, editable:true,edittype:"textarea",
            editoptions:{rows:"2",cols:"120"}},
		{name:'date_created',index:'date_created', width:110},
   		{name:'date_updated',index:'date_updated', width:110},
		{name:'datepicker',index:'datepicker', width:70,editrules:{required:true},editable:true,
			editoptions:{
				size:12,
				dataInit:function(el){
					$(el).datepicker({dateFormat:'yy-mm-dd'});
					$.datepicker.setDefaults( $.datepicker.regional[''] = { // Default regional settings
		clearText: 'Очистить', // Display text for clear link
		clearStatus: 'Стереть текущую дату', // Status text for clear link
		closeText: 'Закрыть', // Display text for close link
		closeStatus: 'Закрыть без сохранения', // Status text for close link
		prevText: '&#x3c;Пред', // Display text for previous month link
		prevStatus: 'Предыдущий месяц', // Status text for previous month link
		nextText: 'След&#x3e;', // Display text for next month link
		nextStatus: 'Следующий месяц', // Status text for next month link
		currentText: 'Сегодня', // Display text for current month link
		currentStatus: 'Текущий месяц', // Status text for current month link
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
			'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'], // Names of months for drop-down and formatting
		monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'], // For formatting
		monthStatus: 'Показать другой месяц', // Status text for selecting a month
		yearStatus: 'Показать другой год', // Status text for selecting a year
		weekHeader: 'Нед', // Header for the week of the year column
		weekStatus: 'Неделя года', // Status text for the week of the year column
		dayNames: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'], // For formatting
		dayNamesShort: ['Вск', 'Пнд', 'Втр', 'Срд', 'Чтв', 'Птн', 'Сбт'], // For formatting
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'], // Column headings for days starting at Sunday
		dayStatus: 'Установить первым днем недели', // Status text for the day of the week selection
		dateStatus: 'Выбрать день, месяц, год', // Status text for the date selection
		dateFormat: 'dd.mm.yy', // See format options on parseDate
		firstDay: 1, // The first day of the week, Sun = 0, Mon = 1, ...
		initStatus: 'Выбрать дату', // Initial Status text on opening
		isRTL: false // True if right-to-left language, false if left-to-right
	} );
					},
				defaultValue: function(){
					var currentTime = new Date();
					var month = parseInt(currentTime.getMonth() + 1);
					month = month <= 9 ? "0"+month : month;
					var day = currentTime.getDate();
					day = day <= 9 ? "0"+day : day;
					var year = currentTime.getFullYear();
					return year+"-"+month + "-"+day;
				}
			}
			},
				
		{name: 'myname',width:70, sortable:false,search:false,resize:false, formatter:'actions', formatoptions:{
						keys: true,					  
				        editformbutton: true,
						editOptions: {
							height:700, width:731,
							afterSubmit: function (server, postdata) {
								$("#custbut").jqGrid("setGridParam", {datatype: 'json'}).trigger("reloadGrid");
								$(".ui-icon-closethick").trigger('click');
								return [success,response.hidden]
                        	},
							afterShowForm: ab_afterShowForm,
							afterclickPgButtons: ab_afterclickPgButtons,
        					beforeSubmit: ab_beforeSubmit,
							onClose:function () {
								try {
         							CKEDITOR.instances.story.destroy(true);
        						} 
								catch(e) {
            						CKEDITOR.remove( 'story' );
        						}
							}
       			        },
						delOptions: {
							afterSubmit: function (server, postdata) {
								$("#custbut").jqGrid("setGridParam", {datatype: 'json'}).trigger("reloadGrid");
								$(".ui-icon-closethick").trigger('click');
     							return [success,response.hidden]
                       			}
						}
			}
		}	
	],
   	rowNum:20,
	rowTotal: -1,
   	rowList:[20,40,60],
   	pager: '#pcustbut',
   	sortname: 'id',
	viewrecords: true,
	loadonce:true,
	ignoreCase: true,
	mtype: "GET",
	rownumbers: true,
	gridview: true,
	sortorder: "desc",
 	caption:"Новость",
	async: false,
	loadComplete: function() {
	 	setSearchSelect1('active');
	 	setSearchSelect1('id');
	 	jQuery("#custbut").jqGrid('navGrid','#pcustbut',{edit:false,add:true,del:false,search:false,refresh:true},
		{},
		{
			height:700, width:731,
		  	afterSubmit: function (server, postdata) {
				$("#custbut").jqGrid("setGridParam", {datatype: 'json'}).trigger("reloadGrid");
				$(".ui-icon-closethick").trigger('click');
				return [success,response.hidden]
           	},
			afterShowForm: ab_afterShowForm,
       		beforeSubmit: ab_beforeSubmit,
			onClose:function () {
				try {
         			CKEDITOR.instances.story.destroy(true);
        		} catch(e) {
            		CKEDITOR.remove( 'story' );
        		}
			}
        }, 
		{}
	 );
	jQuery("#custbut").jqGrid('filterToolbar',{stringResult:true, searchOnEnter:true, defaultSearch:"cn"});
	jQuery ("table.ui-jqgrid-htable", jQuery("#custbut")).css ("height", 30);
	var iCol = getColumnIndexByName($("#custbut"), 'myname');
    $(this).find(">tbody>tr.jqgrow>td:nth-child(" + (iCol + 1) + ")")
        .each(function() {
            $("<div>", {
                title: "Вид выбранной записи",
                mouseover: function() {
                    $(this).addClass('ui-state-hover');
                },
                mouseout: function() {
                    $(this).removeClass('ui-state-hover');
                },
                click: function(e) {
					window.location.href="http://powersoft.tv/arev/newslook.php?id="+
                        $(e.target).closest("tr.jqgrow").attr("id");
                }
            }
          ).css({"margin-right": "5px", float: "left", cursor: "pointer"})
           .addClass("ui-pg-div ui-inline-custom")
           .append('<span class="ui-icon ui-icon-document"></span>')
           .prependTo($(this).children("div"));
    });
		}
	
});
getUniqueNames1 = function(columnName) {
        var texts = jQuery("#custbut").jqGrid('getCol',columnName),
		uniqueTexts = [],
        textsLength = texts.length,
		text, 
		textsMap = {}, i;
		for (i=0;i<textsLength;i++) {
            text = texts[i];
            if (text !== undefined && textsMap[text] === undefined) {
				textsMap[text] = true;
                uniqueTexts.push(text);
            }
        }
        return uniqueTexts;
    },
buildSearchSelect1 = function(uniqueNames) {
        var values=":All";
	    $.each (uniqueNames, function() {
        	values += ";" + this + ":" + this;
       });
       return values;
    },
setSearchSelect1 = function(columnName) {
       jQuery("#custbut").jqGrid('setColProp', columnName,
       {
           stype: 'select',
           searchoptions: {
              value:buildSearchSelect1(getUniqueNames1(columnName)),
              sopt:['eq']
	          }
	   }
    );
};
<!--maintable-->

            getColumnIndexByName = function (grid, columnName) {
                var cm = grid.jqGrid('getGridParam', 'colModel'), i, l = cm.length;
                for (i = 0; i < l; i++) {
                    if (cm[i].name === columnName) {
                        return i; // return the index
                    }
                }
                return -1;
            },

jQuery("#list2").jqGrid({
	url:'table.php?q=2',
	datatype: "json", 
	height: 'auto',
	editurl:'mainajax.php?q=2',
	width: 1200,
   	colNames:['id','артикул','статус','категория','металл','проба','размер','вставка','вес','цена','описание','заметка','создано', 'обновлено' ,'',''],
   	colModel:[
   		{name:'id',index:'id', width:40 ,hidden: true},
		{name:'artikul',index:'artikul', width:70},
		{name:'status',index:'status',width:110},
		{name:'category',index:'category', width:110},
		{name:'metall',index:'metall', width:110},
		{name:'proba',index:'proba', width:100},
		{name:'razmer',index:'razmer', width:100},
		{name:'vstavka',index:'vstavka', width:100},
   		{name:'weight',index:'weight', width:80},		
   		{name:'price',index:'price', width:80,},		
   		{name:'description',index:'description', width:150},
		{name:'notes',index:'notes', width:150},
		{name:'date_created',index:'date_created', width:150},
   		{name:'date_updated',index:'date_updated', width:150},
		{name:'edit',hidden: true,index:'edit', sortable:false,editable: true,search:false,resize:false},		
		{name: 'myname',width:110, sortable:false,search:false,resize:false, formatter:'actions',
			formatoptions:{
                 		onEdit:function(rowid) { 
                             window.location.href="index.php?pan=nn&id="+rowid;
                         },	
						delOptions: {
							afterSubmit: function (server, postdata) {
								var response = eval('('+server.responseText+')'); 
          						success = false;
          						if(response.answerType == 'OK'){
                					success = true;
          							};
     							return [success,response.hidden]
                       		 }
						}
					}
				}
   	],
   	rowNum:25,
	rowTotal: -1,
   	rowList:[25,50,100,150],
   	pager: '#pager2',
   	sortname: 'id',
    viewrecords: true,
	loadonce:true,
	ignoreCase: true,
   	mtype: "GET",
	rownumbers: true,
	gridview: true,	
    sortorder: "desc",
    caption:"Изделия",
	async: false,
	
    loadComplete: function() {
		
		setSearchSelect('status');
		setSearchSelect('category');
		setSearchSelect('metall');
		setSearchSelect('proba'); 
		setSearchSelect('razmer');
		setSearchSelect('vstavka');
		
		jQuery("#list2").jqGrid('filterToolbar',{stringResult:true, searchOnEnter:true, defaultSearch:"cn"});
		var iCol = getColumnIndexByName($("#list2"), 'myname');
    $(this).find(">tbody>tr.jqgrow>td:nth-child(" + (iCol + 1) + ")")
        .each(function() {
            $("<div>", {
                title: "Вид выбранной записи",
                mouseover: function() {
                    $(this).addClass('ui-state-hover');
                },
                mouseout: function() {
                    $(this).removeClass('ui-state-hover');
                },
                click: function(e) {
					window.location.href="http://powersoft.tv/arev/indexpage.php?id="+
                        $(e.target).closest("tr.jqgrow").attr("id");
                }
            }
          ).css({"margin-right": "5px", float: "left", cursor: "pointer"})
           .addClass("ui-pg-div ui-inline-custom")
           .append('<span class="ui-icon ui-icon-document"></span>')
           .prependTo($(this).children("div"));
    });
		}
	
});


jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false,search:false,refresh:true});
getUniqueNames = function(columnName) {

         var texts = jQuery("#list2").jqGrid('getCol',columnName),
		 uniqueTexts = [],
         textsLength = texts.length,
		 text, 
		 textsMap = {}, i;
		
         for (i=0;i<textsLength;i++) {
            text = texts[i];
            if (text !== undefined && textsMap[text] === undefined) {
                // to test whether the texts is unique we place it in the map.
                textsMap[text] = true;
                uniqueTexts.push(text);
            }
        }
        return uniqueTexts;
    },
    buildSearchSelect = function(uniqueNames) {
        var values=":All";
        $.each (uniqueNames, function() {
            values += ";" + this + ":" + this;
        });
        return values;
    },
    setSearchSelect = function(columnName) {
        jQuery("#list2").jqGrid('setColProp', columnName,
                    {
                        stype: 'select',
                        searchoptions: {
                            value:buildSearchSelect(getUniqueNames(columnName)),
                            sopt:['eq']
                        }
                    }
        );
    };

<!--create record-->
		if($("#hidden").val()){
			$("#btn0").val("изменить");	
			$("#filelimit-fine-uploader").css("visibility", "visible");	
			$("#111").css("visibility", "visible");
			$("#messages").css("visibility", "visible");
			$("#edit").css("visibility", "visible");
			} 		
		$('#aptform').ajaxForm(
		{ 
			dataType: "json", 
			success: function(data)
			{
			if(data.uveren){
				$("#uveren").val(data.uveren);
				 if(confirm("Вы уверены?")){
					 $("#aptform").submit(); 
					 $("#anun").html("");
					 $("#uveren").val("");
					 }
				 else {
					$("#anun").html("");
					$("#uveren").val("");
					$("#description").val($("#hiddescription").val());
					$("#notes").val($("#hidnotes").val());					
					$("#price").val($("#hidprice").val());
					$("#weight").val($("#hidweight").val());
					$("#selactive").val($("#hidselactive").val()); 
					$("#selcategory").val($("#hidselcategory").val()); 
					$("#vstavka").val($("#hidvstavka").val()); 
					$("#metall").val($("#hidmetall").val()); 
					$("#proba").val($("#hidproba").val()); 
					$("#notes").val($("#hidnotes").val());
					$("#tegtitle").val($("#hidtegtitle").val());
					$("#metadescription").val($("#hidmetadescription").val());
					$("#metakeywords").val($("#hidmetakeywords").val());
					
				 }
			}
			else {	
				$("#title").val(data.artikul);
				$("#sozdano").val(data.date_created);
				$("#upd").val(data.date_updated);
				if(data.id){
					if(!($("#hidden").val())){
						$("#hidden").val(data.id);
						$("#anun").html("<h2 style='color:#F00'>Объявление успешно добавлено</h2>");
						$("#btn0").val("изменить");	
						$("#filelimit-fine-uploader").css("visibility", "visible");	
						$("#111").css("visibility", "visible");
						$("#messages").css("visibility", "visible");
						$("#edit").css("visibility", "visible");
						$("#seo").css("visibility", "visible");
						} 
					else $("#anun").html("<h2 style='color:#F00'>Объявление успешно изменено</h2>");
					$("#price").val(data.price);
					$("#weight").val(data.weight);
					$("#description").val(data.description);					
					$("#hiddescription").val(data.description);
					$("#notes").val(data.notes);					
					$("#hidnotes").val(data.notes);
					
					$("#hidprice").val(data.price);
					$("#hidweight").val(data.weight);					
					$("#hiddataupd").val(data.date_updated);
					$("#hiddatacrt").val(data.date_created);
					$("#uveren").val("");
					
					$("#hidselcategory").val(data.category_id);
					$("#hidvstavka").val(data.vstavka_id);
					$("#hidmetall").val(data.metall_id);
					$("#hidproba").val(data.proba_id);
					$("#hidrazmer").val(data.razmer_id);
					$("#hidselactive").val(data.active);
									
					$("#selcategory").val(data.category_id);
					$("#vstavka").val(data.vstavka_id);
					$("#metall").val(data.metall_id);
					$("#proba").val(data.proba_id);
					$("#razmer").val(data.razmer_id);
					$("#selactive").val(data.active);
					
					$("#hidtegtitle").val(data.teg_title);
					$("#hidmetadescription").val(data.metadescription);
					$("#hidmetakeywords").val(data.metakeywords);
									
					$("#tegtitle").val(data.teg_title);
					$("#metadescription").val(data.meta_description);
					$("#metakeywords").val(data.meta_keywords);
				}
			}
			} 
		}); 
	
<!--upload-->
	fulltable(); 			  
		
    $fub = $('#fine-uploader');
    $messages = $('#messages');
	
 	
	
    var uploader = new qq.FineUploader({
      element: $('#filelimit-fine-uploader')[0],
      request: {
        endpoint: 'uploaderserv.php'
      },
      validation: {
        allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
        sizeLimit: 5120000, // 500 kB = 500 * 1024 bytes
        //itemLimit: numfile
      },
      callbacks: {
        onSubmit: function(id, fileName) {
          $messages.append('<div id="file-' + id + '" class="alert" style="margin: 20px 0 0"></div>');
        },
        onUpload: function(id, fileName) {
          $('#file-' + id).addClass('alert-info')
                          .html('<img src="images/ajax-loader.gif" alt="Initializing. Please hold."> ' +
                                'Initializing ' +
                                '“' + fileName + '”');
        },
        onProgress: function(id, fileName, loaded, total) {
          if (loaded < total) {
            progress = Math.round(loaded / total * 100) + '% of ' + Math.round(total / 1024) + ' kB';
            $('#file-' + id).removeClass('alert-info')
                            .html('<img src="images/ajax-loader.gif" alt="In progress. Please hold."> ' +
                                  'Uploading ' +
                                  '“' + fileName + '” ' +
                                  progress);
          } else {
            $('#file-' + id).addClass('alert-info')
                            .html('<img src="images/ajax-loader.gif" alt="Saving. Please hold."> ' +
                                  'Saving ' +
                                  '“' + fileName + '”');
          }
        },
        onComplete: function(id, fileName, responseJSON) {	
          if (responseJSON.success) {
				
           $('#file-' + id).remove();
		fulltable();
		
								
			
					  
          } else {
            $('#file-' + id).removeClass('alert-info') 
                            .addClass('alert-error')
                            .html('<i class="icon-exclamation-sign"></i> ' +
                                  'Error with ' +
                                  '“' + fileName + '”: ' +
                                  responseJSON.error);
          }
        }
      }
    });
 });
</script>
</head>
<body> 
<?
function tablnew($tablename,$getname,$lablename, $lablename2){
	mysql_query("CREATE TABLE IF NOT EXISTS `$tablename` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `$tablename` text NOT NULL,
   KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12") or die(mysql_error());
	$flag=0;
	 if($_POST[ru]){
		$input_text = strip_tags($_POST[ru]);
		$input_text	= trim($input_text);
		$input_text = htmlspecialchars($input_text);
		$input_text = mysql_escape_string($input_text);
		$input_text = mb_substr($input_text, 0,140, 'UTF-8');
		if($input_text=="" ||$input_text==" ") { ?>
          <div style="display: none;">
    		<div class="box-modal" id="error1">
        		<div class="box-modal_close arcticmodal-close">закрыть</div>
        		Невозможно добавить.Используются недопустимые символы или пустая строка
    		</div>
		  </div>
         <? }
		else{
		$result=mysql_query("SELECT * FROM `$tablename` WHERE `$tablename`  LIKE '$input_text'");
		$total=mysql_num_rows($result); 
		if($total)$flag=1;		 
		if(!$flag) {
			$rres=mysql_query ("INSERT INTO $tablename($tablename) VALUES('$input_text')") or die(mysql_error());
			//if($rres) echo "<br/><h4 style='color:#F00' align='center'>Успешно добавлено.</h4>";
			}
		if($flag) {?>
        	<div style="display: none;">
    			<div class="box-modal" id="error2">
        			<div class="box-modal_close arcticmodal-close">закрыть</div>
        			Невозможно добавить.Запись существует
    			</div>
		  	</div>
			
		<? }
		}
	 }
	 ?>
	 <div id='fg_membersite' style="padding:15px">
    <h2>Добавить <?=$lablename2?></h2>
  	<form id="myform" action="<?=$_SERVER['PHP_SELF']."?pan=".$getname."&st=".$_GET[st];?>" method="post">    
    <div class='container'>
    <label for='ru' ><?=$lablename?>:</label><br/>
    <input required type='text' name='ru' maxlength="50" /><br/>
    </div>
    <input type="submit" name="coutry" value="добавить" />
    </form>
    </div>
   
<? }
mysql_query("CREATE TABLE IF NOT EXISTS `seo` (`id` INT(11)NOT NULL AUTO_INCREMENT, `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, `title` TEXT NOT NULL COLLATE utf8_general_ci, `description` TEXT NOT NULL COLLATE utf8_general_ci, `keywords` TEXT NOT NULL COLLATE utf8_general_ci, `page` TEXT NOT NULL COLLATE utf8_general_ci, KEY `id` (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12") or die(mysql_error());
mysql_query("CREATE TABLE IF NOT EXISTS `main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `vstavka_id` int(11) NOT NULL,
  `razmer_id` int(11) NOT NULL,
  `metall_id` int(11) NOT NULL,
  `proba_id` int(11) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  `artikul` text NOT NULL,
  `description` text NOT NULL,
  `notes` text NOT NULL,
  `active` tinyint(4) NOT NULL,
  `teg_title` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `image` text NOT NULL,
   PRIMARY KEY (`id`),
  KEY `date_updated` (`date_updated`))
  ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31") ;
?>
<!--LEFT PANEL-->
<div class="centre">
<table>
<tr>
 <td valign=top><div class="adminmenu">

<br />
<h3>НАСТРОЙКИ</h3>
<ul>
  <li><a href="<?=$_SERVER['PHP_SELF']."?pan=p";?>">пароль администратора</a></li>
  <li><a href="<?=$_SERVER['PHP_SELF']."?pan=ss";?>">SEO</a></li>
</ul><br />
<h3>НАПОЛНЕНИЕ</h3>
<ul>
 <li><a href="<?=$_SERVER['PHP_SELF']."?dept=about";?>">о нас</a></li>
 <li><a href="<?=$_SERVER['PHP_SELF']."?dept=news";?>">новости</a></li> 
 <li><a href="<?=$_SERVER['PHP_SELF']."?dept=services";?>">услуги</a></li>
 <li><a href="<?=$_SERVER['PHP_SELF']."?dept=company";?>">контакты</a></li>
 </ul>
 <br />
<h3>ОБЪЯВЛЕНИЯ</h3>
<ul>
 <li><a href="<?=$_SERVER['PHP_SELF']."?pan=n";?>">объявления</a></li>
 <li><a href="<?=$_SERVER['PHP_SELF']."?pan=nn";?>">новое объявление</a></li> 

</ul><br />
<h3>СПРАВОЧНИК</h3>
<ul>
 <li><a href="<?=$_SERVER['PHP_SELF']."?pan=cat";?>">категории</a></li>
 <li><a href="<?=$_SERVER['PHP_SELF']."?pan=met";?>">металлы</a></li>
 <li><a href="<?=$_SERVER['PHP_SELF']."?pan=vst";?>">вставки</a></li>
 <li><a href="<?=$_SERVER['PHP_SELF']."?pan=prb";?>">пробы</a></li>
 <li><a href="<?=$_SERVER['PHP_SELF']."?pan=raz";?>">размеры</a></li>
</ul>

<p align="center"><a href='logout.php'>выход</a></p>
</div>
 </td>
 <td valign=top>
<!--RIGHT PANEL-->
<div class="adminpanel">
<!--SEO-->
<? if($_GET[pan]==ss){ 
	
	
    if($_POST[ttitle]){
		$ttitle = strip_tags($_POST[ttitle]);
		$ttitle	= trim($ttitle);
		$ttitle = htmlspecialchars($ttitle);
		$ttitle = mysql_escape_string($ttitle);
		$ttitle = mb_substr($ttitle, 0,140, 'UTF-8');
		$tmetadescription = strip_tags($_POST[tmetadescription]);
		$tmetadescription	= trim($tmetadescription);
		$tmetadescription = htmlspecialchars($tmetadescription);
		$tmetadescription = mysql_escape_string($tmetadescription);
		$tmetadescription = mb_substr($tmetadescription, 0,140, 'UTF-8');
		$tmetakeywords = strip_tags($_POST[tmetakeywords]);
		$tmetakeywords	= trim($tmetakeywords);
		$tmetakeywords = htmlspecialchars($tmetakeywords);
		$tmetakeywords = mysql_escape_string($tmetakeywords);
		$tmetakeywords = mb_substr($tmetakeywords, 0,140, 'UTF-8');
		if($ttitle=="" ||$ttitle==" ") { ?>
          <div style="display: none;">
    		<div class="box-modal" id="error3">
        		<div class="box-modal_close arcticmodal-close">закрыть</div>
        		Невозможно добавить.Используются недопустимые символы или пустая строка
    		</div>
		  </div>
         <? }
		else{
			$result=mysql_query("SELECT * FROM `seo` WHERE `page`='home' ");
			$total=mysql_num_rows($result); 
			if(!$total)$rres=mysql_query ("INSERT INTO seo (title, description, keywords, page) VALUES('$ttitle' ,'$tmetadescription', '$tmetakeywords' , 'home')") or die(mysql_error());
			else $rres=mysql_query ("UPDATE seo SET `title`= '$ttitle', `description`='$tmetadescription', `keywords`='$tmetakeywords' WHERE `page`='home'") or die(mysql_error());
		}
	}
	
	$result=mysql_query("SELECT * FROM `seo` WHERE `page`='home' ");
	$row=mysql_fetch_array($result);	
		 ?>
	<div>
    <h2>SEO</h2>
    <form id="tseo" name="tseo" method="post">
        <div class='container'>
        	<label  for="ttitle">Тег "title" (Название) *</label><br />
			<textarea required="required"  maxlength="100" name="ttitle" id="ttitle" value="" style="width:295px; height:74px" /><?=$row[title]?></textarea><br/>
            <span id='tseo_ttitle' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="tmetadescription">SEO "Description" (Описание)</label><br />
			<textarea  maxlength="140" name="tmetadescription" id="tmetadescription" value="" style="width:295px; height:74px" /><?=$row[description]?></textarea><br/>
            <span id='tseo_tmetadescription_errorloc' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="tmetakeywords">SEO "Keywords" (Ключевые слова)</label><br />
			<textarea  maxlength="140" name="tmetakeywords" id="tmetakeywords" value="" style="width:295px; height:74px" /><?=$row[keywords]?></textarea><br/>
            <span id='tseo_tmetakeywords_errorloc' class='error'></span>
        </div>
        <input type="submit" value="изменить" name="tseo" id="tseo"/>
     </form>
     </div>
<? } ?>
<!--about-->
<? if($_GET[dept]==about){
		if(isset($_POST[editor1])){
			$file ="../about.html";
			$fabout=fopen($file,"w+") or die("невозможно открыть/создать файл");
			fwrite($fabout, $_POST[editor1]) or die ('Не записал');
			fclose($fabout);
			}?>
        <form method="post"  >
        <h2>о нас</h2>
		<textarea name="editor1" style="width:1000px" id="editor1"><?=file_get_contents("../about.html")?></textarea>
        <input type="submit" name="submit" value="Сохранить"/>
        </form>
        
       <? 
	
    if($_POST[atitle]){
		$atitle = strip_tags($_POST[atitle]);
		$atitle	= trim($atitle);
		$atitle = htmlspecialchars($atitle);
		$atitle = mysql_escape_string($atitle);
		$atitle = mb_substr($atitle, 0,140, 'UTF-8');
		$ametadescription = strip_tags($_POST[ametadescription]);
		$ametadescription	= trim($ametadescription);
		$ametadescription = htmlspecialchars($ametadescription);
		$ametadescription = mysql_escape_string($ametadescription);
		$ametadescription = mb_substr($ametadescription, 0,140, 'UTF-8');
		$ametakeywords = strip_tags($_POST[ametakeywords]);
		$ametakeywords	= trim($ametakeywords);
		$ametakeywords = htmlspecialchars($ametakeywords);
		$ametakeywords = mysql_escape_string($ametakeywords);
		$ametakeywords = mb_substr($ametakeywords, 0,140, 'UTF-8');
		if($atitle=="" ||$atitle==" ") { ?>
          <div style="display: none;">
    		<div class="box-modal" id="error4">
        		<div class="box-modal_close arcticmodal-close">закрыть</div>
        		Невозможно добавить.Используются недопустимые символы или пустая строка
    		</div>
		  </div>
         <? }
		else{
			$result=mysql_query("SELECT * FROM `seo` WHERE `page`='about' ");
			$total=mysql_num_rows($result); 
			if(!$total)$rres=mysql_query ("INSERT INTO seo (title, description, keywords, page) VALUES('$atitle' ,'$ametadescription', '$ametakeywords' , 'about')") or die(mysql_error());
			else $rres=mysql_query ("UPDATE seo SET `title`= '$atitle', `description`='$ametadescription', `keywords`='$ametakeywords' WHERE `page`='about'") or die(mysql_error());
		}
	}
	$result=mysql_query("SELECT * FROM `seo` WHERE `page`='about' ");
	$row=mysql_fetch_array($result);	
		 ?>
	<div>
   
    <form id="aseo" name="aseo" method="post">
        <div class='container'>
        	<label  for="atitle">Тег "title" (Название) *</label><br />
			<textarea required="required"  maxlength="100" name="atitle" id="atitle" value="" style="width:295px; height:74px" /><?=$row[title]?></textarea><br/>
            <span id='aseo_ttitle' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="ametadescription">SEO "Description" (Описание)</label><br />
			<textarea  maxlength="140" name="ametadescription" id="ametadescription" value="" style="width:295px; height:74px" /><?=$row[description]?></textarea><br/>
            <span id='aseo_ametadescription_errorloc' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="ametakeywords">SEO "Keywords" (Ключевые слова)</label><br />
			<textarea  maxlength="140" name="ametakeywords" id="ametakeywords" value="" style="width:295px; height:74px" /><?=$row[keywords]?></textarea><br/>
            <span id='aseo_ametakeywords_errorloc' class='error'></span>
        </div>
        <input type="submit" value="изменить" name="aseo" id="aseo"/>
     </form>
     </div>
<? } ?>
        

<!--services-->
<? if($_GET[dept]==services){
		if(isset($_POST[editor2])){
		$file ="../services.html";
		$fservices=fopen($file,"w+") or die("невозможно открыть/создать файл");
		fwrite($fservices, $_POST[editor2]) or die ('Не записал');
		fclose($fservices);
		}?>
        <form method="post"  >
        <h2>УСЛУГИ</h2>
		<textarea name="editor2" style="width:1045px" id="editor2"><?=file_get_contents("../services.html")?></textarea>
        <input type="submit" name="submit" value="Сохранить"/>
        </form>
        
          <? 
	
    if($_POST[stitle]){
		$stitle = strip_tags($_POST[stitle]);
		$stitle	= trim($stitle);
		$stitle = htmlspecialchars($stitle);
		$stitle = mysql_escape_string($stitle);
		$stitle = mb_substr($stitle, 0,140, 'UTF-8');
		$smetadescription = strip_tags($_POST[smetadescription]);
		$smetadescription	= trim($smetadescription);
		$smetadescription = htmlspecialchars($smetadescription);
		$smetadescription = mysql_escape_string($smetadescription);
		$smetadescription = mb_substr($smetadescription, 0,140, 'UTF-8');
		$smetakeywords = strip_tags($_POST[smetakeywords]);
		$smetakeywords	= trim($smetakeywords);
		$smetakeywords = htmlspecialchars($smetakeywords);
		$smetakeywords = mysql_escape_string($smetakeywords);
		$smetakeywords = mb_substr($smetakeywords, 0,140, 'UTF-8');
		if($stitle=="" ||$stitle==" ") { ?>
          <div style="display: none;">
    		<div class="box-modal" id="error5">
        		<div class="box-modal_close arcticmodal-close">закрыть</div>
        		Невозможно добавить.Используются недопустимые символы или пустая строка
    		</div>
		  </div>
         <? }
		else{
			$result=mysql_query("SELECT * FROM `seo` WHERE `page`='services' ");
			$total=mysql_num_rows($result); 
			if(!$total)$rres=mysql_query ("INSERT INTO seo (title, description, keywords, page) VALUES('$stitle' ,'$smetadescription', '$smetakeywords' , 'services')") or die(mysql_error());
			else $rres=mysql_query ("UPDATE seo SET `title`= '$stitle', `description`='$smetadescription', `keywords`='$smetakeywords' WHERE `page`='services'") or die(mysql_error());
		}
	}
	$result=mysql_query("SELECT * FROM `seo` WHERE `page`='services' ");
	$row=mysql_fetch_array($result);	
		 ?>
	<div>
   
    <form id="sseo" name="sseo" method="post">
        <div class='container'>
        	<label  for="stitle">Тег "title" (Название) *</label><br />
			<textarea required="required"  maxlength="100" name="stitle" id="stitle" value="" style="width:295px; height:74px" /><?=$row[title]?></textarea><br/>
            <span id='sseo_stitle' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="smetadescription">SEO "Description" (Описание)</label><br />
			<textarea  maxlength="140" name="smetadescription" id="smetadescription" value="" style="width:295px; height:74px" /><?=$row[description]?></textarea><br/>
            <span id='sseo_smetadescription_errorloc' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="smetakeywords">SEO "Keywords" (Ключевые слова)</label><br />
			<textarea  maxlength="140" name="smetakeywords" id="smetakeywords" value="" style="width:295px; height:74px" /><?=$row[keywords]?></textarea><br/>
            <span id='sseo_smetakeywords_errorloc' class='error'></span>
        </div>
        <input type="submit" value="изменить" name="sseo" id="sseo"/>
     </form>
     </div>
    
<? }  ?>
<!--company-->
<? if($_GET[dept]==company){
		if(isset($_POST[editor3])){
		$file ="../company.html";
		$company=fopen($file,"w+") or die("невозможно открыть/создать файл");
		fwrite($company, $_POST[editor3]) or die ('Не записал');
		fclose($company);
		}?>
        <form method="post"  >
        <h2>КОНТАКТЫ</h2>
		<textarea name="editor3" style="width:1045px" id="editor3"><?=file_get_contents("../company.html")?></textarea>
        <input type="submit" name="submit" value="Сохранить"/>
        </form>
        
        <? 
	
    if($_POST[ctitle]){
		$ctitle = strip_tags($_POST[ctitle]);
		$ctitle	= trim($ctitle);
		$ctitle = htmlspecialchars($ctitle);
		$ctitle = mysql_escape_string($ctitle);
		$ctitle = mb_substr($ctitle, 0,140, 'UTF-8');
		$cmetadescription = strip_tags($_POST[cmetadescription]);
		$cmetadescription	= trim($cmetadescription);
		$cmetadescription = htmlspecialchars($cmetadescription);
		$cmetadescription = mysql_escape_string($cmetadescription);
		$cmetadescription = mb_substr($cmetadescription, 0,140, 'UTF-8');
		$cmetakeywords = strip_tags($_POST[cmetakeywords]);
		$cmetakeywords	= trim($cmetakeywords);
		$cmetakeywords = htmlspecialchars($cmetakeywords);
		$cmetakeywords = mysql_escape_string($cmetakeywords);
		$cmetakeywords = mb_substr($cmetakeywords, 0,140, 'UTF-8');
		if($ctitle=="" ||$ctitle==" ") { ?>
          <div style="display: none;">
    		<div class="box-modal" id="error6">
        		<div class="box-modal_close arcticmodal-close">закрыть</div>
        		Невозможно добавить.Используются недопустимые символы или пустая строка
    		</div>
		  </div>
         <? }
		else{
			$result=mysql_query("SELECT * FROM `seo` WHERE `page`='company' ");
			$total=mysql_num_rows($result); 
			if(!$total)$rres=mysql_query ("INSERT INTO seo (title, description, keywords, page) VALUES('$ctitle' ,'$cmetadescription', '$cmetakeywords' , 'company')") or die(mysql_error());
			else $rres=mysql_query ("UPDATE seo SET `title`= '$ctitle', `description`='$cmetadescription', `keywords`='$cmetakeywords' WHERE `page`='company'") or die(mysql_error());
		}
	}
	$result=mysql_query("SELECT * FROM `seo` WHERE `page`='company' ");
	$row=mysql_fetch_array($result);	
		 ?>
	<div>
   
    <form id="cseo" name="cseo" method="post">
        <div class='container'>
        	<label  for="ctitle">Тег "title" (Название) *</label><br />
			<textarea required="required"  maxlength="100" name="ctitle" id="ctitle" value="" style="width:295px; height:74px" /><?=$row[title]?></textarea><br/>
            <span id='cseo_ctitle' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="cmetadescription">SEO "Description" (Описание)</label><br />
			<textarea  maxlength="140" name="cmetadescription" id="cmetadescription" value="" style="width:295px; height:74px" /><?=$row[description]?></textarea><br/>
            <span id='cseo_cmetadescription_errorloc' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="cmetakeywords">SEO "Keywords" (Ключевые слова)</label><br />
			<textarea  maxlength="140" name="cmetakeywords" id="cmetakeywords" value="" style="width:295px; height:74px" /><?=$row[keywords]?></textarea><br/>
            <span id='cseo_cmetakeywords_errorloc' class='error'></span>
        </div>
        <input type="submit" value="изменить" name="cseo" id="cseo"/>
     </form>
     </div>
        
<? } ?>
<!--news-->
<? if($_GET[dept]==news){
mysql_query("CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datepicker` date NOT NULL DEFAULT '0000-00-00',
  `story_name` text CHARACTER SET utf8 NOT NULL,
  `story` text CHARACTER SET utf8 NOT NULL,
  `story_sthtml` text CHARACTER SET utf8 NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `active` text CHARACTER SET utf8 NOT NULL,
  KEY `id` (`id`),
  KEY `date_updated` (`date_updated`),
  FULLTEXT KEY `story` (`story`,`story_name`))
" )or die(mysql_error());?>


     
<table id="custbut" ></table>
<div id="pcustbut"></div>
<br/>
<div id=sms></div>

<?

    if($_POST[ntitle]){
		$ntitle = strip_tags($_POST[ntitle]);
		$ntitle	= trim($ntitle);
		$ntitle = htmlspecialchars($ntitle);
		$ntitle = mysql_escape_string($ntitle);
		$ntitle = mb_substr($ntitle, 0,140, 'UTF-8');
		$nmetadescription = strip_tags($_POST[nmetadescription]);
		$nmetadescription	= trim($nmetadescription);
		$nmetadescription = htmlspecialchars($nmetadescription);
		$nmetadescription = mysql_escape_string($nmetadescription);
		$nmetadescription = mb_substr($nmetadescription, 0,140, 'UTF-8');
		$nmetakeywords = strip_tags($_POST[nmetakeywords]);
		$nmetakeywords	= trim($nmetakeywords);
		$nmetakeywords = htmlspecialchars($nmetakeywords);
		$nmetakeywords = mysql_escape_string($nmetakeywords);
		$nmetakeywords = mb_substr($nmetakeywords, 0,140, 'UTF-8');
		if($ntitle=="" ||$ntitle==" ") { ?>
          <div style="display: none;">
    		<div class="box-modal" id="error6">
        		<div class="box-modal_close arcticmodal-close">закрыть</div>
        		Невозможно добавить.Используются недопустимые символы или пустая строка
    		</div>
		  </div>
         <? }
		else{
			$result=mysql_query("SELECT * FROM `seo` WHERE `page`='news' ");
			$total=mysql_num_rows($result); 
			if(!$total)$rres=mysql_query ("INSERT INTO seo (title, description, keywords, page) VALUES('$ntitle' ,'$nmetadescription', '$nmetakeywords' , 'news')") or die(mysql_error());
			else $rres=mysql_query ("UPDATE seo SET `title`= '$ntitle', `description`='$nmetadescription', `keywords`='$nmetakeywords' WHERE `page`='news'") or die(mysql_error());
		}
	}
	$result=mysql_query("SELECT * FROM `seo` WHERE `page`='news' ");
	$row=mysql_fetch_array($result);	
		 ?>
	<div>
   
    <form id="nseo" name="nseo" method="post">
        <div class='container'>
        	<label  for="ntitle">Тег "title" (Название) *</label><br />
			<textarea required="required"  maxlength="100" name="ntitle" id="ntitle" value="" style="width:295px; height:74px" /><?=$row[title]?></textarea><br/>
            <span id='nseo_ntitle' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="nmetadescription">SEO "Description" (Описание)</label><br />
			<textarea  maxlength="140" name="nmetadescription" id="nmetadescription" value="" style="width:295px; height:74px" /><?=$row[description]?></textarea><br/>
            <span id='nseo_nmetadescription_errorloc' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="nmetakeywords">SEO "Keywords" (Ключевые слова)</label><br />
			<textarea  maxlength="140" name="nmetakeywords" id="nmetakeywords" value="" style="width:295px; height:74px" /><?=$row[keywords]?></textarea><br/>
            <span id='nseo_nmetakeywords_errorloc' class='error'></span>
        </div>
        <input type="submit" value="изменить" name="nseo" id="nseo"/>
     </form>
     </div>

<? }?>
<!--obyavleniya-->
<?

if($_GET[pan]==n){ ?>
<table id="list2"></table>
<div id="pager2"></div>
<?
 }
?>
<!--new-->
<?
if($_GET[pan]==nn){ ?>
<div id='fg_membersite'  style="padding:15px" >
<h2>ОБЪЯВЛЕНИЯ</h2>
<div id="anun"></div>
<div class='short_explanation'>Поля, отмеченные *, являются обязательными для заполнения.</div>
<form action="ajaxcreate.php" id="aptform" method="post" > 

		<div class='container'><table><tr>
			<td><label style="text-align:center;"  for="title">Артикул</label><br />
			<input style="width:193px; text-align:center;" disabled="disabled" type="text" name="title" id="title" value="" ></td>
        
            <td><label style="text-align:center;" for="sozdano">Создано</label><br />
			<input style="width:193px; text-align:center;" disabled="disabled" type="text" name="sozdano" id="sozdano" value=""></td>
        
            <td><label style="text-align:center;" for="upd">Обновлено</label><br />
			<input style="width:193px; text-align:center;" disabled="disabled" type="text" name="upd" id="upd" value=""><br /></td></tr></table> 
		</div>
        <table><tr><td valign="top">
        <div class='container'>
        	<label  for="description">Описание</label><br />
			<textarea maxlength="300" name="description" id="description" value="" style="width:295px;" /></textarea><br/>
            <span id='aptform_description_errorloc' class='error'></span>
        </div>
        
		<div class='container'>
        	<label for="selcategory">Категория *</label><br />
   			<select size="1" required name='selcategory' id="selcategory">
   			
   		<?  $result=mysql_query("SELECT * FROM `category`") or die(mysql_error());
   			while($row=mysql_fetch_array($result)){ 
				$cselect=$row['category'];
				?>
				<option value="<?=$row['id'] ?>"><?=$cselect?></option>
   			<? } ?>
			</select><br />
            
        </div> 
        <div class='container'>
        	<label for="metall">Металл *</label><br />
   			<select size="1" required name='metall' id="metall">
   			
   		<?  $result=mysql_query("SELECT * FROM `metall`") or die(mysql_error());
   			while($row=mysql_fetch_array($result)){ 
				$cselect=$row['metall'];
				?>
				<option value="<?=$row['id'] ?>"><?=$cselect?></option>
   			<? } ?>
			</select><br />
            
        </div>
        <div class='container'>
        	<label for="proba">Проба *</label><br />
   			<select size="1" required name='proba' id="proba">
   			
   		<?  $result=mysql_query("SELECT * FROM `proba`") or die(mysql_error());
   			while($row=mysql_fetch_array($result)){ 
				$cselect=$row['proba'];
				?>
				<option value="<?=$row['id'] ?>"><?=$cselect?></option>
   			<? } ?>
			</select><br />
            
        </div>
        <div class='container'>
        	<label for="vstavka">Вставка</label><br />
   			<select size="1"  name='vstavka' id="vstavka">
   			
   		<?  $result=mysql_query("SELECT * FROM `vstavka`") or die(mysql_error());?>
			<option value=""></option>
   			<? while($row=mysql_fetch_array($result)){ 
				$cselect=$row['vstavka'];
				?>
				<option value="<?=$row['id'] ?>"><?=$cselect?></option>
   			<? } ?>
			</select><br />
            
        </div>
		<div class='container'>
        	<label for="razmer">Размер</label><br />
   			<select size="1"  name='razmer' id="razmer">
   			
   		<?  $result=mysql_query("SELECT * FROM `razmer`") or die(mysql_error());?>
			<option value=""></option>
   			<? while($row=mysql_fetch_array($result)){ 
				$cselect=$row['razmer'];
				?>
				<option value="<?=$row['id'] ?>"><?=$cselect?></option>
   			<? } ?>
			</select><br />
            
        </div>
		<div class='container'>
        	<label for="price">Цена(руб.) * </label><br />
    		<input type="text" name="price" id="price" value="" /><br /> 
            <span id='aptform_price_errorloc' class='error'></span>
        </div>
        <div class='container'>
        	<label for="weight">Вес(грамм) * </label><br /> 
    		<input type="text" name="weight" id="weight" value="" /><br />
            <span id='aptform_weight_errorloc' class='error'></span>
        </div>
        
        
        <label for="selactive">Статус *</label><br />
	<select  name="selactive" id="selactive">
	<option value="1">Активно</option>
    <option value="0" selected="selected">Неактивно</option>  
    </select></div>
     	<input type="hidden" id="hidden" name="hidden" />
        <input type="hidden" id="hiddescription" name="hiddescription" />
        <input type="hidden" id="hidselcategory" name="hidselcategory" />
        <input type="hidden" id="hidvstavka" name="hidvstavka" />
        <input type="hidden" id="hidrazmer" name="hidrazmer" />
        <input type="hidden" id="hidnotes" name="hidnotes" />
        <input type="hidden" id="hidprice" name="hidprice" />
        <input type="hidden" id="hidweight" name="hidweight" />
        <input type="hidden" id="hidmetall" name="hidmetall" />
        <input type="hidden" id="hidproba" name="hidproba" />
        <input type="hidden" id="hidselactive" name="hidselactive" />
        <input type="hidden" id="hiddataupd" name="hiddataupd" />
        <input type="hidden" id="hiddatacrt" name="hiddatacrt" />
        
        <input type="hidden" id="hidtegtitle" name="hidtegtitle" />
        <input type="hidden" id="hidmetadescription" name="hidmetadescription" />
        <input type="hidden" id="hidmetakeywords" name="hidmetakeywords" />
        
        <input type="hidden" id="uveren" name="uveren" />
        </td><td valign="top">
        <div class='container'>
        	<label for="notes">Заметка (не показывается)</label><br />
			<textarea  maxlength="300" name="notes" id="notes" value="" style="width:295px;" /></textarea><br/>
            <span id='aptform_notes_errorloc' class='error'></span>
        </div>
        <div style="visibility:hidden" id="seo">
        <div class='container'>
        	<label  for="tegtitle">Тег "title" (Название)</label><br />
			<textarea  maxlength="100" name="tegtitle" id="tegtitle" value="" style="width:295px; height:74px" />ювелирные изделия</textarea><br/>
            <span id='aptform_tegtitle' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="metadescription">SEO "Description" (Описание)</label><br />
			<textarea  maxlength="140" name="metadescription" id="metadescription" value="" style="width:295px; height:74px" /></textarea><br/>
            <span id='aptform_metadescription_errorloc' class='error'></span>
        </div>
        <div class='container'>
        	<label  for="metakeywords">SEO "Keywords" (Ключевые слова)</label><br />
			<textarea  maxlength="140" name="metakeywords" id="metakeywords" value="" style="width:295px; height:74px" /></textarea><br/>
            <span id='aptform_metakeywords_errorloc' class='error'></span>
        </div>
        
        </div></td></tr></table><br />
<input type="submit"  onclick="$('#anun').html('');" name="submit"  value="Создать" id = "btn0" />

</form>	<br />
<?  
if($_GET[id]){?>
		<script>
		
		edititem("<?=$_GET[id]?>");
		</script>
	<?	
	 }
	 ?>
<div style="visibility:hidden" class="wrapper"> 
 
<div style="visibility:hidden" id="filelimit-fine-uploader"></div>
<div style="visibility:hidden" id="messages"></div>

</div>
<div style="visibility:hidden" id="edit"></div>
<div style="visibility:hidden" id="111"></div>	


<br /><br />
</div>
<script>
var frmvalidator  = new Validator("aptform");
frmvalidator.addValidation("weight","num","Необходимо ввести цифры");
frmvalidator.addValidation("price","num","Необходимо ввести цифры");
frmvalidator.addValidation("weight","req","Необходимо заполнить поле Вес");
frmvalidator.addValidation("price","req","Необходимо заполнить поле Цена");
frmvalidator.addValidation("description","maxlen=1000","Слишком много символов");
frmvalidator.addValidation("notes","maxlen=1000","Слишком много символов");
frmvalidator.addValidation("tegtitle","maxlen=100","Слишком много символов");
frmvalidator.addValidation("metadescription","maxlen=140","Слишком много символов");
frmvalidator.addValidation("metakeywords","maxlen=140","Слишком много символов");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
</script>
</div>
</div>
</td>
</tr>
</table>
</div>

<? } ?>
<!--metall-->
<? if($_GET[pan]==met){
	tablnew("metall","met","металл","металл"); ?>
    <table id="metalltable"></table>
	<div id="metallpager"></div>
<?
}
?>
<!--vstavka-->
<? if($_GET[pan]==vst){
	tablnew("vstavka","vst","вставка","вставку");?>
 	<table id="vstavkatable"></table>
    <div id="vstavkapager"></div>
<?
}
?>
<!--CATEGORY-->
<? if($_GET[pan]==cat){
	tablnew("category","cat","категория","категорию");?>
 	<table id="categorytable"></table>
    <div id="categorypager"></div>
<?
 
}
?>
<!--PROBA-->
<?  if($_GET[pan]==prb){ 

tablnew("proba","prb","проба","пробу");?>
 	<table id="probatable"></table>
    <div id="probapager"></div>
<?

}
?>
<!--razmer-->
<? if($_GET[pan]==raz){
	tablnew("razmer","raz","размер","размер");?>
 	<table id="razmertable"></table>
    <div id="razmerpager"></div>
<?
 
}
?>
 <!--PASSWORD--> 
<?
if($_GET[pan]==p){
 if(isset($_POST['submitted'])){
   	if($fgmembersite->ChangePassword()){ ?>
       <br />
       <div id='fg_membersite' style="padding:15px">
       <h2>Changed password</h2>
	   Your password is updated!
	   </div>
   	<?	}
	}
 else { ?>
	<br />	
	 <!-- Form Code Start -->
	<div id='fg_membersite' style="padding:15px">
	<form id='changepwd' action='<?=$_SERVER['../PHP_SELF']."?pan=p";?>' method='post' accept-charset='UTF-8'>
	<legend>Change Password</legend>
	<input type='hidden' name='submitted' id='submitted' value='1'/>
	<div class='short_explanation'>* required fields</div>
	<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
	<div class='container'>
    <label for='oldpwd' >Old Password*:</label><br/>
    <div class='pwdwidgetdiv' id='oldpwddiv' ></div><br/>
    <noscript>
    <input type='password' name='oldpwd' id='oldpwd' maxlength="50" />
    </noscript>    
    <span id='changepwd_oldpwd_errorloc' class='error'></span>
	</div>
	<div class='container'>
    <label for='newpwd' >New Password*:</label><br/>
    <div class='pwdwidgetdiv' id='newpwddiv' ></div>
    <noscript>
    <input type='password' name='newpwd' id='newpwd' maxlength="50" /><br/>
    </noscript>
    <span id='changepwd_newpwd_errorloc' class='error'></span>
	</div>
	<br />
	<div class='container'>
    <label for='confirmpwd' >Confirm Password*:</label><br/>
    <div class='pwdwidgetdiv' id='confirmpwddiv' ></div>
    <noscript>
    <input type='password' name='confirmpwd' id='confirmpwd' maxlength="50" /><br/>
    </noscript>
  	<span id='changepwd_confirmpwd_errorloc' class='error'></span>  
	</div>
	<br/><br/><br/>
	<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
	</div>
	</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->
	<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('oldpwddiv','oldpwd');
    pwdwidget.enableGenerate = false;
    pwdwidget.enableShowStrength=false;
    pwdwidget.enableShowStrengthStr =false;
    pwdwidget.MakePWDWidget();
    var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
    pwdwidget.MakePWDWidget();
	var pwdwidget = new PasswordWidget('confirmpwddiv','confirmpwd');
    pwdwidget.enableGenerate = false;
	pwdwidget.enableShowStrength=false;
	pwdwidget.enableShowStrengthStr =false;
    pwdwidget.MakePWDWidget();
    var frmvalidator  = new Validator("changepwd");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("oldpwd","req","введите старый пароль");
    frmvalidator.addValidation("newpwd","req","введите новый пароль");
	frmvalidator.addValidation("confirmpwd","req","подтвердите новый пароль");
	frmvalidator.addValidation("confirmpwd","eqelmnt=newpwd","подтверждённый пароль не совпадает");
// ]]>
	</script>
<!--
Form Code End (see html-form-guide.com for more info.)
-->
	</div>
<? }
}?>
</div>
 </td>
</tr>
</table>
</div>
</body>
</html>