<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2004-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by Cyril Fresne (cyril.fresne@gmail.com)
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
 *		module   : forum_visu.php
 *		projet   : la page de visualisation du forum sélectionné
 *
 *		version  : 1.1
 *		auteur   : laporte
 *		creation : 14/03/04
 *		modif    : 15/06/06 - par cyril fresne
 *	                 migration PHP5
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$IDmsg    = ( @$_POST["IDmsg"] ) 		// ID du message
	? (int) $_POST["IDmsg"]
	: (int) @$_GET["IDmsg"] ;
$parentID = ( @$_POST["parentID"] ) 	// ID du message parent
	? (int) $_POST["parentID"]
	: (int) @$_GET["parentID"] ;
$nbelem   = ( @$_POST["nbelem"] ) 		// nombre de messages
	? (int) $_POST["nbelem"]
	: (int) @$_GET["nbelem"] ;
$pos      = ( @$_POST["pos"] ) 		// position du message dans la liste 
	? (int) $_POST["pos"]
	: (int) @$_GET["pos"] ;
$begin    = ( @$_POST["begin"] ) 		// date de début
	? (int) $_POST["begin"]
	: (int) @$_GET["begin"] ;

$skpage   = ( @$_GET["skpage"] )		// n° de la page affichée
	? (int) $_GET["skpage"]
	: 1 ;
$skshow   = ( @$_GET["skshow"] )		// n° du commentaire
	? (int) $_GET["skshow"]
	: 1 ;

$submit   = @$_GET["submit"];
?>


<?php
	//---------------------------------------------------------------------------
	function isNew($IDmsg, $date)
	{
		global $mysql_link;

		// pour indiquer les nouveaux messages (moins de 2 jours pour les Anonymes)
		if ( $_SESSION["CnxSex"] == "A" )
			return ( $date > date("Y-m-d H:i:s", (time() - $TIMEFORUM)) )
				? " <img src=\"".$_SESSION["ROOTDIR"]."/images/new.gif\" title=\"\" alt=\"\" />"
				: "" ;

		// lecture de la base de données
		$Query  = "select _IP from forum_vu ";
		$Query .= "where _IDmsg = '$IDmsg' AND _ID = '".$_SESSION["CnxID"]."' ";
		$Query .= "limit 1";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		return ( $row )
			? ""
			: " <img src=\"".$_SESSION["ROOTDIR"]."/images/new.gif\" title=\"\" alt=\"\" />" ;
	}
	//---------------------------------------------------------------------------

	require_once "include/user.php";

	// pour les forums privés (gestion par ACL)
	$acl = new user_acl("forum");

	// lecture du droit de lecture
	$Query  = "select _IDgrprd, _private, _IDmod from forum_data ";
	$Query .= "where _IDforum = '$IDforum' ";
	$Query .= "limit 1";

	$result = mysql_query($Query, $mysql_link);
	$auth   = ( $result ) ? mysql_fetch_row($result) : 0 ;

	// vérification des autorisations
	verifySessionAccess($auth[2], $auth[0]);
?>


