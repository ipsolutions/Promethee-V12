<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2006 by Nordine Zetoutou (nordine.zetoutou@educagri.fr)

   This program is free software. You can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License.
 *-----------------------------------------------------------------------*/


/*
 *		module   : Authentification.php
 *		projet   : gestion du mode d'authentifications externes
 *
 *		version  : 1.0
 *		auteur   : zetoutou
 *		creation : 25/09/06
 *		modif    :
 */


/*-----------------------------------------------------------------------                             
                             modules : Authentification
                             projet : Ldap2Mysql-Authentification
                             CHEFS DE PROJETS : P.BAFFALIE, S.GRESSARD
 
 Description :      gestion du mode d'authentifications externes
                             -
 Environnement PHP   : PHP4 OU PHP5
 author                    : nordine.zetoutou<nzetoutou@educagri.fr>
 date de création     : 25 sept. 06 
 Historique de modification :
                             -
                             -
 version                   :	1.0
-----------------------------------------------------------------------*/
/**
   * @author Nordine Zetoutou  - <nzetoutou@educagri.fr>
   * @package Ldap2Mysql-Authentification
   * @module Authentification
   * @description gestion des bases d'authentification mysql, ldap et cas
   * @dependance  activation de l'extension php_ldap
   * @dependance  si CAS comme serveur d'authentification activation  de l'extension=php_curl.dll
   * 
   * @license GPL
   * @version 1.0 
   * @date :  25 sept. 2006  
   
*/
class Authentification
{
	var $sTableLogin = 'user_id';
	//
	function Authentification()
	{
		define('CONFIG_DIR', $_SESSION["ROOTDIR"].'/Authentification/config');
	}
	//
	/**
	 * @description charge le mode d'authentification externe
	 * @return mixed object|bool $oBase ou false
	 */
	function getAuthMode()
	{
		//
		if ( file_exists(CONFIG_DIR) )
		{
			//baseAuth est le nom du fichier du mode d'authentification
			$fFile = CONFIG_DIR . '/baseAuth';

			if ( file_exists($fFile) )
			{
				$sFileContent = file_get_contents($fFile);
				$oBase = @ unserialize($sFileContent);
				return $oBase;
			}
		}
		else
		{
			$sMessage  = "<p style='color:red;font-weight:bold;'> ************* </br>";
			$sMessage .= "le répertoire de configuration des authentifications externes ne peut être atteint";
			$sMessage .= "</br>*************</p>";
			echo $sMessage;
		}
	}
	//
	/**
	 * @description authentifie un utilisateur dans l'annuaire ldap
	 * @param object $oBase : config du serveur d'authentification 
	 * @param string $login
	 * @param string $pass
	 * 
	 * @return object $oUser
	 */
	function ldap_authenticate($oBase, $login, $pass)
	{
		//
		$ressource_link = ldap_connect($oBase->host, $oBase->port);

		//**** modif zulu : fin si pas de connexion
		if (!$ressource_link){
			return 'noConnexion';
		}
		//fin modif zulu

		switch ( $oBase->type )
		{
			//
			case 'openldap' :
				//**** modif zulu (Gilles Perrot <zuluperrot@club-internet.fr>) : params LDAP pour SSL et éviter de suivre le referral (on authentifie sur un replica)
				ldap_set_option($ressource_link, LDAP_OPT_PROTOCOL_VERSION, 3);
				ldap_set_option($ressource_link, LDAP_OPT_REFERRALS, 0);

				//**** modif Nordine (10/04/07) : En effet, sans cela, certaines configuration (de openldap) bloque la connexion !
				$oBase->rdn = $oBase->login_field . '='.$login.',' . $oBase->rdn;

				//**** modif Michel A. BEGUE <mbegue4@ac-reunion.fr> (23/04/08)
				$oBase->rdn_pwd = $pass;
				// il faudrait utiliser $pass plutot que $oBase->rdn_pwd
				// étant donné que $oBase->rdn est constitué avec $login

				//bind avec le root_dn
				$bLdap_bind = ldap_bind($ressource_link, $oBase->rdn, $oBase->rdn_pwd);

				if (!$bLdap_bind) {
					return 'noConnexion';
				}//fin modif
				break;
				//
			case 'activedirectory' :
				//
				$bLdap_bind = @ldap_bind($ressource_link, $login, $pass);
				break;
				//
		} //fin switch
		//
		if ( $bLdap_bind )
		{
			//**** modif zulu : recherche du vrai dn de l'utilisateur
			$result = ldap_search($ressource_link, $oBase->dn, '(' . $oBase->login_field . '=' . $login . ')');
			$aEntries = ldap_get_entries($ressource_link, $result);

			if ( $aEntries["count"] == (int) 1 )
			{
				$entry = ldap_first_entry($ressource_link, $result);
				$attrs = ldap_get_attributes($ressource_link, $entry);

				//on construit un objet $oUser
				$oUser = new stdClass();
				//
				$aKeys = array_keys($attrs);
				foreach ($aKeys as $value)
				{
					//
					if ( !is_int($value) )
					{
						//les clés attributs ldap contiennent des majuscules
						$propriete = strtolower($value);
						//
						$oUser-> $propriete = $attrs[$value][0];
						//on récupère le nom du champ contenant l'id ldap
						if ( $propriete == $oBase->ldap_user_id_field )
						{
							//on récupère la valeur de ce champ
							$oUser->ldap_user_id = $attrs[$value][0];
						}
					}
				}

				//**** modif zulu : on ferme la connexion root_dn et on tente une avec le dn complet de l'utilisateur
				ldap_free_result($result);
				ldap_close($ressource_link);

				$ds = ldap_connect($oBase->host,$oBase->port);
				if (!$ds) {
					echo "pas de connexion <br />";
					return 'noConnexion';
				} else {
					ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
					ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

					$r = ldap_bind($ds,$entry["dn"]);
					echo $entry["dn"]."<br />";

					if (!$r) {
						echo "Erreur authentification <br />";
						ldap_close($ds);
						return 'notExist';
					} else {
						ldap_close($ds);
						echo $entry["dn"]."<br />";
						return $oUser;
						}
					}
                                                
				//fin modif
				//return $oUser;
			}
			else
			{
				return 'notExist';
			}
			//
			ldap_free_result($result);
			//
		}
		else
		{
			return 'noConnexion';
		}
	}
	//
	/**
	 * @description récupère un utilisateur de la base mysql
	 * @param object $oUser : possédant entre autres son id ldap
	 * 
	 * return object $oUser
	 */
	function mysql_authenticate($oMysql, $ldap_user_id)
	{
		$ressource_link = @ mysql_connect($oMysql->host, $oMysql->root, $oMysql->port);
		//
		if ( $ressource_link )
		{
			mysql_select_db($oMysql->db);
			$sQuery = 'SELECT * FROM ' . $this->sTableLogin;
			$sQuery .= " WHERE ldap_user_id='" . $ldap_user_id . "'";
			$result = mysql_query($sQuery);
			//
			if ( $result )
			{
				//on ne récupère qu'un objet
				return mysql_fetch_object($result);
			} //fin if
			//
			//
		} //fin if
		//
	}
}
?>