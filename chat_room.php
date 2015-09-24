<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2006 by Stéphane Louédin(stef@neni.org)

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
 *		module   : chat_room.php
 *		projet   : fenêtre de discussion à la connexion
 *
 *		version  : 1.0
 *		auteur   : louédin
 *		creation : 2/02/2006
 *		modif    : 
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
	dial_refresh = <?php echo '1000'; ?>;
		
	// CONFIGURATION PAGE
	// salle (matière) du chat
	dial_id_salle = "<?php echo 'Promethee ['.$_SESSION["lang"].']'; ?>";
	// identifiant utilisateur
	dial_id_user = "<?php echo $dial_id_user; ?>";
	// identifiant type utilisateur (pour reconnaissance graphique sur dans le chat)
	dial_id_type = "<?php echo 'eleve'; ?>";

	
	/*  INITIALISATION DES SALLES
		ATTENTION le nom de la variable instanciée de dialDirect doit être le même que celle de l'identifiant id (ici, dial1) du div du HTML.
		En effet, je n'ai pas trouvé de moyen plus efficace (et plus propre) pour basculer en envoi privé par le click sur l'identifiant ou
		le setTimout.
	*/
	var dial1;
	
	window.onload = function(){
		dial1 = new dialDirect("dial1", dial_url, dial_refresh, dial_id_user, dial_id_type, dial_id_salle);
	}
	
	/* pour indiquer le deconnexion */
	window.onunload = function(){
		dial1.sortir();
	}	
		
	// ]]>
	</script>


	<div class="popover" style="display: block; position: relative; max-width: 330px; width: 330px; margin-bottom: 15px">
		<ul class="nav nav-list">
			<li class="nav-header" style="padding-top: 0px;">
				<h3 class="popover-title">
					<a href="index.php?cmde=setusermenu&ident=2&access=close">
					CHAT
					</a>
				</h3>
			</li>
			<li>
				<!-- zone du chat -->
				<div id="dial1" class="dialdirect" style="width:100%;">
					<div class="bartitre">
						<a href="#" id="dial1_etat" class="etat" title="<?php print($dialmsg->read($CHAT_REFRESH)); ?>"></a>
						<a href="#" id="dial1_titre" class="titre" title="<?php print($dialmsg->read($CHAT_ALL)); ?>" ></a>
					</div>
					<div id="dial1_lecture" class="lecture"></div>
					<div  class="zenvoie" style="height: 28px">
						<div id="dial1_envoie" class="envoie"><a href="#" id="dial1_close" class="fermeture" title="<?php print($dialmsg->read($CHAT_CANCEL)); ?>"></a><span id="dial1_envoie_txt"></span></div>
						<a href="#" id="dial1_ok" class="ok" style="margin-top: 5px" ></a>
						<input id="dial1_saisie" type="text" class="saisie" style="width: 290px" />
					</div>
				</div>
				<!-- fin zone du chat -->
			</li>
		</ul>
	</div>