<div class="maincontent">

	<?php
	// seul le big chef OU le propriétaire du post
	// peuvent supprimer un post
	switch ( $submit ) {
		case "del" :	// on efface le post parent et les messages associés
			$parent = (int) @$_GET["parent"];
			$msgid  = (int) @$_GET["msgid"];

			$Query  = "delete from forum_items ";
			$Query .= "where (_IDmsg = '$msgid' OR _parent = '$msgid') ";
			$Query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND _ID = '".$_SESSION["CnxID"]."'";

			if ( !mysql_query($Query, $mysql_link) )
				mysql_error($mysql_link);
			else
				mysql_query("update forum_items set _post = _post - 1 where _IDmsg = '$parent'", $mysql_link);
			break;

		case "clear" :	// RAZ des visualisations
			if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $auth[2] ) {
				$Query  = "select _IDmsg from forum_items ";
				$Query .= "where _IDforum = '$IDforum' ";

				$return = mysql_query($Query, $mysql_link);
				$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;

				while ( $myrow ) {
					// RAZ du compteur des visualisations
					mysql_query("delete from forum_vu where _IDmsg = '$myrow[0]'", $mysql_link);

					$myrow = mysql_fetch_row($return);
					}
				}
			break;

		default :
			break;
		}

	// affichage de la description du forum
	if ( strlen($row[3]) )
        	print("<div style=\"background-color:#eeeeee;\">$row[3]</div>");
	?>

	<p style="margin-top:0px; margin-bottom:10px; text-align:justify">
	<?php print($msg->read($FORUM_ACCESSCHART, myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&cmde=charte"))); ?>
	</p>

	<table class="width100">
	  <tr>
		<td style="width:10%;" class="valign-middle">
		<?php
                  // vérification de l'accès en écriture
                  if ( $_SESSION["CnxAdm"] == 255 OR ($row[4] & pow(2, $_SESSION["CnxGrp"] - 1)) ) 
                  	print("
                  		<a href=\"".myurlencode("index.php?item=$item&cmde=post&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&IDmsg=0")."\">
                  		<img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/post.gif\" title=\"".$msg->read($FORUM_NEW)."\" alt=\"\" /></a>
                  		");
		?>
		</td>
		<td class="valign-middle">
		<?php 
                 	if ( $_SESSION["CnxAdm"] == 255 OR ($row[4] & pow(2, $_SESSION["CnxGrp"] - 1)) ) 
                 		print("". $msg->read($FORUM_NEWSUBJECT) ."");
		?>
		</td>
		<td class="valign-middle align-right">
			<?php print($msg->read($FORUM_NEXTPREV)); ?>
		</td>
	  </tr>
	</table>
            
	<table class="width100">
	<?php
		// lecture de la base de données
		$Query  = "select _title, _date, _IP, _post, _IDmsg, _type, _IDsmile, _ID, _texte, _censor from forum_items ";
		$Query .= "where _IDforum = '$IDforum' AND _visible = 'O' ";
		$Query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND ($grprd & ". pow(2, $_SESSION["CnxGrp"] - 1) .") ";
		$Query .= ( $begin ) ? "AND _date <= '$begin-31' " : "" ;
		$Query .= ( $showmode == "F" ) ? "AND _parent = '$parentID' " : "AND _type = 'M' ";
		if ( $showmode == "F" )
			switch ( $chrono ) {
				case "P" :	// dernier post
					$Query .= "order by _type desc, _access desc";
					break;
				default :	// chrono/anté chrono
					$Query .= "order by _type desc, _date ". ($chrono == "N" ? "desc" : "asc");
					break;
				}
		else
			$query .= "order by _date ". ($chrono == "N" ? "desc" : "asc") ." limit $MAXRECENT";

		// détermination du nombre de pages
		$result = mysql_query($Query, $mysql_link);
		$nbelem = ( $result ) ? mysql_affected_rows($mysql_link) : 0 ;

		$page   = $nbelem;
		$show   = 1;

		// ----- affichage style FAQ -----
		if ( $showmode == "F" ) {
			// raz des fils de discussion vus
			$reset  = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $auth[0] )
				? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&cmde=visu&submit=clear")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($FORUM_RESET)."\" alt=\"".$msg->read($FORUM_RESET)."\"/></a>"
				: "" ;

			print("
		              <tr class=\"align-center\" style=\"background-color:#C0C0C0;\">
		                <td style=\"width:50%;\" colspan=\"2\">". $msg->read($FORUM_SUBJECTS) ."</td>
		                <td style=\"width:20%;\">". $msg->read($FORUM_DATE) ."</td>
		                <td style=\"width:10%;\">". $msg->read($FORUM_HIT) ." ".$reset."</td>
		                <td style=\"width:20%;\">". $msg->read($FORUM_REPLIES) ."</td>
		              </tr>
		              ");

			if ( $nbelem ) {
				$page  = ( $page % $MAXPAGE )
					? (int) ($page / $MAXPAGE) + 1
					: (int) ($page / $MAXPAGE) ;

				$show  = ( $page % $MAXSHOW )
					? (int) ($page / $MAXSHOW) + 1
					: (int) ($page / $MAXSHOW) ;

				// initialisation
				$i     = 1;
				$first = 1 + (($skpage - 1) * $MAXPAGE);
				$pos   = $first;

				// se positionne sur la page ad hoc
				mysql_data_seek($result, $first - 1);
				$row   = remove_magic_quotes(mysql_fetch_row($result));

				while ( $row AND $i <= $MAXPAGE ) {
					$bgcol  = ( $i % 2 ) ? "item" : "menu" ;

					// pour indiquer un message ou un post-it
					$puce   = ( $row[5] == "M" )
						? "files.gif"
						: "annonce.gif" ;

					// lecture du smiley
					$res    = mysql_query("select _ident from smileys where _IDsmile = '$row[6]' limit 1", $mysql_link);
					$smile  = ( $res ) ? mysql_fetch_row($res) : 0 ;

					$humeur = ( $row[9] == "O" )
						? "<img src=\"".$_SESSION["ROOTDIR"]."/images/forbidden.gif\" title=\"\" alt=\"\" />"
						: "<img src=\"".$_SESSION["ROOTDIR"]."/images/smiley/forum/$smile[0].gif\" title=\"$smile[0]\" alt=\"$smile[0]\" />" ;

					// pour indiquer les nouveaux messages (moins de 2 jours OU non lus)
					$new    = isNew($row[4], $row[1]);

					// pour savoir qui a lu les messages
					$return = mysql_query("select _ID from forum_vu where _IDmsg = '$row[4]'", $mysql_link);
					$nbelem = ( $return ) ? mysql_affected_rows($mysql_link) : 0 ;

					$lien   = ( $nbelem )
						? "<a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/user_list.php?sid=".$_SESSION["sessID"]."&amp;IDmsg=$row[4]&amp;cmde=forum&amp;lang=".$_SESSION["lang"]."', '450', '200'); return false;\">$nbelem</a>"
						: "0" ;

					// suppression des post
					$req    = $msg->read($FORUM_ERASING, str_replace(Array(' ', '"'), Array('+', '\''), "$row[0]"));
					$del    = ( $_SESSION["CnxAdm"] == 255 OR ($row[7] == $_SESSION["CnxID"] AND $erase == "O") )
						? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&msgid=$row[4]&cmde=visu&submit=del")."\" onclick=\"return confirmLink(this, \"$req\");\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($FORUM_DELMESSAGE)."\" alt=\"".$msg->read($FORUM_DELMESSAGE)."\"/></a>"
						: "" ;

					// modification des post
					$maj    = ( $_SESSION["CnxAdm"] == 255 OR ($row[7] == $_SESSION["CnxID"] AND $update == "O") )
						? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&IDmsg=$row[4]&parent=$row[4]&msgid=$row[4]&cmde=post&submit=update")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"".$msg->read($FORUM_UPDATEMESSAGE)."\" alt=\"".$msg->read($FORUM_UPDATEMESSAGE)."\" /></a>"
						: "" ;

					// lecture des PJ
					$res    = mysql_query("select _IDpj from forum_pj where _IDmsg = '$row[4]'", $mysql_link);
					$pj     = mysql_numrows($res)
						? "<img src=\"".$_SESSION["ROOTDIR"]."/images/pj.gif\" title=\"".$msg->read($FORUM_ATTACHMENT)."\" alt=\"".$msg->read($FORUM_ATTACHMENT)."\" />"
						: "" ;

					// dernier message validé
					$query  = "select _date, _ID, _IDmsg from forum_items ";
					$query .= "where _IDforum = '$IDforum' AND _parent = '$row[4]' AND _visible = 'O' ";
					$query .= "order by _IDmsg desc limit 1";

					$return = mysql_query($query, $mysql_link);
					$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

					$mylink = myurlencode("index.php?item=$item&cmde=show&IDroot=$IDroot&IDgroup=$IDgroup&IDmsg=$myrow[2]");

					$icon   = "
						<a href=\"$mylink\" class=\"overlib\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/minireply.gif\" title=\"\" alt=\"\" /><span>". getUserName(@$myrow[1], false) ."</span>
						</a>";

					$lastmsg = ( $row[3] )
						? "$icon <span class=\"x-small\">$myrow[0]</span>"
						: "" ;

					print("            
						<tr class=\"$bgcol\">
	       					<td style=\"width:1%;\" class=\"valign-middle\"><img src=\"".$_SESSION["ROOTDIR"]."/images/$puce\" title=\"\" alt=\"\" /></td>
		          				<td style=\"width:49%;\">
	      	    		    		  	<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&IDmsg=$row[4]&cmde=show")."\">$row[0]</a>
	          			    		  	$humeur $pj $new $del $maj<br/>
								<span class=\"x-small\">".$msg->read($FORUM_BY, Array(getUserName($row[7]), _getHostName($row[2])))."</span>
	          		    			</td>
				       		<td class=\"x-small align-center\">$row[1]</td>
		       				<td class=\"align-center\">$lien</td>
							<td class=\"align-center\">$row[3]<br/>$lastmsg</td>
		       		       </tr>
		       		       ");
              
					$i++;
					$pos++;
					$row = remove_magic_quotes(mysql_fetch_row($result));
					}	// endwhile $row
				}	// endif $nbelem
			}	// endif affichage standard
		// ----- affichage style egroup -----
		else {
			$mois = explode(",", $msg->read($FORUM_MONTH));

			print("
				<tr style=\"background-color:#c0c0c0;\">
					<td>". $msg->read($FORUM_RECENTMSG) ."</td>
					<td class=\"align-right\">".$msg->read($FORUM_SEEMSG, Array(myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&cmde=visu&showmode=F"), strval($nbelem)))."</td>
				</tr>
				");

			$row = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

			$i = 0;
			while ( $row ) {
				$bgcol = ( $i++ % 2 ) ? "item" : "menu" ;

				// date du message
				$date = substr($row[1], 8, 2) . " " . $mois[substr($row[1], 5, 2) - 1];

				// 1ère phrase du message
				$text = substr($row[8], 0, 60) ;

				// suppression des post
				$req = $msg->read($FORUM_ERASING, str_replace(Array(' ', '"'), Array('+', '\''), "$row[0]"));
				$del = ( $_SESSION["CnxAdm"] == 255 OR ($row[7] == $_SESSION["CnxID"] AND $erase == "O") )
					? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&msgid=$row[4]&cmde=visu&submit=del")."\" onclick=\"return confirmLink(this, \"$req\");\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($FORUM_DELMESSAGE)."\" alt=\"\" /></a>"
					: "" ;

				// modification des post
				$maj = ( $_SESSION["CnxAdm"] == 255 OR ($row[7] == $_SESSION["CnxID"] AND $update == "O") )
					? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&IDmsg=$row[4]&parent=$row[4]&msgid=$row[4]&cmde=post&submit=update")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"".$msg->read($FORUM_UPDATEMESSAGE)."\" alt=\"\" /></a>"
					: "" ;

				// lecture des PJ
				$res = mysql_query("select _IDpj from forum_pj where _IDmsg = '$row[4]'", $mysql_link);
				$pj  = mysql_numrows($res)
					? "<img src=\"".$_SESSION["ROOTDIR"]."/images/pj.gif\" title=\"".$msg->read($FORUM_ATTACHMENT)."\" alt=\"".$msg->read($FORUM_ATTACHMENT)."\" />"
					: "" ;

				// pour indiquer les nouveaux messages (moins de 2 jours OU non lus)
				$new   = isNew($row[4], $row[1]);

				print("
				  <tr class=\"$bgcol\">
				    <td colspan=\"2\">
				      <table>
				          <tr>
				            <td style=\"width:10%;\">$date</td>
				            <td>
							<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&IDmsg=$row[4]&parent=$row[4]&nbelem=$nbelem&pos=1&cmde=show")."\">$row[0]</a>
							$pj $new $del $maj - ".getUserName($row[7])."<br/>
							$text...
				            </td>
				          </tr>
				      </table>
				    </td>
				  </tr>
				");

				$row = remove_magic_quotes(mysql_fetch_row($result));
				}	// endwhile $row

			// séparation
			print("
				<tr>
					<td style=\"height:6px;\"></td>
				</tr>
				");

			// liste des messages par annnées et par mois
			print("
				<tr class=\"align-left\" style=\"background-color:#C0C0C0;\">
					<td colspan=\"2\">". $msg->read($FORUM_MSGLIST) ."</td>
				</tr>

				<tr>
				    <td colspan=\"2\">
				      <table class=\"width100\">
					  <tr>
						<td style=\"width:14%\"></td>");

			for ($i=0; $i < count($mois); $i++)
				print("<td style=\"width:7%\" class=\"align-center\">$mois[$i]</td>");

			print("</tr>");

			// lectures des années
			$res   = mysql_query("select _date from forum_items where _IDforum = '$IDforum' order by _IDmsg asc limit 1", $mysql_link);
			$start = ( $res ) ? mysql_fetch_row($res) : 0 ;

			$res   = mysql_query("select _date from forum_items where _IDforum = '$IDforum' order by _IDmsg desc limit 1", $mysql_link);
			$end   = ( $res ) ? mysql_fetch_row($res) : 0 ;

			// construction du tableau
			$limit = (int) substr($end[0], 0, 4);

			for ($i = (int) substr($start[0], 0, 4); $i AND $i >= $limit; $i--) {
				print("<tr>");

				print("<td style=\"width:14%; white-space:nowrap;\" class=\"align-right\">$i</td>");

				for ($m = 1; $m <= 12; $m++) {
					// détermination du nombre de pages
					$Query  = "select _IDmsg from forum_items ";
					$Query .= "where _IDforum = '$IDforum' ";
					$Query .= "AND _date >= '$i-$m-01' AND _date <= '$i-$m-31' ";
					$Query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND _visible = 'O' AND ($grprd & ". pow(2, $_SESSION["CnxGrp"] - 1) .") ";
					$Query .= "order by _IDmsg desc";

					$res  = mysql_query($Query, $mysql_link);
					$nb   = ( $res ) ? mysql_affected_rows($mysql_link) : 0 ;

					$link = ( $nb )
						? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&IDroot=$IDroot&cmde=visu&showmode=F&begin=$i-$m")."\">$nb</a>"
						: "&nbsp;" ;

					print("<td class=\"align-center\" style=\"width:7%; white-space:nowrap; background-color:#eeeeee;\">$link</td>");
           				}

				print("</tr>");
				}

			print("
				      </table>
				    </td>
				</tr>
				");
			}	// endif affichage egroup
	?>
	</table>
       
	<?php
		// bouton précédent
		$where = $skshow - 1;
		if ( $skshow == 1 )
			$prev = "";
		else {
			$skpg = 1 + (($skshow - 2) * $MAXSHOW);
			$prev = "[<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&cmde=visu&skpage=$skpg&skshow=$where")."\">".$msg->read($FORUM_PREV)."</a>]";
			}

		// liens directs sur n° de page
		$start = 1 + (($skshow - 1) * $MAXSHOW);
		$end   = $skshow * $MAXSHOW;

		$choix = ( $skpage == $start )
			? "<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_left.gif\" title=\"\" alt=\"\"/><strong>$start</strong><img src=\"".$_SESSION["ROOTDIR"]."/images/nav_right.gif\" title=\"»\" alt=\"»\" />"
			: "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&cmde=visu&skpage=$start&skshow=$skshow")."\">$start</a>" ;

		for ($j = $start + 1; $j <= $end AND $j <= $page; $j++)
			$choix .= ( $skpage == $j )
				? "|<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_left.gif\" title=\"\" alt=\"\"/><strong>$j</strong><img src=\"".$_SESSION["ROOTDIR"]."/images/nav_right.gif\" title=\"»\" alt=\"»\" />"
				: "|<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&cmde=visu&skpage=$j&skshow=$skshow")."\">$j</a>" ;

		// bouton suivant
		$where = $skshow + 1;
		$next  = ( $skshow == $show )
			? ""
			: "[<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDforum=$IDforum&cmde=visu&skpage=$j&skshow=$where")."\">".$msg->read($FORUM_NEXT)."</a>]" ;

		// ----- affichage style FAQ -----
		if ( $showmode == "F"  AND $nbelem )
			print("
				<hr/>
				<div style=\"text-align:center;\">$prev $choix $next</div>
				");

		// ----- affichage style egroup -----
		print("<hr/>");
	?>

	<!-- recherche d'un message dans les forums -->
	<table class="width100">
	  <tr>
	    <td>
	      <img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/search.gif"  title="" alt="" />
	      <?php print($msg->read($FORUM_FORUMSEARCH, "index.php?item=91&amp;IDgroup=$IDgroup&amp;IDforum=$IDforum&amp;IDroot=$IDroot&amp;cmde=search")); ?>
	    </td>
	    <td class="align-right">
	      <?php print("[<a href=\"index.php?item=$item&amp;IDgroup=$IDgroup&amp;IDroot=$IDroot\">".$msg->read($FORUM_BACKTOLIST)."</a>]"); ?>
	    </td>
	  </tr>
	</table>

	<form id="gotomsg" action="<?php echo myurlencode("index.php?item=3&IDgroup=$IDgroup&IDroot=$IDroot&cmde=show"); ?>" method="post" >
		<p style="margin:0;">
		<img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/in.gif" title="" alt="" /> <?php print($msg->read($FORUM_GOTO)); ?>

		<label for="IDmsg"><input type="text" id="IDmsg" name="IDmsg" size="4" style="font-size:9px;" /></label>
		<input type="image" src="images/go.gif" title="<?php echo $msg->read($FORUM_GOTO); ?>" alt="<?php echo $msg->read($FORUM_GOTO); ?>" />
		</p>
	</form>

</div>