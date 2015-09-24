<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2008 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by Hugues Lecocq(hugues.lecocq@laposte.net)
   Copyright (c) 2006 by Nordine Zetoutou (nordine.zetoutou@educagri.fr)

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
 *		module   : gallery.php
 *		projet   : la page des galeries d'images
 *
 *		version  : 1.5
 *		auteur   : laporte
 *		creation : 2/07/03
 *		modif    : 15/06/06 - par hugues lecocq
 *                     migration PHP5 
 *		           17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$IDgal = ( strlen(@$_POST["IDgal"]) )		// identifiant des galeries
	? (int) $_POST["IDgal"]
	: (int) @$_GET["IDgal"] ;
$IDroot  = ( @$_POST["IDroot"] )			// ID répertoire racine
	? (int) $_POST["IDroot"]
	: (int) @$_GET["IDroot"] ;
$IDdata   = ( @$_POST["IDdata"] )			// identifiant des répertoires des items des galeries
	? (int) $_POST["IDdata"]
	: (int) @$_GET["IDdata"] ;
$IDident = ( @$_POST["IDident"] )			// 
	? $_POST["IDident"]
	: @$_GET["IDident"] ; 
$ident   = ( @$_POST["ident"] )			// 
	? $_POST["ident"]
	: @$_GET["ident"] ;
$mysort  = ( strlen(@$_POST["mysort"]) )		// filtre du tri
	? (int) $_POST["mysort"]
	: (int) (strlen(@$_GET["mysort"]) ? $_GET["mysort"] : -1);
$mvitem  = @$_POST["mvitem"];				// liste des galeries à déplacer
$cpitem  = @$_POST["cpitem"];				// liste des galeries à copier

$skpage  = ( @$_GET["skpage"] )			// n° de la page affichée
	? (int) $_GET["skpage"]
	: 1 ;
$skshow  = ( @$_GET["skshow"] )			// n° du flash info
	? (int) $_GET["skshow"]
	: 1 ;

$submit = ( @$_POST["submit"] )			// bouton de validation
	? $_POST["submit"]
	: @$_GET["submit"] ;
?>


