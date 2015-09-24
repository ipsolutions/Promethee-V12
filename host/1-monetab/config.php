<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2002-2008 by Dominique Laporte(C-E-D@wanadoo.fr)

   This file is part of Prom�th�e.

   Prom�th�e is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   Prom�th�e is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 *-----------------------------------------------------------------------*/


/*
 *		module   : config.php (g�n�r� � partir de config.ini)
 *		projet   : d�finiton des variables de configuration de l'intranet
 *
 *		version  : 2.0
 *		auteur   : laporte
 *		creation : 4/10/02
 *		modif    : 23/12/02 - par D. Laporte
 *                     filtrage des adresses IP pour l'acc�s s�curis�
 *
 *		           20/03/03 - par D. Laporte
 *                     log des connexions et des d�connexions
 *
 *		           11/05/03 - par D. Laporte
 *                     statistiques de connexion
 *
 *		           2/06/03 - par D. Laporte
 *                     param�trage nom et mot de passe de l'utilisateur de la base MySQL
 *
 *		           22/08/03 - par D. Laporte
 *                     param�trage d'une connexion persistante � la base MySQL
 *
 *		           25/12/03 - par D. Laporte
 *                     choix du style d'affichage dans les forums
 *
 *		           4/07/05 - par D. Laporte
 *                     attribution user ID et password automatiques
 *
 *		           22/01/06 - par D. Laporte
 *                     synchronisation avec serveur LDAP
 */


//---------------------------------------------------------------------------
static	$SERVER       = "localhost";				// nom du serveur MySQL
static	$SERVPORT     = 0;				// n� du port du serveur MySQL
static	$USER         = "root";				// nom de l'utilisateur de la base MySQL
static	$PASSWD       = "";				// mot de passe de l'utilisateur de la base MySQL
static	$DATABASE     = "1-monetab";			// nom de la base de donn�es MySQL
static	$DOWNLOAD     = "host/1-monetab/download";			// r�pertoire des documents des utilisateurs
static	$LANG         = "fr";				// langue utilis�e
static	$PERSISTENT   = 0;			// connexion persistante � la base de donn�es
static	$TIMELOG      = 5184000;				// dur�e de stockage des logs : 60 jours (0 si illimit�)
static	$TIMESTAT     = 2678400;				// dur�e de stockage des stats : 31 jours (0 si illimit�)
static	$TIMELIMIT    = 1800;				// temps d'expiration des pages : 30 minutes
static	$TIMEFORUM    = 86400;					// nouveaux messages des forums : 24 heures
static	$TIMERSS      = 604800;					// temps d'expiration des news rss : 7 jours
static	$TIMELINK     = 172800;				// temps d'expiration des liens par mail: 2 jours
static	$TIMEREFRESH  = 10;				// temps de rafraichissement des images du bandeau (secondes)
static	$TIMETMP      = 600;				// d�lais des fichiers temporaires avant suppression (secondes)
static	$FILESIZE     = 1024000;				// taille max des fichiers � transf�rer
static	$DEBUG        = 0;				// mode d�bogage (1 pour activer)
static	$DEMO         = 1;				// mode d�mo (1 pour activer)
static	$CHARSET      = "iso-8859-1";				// encodage des caract�res
static	$WYSIWYG      = 1;					// �diteur wysiwyg (1 pour activer par d�faut)
static	$MAINTENANCE  = 0;					// mode maintenance (1 pour activer)
static	$USERPWD      = 0;			// longueur des mots de passe (0 pour mdp vide)
static	$IPFILTER     = 0;				// filtrage des adresses IP (1 pour activer)
static	$MAXPAGE      = 20;				// nombre max de donn�es par page de pr�sentation
static	$MAXSHOW      = 9;				// nombre max de pages accessibles
static	$IMGWIDTH     = 700;					// largeur max des images (en pixels)
static	$MAXIMGWDTH   = 150;					// largeur max des vignettes (en pixels)
static	$MAXIMGHGTH   = 150;					// hauteur max des vignettes (en pixels)
static	$IMGBYLINE    = 3;					// nombre de vignettes par ligne
static	$IMGMAXLINE   = 6;					// nombre max de ligne de vignettes
static	$IMGUPLOAD    = "galerie/upload";		// r�pertoire pour import d'images
static	$MAXSTAR      = 5;					// nombre max d'�toiles pour les stats de fr�quentation
static	$HITBYSTAR    = 100;					// nombre de hit par �toile
static	$MAXRECENT    = 5;				// nombre max de messages r�cents affich�s dans les forums
static	$FLASH        = "Prom�th�e";				// flash info par d�faut (si vide : flash personnalis� download/spip/templates/<lang>/custom.htm)
static	$SERVICE      = "";					// service au d�marrage (si vide : flash info par d�faut)
//static	$IDENT        = "�l�ve[_ID:0]";		// ID pour attribution automatique de login (�l�ve + n� de connexion)
static	$IDENT        = "[_name:4][_fname:4]";		// ID pour attribution automatique de login (4 lettres du nom + 4 lettres du pr�nom)
static	$AUTOPASSWD   = "[_born:0]";				// mot de passe pour attribution automatique de login (date de naissance aaaa-mm-jj)
//static	$AUTOLOGIN    = "id=visiteur&pwd=visiteur";			// ID et mot de passe pour connexion automatique
static	$AUTOLOGIN    = "";			// ID et mot de passe pour connexion automatique
static	$AUTOVAL      = 0;					// validation automatique des comptes cr��s par les utilisateurs (1 pour activer)
static	$AUTODEL      = 0;					// suppression automatique des comptes non visit�s au bout de x heures (0 pour d�sactiver)
static	$VERSION      = "9.0rc1";				// version de l'intranet
static	$CONFIG       = "config.txt";				// fichier de configuration de l'intranet utilis�
static	$CREDITS      = "credits.txt";			// fichier de la liste des contributeurs
//static	$GEOLOC       = 10753;					// ID inscription geo-loc.com pour la localisation g�ographique des internautes
static	$GEOLOC       = 0;					// ID inscription geo-loc.com pour la localisation g�ographique des internautes
static	$MAXPOST      = 3628800;				// d�lai max avant l'effa�age des post-it en attentes : 6 semaines (0 si illimit�)
static	$SHOWPOST     = 0;					// pour visualiser les post-it en attentes (1 pour activer)
static	$HDQUOTAS     = 1024000;			// quotas disque pour les Espaces de Travail Partag�s
static	$AUTHUSER     = "1:0";			// pour autoriser les utilisateurs � cr�er leur compte (1 pour activer)
static	$ACOUNTIME    = "0000-00-00 00:00:00";			// dur�e de validit� des comptes (0000-00-00 00:00:00 pour validit� illimit�e)
static	$ROOTSYS      = "";					// chemin absolu pour le d�p�t des fichiers (pb e-smith)
static	$HDRSPACING   = 10;					// s�paration barre d'accueil et la page (en pixels)
static	$TBLSPACING   = 10;			// s�paration entre les tableaux des menus (en pixels)
static	$MENUSKIN     = 0;			// placement des menus (0 : 2 colonnes, 1 : gauche, 2 : droite)
static	$WEBSITE      = "http://promethee.eu.org";	// site internet Prom�th�e
//static	$SMSPROVIDER  = "sms@SMStoB.com";			// fournisseur service SMS
static	$SMSPROVIDER  = "";			// fournisseur service SMS
static	$SMSPWD       = "";			// mot de passe au service SMS
static	$CHMOD        = 0775;			// permission par d�faut pour transfert de fichiers
//---------------------------------------------------------------------------
?>
