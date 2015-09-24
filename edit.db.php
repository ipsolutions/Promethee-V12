<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2013 by IP-Solutions(contact@ip-solutions.fr)

   This file is part of Prométhée.

   Prométhée is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   Prométhée is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Prométhée.  If not, see <http://www.gnu.org/licenses/>.
 *-----------------------------------------------------------------------*/


/*
 *		module   : edit.db.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

<?php
include_once("php/dbconfig.php");
include_once("php/functions.php");
function getCalendarByRange($id){
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "select * from `edt_data` where `_IDx` = " . $id;
    $handle = mysql_query($sql);
    //echo $sql;
    $row = mysql_fetch_object($handle);
	}catch(Exception $e){
  }
  return $row;
}
if(@$_GET["id"] && $_GET["type"] == "edit"){
  $event = getCalendarByRange($_GET["id"]);
}
?>


<?php
$sid  = ( @$_POST["sid"] )			// session de l'utilisateur
	? $_POST["sid"]
	: @$_GET["sid"] ;

$IDedt  = ( @$_POST["IDedt"] )			// ID du type d'edt
	? $_POST["IDedt"]
	: @$_GET["IDedt"] ;
	
$IDcentre  = ( @$_POST["IDcentre"] )			// ID du centre
	? $_POST["IDcentre"]
	: @$_GET["IDcentre"] ;
	
$IDdata  = ( @$_POST["IDdata"] )			// ID de l'emploi du temps
	? $_POST["IDdata"]
	: @$_GET["IDdata"] ;
	
$IDx  = ( @$_POST["IDx"] )			// ID de l'emploi du temps
	? $_POST["IDx"]
	: @$_GET["IDx"] ;
$IDxx  = ( @$_POST["IDxx"] )			// ID de l'emploi du temps
	? $_POST["IDxx"]
	: @$_GET["IDxx"] ;

$j        = @$_GET["j"];			// jour
$h        = @$_GET["h"];			// heure

$IDitem   = ( @$_POST["IDitem"] )		// ID de la salle
	? (int) $_POST["IDitem"]
	: (int) @$_GET["IDitem"] ;
$IDclass  = ( @$_POST["IDclass"] )		// ID de la classe
	? (int) $_POST["IDclass"]
	: (int) @$_GET["IDclass"] ;
$IDmat  = ( @$_POST["IDmat"] )		// ID de la matière
	? (int) $_POST["IDmat"]
	: (int) @$_GET["IDmat"] ;
$IDuser   = ( @$_POST["IDuser"] )		// ID de l'utilisateur
	? (int) $_POST["IDuser"]
	: (int) @$_GET["IDuser"] ;
$IDmat    = (int) @$_POST["IDmat"];		// ID de la matière
$idweek   = (int) @$_POST["idweek"];	// type de semaine
$idgroup  = (int) @$_POST["idgroup"];	// groupe classe
$delay    = @$_POST["delay"];			// durée du cours

$generique  = ( @$_POST["generique"] )		
	? $_POST["generique"]
	: @$_GET["generique"] ;
	
$start  = ( @$_POST["start"] )		
	? $_POST["start"]
	: @$_GET["start"] ;
	
$end  = ( @$_POST["end"] )		
	? $_POST["end"]
	: @$_GET["end"] ;

$submit   = @$_POST["valid_x"];		// bouton de validation
//$url   = $_SERVER['SERVER_NAME'] .$_SERVER ['REQUEST_URI'];		// bouton de validation

$_SESSION["CnxCentre"] = $IDcentre;
?>

<?php require "page_banner.htm"; ?>


<?php
	require "msg/edt.php";
	require_once "include/TMessage.php";

	// qui suis-je ?
	$query  = "select distinctrow _adm, _IDgrp from user_id, user_session ";
	$query .= "where _IDsess = '$sid' " ;
	$query .= "AND user_id._ID = user_session._ID ";
	$query .= "order by _lastaction ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$auth   = ( $result ) ? mysql_fetch_row($result) : 0 ;

	// vérification des droits
	$query   = "select _IDmod, _IDgrpwr from edt ";
	$query  .= "where _IDedt = '$IDedt' " ;
	$query  .= "limit 1";

	$result  = mysql_query($query, $mysql_link);
	$row     = ( $result ) ? mysql_fetch_row($result) : 0 ;

	if ( $auth[0] != 255 AND $auth[0] != $row[0] AND !($row[1] & pow(2, $auth[1] - 1)) )
		exit;

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/edt.php");
	$msg->msg_search  = $keywords_search;
	$msg->msg_replace = $keywords_replace;

	if ( $IDxx )
	{
		if($generique == "off")
		{
			$query   = "select _IDmat, _IDclass, _delais, _semaine, _IDitem, _group, _ID from edt_data ";
			$query  .= "where _IDx = '$IDxx' " ;
			$query  .= "limit 1";
		}
		else
		{
			$query   = "select _IDmat, _IDclass, _delais, _semaine, _IDitem, _group, _ID from edt_data ";
			$query  .= "where _IDx = '$IDxx' " ;
			$query  .= "limit 1";
		}

		$result  = mysql_query($query, $mysql_link);
		$row     = ( $result ) ? mysql_fetch_row($result) : 0 ;

		$IDmat   = (int) $row[0];
		$IDclass = $row[1];
		$delay   = $row[2];
		$idweek  = (int) $row[3];
		$IDitem  = (int) $row[4];
		$idgroup = (int) $row[5];
		$IDuser  = (int) $row[6];
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
  <head>    
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">    
    <title>Calendar Details</title>    
    <link href="css/main.css" rel="stylesheet" type="text/css" />       
    <link href="css/dp.css" rel="stylesheet" />    
    <link href="css/dropdown.css" rel="stylesheet" />    
    <link href="css/colorselect.css" rel="stylesheet" />   
     
    <script src="script/jquery.js" type="text/javascript"></script>    
    <script src="script/Plugins/Common.js" type="text/javascript"></script>        
    <script src="script/Plugins/jquery.form.js" type="text/javascript"></script>     
    <script src="script/Plugins/jquery.validate.js" type="text/javascript"></script>     
    <script src="script/Plugins/datepicker_lang_US.js" type="text/javascript"></script>        
    <script src="script/Plugins/jquery.datepicker.js" type="text/javascript"></script>     
    <script src="script/Plugins/jquery.dropdown.js" type="text/javascript"></script>     
    <script src="script/Plugins/jquery.colorselect.js" type="text/javascript"></script>    
	
	<!-- Calendar -->
	<script type="text/javascript" src="script/datepicker.js"></script>
	<link href="css/datepicker.css" rel="stylesheet" type="text/css" />
     
	<?php if($generique == "off") { ?>
	<script type="text/javascript">
	//<![CDATA[

	/* The following function creates a new input field and then calls datePickerController.create();
	   to dynamically create a new datePicker widgit for it */
	function newline() {
			var total = document.getElementById("newline-wrapper").getElementsByTagName("table").length;
			total++;

			// Clone the first div in the series
			var tbl = document.getElementById("newline-wrapper").getElementsByTagName("table")[0].cloneNode(true);

			// DOM inject the wrapper div
			document.getElementById("newline-wrapper").appendChild(tbl);

			var buts = tbl.getElementsByTagName("a");
			if(buts.length) {
					buts[0].parentNode.removeChild(buts[0]);
					buts = null;
			}

			// Reset the cloned label's "for" attributes
			var labels = tbl.getElementsByTagName('label');

			for(var i = 0, lbl; lbl = labels[i]; i++) {
					// Set the new labels "for" attribute
					if(lbl["htmlFor"]) {
							lbl["htmlFor"] = lbl["htmlFor"].replace(/[0-9]+/g, total);
					} else if(lbl.getAttribute("for")) {
							lbl.setAttribute("for", lbl.getAttribute("for").replace(/[0-9]+/, total));
					}
			}

			// Reset the input's name and id attributes
			var inputs = tbl.getElementsByTagName('input');
			for(var i = 0, inp; inp = inputs[i]; i++) {
					// Set the new input's id and name attribute
					inp.id = inp.name = inp.id.replace(/[0-9]+/g, total);
					if(inp.type == "text") inp.value = "";
			}

			// Call the create method to create and associate a new date-picker widgit with the new input
			datePickerController.create(document.getElementById("date-" + total));

			var dp = datePickerController.datePickers["dp-normal-1"];

			// No more than 5 inputs
			if(total == 50) document.getElementById("newline").style.display = "none";

			// Stop the event
			return false;
	}

	function createNewLineButton() {
			var nlw = document.getElementById("newline-wrapper");

			var a = document.createElement("a");
			a.href="#";
			a.id = "newline";
			a.title = "Create New Input";
			a.onclick = newline;
			nlw.parentNode.appendChild(a);

			a.appendChild(document.createTextNode("Plus"));
			a.style.fontWeight = "bold";
			a.style.marginLeft = "168px";
			a = null;
	}

	datePickerController.addEvent(window, 'load', createNewLineButton);

	//]]>
	</script>
	<?php } ?>

    <script type="text/javascript">
        if (!DateAdd || typeof (DateDiff) != "function") {
            var DateAdd = function(interval, number, idate) {
                number = parseInt(number);
                var date;
                if (typeof (idate) == "string") {
                    date = idate.split(/\D/);
                    eval("var date = new Date(" + date.join(",") + ")");
                }
                if (typeof (idate) == "object") {
                    date = new Date(idate.toString());
                }
                switch (interval) {
                    case "y": date.setFullYear(date.getFullYear() + number); break;
                    case "m": date.setMonth(date.getMonth() + number); break;
                    case "d": date.setDate(date.getDate() + number); break;
                    case "w": date.setDate(date.getDate() + 7 * number); break;
                    case "h": date.setHours(date.getHours() + number); break;
                    case "n": date.setMinutes(date.getMinutes() + number); break;
                    case "s": date.setSeconds(date.getSeconds() + number); break;
                    case "l": date.setMilliseconds(date.getMilliseconds() + number); break;
                }
                return date;
            }
        }
        function getHM(date)
        {
             var hour =date.getHours();
             var minute= date.getMinutes();
             var ret= (hour>9?hour:"0"+hour)+":"+(minute>9?minute:"0"+minute) ;
             return ret;
        }
        $(document).ready(function() {
            //debugger;
            var DATA_FEED_URL = "php/datafeed.php";
            var arrT = [];
            var tt = "{0}:{1}";
            for (var i = 0; i < 24; i++) {
                arrT.push({ text: StrFormat(tt, [i >= 10 ? i : "0" + i, "00"]) }, { text: StrFormat(tt, [i >= 10 ? i : "0" + i, "30"]) });
            }
            $("#timezone").val(new Date().getTimezoneOffset()/60 * -1);
            $("#stparttime").dropdown({
                dropheight: 200,
                dropwidth:60,
                selectedchange: function() { },
                items: arrT
            });
            $("#etparttime").dropdown({
                dropheight: 200,
                dropwidth:60,
                selectedchange: function() { },
                items: arrT
            });
            var check = $("#IsAllDayEvent").click(function(e) {
                if (this.checked) {
                    $("#stparttime").val("00:00").hide();
                    $("#etparttime").val("00:00").hide();
                }
                else {
                    var d = new Date();
                    var p = 60 - d.getMinutes();
                    if (p > 30) p = p - 30;
                    d = DateAdd("n", p, d);
                    $("#stparttime").val(getHM(d)).show();
                    $("#etparttime").val(getHM(DateAdd("h", 1, d))).show();
                }
            });
            if (check[0].checked) {
                $("#stparttime").val("00:00").hide();
                $("#etparttime").val("00:00").hide();
            }
            $("#Savebtn").click(function() { $("#fmEdit").submit(); });
            $("#Closebtn").click(function() { CloseModelWindow(); });
            $("#Deletebtn").click(function() {
                 if (confirm("Are you sure to remove this event")) {  
                    var param = [{ "name": "calendarId", value: 8}];                
                    $.post(DATA_FEED_URL + "?method=remove",
                        param,
                        function(data){
                              if (data.IsSuccess) {
                                    alert(data.Msg); 
                                    CloseModelWindow(null,true);                            
                                }
                                else {
                                    alert("Error occurs.\r\n" + data.Msg);
                                }
                        }
                    ,"json");
                }
            });
            
           $("#stpartdate,#etpartdate").datepicker({ picker: "<button class='calpick'></button>"});    
            var cv =$("#colorvalue").val() ;
            if(cv=="")
            {
                cv="-1";
            }
            $("#calendarcolor").colorselect({ title: "Color", index: cv, hiddenid: "colorvalue" });
            //to define parameters of ajaxform
            var options = {
                beforeSubmit: function() {
                    return true;
                },
                dataType: "json",
                success: function(data) {
                    alert(data.Msg);
                    if (data.IsSuccess) {
                        CloseModelWindow(null,true);  
                    }
                }
            };
            $.validator.addMethod("date", function(value, element) {                             
                var arrs = value.split(i18n.datepicker.dateformat.separator);
                var year = arrs[i18n.datepicker.dateformat.year_index];
                var month = arrs[i18n.datepicker.dateformat.month_index];
                var day = arrs[i18n.datepicker.dateformat.day_index];
                var standvalue = [year,month,day].join("-");
                return this.optional(element) || /^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3-9]|1[0-2])[\/\-\.](?:29|30))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3,5,7,8]|1[02])[\/\-\.]31)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:16|[2468][048]|[3579][26])00[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1-9]|1[0-2])[\/\-\.](?:0?[1-9]|1\d|2[0-8]))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?:\d{1,3})?)?$/.test(standvalue);
            }, "Invalid date format");
            $.validator.addMethod("time", function(value, element) {
                return this.optional(element) || /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])$/.test(value);
            }, "Invalid time format");
            $.validator.addMethod("safe", function(value, element) {
                return this.optional(element) || /^[^$\<\>]+$/.test(value);
            }, "$<> not allowed");
            $("#fmEdit").validate({
                submitHandler: function(form) { $("#fmEdit").ajaxSubmit(options); },
                errorElement: "div",
                errorClass: "cusErrorPanel",
                errorPlacement: function(error, element) {
                    showerror(error, element);
                }
            });
            function showerror(error, target) {
                var pos = target.position();
                var height = target.height();
                var newpos = { left: pos.left, top: pos.top + height + 2 }
                var form = $("#fmEdit");             
                error.appendTo(form).css(newpos);
            }
        });
    </script>      
    <style type="text/css">     
    .calpick     {        
        width:16px;   
        height:16px;     
        border:none;        
        cursor:pointer;        
        background:url("sample-css/cal.gif") no-repeat center 2px;        
        margin-left:-22px;    
    }
	
	body {
		overflow-y: scroll;
	}
		</style>
	</head>
	<body>   
	<?php 
	if(isset($_POST["submit"]))
	{
		if($IDx)
		{
			// initialisation
			if ( $IDitem < 0 ) {
				$IDuser = (int) abs($IDitem / 100);
				$IDitem = abs($IDitem + $IDuser);
			}
			
			$stpartdate = @$_POST["stpartdate"];
			$stparttime = @$_POST["stparttime"];
			$etpartdate = @$_POST["etpartdate"];
			$etparttime = @$_POST["etparttime"];
			
			$a = $stpartdate." ".$stparttime;
			$b = $etpartdate." ".$etparttime;
			
			$tab = DateCalendarToPmt($a, $b);
			
			$startx = $start;
			$start  = date('Y-m-d H:i:s', js2PhpTime($a));
			$end    = date('Y-m-d H:i:s', js2PhpTime($b));
			$d_start    = new DateTime($start);
			$d_end      = new DateTime($end);
			$diff = $d_start->diff($d_end);
			$duree = $diff->format('%H').":".$diff->format('%I');
			
			if($generique == "on")
			{
				// Recup IDdata
				$sql = "select _IDdata from `edt_data` order by _IDdata desc limit 1";
				$handle = mysql_query($sql);

				while ($row = mysql_fetch_object($handle)) {
					$IDdata =    intval($row->_IDdata) + 1;
				}
				
				// traitement classes multiples
				$string_class = ";";
				foreach($_POST as $key => $val)
				{
					if(substr($key, 0, 8) == "IDclass_")
					{
						if($val != "")
						{
							$string_class .= $val.";";
						}
					}
				}
				
				$sql = "update edt_data set _IDmat = '$IDmat', _IDclass = '$string_class', _ID = '$IDuser', _semaine = '$idweek', _group = '$idgroup', _jour = '".$tab["jour"]."', _heure = '".$tab["heure"]."', _delais = '$duree' where _IDx = $IDx and _annee = ".date("Y", js2PhpTime($startx))." ";
				
				if(mysql_query($sql)==false)
				{
					$ret['IsSuccess'] = false;
					$ret['Msg'] = mysql_error();
				}
				else
				{
					$ret['IsSuccess'] = true;
					$ret['Msg'] = 'Succefully';
				}
			}
			else if($generique == "off")
			{
				// Recup IDdata
				$sql = "select _IDdata from `edt_data` order by _IDdata desc limit 1";
				$handle = mysql_query($sql);

				while ($row = mysql_fetch_object($handle)) {
					$IDdata =    intval($row->_IDdata) + 1;
				}

				// traitement classes multiples
				$string_class = ";";
				foreach($_POST as $key => $val)
				{
					if(substr($key, 0, 8) == "IDclass_")
					{
						if($val != "")
						{
							$string_class .= $val.";";
						}
					}
				}
				
				$sql = "update edt_data set _IDmat = '$IDmat', _IDclass = '$string_class', _ID = '$IDuser', _semaine = '$idweek', _group = '$idgroup', _jour = '".$tab["jour"]."', _heure = '".$tab["heure"]."', _delais = '$duree' where _IDx = $IDx and _annee = ".date("Y", js2PhpTime($startx))." and _nosemaine = ".date("W", js2PhpTime($a))." ";

				if(mysql_query($sql)==false)
				{
					$ret['IsSuccess'] = false;
					$ret['Msg'] = mysql_error();
				}
				else
				{
					$ret['IsSuccess'] = true;
					$ret['Msg'] = 'Succefully';
				}
			}
		}
		else
		{
			// initialisation
			if ( $IDitem < 0 ) {
				$IDuser = (int) abs($IDitem / 100);
				$IDitem = abs($IDitem + $IDuser);
			}
			
			$stpartdate = @$_POST["stpartdate"];
			$stparttime = @$_POST["stparttime"];
			$etpartdate = @$_POST["etpartdate"];
			$etparttime = @$_POST["etparttime"];
			
			$a = $stpartdate." ".$stparttime;
			$b = $etpartdate." ".$etparttime;

			$tab = DateCalendarToPmt($a, $b);
			
			$startx = $start;
			$start  = date('Y-m-d H:i:s', js2PhpTime($a));
			$end    = date('Y-m-d H:i:s', js2PhpTime($b));
			$d_start    = new DateTime($start);
			$d_end      = new DateTime($end);
			$diff = $d_start->diff($d_end);
			$duree = $diff->format('%H').":".$diff->format('%I');
			
			if($generique == "on")
			{
				// Recup IDdata
				$sql = "select _IDdata from `edt_data` order by _IDdata desc limit 1";
				$handle = mysql_query($sql);

				while ($row = mysql_fetch_object($handle)) {
					$IDdata =    intval($row->_IDdata) + 1;
				}

				// traitement classes multiples
				$string_class = ";";
				foreach($_POST as $key => $val)
				{
					if(substr($key, 0, 8) == "IDclass_")
					{
						if($val != "")
						{
							$string_class .= $val.";";
						}
					}
				}
				
				$sql  = "insert into `edt_data` (`_IDdata`, `_IDedt`, `_IDcentre`, `_IDmat`, `_IDclass`, `_IDitem`, `_ID`, ";
				$sql .= "`_semaine`, `_group`, `_jour`, `_heure`, `_delais`, `_visible`, `_nosemaine`, `_etat`, `_IDx`, `_annee`) values ";
				$sql .= "('$IDdata', '$IDedt', '$IDcentre', '$IDmat', '$string_class', '$IDitem', '$IDuser', '$idweek', '$idgroup', '".$tab["jour"]."', '".$tab["heure"]."', '$duree', 'O', '0', '0', '', '".date("Y", js2PhpTime($startx))."')";
				
				if(mysql_query($sql)==false)
				{
					$ret['IsSuccess'] = false;
					$ret['Msg'] = mysql_error();
				}
				else
				{
					$ret['IsSuccess'] = true;
					$ret['Msg'] = 'Succefully';
				}
			}
			else if($generique == "off")
			{
				// Recup IDdata
				$sql = "select _IDdata from `edt_data` order by _IDdata desc limit 1";
				$handle = mysql_query($sql);

				while ($row = mysql_fetch_object($handle)) {
					$IDdata =    intval($row->_IDdata) + 1;
				}
				
				// traitement classes multiples
				$string_class = ";";
				foreach($_POST as $key => $val)
				{
					if(substr($key, 0, 8) == "IDclass_")
					{
						if($val != "")
						{
							$string_class .= $val.";";
						}
					}
				}
				
				$sql  = "insert into `edt_data` (`_IDdata`, `_IDedt`, `_IDcentre`, `_IDmat`, `_IDclass`, `_IDitem`, `_ID`, ";
				$sql .= "`_semaine`, `_group`, `_jour`, `_heure`, `_delais`, `_visible`, `_nosemaine`, `_etat`, `_IDx`, `_annee`) values ";
				$sql .= "('$IDdata', '$IDedt', '$IDcentre', '$IDmat', '$string_class', '$IDitem', '$IDuser', '0', '$idgroup', '".$tab["jour"]."', '".$tab["heure"]."', '$duree', 'O', '".date("W", js2PhpTime($a))."', '1', '', '".date("Y", js2PhpTime($startx))."')";

				if(mysql_query($sql)==false)
				{
					$ret['IsSuccess'] = false;
					$ret['Msg'] = mysql_error();
				}
				else
				{
					$ret['IsSuccess'] = true;
					$ret['Msg'] = 'Succefully';
				}
				
				// **** Gestion des reports ****
				foreach($_POST as $key => $val)
				{
					$split_date = @split("-", $key);
					
					if($split_date[0] == "date" && $val != "")
					{						
						$a = $val." ".$stparttime;
						$b = $val." ".$etparttime;
						
						$tab = DateCalendarToPmt($a, $b);
						
						$startx = $val;
						$start  = date('Y-m-d H:i:s', js2PhpTime($a));
						$end    = date('Y-m-d H:i:s', js2PhpTime($b));
						$d_start    = new DateTime($start);
						$d_end      = new DateTime($end);
						$diff = $d_start->diff($d_end);
						$duree = $diff->format('%H').":".$diff->format('%I');
			
						// Recup IDdata
						$sql = "select _IDdata from `edt_data` order by _IDdata desc limit 1";
						$handle = mysql_query($sql);

						while ($row = mysql_fetch_object($handle)) {
							$IDdata =    intval($row->_IDdata) + 1;
						}
						
						// traitement classes multiples
						$string_class = ";";
						foreach($_POST as $key => $val)
						{
							if(substr($key, 0, 8) == "IDclass_")
							{
								if($val != "")
								{
									$string_class .= $val.";";
								}
							}
						}
						
						$sql  = "insert into `edt_data` (`_IDdata`, `_IDedt`, `_IDcentre`, `_IDmat`, `_IDclass`, `_IDitem`, `_ID`, ";
						$sql .= "`_semaine`, `_group`, `_jour`, `_heure`, `_delais`, `_visible`, `_nosemaine`, `_etat`, `_IDx`, `_annee`) values ";
						$sql .= "('$IDdata', '$IDedt', '$IDcentre', '$IDmat', '$string_class', '$IDitem', '$IDuser', '0', '$idgroup', '".$tab["jour"]."', '".$tab["heure"]."', '$duree', 'O', '".date("W", js2PhpTime($a))."', '1', '', '".date("Y", js2PhpTime($startx))."')";
						
						if(mysql_query($sql)==false)
						{
							$ret['IsSuccess'] = false;
							$ret['Msg'] = mysql_error();
						}
						else
						{
							$ret['IsSuccess'] = true;
							$ret['Msg'] = 'Succefully';
						}
					}
				}
			}
		}
		?>

		<script>
		//window.top.location.reload();
		parent.$("#gridcontainer").reload();
		CloseModelWindow(null,true);
		// realsedragevent();
        // render();
		// $.fn.reload;
		//window.location.reload();
		</script>
		<?php
	}
	?>
    <div>          
      <div class="infocontainer">
		<br />
        <form action="edit.db.php?<?php echo isset($event)?"&id=".$event->Id:""; ?>" class="fform" id="fmEdit" method="post">
			<input type="hidden" name="generique" value="<?php echo $generique; ?>" />
			<input type="hidden" name="start" value="<?php echo $start; ?>" />
			<input type="hidden" name="end" value="<?php echo $end; ?>" />
			<input type="hidden" name="IDitem" value="<?php echo $IDitem; ?>" />
			<input type="hidden" name="IDuser" value="<?php echo $IDuser; ?>" />
			<input type="hidden" name="IDcentre" value="<?php echo $IDcentre; ?>" />
			<input type="hidden" name="IDclass" value="<?php echo $IDclass; ?>" />
			<input type="hidden" name="IDedt" value="<?php echo $IDedt; ?>" />
			<input type="hidden" name="sid" value="<?php echo $sid; ?>" />
			<?php
			if($IDxx)
			{
				?>
				<input type="hidden" name="IDx" value="<?php echo $IDxx; ?>" />
				<?php
			}
			?>

		<?php if(isset($event)){
			$sarr = explode(" ", php2JsTime(mySql2PhpTime($event->StartTime)));
			$earr = explode(" ", php2JsTime(mySql2PhpTime($event->EndTime)));
		}
		else
		{
			$sarr = explode(" ", $start);
			$earr = explode(" ", $end);
		}
		?>                
		
		<?php if($generique == "off") { ?>
		
		<table width="100%">
			<tr>
				<td class="align-center" width="50%">                
					<input MaxLength="10" id="stpartdate" name="stpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo $sarr[0]; ?>" />                       
					<input MaxLength="5" id="stparttime" name="stparttime" style="width:60px;" type="text" value="<?php echo $sarr[1]; ?>" />
				</td>
				<td class="align-center" width="50%">  
					<input MaxLength="10" id="etpartdate" name="etpartdate" style="padding-left:2px;width:90px; margin-left: -15px" type="text" value="<?php echo $earr[0]; ?>" />                       
					<input MaxLength="50" id="etparttime" name="etparttime" style="width:60px;" type="text" value="<?php echo $earr[1]; ?>" />
				</td>
			</tr>
		</table>
            
		<input id="timezone" name="timezone" type="hidden" value="" /> 
		<?php } ?>
		
		<?php if($generique == "on") { ?>
		
			<input id="stpartdate" name="stpartdate" type="hidden" value="<?php echo $sarr[0]; ?>" />                       
			<input id="stparttime" name="stparttime" type="hidden" value="<?php echo $sarr[1]; ?>" />
			<input id="etpartdate" name="etpartdate" type="hidden" value="<?php echo $earr[0]; ?>" />                       
			<input id="etparttime" name="etparttime" type="hidden" value="<?php echo $earr[1]; ?>" />
		
		<?php } ?>
		
			<table width="100%">
				<tr>
					<td class="align-center" width="50%">
						<label for="IDmat">
							<select id="IDmat" name="IDmat">
								<option value=""></option>
							<?php
								// recherche des matières enseignées
								$query  = "select _IDmat from user_id ";
								$query .= "where _ID = '$IDuser' ";
								$query .= "limit 1";

								$result = mysql_query($query, $mysql_link);
								$myrow  = ( $result ) ? mysql_fetch_row($result) : 0 ;

								$list   = explode(" ", trim($myrow[0]));

								// affichage des matières
								$query  = "select _IDmat, _titre from campus_data ";
								$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
								$query .= "order by _titre";

								$result = mysql_query($query, $mysql_link);
								$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

								while ( $row ) {
									$select = ( $IDmat == $row[0] ) ? "selected=\"selected\"" : "" ;

									if ( !strlen(trim($myrow[0])) OR in_array($row[0], $list) )
										print("<option value=\"$row[0]\" $select>$row[1]</option>");

									$row = remove_magic_quotes(mysql_fetch_row($result));
									}				
							?>
							</select> <img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/donneravis.gif" title="" alt="" />
						</label>
					</td>
					<td class="align-center" width="50%">
						<style>
						#add_class {
							font-size: 12px;
							font-weight: bold;
							margin-left: -145px;
						}
						
						#add_class:hover {
							cursor: pointer;
						}
						
						</style>
						<div id="div_class">
						</div>
						<div id="add_class" />Plus</div>
						
						<?php
						
						// traitement classes multiples
						$num_class = 0;
						$string_class = substr($IDclass, 1, strlen($IDclass)-2);
						$string_class = @split(";", $string_class);
						
						foreach($string_class as $key => $val)
						{
							$js_class = "<option value=\"\"></option>";

							$query  = "select _IDclass, _ident from campus_classe ";
							$query .= "where _visible = 'O' ";
							$query .= "order by _text";

							$result = mysql_query($query, $mysql_link);
							$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

							while ( $row ) {			
								if ( $val == $row[0] )
									$js_class .= "<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>";
								else
									$js_class .= "<option value=\"$row[0]\">$row[1]</option>";

								$row = remove_magic_quotes(mysql_fetch_row($result));
								}				

							$js_class .= "</select><img src=\"".$_SESSION["ROOTDIR"]."/images/campus.png\" title=\"\" alt=\"\" /></label>";
							?>
							
							<script>
							num_class = <?php echo $num_class; ?>;
							$("#div_class").append('<label for="IDclass_'+num_class+'"><select id="IDclass_'+num_class+'" name="IDclass_'+num_class+'"><?php echo $js_class; ?>');
							num_class++;
							</script>
							
							<?php
							$num_class++;
						}
						?>

						<script>						
						$("#add_class").click(function() {
							$("#div_class").append('<label for="IDclass_'+num_class+'"><select id="IDclass_'+num_class+'" name="IDclass_'+num_class+'"><?php echo $js_class; ?>');
							num_class++;
						});
						</script>
					</td>
				</tr>
			</table>
			
			<hr />
			
			<center>
			<?php		
				if ( $IDedt != 2 )
				{
					print("
						<select id=\"IDuser\" name=\"IDuser\">
							<option value=\"0\">&nbsp;</option>
						");

						$query  = "select distinctrow _ID, _name, _fname ";
						$query .= "from user_id, user_group ";
						$query .= "where user_id._adm AND user_id._IDcentre = '$IDcentre' ";
						$query .= "AND user_group._IDcat = '2' ";
						$query .= "AND user_id._IDgrp = user_group._IDgrp ";
						$query .= "order by _name";

						$result = mysql_query($query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						while ( $row ) {			
							$select = ( $IDuser == $row[0] ) ? "selected=\"selected\"" : "" ;

							print("<option value=\"$row[0]\" $select>$row[1] $row[2]</option>");

							$row = remove_magic_quotes(mysql_fetch_row($result));
							}
						
					print("
						</select> <img src=\"".$_SESSION["ROOTDIR"]."/images/whosonline.gif\" title=\"\" alt=\"\" />
						");
				}
				else
				{
					print("
						<select id=\"IDuser\" name=\"IDuser\">
							<option value=\"0\">&nbsp;</option>
						");

						$query  = "select distinctrow _ID, _name, _fname ";
						$query .= "from user_id, user_group ";
						$query .= "where user_id._adm AND user_id._IDcentre = '$IDcentre' ";
						$query .= "AND user_group._IDcat = '2' ";
						$query .= "AND user_id._IDgrp = user_group._IDgrp ";
						$query .= "order by _name";

						$result = mysql_query($query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						while ( $row ) {			
							$select = ( $IDuser == $row[0] ) ? "selected=\"selected\"" : "" ;

							print("<option value=\"$row[0]\" $select>$row[1] $row[2]</option>");

							$row = remove_magic_quotes(mysql_fetch_row($result));
							}
						
					print("
						</select> <img src=\"".$_SESSION["ROOTDIR"]."/images/whosonline.gif\" title=\"\" alt=\"\" />
						");
				}

				if ( $IDedt != 1 )
				{
					print("
						<select id=\"IDitem\" name=\"IDitem\">
							<option value=\"0\">&nbsp;</option>
						");

						$query  = "select _IDitem, _title from edt_items ";
						$query .= "where _IDcentre = '$IDcentre' ";
						$query .= "AND _lang = '".$_SESSION["lang"]."' ";

						$result = mysql_query($query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						while ( $row ) {			
							$select = ( $IDitem == $row[0] ) ? "selected=\"selected\"" : "" ;

							print("<option value=\"$row[0]\" $select>$row[1]</option>");

							$row = remove_magic_quotes(mysql_fetch_row($result));
							}
						
					print("
						</select> <img src=\"".$_SESSION["ROOTDIR"]."/images/home.gif\" title=\"\" alt=\"\" />
						");
				}
				else
				{
					print("
						<select id=\"IDitem\" name=\"IDitem\">
							<option value=\"0\">&nbsp;</option>
						");

						$query  = "select _IDitem, _title from edt_items ";
						$query .= "where _IDcentre = '$IDcentre' ";
						$query .= "AND _lang = '".$_SESSION["lang"]."' ";

						$result = mysql_query($query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						while ( $row ) {			
							$select = ( $IDitem == $row[0] ) ? "selected=\"selected\"" : "" ;

							print("<option value=\"$row[0]\" $select>$row[1]</option>");

							$row = remove_magic_quotes(mysql_fetch_row($result));
							}
						
					print("
						</select> <img src=\"".$_SESSION["ROOTDIR"]."/images/home.gif\" title=\"\" alt=\"\" />
						");
				}
			?>

			<select id="idgroup" name="idgroup">
				<option value="0">&nbsp;</option>
			<?php
				// recherche du groupe classe
				for ($i = 1; $i < 3; $i++)
					if ( $idgroup == $i )
						print("<option selected=\"selected\" value=\"$i\">$i</option>");
					else
						print("<option value=\"$i\">$i</option>");
			?>
			</select> <img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/group.gif" title="" alt="" />
						
			<?php if($generique == "on") { ?>
				<select id="idweek" name="idweek">
					<option value="0">&nbsp;</option>
				<?php
					// recherche de la semaine
					$Query  = "select _IDweek, _ident from edt_week ";
					$Query .= "where _lang = '".$_SESSION["lang"]."' ";
					$Query .= "order by _IDweek" ;

					$result = mysql_query($Query, $mysql_link);
					$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

					while ( $row ) {
						if ( $idweek == $row[0] )
							print("<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>");
						else
							print("<option value=\"$row[0]\">$row[1]</option>");

						$row = remove_magic_quotes(mysql_fetch_row($result));
						}
				?>
				</select> <img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/agenda.gif" title="" alt="" />
			<?php } ?>
			</center>
			
			<?php if($generique == "off") { ?>
			<hr />
			
			<div id="newline-wrapper">
				<table class="split-date-wrap" cellpadding="0" cellspacing="0" border="0" class="align-center">
				  <tbody>
					<tr>
					  <td><input type="text" class="format-m-d-y divider-slash" id="date-1" name="date-1" value="" maxlength="4" /></td>
					  <td> </td>
					</tr>
				  </tbody>
				</table>
			</div>

			<?php } ?>
			
			</div>
			
			<table width="100%">
				<tr>
					<td class="align-right" width="75%">
						<!--<button class="btn btn-danger" onclick="javascript: CloseModelWindow(null,true);"><?php //echo $msg->read($EDT_INPUTCANCEL); ?></button>-->
					</td>
					<td class="align-left" width="25%" style="padding-left: 10px">
						<button class="btn btn-success" type="submit" name="submit"><?php echo $msg->read($EDT_INPUTOK); ?></button>
					</td>
				</tr>
			</table>
			
        </form>      
      </div>         
    </div>
  </body>
</html>