<?php
	// actions sur les galeries
	if ( @$_POST["move_x"] )
		$submit = "moveDir";
	if ( @$_POST["copy_x"] )
		$submit = "copyDir";
	if ( @$_POST["del_x"] )
		$submit = "delete";

	// commandes utilisateur
	switch ( $submit ) {
		case "erase" :	// on efface le thème
			$Query  = "delete from gallery ";
			$Query .= "where _IDgal = '$IDgal' " ;
			$Query .= "AND _lang = '".$_SESSION["lang"]."' " ;
			$Query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND _IDmod = '".$_SESSION["CnxID"]."' ";

			if ( !mysql_query($Query, $mysql_link) ) {
				mysql_error($mysql_link);
				break;
				}

		case "delete" :	// on efface la galerie
			$cb = @$_POST["cbitem"];

			for ($i = 0; $i < count($cb); $i++) {
				$Query  = "delete from gallery_data ";
				$Query .= "where _IDdata = '$cb[$i]' " ;
				$Query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND _IDmod = '".$_SESSION["CnxID"]."' ";
				$Query .= "limit 1" ;

				if ( !mysql_query($Query, $mysql_link) )
					mysql_error($mysql_link);
				else {
					// et on efface les images associées
					$Query  = "select _file from gallery_items ";
					$Query .= "where _IDdata = '$cb[$i]' " ;

					$result = mysql_query($query, $mysql_link);
					$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

					while ( $row ) {			
						unlink("$DOWNLOAD/galerie/".$cb[$i]."/vignettes/$row[0]");
						unlink("$DOWNLOAD/galerie/".$cb[$i]."/$row[0]");

						$row = mysql_fetch_row($result);
						}	// endwhile $row

					// puis la galerie
					$Query  = "delete from gallery_items ";
					$Query .= "where _IDdata = '$cb[$i]' " ;

					if ( mysql_query($Query, $mysql_link) ) {
						rmdir("$DOWNLOAD/galerie/".$cb[$i]."/vignettes");
						rmdir("$DOWNLOAD/galerie/".$cb[$i]);
						}
					else
						mysql_error($mysql_link);
					}
				}
			break;

		case "deldir" :	// on efface le répertoire
			$query  = "delete from gallery_root ";
			$query .= "where _IDroot = '".@$_GET["mydir"]."' ";
			$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND _ID = '".$_SESSION["CnxID"]."' ";
			$query .= "limit 1";

			mysql_query($query, $mysql_link);
			break;

		default :
			// copie ou déplacement dans répertoire
			$page_cmde = @$_POST["page_cmde"];

			if ( $page_cmde == $msg->read($GALLERY_COPY) OR $page_cmde == $msg->read($GALLERY_MOVE) ) {
				$date = date("Y-m-d H:i:s");
				$dir  = (int) @$_POST["newdir"] ;
				$cbi  = @$_POST["cbitem"];

				for ($i = 0; $i < count($cbi) AND $dir != -1; $i++) {
					// ajout dans la base de données
					$result = mysql_query("select * from gallery_data where _IDdata = '$cbi[$i]' limit 1", $mysql_link);
					$myrow  = ( $result ) ? mysql_fetch_row($result) : 0 ;

					$Query  = "insert into gallery_data ";
					$Query .= "values('', '$myrow[1]', '$dir', '$myrow[3]', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$myrow[6]', '$myrow[7]', '$date', '$myrow[9]', '$myrow[10]', '$myrow[11]', '$myrow[12]', '$myrow[13]', '$myrow[14]', '$myrow[15]', '$myrow[16]')";

					$iddata = ( mysql_query($Query) ) ? mysql_insert_id() : 0 ;

					// lecture des images
					$result = mysql_query("select * from gallery_items where _IDdata = '$myrow[0]' limit 1", $mysql_link);
					$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

					while ( $row AND $iddata ) {
						// ajout dans la base de données
						$Query  = "insert into gallery_items ";
						$Query .= "values('', '$iddata', '".$_SESSION["CnxIP"]."', '".$_SESSION["CnxID"]."', '$date', '$row[5]', '$row[6]', '$row[7]', '$row[8]', '0', '$row[10]', '$row[11]', '$row[12]')";

						if ( mysql_query($Query) ) {
							mymkdir("$DOWNLOAD/galerie/$iddata", $CHMOD);
							mymkdir("$DOWNLOAD/galerie/$iddata/vignettes", $CHMOD);

							copy("$DOWNLOAD/galerie/$row[1]/$row[5]", "$DOWNLOAD/galerie/$iddata/$row[5]");
							copy("$DOWNLOAD/galerie/$row[1]/vignettes/$row[5]", "$DOWNLOAD/galerie/$iddata/vignettes/$row[5]");
							}

						// si on déplace => suppression ancien fichier
						if ( $page_cmde == $msg->read($GALLERY_MOVE) )
							if ( mysql_query("delete from gallery_items where _IDitem = '$row[0]'", $mysql_link) ) {
								unlink("$DOWNLOAD/galerie/$row[1]/$row[5]");
								unlink("$DOWNLOAD/galerie/$row[1]/vignettes/$row[5]");
								}

						$row    = mysql_fetch_row($result);
						}

					// si on déplace => suppression ancien fichier
					if ( $page_cmde == $msg->read($GALLERY_MOVE) )
						if ( mysql_query("delete from gallery_data where _IDdata = '$cbi[$i]' limit 1", $mysql_link) ) {
							rmdir("$DOWNLOAD/galerie/".$cbi[$i]."/vignettes");
							rmdir("$DOWNLOAD/galerie/".$cbi[$i]);
							}
					}
				}
			break;
		}
?>


<div class="maincontent">

