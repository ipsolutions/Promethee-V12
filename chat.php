<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2006 by Stéphane Louédin(stef@neni.org)
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
?>

<?php
/*
 *		module   : chat.php
 *		projet   : forum de discussion en direct
 *
 *		version  : 1.0
 *		auteur   : louédin
 *		creation : 2/02/2006
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


// transformation des accentuations
$dial_id_user = str_replace(
	Array("é", "è", "à", "ô", "ü", "ë", "ç", "â", "ê", "î", "ï", "œ", "ù", "û", "°"),
	Array("&eacute;", "&egrave;", "&agrave;", "&ocirc;", "&uuml;", "&euml;", "&ccedil;", "&acirc;", "&ecirc;", "&icirc;", "&iuml;", "&oelig;", "&ugrave;", "&ucirc;", "&deg;"),
	$_SESSION["CnxName"]);
?>


	<!-- le code JS extene pour le dialogue -->
	<script  type="text/javascript" src="<?php echo $_SESSION["ROOTDIR"]; ?>/script/dialdirect.js"></script>

	<!-- les param. de configuration passés par le PHP -->
	<script  type="text/javascript">
	// <![CDATA[

	// CONFIGURATION GLOBALE
	// url du script
	dial_url = "<?php echo 'dialdirect.php'; ?>";
	// rafraichissement
	dial_refresh = <?php echo $chat[5]; ?>;
		
	// CONFIGURATION PAGE
	// salle (matière) du chat
	dial_id_salle = "<?php print($msg->read($CHAT_DIALOG)); ?>" + "<?php echo $salon; ?>";
	// identifiant utilisateur
	dial_id_user = "<?php echo $dial_id_user; ?>";
	// identifiant type utilisateur (pour reconnaissance graphique sur dans le chat)
	dial_id_type = "<?php echo 'eleve'; ?>";

	
	/*  INITIALISATION DES SALLES
		ATTENTION le nom de la variable instanciée de dialDirect doit être le même que celle de l'identifiant id (ici, dial1) du div du HTML.
		En effet, je n'ai pas trouvé de moyen plus efficace (et plus propre) pour basculer en envoi privé par le click sur l'identifiant ou
		le setTimout.
	*/
	var dial3;
	
	window.onload = function(){
		dial3 = new dialDirect("dial3", "dialdirect.php", 4000, dial_id_user, dial_id_type, dial_id_salle);

		/* tempo pour changement utilsateur du 3ème dialogue*/
		document.getElementById("nomUtilisateur").onchange=function(){dial3.ident=this.value;}
		/* tempo pour changement du groupe utilisateur du 3ème dialogue */
		document.getElementById("groupeUtilisateur").onchange=function(){dial3.genre=this.value;}
		
		/* ajoute de la deco aux messages de la boite 3 */
		dial3.decodebut = '<div class="dialdirectbox"><div class="ee"><div class="oo"><div class="nn"><div class="no"><\/div><div class="ne"><\/div><\/div><div class="cc">';
		dial3.decofin = '<\/div><div class="ss"><div class="so"><\/div><div class="se"><\/div><\/div><\/div><\/div><\/div>';
	}
	
	/* pour indiquer le deconnexion */
	window.onunload = function(){
		dial3.sortir();
	}	
		
	// ]]>
	</script>


	<!-- zone du chat 3: petite modification du style -->
	<div style="border: 1px solid #aaa; padding: 4px; background: #eee; width:400px;">
	<div id="dial3" class="dialdirect2">
		<div class="bartitre">
			<a href="#" id="dial3_etat" class="etat" title="<?php print($msg->read($CHAT_REFRESH)); ?>"></a>
			<a href="#" id="dial3_titre" class="titre" title="<?php print($msg->read($CHAT_ALL)); ?>" ></a>
		</div>
		<div id="dial3_envoie" class="envoie"><a href="#" id="dial3_close" class="fermeture" title="<?php print($msg->read($CHAT_CANCEL)); ?>"></a><span id="dial3_envoie_txt"></span></div>
		<div id="dial3_lecture" class="lecture"></div>
		<div  class="zenvoie">
			<a href="#" id="dial3_ok" class="ok" ></a>
			<input id="dial3_saisie" type="text" class="saisie" />
		</div>
	</div>
	</div>
	<!-- fin zone du chat -->