<?php
	if ( $IDgal ) {
		$query  = "select _texte, _IDmod, _IDgrpwr, _IDgrprd from gallery ";
		$query .= "where _IDgal = '$IDgal' AND _lang = '".$_SESSION["lang"]."' limit 1";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

         	if ( $row[0] )
         		print("<div style=\"background-color:#eeeeee;\">$row[0]</div>");
		}

	$IDmod = ( $IDgal ) ? @$row[1] : 0 ;
	$grpwr = ( $IDgal ) ? @$row[2] : 0 ;
	$grprd = ( $IDgal ) ? @$row[3] : 0 ;
?>

	<form id="formulaire" action="index.php" method="post">
	<?php
		print("
			<p class=\"hidden\"><input type=\"hidden\" name=\"item\"    value=\"$item\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"    value=\"$cmde\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"IDroot\"  value=\"$IDroot\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"IDgal\"   value=\"$IDgal\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"IDgroup\" value=\"$IDgroup\" /></p>
			");
	?>

		<hr style="width:80%;" />

		<table class="width100">
		  <tr>
		    <td style="width:50%;" class="align-right valign-middle">
		    	<?php print($msg->read($GALLERY_CHOOSETHEME)); ?>
		    </td>
		    <td style="width:50%;">
			<?php
				$t_add = $msg->read($GALLERY_NEWTHEME);
				$t_maj = $msg->read($GALLERY_UPDTHEME);

				if ( $IDgroup )
					$add = $del = $maj = "";
				else {
					// seul l'administrateur peut créer un thème
					$add   = ( $_SESSION["CnxAdm"] == 255 )
						? "<a href=\"index.php?item=$item&amp;cmde=theme\"><img src=\"".$_SESSION["ROOTDIR"]."/images/ajouter.gif\" title=\"$t_add\" alt=\"$t_add\" /></a>"
						: "<img src=\"".$_SESSION["ROOTDIR"]."/images/gallery.gif\" title=\"\" alt=\"\" />" ;

					// seuls l'administrateur et le modérateur peuvent modifier ou supprimer un thème
					$req   = $msg->read($GALLERY_DELTHEME);
					$del   = ( ($_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $row[1]) AND $IDgal )
						? "<a href=\"index.php?item=$item&amp;IDgal=$IDgal&amp;submit=erase\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"$req\" alt=\"$req\" /></a>"
						: "" ;

					$maj   = ( ($_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $row[1]) AND $IDgal )
						? "<a href=\"index.php?item=$item&amp;IDgal=$IDgal&amp;cmde=theme\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"$t_maj\" alt=\"$t_maj\" /></a>"
						: "" ;
					}

		         	print("
					<label for=\"IDgal\">
					<select id=\"IDgal\" name=\"IDgal\" onchange=\"document.forms.formulaire.submit()\">
					  <option value=\"0\">". $msg->read($GALLERY_ALLTHEME) ."</option>
					");

				// affichage des thèmes
				$query  = "select _IDgal, _title, _sort from gallery ";
				$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
				$query .= ( (int) @$_SESSION["egroup"] > 0 )
					? "AND _IDgal = '3' " 
					: (@$_SESSION["CampusName"] ? "AND _IDgal = '2' " : "") ;
				$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND (_IDgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).") ";
				$query .= "order by _title";

				$result = mysql_query($query, $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				// initialisation
				if ( !$IDgal AND mysql_affected_rows($mysql_link) == 1 )
					$IDgal = (int) $row[0];

				$sort = (int) $row[2];

				while ( $row ) {			
					if ( $IDgal == $row[0] ) {
						$sort = (int) $row[2];
						print("<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>");
						}
					else
						print("<option value=\"$row[0]\">$row[1]</option>");

					$row = remove_magic_quotes(mysql_fetch_row($result));
					}	// endwhile catégorie

		         	print("</select> $del $maj $add");
		         	print("</label>");
			?>
		    </td>
		  </tr>
		</table>

		<hr style="width:80%;" />

	<?php
		switch ( $submit ) {
			case "moveDir" :	// déplacement dans répertoire
			case "copyDir" :	// copie dans répertoire
				$value   = ( $submit == "moveDir" ) ? $msg->read($GALLERY_MOVE) : $msg->read($GALLERY_COPY) ;
				$cbi     = ( $submit == "moveDir" ) ? @$_POST["mvitem"] : @$_POST["cpitem"] ;

				$query  = "select _IDroot, _titre from gallery_root ";
				$query .= "where _IDgal = '$IDgal' AND _IDparent = '$IDroot' ";
				$query .= "order by _titre";

				$result = mysql_query($query, $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				$select  = "<label for=\"newdir\" >" ;
				$select .= "<select id=\"newdir\" name=\"newdir\" style=\"font-size:9px;\" >" ;
				$select .= ( $IDroot ) ? "<option value=\"0\">..</option>" : "<option value=\"-1\">.</option>" ;

				while ( $row ) {			
					$select .= "<option value=\"$row[0]\">$row[1]</option>";

					$row = remove_magic_quotes(mysql_fetch_row($result));
					}				

				$select .= "</select>";
				$select .= "</label>";

				for ($i = 0; $i < count($cbi); $i++)
					print("<p class=\"hidden\"><input type=\"hidden\" name=\"cbitem[]\" value=\"$cbi[$i]\" /></p>");

				print("
					<p style=\"margin:0px;\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/mvcopy.gif\" title=\"\" alt=\"\" />
						". $msg->read($GALLERY_SELECTION, $value) ." $select
						<input type=\"submit\" name=\"page_cmde\" value=\"$value\" style=\"font-size: 9px;\" />
						". $msg->read($GALLERY_OR) ."
						<input type=\"submit\" value=\"".$msg->read($GALLERY_INPUTCANCEL)."\" name=\"page_cancel\" style=\"font-size: 9px;\" />
					</p>
					");
				break;

			default :
				if ( $IDgal ) {
			         	// seul le big chef ou le modérateur
					// peuvent créer un dossier
			         	$add    = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $IDmod )
						? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDparent=$IDroot&cmde=newdir")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/folder-new.gif\" title=\"". $msg->read($GALLERY_CREATDIR) ."\" alt=\"". $msg->read($GALLERY_CREATDIR) ."\" /></a>"
						: "" ;

					$result = mysql_query("select _titre, _IDparent from gallery_root where _IDroot = '$IDroot' limit 1", $mysql_link);
					$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

					$mydir  = ( $row ) ? $row[0] : $msg->read($GALLERY_ROOTDIR) ;

					if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $IDmod OR $grpwr & pow(2, $_SESSION["CnxGrp"] - 1) )
				    		print("
					            <table class=\"width100\">
					              <tr>
					                <td style=\"width:10%;\" class=\"valign-middle\">
								<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDroot=$IDroot&cmde=new")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/post.gif\" title=\"". $msg->read($GALLERY_ADDGALLERY) ."\" alt=\"". $msg->read($GALLERY_ADDGALLERY) ."\" /></a>
						          </td>
						          <td style=\"width:40%;\" class=\"valign-middle\">". $msg->read($GALLERY_ADDGALLERY) ."</td>
						          <td class=\"valign-middle align-right\">[$add $mydir ]</td>
					              </tr>
					            </table>
					            ");
					}
				else {
					$IDroot = 0;
					$mysort = 1;
					}
				break;
				}

		// affichage filtrer
		$list    = explode("|", $msg->read($GALLERY_SORTFILTER));

		$select  = "<label for=\"mysort\">";
		$select .= "<select id=\"mysort\" name=\"mysort\" onchange=\"document.forms.formulaire.submit()\" style=\"font-size:9px;\">";
		$select .= "<option value=\"-1\">". $msg->read($GALLERY_SCREENING) ."</option>";
		for ($i = 0; $i < count($list); $i++)
			$select .= ( $mysort == $i )
				? "<option value=\"$i\" selected=\"selected\">$list[$i]</option>"
				: "<option value=\"$i\">$list[$i]</option>" ;
		$select .= "</select>";
		$select .= "</label>";
	?>

            <table class="width100">
              <tr style="background-color:#c0c0c0;">
                <td colspan="2" style="width:50%;"><?php print($msg->read($GALLERY_GALLERY) ." ". $select); ?></td>
	<?php
		// barre d'outils
	      if ( $_SESSION["CnxAdm"] == 255 )
			print("
	                <td style=\"width:1%;\" class=\"align-center\"><input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" name=\"del\" title=\"".$msg->read($GALLERY_ERASE)."\" alt=\"".$msg->read($GALLERY_ERASE)."\" /></td>
	                <td style=\"width:1%;\" class=\"align-center\"><input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/mv.gif\"   name=\"move\" title=\"".$msg->read($GALLERY_MOVE)."\" alt=\"".$msg->read($GALLERY_MOVE)."\" /></td>
	                <td style=\"width:1%;\" class=\"align-center\"><input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/add.gif\"  name=\"copy\" title=\"".$msg->read($GALLERY_COPY)."\" alt=\"".$msg->read($GALLERY_COPY)."\" /></td>");
	      else
			print("
	                <td style=\"width:1%;\" class=\"align-center\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"\" alt=\"*\" /></td>
	                <td style=\"width:1%;\" class=\"align-center\"><img src=\"".$_SESSION["ROOTDIR"]."/images/mv.gif\"   title=\"\" alt=\"*\" /></td>
	                <td style=\"width:1%;\" class=\"align-center\"><img src=\"".$_SESSION["ROOTDIR"]."/images/add.gif\"  title=\"\" alt=\"*\" /></td>");
	?>
                <td class="align-center" style="width:18%"><?php print($msg->read($GALLERY_AUTHOR)); ?></td>
                <td class="align-center" style="width:18%;"><?php print($msg->read($GALLERY_CREATBY)); ?></td>
                <td class="align-center" style="width:11%"><?php print($msg->read($GALLERY_IMAGES)); ?></td>
              </tr>

	<?php
		require_once "include/user.php";

		$acl = new user_acl("gallery");

		// accès au répertoire parent
         	if ( $IDroot )
			print("
				<tr>
   			        <td style=\"width:1%;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/folder-up.gif\" title=\"\" alt=\"..\" /></td>
     		    		  <td class=\"align-left\" style=\"width:49%;\">
					<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDroot=$row[1]")."\">". $msg->read($GALLERY_PARENTDIR) ."</a>
     		    		  </td>
     		    		  <td colspan=\"3\"></td>
				</tr>
				");

		//---- lecture des répertoires ----
		$Query  = "select _IDroot, _titre, _IDmod, _IDgrprd, _visible, _IDparent, _IP, _date from gallery_root ";
		$Query .= "where _IDparent = '$IDroot' AND _IDgal = '$IDgal' " ;
		$Query .= "AND _IDgroup = '$IDgroup' " ;

		$switch = ( $mysort == -1 )
			? (int) ($sort / 100)
			: $mysort ;

		switch ( $switch ) {
			case 1 :
				$Query .= "order by _IDroot desc";
				break;
			case 2 :
				$Query .= "order by _titre asc";
				break;
			case 3 :
				$Query .= "order by _titre desc";
				break;
			default :
				$Query .= "order by _IDroot asc";
				break;
			}

		$result = ( $skpage == 1 ) ? mysql_query($Query, $mysql_link) : 0 ;
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		$i = 0;
		while ( $row ) {
			// accès protégé en lecture
			if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $row[2] OR ($row[3] & pow(2, $_SESSION["CnxGrp"] - 1) AND $row[4] == "O") ) {
				$bgcol  = ( $i++ % 2 ) ? "item" : "menu" ;

				// détermination du nombre de répertoires
				$return = mysql_query("select _IDroot from gallery_root where _IDgal = '$IDgal' AND _IDparent = '$row[0]' AND _IDgroup = '$IDgroup'", $mysql_link);
				$nbr    = ( $return ) ? mysql_affected_rows($mysql_link) : 0 ;

				$msg->isPlural = (bool) ( $nbr > 1 );
				$text   = "(" . $msg->read($GALLERY_NBDIR, strval($nbr)) .", ";

				// détermination du nombre de documents
				$return = mysql_query("select _IDdata from gallery_data where _IDgal = '$IDgal' AND _IDroot = '$row[0]' AND _IDgroup = '$IDgroup'", $mysql_link);
				$nbd    = ( $return ) ? mysql_affected_rows($mysql_link) : 0 ;

				$msg->isPlural = (bool) ( $nbd > 1 );
				$text  .= $msg->read($GALLERY_NBDOC, strval($nbd)) .")";

				$file   = ( $row[4] == "O" ) ? "folder-closed.gif" : "folder-lock.jpg" ;
				$link   = "<a href=\"". myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDroot=$row[0]")."\">$row[1]</a>";

				// suppression du répertoire
				$req   = $msg->read($GALLERY_DELGALLERY, $row[1]);
				$del   = ( !$nbr AND !$nbd AND ($_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $row[2]) )
					? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDroot=$IDroot&mydir=$row[0]&submit=deldir")."\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"$req\" alt=\"$req\" /></a>"
					: "" ;

				// modification du répertoire
				$maj   = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $row[2] )
					? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDroot=$row[0]&IDparent=$IDroot&cmde=newdir")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"". $msg->read($GALLERY_MODIFY) ."\" alt=\"". $msg->read($GALLERY_MODIFY) ."\" /></a>"
					: "" ;

				print("
					<tr class=\"$bgcol\">
					  <td style=\"width:1%;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/$file\" title=\"\" alt=\"\" /></td>
      		    		  <td style=\"width:49%;\">
     		    		  		$link $maj $del<br/>
      		    		  	<span class=\"x-small\">$text</span>
      		    		  </td>
					  <td></td>
					  <td></td>
					  <td></td>
		       		  <td class=\"x-small align-center\">". getUserName($row[2]) ."<br/>". _getHostName($row[6]) ."</td>
					  <td class=\"x-small align-center\">". date2longfmt($row[7]) ."</td>
					  <td class=\"align-center\">X</td>
					</tr>
					");
				}

			$row = remove_magic_quotes(mysql_fetch_row($result));
			}

		//---- lecture de la base de données ----
		$Query  = "select _IDdata, _IDmod, _date, _title, _visible, _IDgal, _private, _IP, _IDroot from gallery_data ";
		$Query .= "where _IDgroup = '$IDgroup' " ;
		$Query .= ( $IDgal OR $IDroot ) ? "AND _IDroot = '$IDroot' " : "" ;
		$Query .= ( $IDgal ) ? "AND _IDgal = '$IDgal' " : "" ;
		$Query .= ( $_SESSION["CnxAdm"] != 255 )
			? "AND (_IDmod = '".$_SESSION["CnxID"]."' OR (_visible = 'O' AND (_IDgrprd & ". pow(2, $_SESSION["CnxGrp"] - 1) ."))) "
			: "" ;

		$switch = ( $mysort == -1 )
			?  $sort - ($switch * 100)
			: $mysort ;

		switch ( $switch ) {
			case 1 :
				$Query .= "order by _IDdata desc";
				break;
			case 2 :
				$Query .= "order by _title asc";
				break;
			case 3 :
				$Query .= "order by _title desc";
				break;
			default :
				$Query .= "order by _IDdata asc";
				break;
			}

		// détermination du nombre de pages
		$result = mysql_query($Query, $mysql_link);
		$nbelem = ( $result ) ? mysql_affected_rows($mysql_link) : 0 ;

		$page  = $nbelem;
		$show  = 1;

		if ( $nbelem ) {
			$page  = ( $page % $MAXPAGE )
				? (int) ($page / $MAXPAGE) + 1
				: (int) ($page / $MAXPAGE) ;

			$show  = ( $page % $MAXSHOW )
				? (int) ($page / $MAXSHOW) + 1
				: (int) ($page / $MAXSHOW) ;

			// initialisation
			$i     = 1; $j = 0;
			$first = 1 + (($skpage - 1) * $MAXPAGE);
			$pos   = $first;

			// se positionne sur la page ad hoc
			mysql_data_seek($result, $first - 1);
			$row = remove_magic_quotes(mysql_fetch_row($result));

			while ( $row AND $i <= $MAXPAGE ) {
				$bgcol  = ( $i++ % 2 ) ? "item" : "menu" ;

				// lecture de la base de données des PJ
				$Query  = "select _IDpj from gallery_pj ";
				$Query .= "where _IDdata = '$row[0]' ";
				$Query .= "limit 1";

				@mysql_query($Query, $mysql_link);

		         	$pj  = ( mysql_affected_rows($mysql_link) )
					? "<img src=\"".$_SESSION["ROOTDIR"]."/images\pj.gif\" title=\"\" alt=\"\" />"
					: "" ;

				// visualisation des galeries fermées
				$img = ( $row[4] == "O" ) ? "file.gif" : "lock.gif" ;

				// la galerie est-elle privée ?
				if ( $row[6] == "O" ) {
					$priv = ( $_SESSION["CnxAdm"] == 255 OR $row[1] == $_SESSION["CnxID"] )
						? "<a href=\"".myurlencode("index.php?item=1&cmde=acl&ident=gallery&IDident=$row[0]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/invisible.gif\" title=\"". $msg->read($GALLERY_PRIVATE) ."\" alt=\"". $msg->read($GALLERY_PRIVATE) ."\" /></a>"
						: "<img src=\"".$_SESSION["ROOTDIR"]."/images/invisible.gif\" title=\"". $msg->read($GALLERY_PRIVATE) ."\" alt=\"". $msg->read($GALLERY_PRIVATE) ."\" />" ;
					$link = ( $_SESSION["CnxAdm"] == 255 OR $acl->isMember($row[0], $_SESSION["CnxID"]) )
						? "<a href=\"".myurlencode("index.php?item=$item&cmde=visu&IDgroup=$IDgroup&IDgal=$row[5]&IDroot=$row[8]&IDdata=$row[0]")."\">$row[3]</a>"
						: $row[3] ;
					}
				else {
					$priv = "";
					$link = "<a href=\"".myurlencode("index.php?item=$item&cmde=visu&IDgroup=$IDgroup&IDgal=$row[5]&IDdata=$row[0]")."\">$row[3]</a>";
					}

				// modification des galeries
				$maj = ( $_SESSION["CnxAdm"] == 255 OR $row[1] == $_SESSION["CnxID"] )
					? "<a href=\"".myurlencode("index.php?item=$item&cmde=new&IDgroup=$IDgroup&IDgal=$row[5]&IDdata=$row[0]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"". $msg->read($GALLERY_UPDTGALLERY) ."\" alt=\"". $msg->read($GALLERY_UPDTGALLERY) ."\" /></a>"
					: "" ;

				// pour savoir le nombre total d'images visualisables
				$res = mysql_query("select _IDitem from gallery_items where _IDdata = '$row[0]' AND _visible = 'O'", $mysql_link);
				$tot = ( $res ) ? mysql_numrows($res) : 0 ;				

				// backoffice pour paramétrage des droits
				$back = ( $_SESSION["CnxAdm"] == 255 OR $row[1] == $_SESSION["CnxID"] )
					? "<a href=\"".myurlencode("index.php?item=$item&cmde=gestion&IDgroup=$IDgroup&IDgal=$row[5]&IDdata=$row[0]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/tools.gif\" title=\"". $msg->read($GALLERY_MGMTGALLERY) ."\" alt=\"". $msg->read($GALLERY_MGMTGALLERY) ."\" /></a>" 
					: "" ;

				// lecture du thème associé
				$return = mysql_query("select _title from gallery where _IDgal = '$row[5]' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
				$theme  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

				// suppression galerie
				$enable = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $row[1] ) ? "" : "disabled=\"disabled\"" ;
				$delete = "<label for=\"cbitem_$row[0]\"><input type=\"checkbox\" id=\"cbitem_$row[0]\" name=\"cbitem[]\" value=\"$row[0]\" $enable /></label>";

				// déplacement galerie
				$enable = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $row[1] ) ? "" : "disabled=\"disabled\"" ;
				$check  = ( $submit == "moveDir" AND @$mvitem[$j] == $row[0] ) ? "checked=\"checked\"" : "" ;
				$move   = "<label for=\"mvitem_$row[0]\"><input type=\"checkbox\" id=\"mvitem_$row[0]\" name=\"mvitem[]\" value=\"$row[0]\" $enable $check /></label>";

				// copie galerie
				$enable = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $row[1] ) ? "" : "disabled=\"disabled\"" ;
				$check  = ( $submit == "copyDir" AND @$cpitem[$j] == $row[0] ) ? "checked=\"checked\"" : "" ;
				$copy   = "<label for=\"cpitem_$row[0]\"><input type=\"checkbox\" id=\"cpitem_$row[0]\" name=\"cpitem[]\" value=\"$row[0]\" $enable $check /></label>";

				print("            
					<tr class=\"$bgcol\">
       				  <td style=\"width:1%;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/$img\" title=\"$img\" alt=\"$img\" /></td>
          		    		  <td style=\"width:49%;\">
						$link $pj $priv $maj $back<br/>
						<span class=\"x-small\">". $msg->read($GALLERY_THEME) ." $theme[0]</span>
					  </td>
				        <td class=\"align-center\">$delete</td>
				        <td class=\"align-center\">$move</td>
				        <td class=\"align-center\">$copy</td>
		       		  <td class=\"x-small align-center\">". getUserName($row[1]) ."<br/>". _getHostName($row[7]) ."</td>
					  <td class=\"x-small align-center\">". date2longfmt($row[2]) ."</td>
					  <td class=\"align-center\">$tot</td>
	       		       </tr>
	       		       ");

				$j++;
				$row = remove_magic_quotes(mysql_fetch_row($result));
				}
			}
	?>

            </table>

	<?php
		// bouton précédent
		$where = $skshow - 1;
		if ( $skshow == 1 )
			$prev = "";
		else {
			$skpg = 1 + (($skshow - 2) * $MAXSHOW);
			$prev = "[<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDroot=$IDroot&mysort=$mysort&skpage=$skpg&skshow=$where")."\">". $msg->read($GALLERY_PREV) ."</a>]";
			}

		// liens directs sur n° de page
		$start = 1 + (($skshow - 1) * $MAXSHOW);
		$end   = $skshow * $MAXSHOW;

		$choix = ( $skpage == $start )
			? "<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_left.gif\" title=\"«\" alt=\"«\" /><strong>$start</strong><img src=\"".$_SESSION["ROOTDIR"]."/images/nav_right.gif\" title=\"»\" alt=\"»\" />"
			: "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDroot=$IDroot&mysort=$mysort&skpage=$start&skshow=$skshow")."\">$start</a>" ;

		for ($j = $start + 1; $j <= $end AND $j <= $page; $j++)
			$choix .= ( $skpage == $j )
				? "|<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_left.gif\" title=\"«\" alt=\"«\" /><strong>$j</strong><img src=\"".$_SESSION["ROOTDIR"]."/images/nav_right.gif\" title=\"»\" alt=\"»\" />"
				: "|<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDroot=$IDroot&mysort=$mysort&skpage=$j&skshow=$skshow")."\">$j</a>" ;

		// bouton suivant
		$where = $skshow + 1;
		$next  = ( $skshow == $show )
			? ""
			: "[<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDgal=$IDgal&IDroot=$IDroot&mysort=$mysort&skpage=$j&skshow=$where")."\">". $msg->read($GALLERY_NEXT) ."</a>]" ;
	?>

	<hr/>
		<?php if ( $nbelem ) print("<div style=\"text-align:center;\">$prev $choix $next</div>"); ?>
	<hr/>

	<!-- recherche d'un message dans les galeries -->
	<div>
	      <img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/search.gif" title="" alt="" />
		<?php print($msg->read($GALLERY_SEARCH, "index.php?item=91&amp;cmde=search&amp;IDgal=$IDgal&amp;rub=4")); ?>
	</div>

	</form>

</div>
