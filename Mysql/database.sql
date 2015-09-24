##############################################################################
#    Copyright (c) 2002-2007 by Dominique Laporte (C-E-D@wanadoo.fr)         #
#                                                                            #
#    This file is part of Prom�th�e.                                         #
#                                                                            #
#    Prom�th�e is free software: you can redistribute it and/or modify       #
#    it under the terms of the GNU General Public License as published by    #
#    the Free Software Foundation, either version 3 of the License, or       #
#    (at your option) any later version.                                     #
#                                                                            #
#    Prom�th�e is distributed in the hope that it will be useful,            #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of          #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           #
#    GNU General Public License for more details.                            #
#                                                                            #
#    You should have received a copy of the GNU General Public License       #
#    along with Prom�th�e.  If not, see <http://www.gnu.org/licenses/>.      #
##############################################################################


# si la base de donn�es existe, on la d�truit
drop database if exists `##DATABASE##`;

# et on en cr�e une nouvelle
create database `##DATABASE##`;

# que l'on utilise
use `##DATABASE##`;

###############################################################################
# table de configuration de la base de donn�es
# ver 1.2
#
## rajout champ _lang

create table `config_database` (
	_IDconf		int unsigned not null auto_increment,		# ID de la configuration
	_version	varchar(12) not null,				# version de la bdd
	_IPv6		varchar(24) not null,				# adresse IP v6 du poste sur le LAN
	_date		datetime,					# date et heure de cr�ation/modification de la bdd
	_table		int unsigned not null,				# nombre de tables
	_retcode	int unsigned not null,				# code retour du nombre d'erreurs (0 si ok)
	_lang		varchar(2) not null,				# langue utilis�e pour la base de donn�es
	primary key (_IDconf)
	) ENGINE  = MyISAM COMMENT = "Table de configuration de la base de donn�es";

###############################################################################
# table de la configuration de l'intranet
# ver 2.5
#
# remarque : placer les images logo01.jpg et logo02.jpg dans le r�pertoire images/logos/<_ident>
#            les puces se trouvent dans le dossier themes/puce
#            les fonds des pages se trouvent dans le dossier themes/fond
#            les fonds du bandeau se trouvent dans le dossier themes/header
#
## ajout champs : _cp et _ville

create table config (
	_IDconf		int unsigned not null auto_increment,		# ID de la configuration
	_ident		varchar(60) not null,				# identification de la config (nom du Lyc�e)
	_title		varchar(60) not null,				# titre de la fen�tre
	_texte		varchar(60) not null,				# texte d'accueil (dans le bandeau)
	_crawler		tinytext not null,				# mot-clefs pour les robots d'indexation
	_tdcolor	varchar(6) default 'FFFFFF' not null,		# couleur de fond du bandeau
	_align		enum('G', 'C', 'D') default 'C' not null,	# alignement bandeau (G : Gauche, C : Centre, D : Droite)
	_login		mediumtext not null,				# texte d'accueil au login
	_nologin	mediumtext not null,				# texte d'accueil en mode maintenance
	_IDtheme	int unsigned default '1' not null,		# ID du th�me choisi (voir table config_theme)
	_bgcolor	enum('O', 'N') default 'N' not null,		# utilisation des fonds de couleur (O : Oui, N : Non)
	_puce		varchar(20) not null,				# type de puce des menus
	_fond		varchar(20) not null,				# image de fond de la page centrale
	_page		enum('O', 'N') default 'N' not null,		# appliquer l'image de fond � la page enti�re (O : Oui, N : Non)
	_header		varchar(20) not null,				# image de fond des titres de menus
	_adresse	varchar(60) not null,				# adresse de l'�tablissement
	_cp		varchar(6) not null,				# code postal de l'�tablissement
	_ville		varchar(20) not null,				# ville de l'�tablissement
	_tel		varchar(20) not null,				# t�l�phone de l'�tablissement
	_fax		varchar(20) not null,				# fax de l'�tablissement
	_web		varchar(80) not null,				# site web de l'�tablissement
	_email		varchar(60) not null,				# email de l'�tablissement
	_logo1		enum('O', 'N') default 'O' not null,		# affichage du logo principal (O : Oui, N : Non)
	_logo2		enum('O', 'N') default 'O' not null,		# affichage du logo r�gion (O : Oui, N : Non)
	_webmaster	varchar(40) not null,				# email du webmaster
	_visible	enum('O', 'N') default 'O' not null,		# config active (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	_bandeau	int not null,
	primary key (_IDconf),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table de la configuration de l'intranet";

###############################################################################
# table des centres de formations
# ver 1.5
#
## suppression champ _student

create table config_centre (
	_IDcentre	int unsigned not null,				# ID du centre de formation
	_ident		varchar(40) not null,				# intitul� du centre de formation
	_adresse	varchar(60) not null,				# adresse du centre
	_tel		varchar(20) not null,				# t�l�phone du centre
	_fax		varchar(20) not null,				# fax du centre
	_web		varchar(60) not null,				# site web du centre
	_email		varchar(60) not null,				# email du centre
	_visible	enum('O', 'N') default 'O' not null,		# centre publiable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	_semaines	tinytext not null,
	_vacances	tinytext not null,
	primary key (_IDcentre, _lang)
	) ENGINE = MyISAM COMMENT = "Table des centres de formation";

###############################################################################
# table des th�mes de l'intranet
# ver 1.2
#
# remarque : les feuilles de style sont plac�es dans le r�pertoire themes/<_nom>/styles
#            les images du fond des pages sont plac�es dans le r�pertoire themes/<_nom>/images
#

create table config_theme (
	_IDtheme	int unsigned not null auto_increment,		# ID du theme
	_theme		varchar(10) not null,				# nom du th�me
	_color		varchar(7) not null,				# code couleur de la charte graphique
	_bgcolor	varchar(7) not null,				# code couleur de l'arri�re plan des menus
	primary key (_IDtheme),
	unique key _key(_theme)
	) ENGINE = MyISAM COMMENT = "Table des habillages (skins) de l'intranet";

###############################################################################
# table des logos du bandeau
# ver 1.0
#
# remarque : les fichiers images sont plac�s dans le r�pertoire images/logos/<_ident>/logo01-<_IDlogo>.jpg

create table config_logo (
	_IDlogo		int unsigned not null auto_increment,		# ID du logo
	_visible	enum('O', 'N') default 'O' not null,		# affichable (O : Oui, N : Non)
	primary key (_IDlogo)
	) ENGINE = MyISAM  COMMENT = "Table des logos";

###############################################################################
# table de configuration des d�finitions des mot-clefs
# ver 1.0

create table config_def (
	_IDdef		int unsigned not null auto_increment,		# ID de la configuration
	_IDcentre	int unsigned not null,				# ID du centre de formation
	_ident		varchar(20) not null,				# intitul� du mot-clef
	_text		varchar(40) not null,				# texte correspondant au mot-clef
	_lang		varchar(2) not null,				# langue utilis�e pour la base de donn�es
	primary key (_IDdef),
	unique key _key(_IDcentre, _ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table de configuration des d�finitions des mot-clefs";

###############################################################################
# table des extensions de fichiers
# ver 1.6
#
# remarque : les fichiers images sont plac�s dans le r�pertoire images/mime/<_ext>.gif
#
## modification _ext varchar(5) -> varchar(6)

create table config_mime (
	_IDmime		int unsigned not null auto_increment,		# ID du mime
	_ext		varchar(5) not null,				# extension de fichier
	_mime		varchar(40) not null,				# nom de l'application associ�e
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (extension autoris�e)
	_lang		varchar(2) not null,				# langue utilis�e pour la description
	primary key (_IDmime),
	unique key _key(_ext, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des fichiers autoris�s";

###############################################################################
# table de l'encodage des caract�res
# ver 1.0

create table config_charset (
	_IDchar		int unsigned not null auto_increment,		# ID du codage
	_charset	varchar(20) not null,				# nom du codage
	primary key (_IDchar)
	) ENGINE = MyISAM  COMMENT = "Table de l'encodage des caract�res";

###############################################################################
# table des menus affichables
# ver 1.8
#
## ajout champ _type

create table config_menu (
	_IDmenu		int unsigned not null auto_increment,		# ID du menu
	_ident		varchar(20) not null,				# libell� du menu
	_text		tinytext not null,				# texte descriptif du menu
	_order		int not null,					# n� apparition dans les colonnes (> 0 : gauche, < 0 : droite)
	_marquee	enum('O', 'N') default 'N' not null,		# menu d�filant (O : Oui, N : Non)
	_img		varchar(20) default 'default.png' not null,	# icone du titre du menu
	_IDgrprd	int unsigned default '255' not null,		# ID des lecteurs (voir table groupe)
	_anonyme	enum('O', 'N') default 'O' not null,		# acc�s en mode anonyme (O : Oui, N : Non)
	_backoffice	varchar(80) not null,				# lien sur le backoffice
	_sort		enum('O', 'N') default 'O' not null,		# trier les items du menu (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# menu visible (O : Oui, N : Non)
	_activate	enum('O', 'N') default 'O' not null,		# menu install� (O : Oui, N : Non)
	_table		varchar(20) not null,				# table des items des menus (config_submenu par d�faut)
	_type		int unsigned default '0' not null,		# type de menu (0 : g�n�rique, 1 : syst�me, ...)
	_lang		varchar(2) not null,				# langue
	primary key (_IDmenu, _lang),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des menus de la page d'accueil";

###############################################################################
# table des sous menus
# ver 1.8
#
## ajout champ _type

create table config_submenu (
	_IDsubmenu	int unsigned not null auto_increment,		# ID du sous menu
	_IDmenu		int not null,					# ID du menu parent (< 0 si sous menu)
	_ident		varchar(40) not null,				# texte (ou image) du sous menu
	_link		varchar(255) not null,				# lien du sous menu
	_url		enum('O', 'N') default 'O' not null,		# url (O : Oui, N : Non) ou contenu
	_order		int default '0' not null,			# n� apparition dans les colonnes (si items non tri�s, voir table config_menu)
	_IDgrprd	int unsigned default '255' not null,		# ID des lecteurs (voir table groupe)
	_anonyme	enum('O', 'N') default 'N' not null,		# acc�s en mode anonyme (O : Oui, N : Non)
	_backoffice	enum('O', 'N') default 'N' not null,		# acc�s au backoffice (O : Oui, N : Non)
	_image		varchar(40) not null,				# fichier image (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# sous menu visible (O : Oui, N : Non)
	_type		int unsigned default '0' not null,		# type de menu (0 : g�n�rique, 1 : syst�me, 2 : utilisateur, ...)
	_lang		varchar(2) not null,				# langue
	primary key (_IDsubmenu),
	unique key _key(_IDmenu, _ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des sous menus";

###############################################################################
# table des fuseaux horaires
# ver 1.0

create table config_timezone (
	_IDzone		int unsigned not null auto_increment,		# ID du fuseau
	_timezone	varchar(40) not null,				# nom du fuseau
	primary key (_IDzone)
	) ENGINE = MyISAM  COMMENT = "Table des fuseaux horaires";


###############################################################################
# table des identifiants de connexion des utilisateurs � l'intranet
# ver 4.0
#
# remarque : pour des organismes ou un groupe (ie : �l�ves) utiliser Anonyme pour le sexe
#            cela permet, entre autre, de voter plusieurs fois pour un sondage.
#
#            le n� _ID correspond au fichier image de l'utilisateur : images/photo/<_ID>.jpg OU
#            le n� _ID correspond au fichier image de l'utilisateur : images/photo/eleves<_ID>.jpg
#
## renommage champs : _adr -> _adr1
## ajout champs : _IDclass, _numen, _work, _mobile, _IDtuteur1, _IDtuteur2, _regime, _bourse, _delegue, _visible
## ajout clef index _key2

create table user_id (
	_ID		int unsigned not null auto_increment,			# ID de connexion
	_IDgrp		int unsigned default '1' not null,			# ID de groupe (voir table groupe)
	_IDcentre	int unsigned default '1' not null,			# ID du centre d'affectation (voir table config_centre)
	_IDclass	int unsigned not null,					# ID de la classe de l'�l�ve (voir table campus_classe)
	_numen		varchar(20) not null,					# n� identification de l'�l�ve
	_create		datetime default '2002-09-01' not null,			# date et heure de cr�ation
	_date		datetime,						# date et heure de connexion
	_lastcnx	datetime,						# date et heure de derni�re connexion
	_adm		tinyint unsigned default '1' not null,			# droit administrateur (voir table admin)
	_ident		varchar(20) not null,					# identification : le login
	_passwd		varchar(20) not null,					# mot de passe
	_name		varchar(40) not null,					# nom de la personne connect�e
	_fname		varchar(40) not null,					# pr�nom de la personne connect�e
	_sexe		enum('H', 'F', 'A') not null,				# H : Homme, F : Femme, A : Anonyme
	_title		varchar(60) not null,					# titre de la personne
	_fonction	tinytext not null,					# la fonction dans l'�tablissement
	_email		varchar(40),						# email
	_work		varchar(20),						# t�l�phone travail
	_tel		varchar(20),						# t�l�phone fixe
	_mobile		varchar(20),						# t�l�phone mobile
	_born		date null,						# ann�ee-mois-jour de naissance
	_adr1		tinytext not null,					# adresse
	_adr2		tinytext not null,					# adresse
	_cp		varchar(10),						# code postal
	_city		varchar(40),						# ville
	_signature	tinytext not null,					# signature pour les messages
	_msg		int unsigned default '0' not null,			# nbr de messages envoy�s (messure d'activit�)
	_res		int unsigned default '0' not null,			# nbr de ressources envoy�es (messure d'activit�)
	_cnx		int unsigned default '0' not null,			# nbr de connexions (mesure d'activit�)
	_IP		bigint default '0' not null,				# ID de l'@ IP de connexion
	_avatar		int unsigned default '0' not null,			# avatar
	_persistent	enum('O', 'N') default 'N' not null,			# session non limit�e dans le temps (O : Oui, N : Non)
	_chs		enum('O', 'N') default 'N' not null,			# membre du CHS (O : Oui, N : Non)
	_regime		enum('E', 'I', 'D', 'C') default 'E' not null,		# r�gime (E : Externe, I : Interne, D : 1/2 pensionnaire, C : Campus)
	_bourse		enum('O', 'N') default 'N' not null,			# Bourse d'�tudes (O : Oui, N : Non)
	_delegue	enum('O', 'N') default 'N' not null,			# D�l�gu� �l�ve (O : Oui, N : Non)
	_visible	enum('O', 'N', 'A', 'D', 'E') default 'O' not null,	# visible dans la liste des �l�ves (O : Oui, N : Non => ancien �l�ve, A : attente de validation, D : D�misionnaire, E : Exclus)
	_delay		datetime not null,					# dur�e d'inscription
	_centre		bigint unsigned default '0' not null,			# ID des centres de d�tachement (voir table config_centre)
	_IDmat		tinytext not null,					# liste des mati�re enseign�es (voir table campus)
	_lang		varchar(2) not null,					# langue de l'utilisateur
	_IDtuteur1	int unsigned default '0' not null,			# ID du tuteur (voir table user_id)
	_IDtuteur2	int unsigned default '0' not null,			# ID du tuteur (voir table user_id)
	primary key (_ID),
	unique key _key(_ident, _passwd),
	unique key _key2(_IDgrp, _IDclass, _name, _fname)
	) ENGINE = MyISAM COMMENT = "Table des identifiants de connexion des utilisateurs � l'intranet";

###############################################################################
# table des tuteurs
# ver 1.0
#

create table user_tutors (
	_index		int unsigned not null auto_increment,		# index
	_ID		int unsigned not null,				# ID de l'�l�ve
	_IDtutor	int unsigned not null,				# ID du tuteur
	primary key (_index),
	unique key _key(_ID, _IDtutor)
	) ENGINE = MyISAM COMMENT = "Table des tuteurs";

###############################################################################
# table des promotions
# ver 1.0
#
# remarque : cette table est mise � jour lors des changements de classe ou lorsque l'on bascule en ancien �l�ve

create table user_promos (
	_IDeleve	int unsigned not null auto_increment,		# ID de l'�l�ve
	_IDclass	int unsigned not null,				# ID de la classe de l'�l�ve
	_date		date not null,					# date de la promotion
	_delegue	enum('O', 'N') default 'N' not null,		# D�l�gu� �l�ve (O : Oui, N : Non)
	unique key _key(_IDeleve, _IDclass, _date)
	) ENGINE = MyISAM COMMENT = "Table des promotions";

###############################################################################
# table des groupes utilisateurs
# ver 2.0
#
# remarque : le n� _IDgrp correspond au fichier image du groupe : images/smiley/<_IDgrp>.gif
#
## modification taille champ ident : 20 -> 40

create table user_group (
	_IDgrp		int unsigned not null,				# groupe : 1 (�l�ves), 2 (enseignants), 3 (ATOSS), 4 (administration), 5 (exploitation), 6 (formateurs)
	_ident		varchar(40) not null,				# identification
	_delay		datetime not null,				# dur�e de validit� du groupe
	_hdquotas	bigint unsigned default '1024000' not null,	# quotas disques ETP + webmail par groupe (1 Mo par d�faut, 0 si illimit�)
	_IDcat		int unsigned not null,				# cat�gorie du groupe (voir table user_cat�gorie)
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (visible dans la liste des groupes)
	_lang		varchar(2) not null,				# langue du groupe
	primary key (_IDgrp, _lang),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des groupes utilisateurs";

###############################################################################
# table des droits utilisateurs
# ver 1.3
#
## modification clef unique

create table user_admin (
	_adm		tinyint unsigned not null,			# droits : 0 (bannis), 1 (utilisateur), 2 (PUU), 4 (mod�rateur), 8 (gestionnaire), 255 (big chef)
	_ident		varchar(20) not null,				# identification
	_lang		varchar(2) not null,				# langue de l'utilisateur
	primary key (_adm, _lang),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des droits utilisateurs";

###############################################################################
# table des cat�gories d'utilisateurs
# ver 1.0

create table user_category (
	_IDcat		int unsigned not null,				# cat�gorie du groupe (1 : Apprenant, 2 : Personnel, 3 : Ext�rieur)
	_ident		varchar(20) not null,				# intitul� fonction (forum, wiki, postit, ...)
	_lang		varchar(2) not null,				# langue du groupe
	primary key (_IDcat, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des cat�gories d'utilisateurs";

###############################################################################
# table des sessions de connexion des utilisateurs � l'intranet
# ver 1.3
#
# remarque : depuis PHP4, une librairie de gestion de sessions a �t� impl�ment�e...
#
## ajout champs : _action et _IP

create table user_session (
	_IDsess		varchar(10) not null,				# identifiant de session
	_lastaction	datetime not null,				# dernier acc�s
	_ID		int unsigned not null,				# ID de connexion
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (visible dans la liste des connect�s)
	_anonyme	enum('O', 'N') default 'O' not null,		# Oui ou Non (utilisateur anonyme)
	_action		enum('C', 'D') default 'C' not null,		# C : Connexion, D : D�connexion
	_IP		bigint default '0' not null,			# IP de connexion (station du posteur)
	primary key (_IDsess)
	) ENGINE = MyISAM COMMENT = "Table des sessions de connexion des utilisateurs � l'intranet";

###############################################################################
# table de la liste des controles d'acc�s des utilisateurs
# ver 1.1
#
## modification champ _IDident : unsigned int -> int

create table user_acl (
	_IDacl		int unsigned not null auto_increment,		# ID de l'acl
	_ident		varchar(20) not null,				# type de l'acl (forum, weblog, ...)
	_IDident	int not null,				# ID du type de l'acl
	_ID		int unsigned not null,				# ID utilisateur
	_date		datetime not null,				# date et heure d'invitation
	_visible	enum('O', 'N') default 'O' not null,		# liste br�l�e
	primary key (_IDacl),
	unique key _key(_ident, _IDident, _ID)
	) ENGINE = MyISAM COMMENT = "Table des ACL (Access Control List)";

###############################################################################
# table des menus personnalis�s des utilisateurs
# ver 1.0

create table user_menu (
	_ID		int unsigned not null,				# ID utilisateur
	_IDmenu		int unsigned not null,				# ID du menu
	_visible	enum('O', 'N') default 'O' not null,		# menu visible (O : Oui, N : Non)
	unique key _key(_ID, _IDmenu)
	) ENGINE = MyISAM COMMENT = "Table des menus personnalis�s des utilisateurs";

###############################################################################
# table de la personnalisation de l'intranet
# ver 1.1
#
## ajout champ _header

create table user_config (
	_IDconf		int unsigned not null,				# ID de la configuration (ID utilisateur)
	_IDtheme	int unsigned default '1' not null,		# ID du th�me choisi (voir table config_theme)
	_menu		int unsigned default '0' not null,		# positionnement des menus (0 : 2 colonnes, 1 : gauche, 2 : droite, 3 : bandeau)
	_puce		varchar(20) not null,				# type de puce des menus
	_fond		varchar(20) not null,				# image de fond des pages
	_header		varchar(20) not null,				# barre des titres
	_service	tinytext not null,				# les services autoris�s
	primary key (_IDconf)
	) ENGINE = MyISAM COMMENT = "Table de la personnalisation de l'intranet";

###############################################################################
# table des droits d'acc�s � l'intranet
# ver 1.0

create table user_denied (
	_IDcentre	int unsigned not null,				# ID du centre (voir table config_centre)
	_IDgrp		int unsigned not null,				# ID du groupe (voir table user_group)
	_dstart		date not null,					# date de rejet (d�but)
	_dend		date not null,					# date de rejet (fin)
	_hstart		time not null,					# heure de rejet (d�but)
	_hend		time not null,					# heure de rejet (fin)
	unique key _key(_IDcentre, _IDgrp)
	) ENGINE = MyISAM COMMENT = "Table des droits d'acc�s � l'intranet";

###############################################################################
# table des sauvegardes de la base de donn�es
# ver 1.1
#
## renommage table backup -> admin_backup

create table admin_backup (
	_IDbackup	int unsigned not null auto_increment,		# ID de l'@ IP
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_version	varchar(12) not null,				# version de la bdd
	_create		datetime,					# date et heure de la sauvegarde
	_update		datetime,					# date et heure de la restoration
	_size		int unsigned not null,				# taille du fichier de sauvegarde
	_table		int unsigned not null,				# nombre de tables
	primary key (_IDbackup),
	unique key _key(_create)
	) ENGINE = MyISAM COMMENT = "Table des sauvegardes de la base de donn�es";

###############################################################################
# table des imports de la base de donn�es
# ver 1.0

create table admin_import (
	_IDimport	int unsigned not null auto_increment,		# ID de l'import
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_table		varchar(20) not null,				# nom de la table affect�e
	_IDgroup	int unsigned not null,				# ID du groupe (voir table user_group)
	_date		datetime,					# date et heure de l'import
	_record		int unsigned not null,				# nombre d'enregistrments affect�s
	_ext		varchar(3) not null,				# extention du fichier d'import
	primary key (_IDimport)
	) ENGINE = MyISAM COMMENT = "Table des sauvegardes de la base de donn�es";

###############################################################################
# table des logs d'erreurs des imports
# ver 1.0

create table admin_log (
	_IDlog		int unsigned not null auto_increment,		# ID du log
	_IDimport	int unsigned not null,				# ID de l'import
	_text		mediumtext not null,				# diagnostic erreur
	primary key (_IDlog)
	) ENGINE = MyISAM COMMENT = "Table des logs d'erreurs des imports";

###############################################################################
# table des adresses IP des postes clients
# ver 1.2
#
## ajout champ _IDcentre

create table ip (
	_IP		int unsigned not null auto_increment,		# ID de l'@ IP
	_IDcentre	int unsigned not null,				# ID du centre (voir table config_centre)
	_IPv6		varchar(23) not null,				# adresse IP v6 du poste sur le LAN
	_host		varchar(40) not null,				# le nom du poste
	_visible	enum('O', 'N') default 'O' not null,		# station accessible (O : Oui, N : Non)
	primary key (_IP),
	unique key _key(_IPv6)
	) ENGINE = MyISAM COMMENT = "Table des adresses IP des postes clients";

###############################################################################
# table des adresses IP des postes distants en extranet
# ver 1.0

create table ip_remote (
	_IP		bigint not null auto_increment,			# ID de l'@ IP
	_IPv6		varchar(23) not null,				# adresse IP v6 du poste sur le LAN
	_host		varchar(50) not null,				# le nom du poste
	_visible	enum('O', 'N') default 'O' not null,		# station accessible (O : Oui, N : Non)
	primary key (_IP),
	unique key _key(_IPv6)
	) ENGINE = MyISAM COMMENT = "Table des adresses IP des postes distants en extranet";

###############################################################################
# table des adresses IP en liste br�l�e
# ver 1.0

create table ip_denied (
	_IP		int unsigned not null auto_increment,		# ID de l'@ IP
	_IPv6		varchar(23) not null,				# adresse IP v6
	_date		datetime not null,				# date et heure de la derni�re mise � jour
	_visible	enum('O', 'N') default 'O' not null,		# station accessible (O : Oui, N : Non)
	primary key (_IP),
	unique key _key(_IPv6)
	) ENGINE = MyISAM COMMENT = "Table des adresses IP en liste br�l�e";

###############################################################################
# table des log des erreurs d'autorisation sur les modules
# ver 1.0

create table ip_logerr (
	_auto		int unsigned not null auto_increment,		# ID du log
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date et heure du log
	_adm		tinyint unsigned default '1' not null,		# droit administrateur (voir table admin)
	_name		varchar(80) not null,				# nom de la personne connect�e
	_item		int unsigned not null,				# ID du module
	_cmde		varchar(20) not null,				# commande
	primary key (_auto)
	) ENGINE = MyISAM COMMENT = "Table des log des erreurs des autorisations sur les modules";

###############################################################################
# table des logs de connexion � l'intranet
# ver 1.3
#
## ajout champ _ident
## modif champ _action (E + X)

create table stat_log (
	_date		datetime not null,				# date et heure du log
	_ID		int unsigned not null,				# ID de connexion
	_ident		varchar(20) not null,				# id utilisateur sur �chec d'identification
	_IPv6		varchar(23) not null,				# adresse IP v6 du poste sur le LAN
	_action	enum('C', 'D', 'E', 'X') not null			# action : C (Connect), D (Disconnect), E (Expiration), X (Erreur identification)
	) ENGINE = MyISAM COMMENT = "Table des logs de connexion � l'intranet";

###############################################################################
# table des statistiques par page
# ver 1.1
#
## rajout champ _IP

create table stat_page (
	_date		datetime not null,				# date et heure d'acc�s � la page
	_ident		varchar(80) not null,				# nom de la page
	_IDgrp		int unsigned not null,				# ID de groupe : voir table groupe
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint default '0' not null			# ID de l'IP (station du posteur)
	) ENGINE = MyISAM COMMENT = "Table des statistiques par page";

###############################################################################
# table des serveurs ftp
# ver 1.4
#
## ajout champ _lock

create table ftp (
	_IDftp		int unsigned not null auto_increment,		# ID du serveur ftp
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_ident		varchar(40) not null,				# nom du point de montage
	_path		varchar(255) not null,				# chemin du point de montage
	_texte		tinytext not null,				# description du serveur
	_open		datetime not null,				# date et heure d'acc�s pour CCF (inactiv� si 0)
	_close		datetime not null,				# date et heure d'acc�s pour CCF (inactiv� si 0)
	_sort		enum('C', 'D') default 'C' not null,		# tri des noms de fichiers (C : Croissant, D : D�croissant)
	_lock		int unsigned default '1' not null,		# d�lai du verrou en heures
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (visible dans la liste des pts de montage)
	_lang		varchar(2) not null,				# langue du ftp
	primary key (_IDftp, _lang),
	unique key _ident(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des serveurs ftp";

###############################################################################
# table des r�pertoires ftp
# ver 1.1
#

create table ftp_data (
	_IDdata		int unsigned not null auto_increment,		# ID du r�pertoire
	_IDparent	int unsigned not null,				# ID du r�pertoire parent (0 si racine)
	_IDftp		int unsigned not null,				# ID du serveur ftp
	_ident		varchar(40) not null,				# nom du r�pertoire
	_date		datetime not null,				# date et heure de cr�ation
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDmod		int unsigned not null,				# ID du propri�taire du r�pertoire
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_open		datetime not null,				# date et heure d'acc�s pour CCF (inactiv� si 0)
	_close		datetime not null,				# date et heure d'acc�s pour CCF (inactiv� si 0)
	_private	enum('O', 'N') default 'N' not null,		# r�pertoire priv� (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# r�pertoire accessible (O : Oui, N : Non)
	primary key (_IDdata),
	unique key _key(_IDparent, _ident)
	) ENGINE = MyISAM  COMMENT = "Table des r�pertoires ftp";

###############################################################################
# table des documents ftp
# ver 1.1
#

create table ftp_items (
	_IDitem		int unsigned not null auto_increment,		# ID du document
	_IDdata		int unsigned not null,				# ID du r�pertoire (0 si racine)
	_IDftp		int unsigned not null,				# ID du serveur ftp
	_date		datetime not null,				# date et heure de cr�ation
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_ident		varchar(40) not null,				# nom du document
	_ver		int unsigned default '1' not null,		# version du document
	_IDmod		int unsigned not null,				# ID du propri�taire du document
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_private	enum('O', 'N') default 'N' not null,		# document priv� (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# r�pertoire accessible (O : Oui, N : Non)
	primary key (_IDitem),
	unique key _key(_IDdata, _ident)
	) ENGINE = MyISAM  COMMENT = "Table des documents ftp";

###############################################################################
# table des notes sur les ressources ftp
# ver 2.0
#
## renommage table resource_note -> ftp_note

create table ftp_note (
	_IDnote		int unsigned not null auto_increment,		# ID de la note
	_ID		int unsigned not null,				# ID de connexion (posteur du message)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de cr�ation du message
	_modify		datetime not null,				# date de modification (utilis� pour le verrou)
	_path		varchar(255) not null,				# chemin + nom de fichier
	_text		mediumtext not null,				# note associ�e au fichier
	_lock		int default '0' not null,			# verrou pour doc collaboratif (0 : pas de partage, -1 : d�verroulli�, > 0 : ID de l'utilisateur)
	primary key (_IDnote),
	unique key _key(_path)
	) ENGINE = MyISAM COMMENT = "Table des notes sur les ressources ftp";

###############################################################################
# table des ressources
# ver 1.3
#
## rajout champs _IDlicense et _color

create table resource (
	_IDres		int unsigned not null,				# ID de ressource
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur du r�pertoire)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_titre		varchar(30) not null,				# intitul� des ressources
	_texte		tinytext not null,				# description des ressources
	_IDlicense	int unsigned default '11' not null,		# ID du type de licence (voir table resource_license)
	_color	enum('O', 'N') default 'N' not null,		# utilisation d'un code couleur pour le partage de ressources (O : Oui, N : Non)
	_internal	enum('O', 'N') default 'N' not null,		# utilis� en interne par l'application (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# ressource visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue des ressources
	primary key (_IDres, _lang),
	unique key _key(_titre, _lang)
	) ENGINE = MyISAM COMMENT = "Table des ressources";

###############################################################################
# table des cat�gories de ressources
# ver 1.9
#
## rajout champ _share

create table resource_data (
	_IDcat		int unsigned not null auto_increment,		# ID de cat�gorie
	_IDres		int unsigned not null,				# ID de ressource
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_nom		varchar(30) not null,				# intitul� de la cat�gorie
	_texte		tinytext not null,				# description de la cat�gorie
	_email		enum('0', '1', '2', '3') default '0' not null,	# avertissement sur d�p�t de ressource (0 : aucun, 1 : admin seulement, 2 : Post-it, 3 : Email)
	_lock		int unsigned default '1' not null,		# d�lai du verrou en heures
	_rss		enum('O', 'N') default 'N' not null,		# envoi par flux rss (O : Oui, N : Non)
	_PJ		int unsigned default '1' not null,		# nombre de fichiers � transferrer
	_share	enum('O', 'N') default 'O' not null,			# partage multicentres (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# cat�gorie visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue des ressources
	primary key (_IDcat),
	unique key _key(_IDres, _nom, _lang)
	) ENGINE = MyISAM COMMENT = "Table des cat�gories de ressources";

###############################################################################
# table des r�pertoires des ressources
# ver 1.2
#
## rajout champ _IDroot

create table resource_root (
	_IDroot		int unsigned not null auto_increment,		# ID du r�pertoire
	_IDparent	int unsigned not null,				# ID du r�pertoire parent (0 si racine)
	_IDcentre	int default '1' not null,			# ID du centre
	_IDgroup	int default '0' not null,			# s�lecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDcat		int unsigned not null,				# ID de la cat�gorie de la ressource
	_ID		int unsigned not null,				# ID du propri�taire du r�pertoire
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date et heure de cr�ation
	_titre		varchar(40) not null,				# nom du r�pertoire
	_IDmod		int unsigned not null,				# ID du mod�rateur du r�pertoire
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_private	enum('O', 'N') default 'N' not null,		# r�pertoire priv� (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# r�pertoire accessible (O : Oui, N : Non)
	primary key (_IDroot),
	unique key _key(_IDparent, _IDcat, _IDgroup, _titre)
	) ENGINE = MyISAM  COMMENT = "Table des r�pertoires des ressources";

###############################################################################
# table des articles des ressources
# ver 2.9
#
## modification champs : _level unsigned int -> int

create table resource_items (
	_IDitem		int unsigned not null auto_increment,		# ID de ressource
	_IDroot		int unsigned default '0' not null,		# ID du r�pertoire de la resource
	_IDgroup	int default '0' not null,			# s�lecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDlicense	int unsigned default '1' not null,		# ID du type de licence (voir table resource_license)
	_date		datetime not null,				# date de cr�ation de la ressource
	_modify		datetime not null,				# date de modification (utilis� pour le verrou)
	_ID		int unsigned not null,				# ID de connexion (qui a cr�� la ressource)
	_IDgrprd	text not null,					# destinataires de la ressource (voir table groupe ou classe)
	_IDcentre	text not null,					# ID des centres qui partagent la ressource
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDcat		int unsigned not null,				# ID de la cat�gorie de la ressource
	_title		varchar(80) not null,				# titre de la ressource
	_file		varchar(80) not null,				# nom du fichier ressource
	_size		int unsigned not null,				# taille du fichier ressource
	_texte		tinytext not null,				# description du fichier ressource
	_note		mediumtext not null,				# note associ�e � la ressource
	_ver		varchar(10) default '1.0' not null,		# version du fichier ressource
	_count		int unsigned default '0' not null,		# nbr de t�l�chargements (messure d'activit�)
	_level		int default '0' not null,			# priorit� (< 0 : niveau de difficult� des exercices (P�dago), > 0 niveau d'importance des documents)
	_valid		datetime not null,				# date de validit� de la ressource (illimit� si 0000-00-00)
	_comment	enum('O', 'N') default 'O' not null,		# autoriser les commentaires (O : Oui, N : Non)
	_lock		int default '0' not null,			# verrou pour doc collaboratif (0 : pas de partage, -1 : d�verroulli�, > 0 : ID de l'utilisateur)
	_usability	int unsigned default '0' not null,		# niveau d'utilisabilit� (0 : ind�fini, 1 : Visuel, 2 : Auditif, 4 : Kinesth�sique))
	_visible	enum('O', 'N') default 'O' not null,		# article publiable (O : Oui, N : Non)
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des articles des ressources";

###############################################################################
# table des articles des ressources en ligne
# ver 1.0

create table resource_online (
	_IDitem		int unsigned not null auto_increment,		# ID de ressource
	_IDlicense	int unsigned default '1' not null,		# ID du type de licence (voir table resource_license)
	_date		datetime not null,				# date de cr�ation de la ressource
	_update		datetime not null,				# date de modification de la ressource
	_ID		int unsigned not null,				# ID de connexion (qui a cr�� la ressource)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDgrprd	text not null,					# destinataires de la ressource (voir table groupe ou classe)
	_IDtype		text not null,					# types de ressource (voir table ressource_type)
	_IDcat		text not null,					# ID des cat�gories de la ressource (voir table campus)
	_IDfunc		text not null,					# types de fonctions associ�es � la ressource (voir table ressource_function)
	_title		varchar(80) not null,				# titre de la ressource
	_texte		mediumtext not null,				# description de la ressource
	_author		tinytext not null,				# auteur de la ressource
	_tags		tinytext not null,				# mots clef
	_url		varchar(128) not null,				# URL
	_lang		varchar(6) not null,				# langue du site
	_break		enum('O', 'N') default 'N' not null,		# lien bris� (O : Oui, N : Non)
	_count		int unsigned default '0' not null,		# nbr de t�l�chargements (messure d'activit�)
	_visible	enum('O', 'N') default 'O' not null,		# article publiable (O : Oui, N : Non)
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des articles des ressources";

###############################################################################
# table des types de ressources
# ver 1.1
#
## ajout champ _lang
## modification clef primaire

create table resource_type (
	_IDtype		int unsigned not null,				# ID du type de ressource
	_ident		varchar(40) not null,				# intitul� du type de ressource
	_visible	enum('O', 'N') default 'O' not null,		# intitul� visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDtype, _lang)
	) ENGINE = MyISAM COMMENT = "Table des types de ressources";

###############################################################################
# table des fonctions associ�es aux ressources
# ver 1.0
#
## ajout champ _lang
## modification clef primaire

create table resource_function (
	_IDfunc		int unsigned not null,				# ID de la fonction
	_ident		varchar(40) not null,				# intitul� de la fonction
	_visible	enum('O', 'N') default 'O' not null,		# intitul� visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDfunc, _lang)
	) ENGINE = MyISAM COMMENT = "Table des types de ressources";

###############################################################################
# table des licences des ressources
# ver 1.1
#
## ajout champ _lang
## modification clef primaire

create table resource_license (
	_IDlicense	int unsigned not null,				# ID de la licence
	_titre		varchar(20) not null,				# titre de la licence
	_texte		varchar(80) not null,				# description de la licence
	_visible	enum('O', 'N') default 'O' not null,		# licence visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDlicense, _lang)
	) ENGINE = MyISAM COMMENT = "Table des licences des ressources";

###############################################################################
# table des commentaires des ressources
# ver 1.0

create table resource_post (
	_IDmsg		int unsigned not null auto_increment,		# ID de l'article
	_IDitem		int unsigned not null,				# ID de ressource
	_ID		int unsigned not null,				# ID de connexion (posteur du message)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de cr�ation du message
	_texte		mediumtext not null,				# texte du message
	primary key (_IDmsg)
	) ENGINE = MyISAM COMMENT = "Table des commentaires des ressources";

###############################################################################
# table du cartable �lectronique
# ver 1.0

create table resource_bag (
	_IDitem		int unsigned not null auto_increment,		# ID de ressource
	_ID		int unsigned not null,			# ID de connexion
	_date		datetime not null,				# date de d�pot dans le cartable
	_title		varchar(80) not null,				# titre de la ressource
	_file			varchar(255) not null,				# chemin du fichier ressource
	primary key (_IDitem),
	unique key _key(_ID, _file)
	) ENGINE = MyISAM COMMENT = "Table du cartable �lectronique";

###############################################################################
# table des Espaces de Travail Partag� (ETP)
# ver 1.2
#
## ajout des champs _date, _ID, _IP

create table etp (
	_IDetp		int unsigned not null auto_increment,		# ID de l'Espace de Travail Partag�
	_IDcentre	int unsigned default '1' not null,		# ID du centre (voir table config_centre)
	_IDgrp		int unsigned default '0' not null,		# ID du groupe (voir table groupe)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur ou propri�taire)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_texte		tinytext not null,				# description de l'ETP
	_maxsize	bigint unsigned default '10240000' not null,	# espace disque autoris� (10 Mo par d�faut, 0 si illimit�)
	_size		bigint unsigned default '0' not null,		# espace disque occup�
	_date		datetime not null,				# date et heure du dernier acc�s
	_ID		int unsigned not null,				# ID de l'utilisateur qui a acc�der � l'ETP
	_IP		bigint default '0' not null,			# ID de l'IP (station de l'utilisateur ci-dessus)
	_visible	enum('O', 'N') default 'O' not null,		# ETP ouvert (O : Oui, N : Non)
	primary key (_IDetp)
	) ENGINE = MyISAM COMMENT = "Table des Espaces de Travail Partag�";

###############################################################################
# table des r�pertoires des ETP
# ver 1.0

create table etp_data (
	_IDdata		int unsigned not null auto_increment,		# ID du r�pertoire
	_IDparent	int unsigned not null,				# ID du r�pertoire parent (0 si racine)
	_IDetp		int unsigned not null,				# ID de l'Espaces de Travail Partag�
	_titre		varchar(40) not null,				# nom du r�pertoire
	_date		datetime not null,				# date et heure de cr�ation
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDmod		int unsigned not null,				# ID du propri�taire du r�pertoire
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_private	enum('O', 'N') default 'N' not null,		# r�pertoire priv� (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# r�pertoire accessible (O : Oui, N : Non)
	primary key (_IDdata),
	unique key _key(_IDparent, _IDetp, _titre)
	) ENGINE = MyISAM  COMMENT = "Table des r�pertoires des ETP";

###############################################################################
# table des documents des ETP
# ver 1.1
#
## ajout champ _note

create table etp_items (
	_IDitem		int unsigned not null auto_increment,		# ID du document
	_IDdata		int unsigned not null,				# ID du r�pertoire (0 si racine)
	_IDetp		int unsigned not null,				# ID de l'Espaces de Travail Partag�
	_IDlicense	int unsigned default '1' not null,		# ID du type de licence (voir table resource_license)
	_date		datetime not null,				# date et heure de cr�ation
	_update		datetime not null,				# date et heure de modification
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDmod		int unsigned not null,				# ID du propri�taire du document
	_ID		int unsigned default '0' not null,		# ID de la personne qui a modifi� le document
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_titre		varchar(80) not null,				# titre du fichier
	_file		varchar(80) not null,				# nom du fichier
	_size		int unsigned not null,				# taille du fichier
	_ver		int unsigned default '1' not null,		# version du fichier
	_texte		tinytext not null,				# description du fichier
	_note		mediumtext not null,				# note associ�e au document
	_private	enum('O', 'N') default 'N' not null,		# document priv� (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# document visible (O : Oui, N : Non)
	primary key (_IDitem),
	unique key _key(_IDdata, _IDetp, _file)
	) ENGINE = MyISAM  COMMENT = "Table des documents des ETP";

###############################################################################
# table des acc�s dans les ETP
# ver 1.0

create table etp_vu (
	_IDetp		int unsigned not null,				# ID de l'ETP
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# IP de la station
	_date		datetime not null,				# date et heure de lecture
	unique key _key(_IDetp, _ID)
	) ENGINE = MyISAM COMMENT = "Table de log des acc�s dans les ETP";

###############################################################################
# table des logs des ressources t�l�charg�es
# ver 1.2
#
## ajout champ _IP

create table download (
	_IDdown		int unsigned not null,				# ID du download
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# IP de connexion
	_count		int unsigned default '0' not null,		# le nombre de t�l�chargements
	_date		datetime not null,				# date et heure du dernier t�l�chargement
	unique key _key(_IDdown, _ID)
	) ENGINE = MyISAM COMMENT = "Table des ressources t�l�charg�es";

###############################################################################
# table des ressources � t�l�charger
# ver 1.2

create table download_data (
	_IDdown		int unsigned not null auto_increment,		# ID du download
	_file		varchar(255) not null,				# fichier � t�l�charger
	_count		int unsigned default '0' not null,		# le nombre de t�l�chargements
	_date		datetime not null,				# date et heure du dernier t�l�chargement
	primary key (_IDdown),
	unique key _key(_file)
	) ENGINE = MyISAM COMMENT = "Table des ressources � t�l�charger";

###############################################################################
# table des fichiers temporaires
# ver 1.0

create table download_tmp (
	_IDfile		int unsigned not null auto_increment,		# ID du fichier
	_file		varchar(255) not null,				# fichier temporaire
	_date		datetime not null,				# date et heure du d�p�t
	primary key (_IDfile),
	unique key _key(_file, _date)
	) ENGINE = MyISAM COMMENT = "Table des fichiers temporaires";

###############################################################################
# table du webmail
# ver 1.0

create table webmail (
	_IDpost		int unsigned not null auto_increment,		# ID du post-it
	_ID		int unsigned not null,				# ID utilisateur
	_IP		bigint default '0' not null,			# ID de l'IP (station de l'exp�diteur)
	_date		datetime not null,				# date et heure de l'exp�dition du message
	_IDcentre	int unsigned default '1' not null,		# ID des centres (voir table config_centre)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_titre		varchar(80) not null,				# intitul� du message
	_texte		mediumtext not null,				# texte du message				
	_pj		enum('O', 'N') default 'N' not null,		# Pi�ce Jointe (O : Oui, N : Non)
	_priority	int unsigned not null,				# priorit� du m�l
	_total		int unsigned not null,				# total des envois
	primary key (_IDpost)
	) ENGINE = MyISAM COMMENT = "Table des messages du webmail";

###############################################################################
# table des carnets d'adresses
# ver 1.0

create table email_address (
	_IDadd		int unsigned not null auto_increment,		# ID du carnet
	_ID		int unsigned not null,				# ID de connexion
	_name		varchar(40) not null,				# nom de la personne
	_fname		varchar(40) not null,				# pr�nom de la personne
	_sexe		enum('H', 'F', 'A') not null,			# H : Homme, F : Femme, A : Anonyme
	_titre		varchar(40) not null,				# titre de la personne
	_fonction	tinytext not null,				# la fonction dans le lyc�e
	_company	varchar(40) not null,				# institution
	_adresse	varchar(60) not null,				# adresse professionnelle
	_cp		varchar(5) not null, 				# code postal du contact
	_ville 		varchar(40) not null, 				# ville du contact
	_tel		varchar(20) not null,				# t�l�phone professionnel
	_fax		varchar(20) not null,				# fax professionnel
	_email		varchar(40),					# email professionnel
	_web		varchar(60) not null,				# site web de l'institution
	primary key (_IDadd)
	) ENGINE = MyISAM COMMENT = "Table des carnet d'adresses";

###############################################################################
# table des documents wiki
# ver 1.5
#
## modification champ : _ver int -> varchar

create table wiki (
	_IDpage		int unsigned not null auto_increment,		# ID de la page
	_tag		varchar(80) not null,				# tag du groupe de pages
	_date		datetime not null,				# date et heure de cr�ation
	_owner		varchar(40) not null,				# nom du propri�taire du document
	_author		varchar(40) not null,				# nom de l'auteur du document
	_ver		varchar(10) not null,				# version du document (n�item.ID dans arboresence)
	_title		varchar(80) not null,				# titre du document
	_text		mediumtext not null,				# texte du document
	_raw		enum('O', 'N') default 'O' not null,		# texte brut pour syntaxe wiki (O : Oui, N : Non)
	_banner		mediumtext not null,				# texte avant le paragraphe
	_footer		mediumtext not null,				# texte apr�s le paragraphe
	_lock		enum('O', 'N') default 'N' not null,		# page verrouill�e (O : Oui, N : Non)
	_current	enum('O', 'N') default 'O' not null,		# page courrante (O : Oui, N : Non)
	primary key (_IDpage)
	) ENGINE = MyISAM  COMMENT = "Table des pages wiki";

###############################################################################
# table du r�pertoire des pages wiki
# ver 1.3
#
## ajout champs : _lang

create table wiki_page (
	_IDpage		int unsigned not null auto_increment,		# ID du r�pertoire de page
	_IDparent	int unsigned not null,				# ID du r�pertoire parent (0 si racine)
	_IDgroup	int default '0' not null,			# s�lecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_ident		varchar(80) not null,				# nom du r�pertoire
	_date		datetime not null,				# date et heure de cr�ation
	_update		datetime not null,				# date et heure de derni�re modification
	_IDmod		int unsigned not null,				# ID du propri�taire du r�pertoire
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_raw		enum('O', 'N') default 'O' not null,		# texte brut pour syntaxe wiki (O : Oui, N : Non)
	_PJ		int unsigned default '0' not null,		# nombre de pi�ces jointes
	_visible	enum('O', 'N') default 'O' not null,		# r�pertoire accessible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue des liens
	primary key (_IDpage),
	unique key _key(_IDgroup, _ident)
	) ENGINE = MyISAM  COMMENT = "Table du r�pertoire des pages wiki";

###############################################################################
# table des Pi�ces Jointes des pages wiki
# ver 1.0

create table wiki_pj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_tag		varchar(80) not null,				# tag du groupe de pages (voir table wiki)
	_file		varchar(80) not null,				# nom du fichier en PJ
	_size		int unsigned not null,				# taille du fichier
	_text		tinytext not null,				# description du fichier en PJ
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ des pages wiki";

###############################################################################
# table des liens
# ver 1.4
#
## modification taille champ _url : 128 -> 255

create table link (
	_IDlink		int unsigned not null auto_increment,		# ID du lien
	_IDdata		int unsigned default '0' not null,		# ID du dossier (0 si dossier racine)
	_IDgroup	int default '0' not null,			# s�lecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDgrprd	int unsigned default '255' not null,		# ID des lecteurs (voir table groupe)
	_titre		varchar(80) not null,				# titre du site
	_url		varchar(255) not null,				# URL
	_texte		tinytext not null,				# description du lien
	_country	varchar(6) not null,				# langue du site
	_visible	enum('O', 'N') default 'O' not null,		# lien ouvert (O : Oui, N : Non)
	_IDlicense	int unsigned default '0' not null,		# type de licence
	_lang		varchar(2) not null,				# langue des liens
	primary key (_IDlink)
	) ENGINE = MyISAM COMMENT = "Table des liens";

###############################################################################
# table des r�pertoires des liens
# ver 1.3
#
## modification clef unique

create table link_data (
	_IDdata		int unsigned not null auto_increment,		# ID des r�pertoires
	_IDparent	int unsigned default '0' not null,		# ID du r�pertoire parent
	_IDgroup	int default '0' not null,			# s�lecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDmod		int unsigned default '0' not null,		# ID du mod�rateur
	_titre		varchar(80) not null,				# intitul� du r�pertoire
	_texte		tinytext not null,				# description du r�pertoire
	_visible	enum('O', 'N') default 'O' not null,		# r�pertoire ouvert (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue des liens
	primary key (_IDdata),
	unique key (_IDparent, _IDgroup, _titre, _lang)
	) ENGINE = MyISAM COMMENT = "Table des r�pertoires des liens";

###############################################################################
# table des absences
# ver 1.4
#
## rajout champs : _autoval, _email

create table absent (
	_IDcentre	int unsigned default '1' not null,		# ID du centre
	_IDgrp		int unsigned not null,				# ID des groupes (voir table groupe)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_template	varchar(20) not null,				# nom du fichier template des email
	_sms		varchar(20) not null,				# nom du fichier template des sms
	_display	enum('D', 'W', 'M') default 'D' not null,	# affichage par d�faut (D : Journalier, W : hebdo, M : mensuel)
	_autoval	enum('O', 'N') default 'O' not null,		# validation automatique des absences (O : Oui, N : Non)
	_email		enum('-', 'P', 'E') default '-' not null,	# email pour avertissement (- : aucun, P : Post-it, E : Email)
	unique key _key(_IDcentre, _IDgrp)
	) ENGINE = MyISAM COMMENT = "Table des absences";

###############################################################################
# table des motifs des absences
# ver 1.2
#
## suppression clef unique

create table absent_data (
	_IDdata		int unsigned not null,				# ID du motif
	_texte		varchar(40) not null,				# intitul� du motif
	_visible	enum('O', 'N') default 'N' not null,		# motif visualisable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	unique key _key(_IDdata, _lang)
	) ENGINE = MyISAM COMMENT = "Table des motifs des absences";

###############################################################################
# table des annonces des absences
# ver 1.6
#
## rajout champs : _valid, _file, _comment

create table absent_items (
	_IDitem		int unsigned not null auto_increment,		# ID de l'absence
	_IDdata		int unsigned default '1' not null,		# ID du motif de l'absence (voir table absent_data)
	_IDctn		int default '0' not null,			# ID de l'article du CTN (0 pour absence groupe, < 0 si apel hors classe)
	_ID		int unsigned not null,				# ID de l'auteur
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de l'enregistrement de l'annonce
	_IDgrp		int unsigned not null,				# ID des groupes (voir table groupe)
	_IDabs		int unsigned not null,				# ID de l'absent (ou classe si _IDctn = 0)
	_start		datetime,					# date de d�but de l'absence
	_end		datetime,					# date de fin de l'absence
	_texte		tinytext not null,				# texte de l'absence				
	_comment	tinytext not null,				# commentaire sur une absence				
	_display	enum('O', 'N') default 'O' not null,		# afficher le texte (O : Oui, N : Non)
	_calendar	enum('O', 'N') default 'N' not null,		# afficher dans le calendrier (O : Oui, N : Non)
	_delay		enum('0', '1') default '0' not null,		# affichage (0 : diff�r�, 1 : imm�diat)
	_email		datetime,					# date d'envoie de l'email (aux parents)
	_sms		datetime,					# date d'envoie du sms (aux parents)
	_IDmod		int unsigned default '0' not null,		# ID du validateur (autorisation � rentrer en cours)
	_isok		datetime,					# date d'autorisation � rentrer en cours
	_visible	enum('O', 'N') default 'N' not null,		# afficher sur page d'accueil (O : Oui, N : Non)
	_valid		enum('O', 'N', 'A') default 'A' not null,	# demande accept�e (O : Oui, N : Non, A : attente)
	_file		varchar(40) not null,				# justificatif en PJ
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des annonces des absences";

###############################################################################
# table des passages � l'infirmerie
# ver 1.0

create table absent_sick (
	_IDsick		int unsigned not null auto_increment,		# ID du passage
	_IDcentre	int unsigned default '1' not null,		# ID du centre
	_IDclass	int unsigned not null,				# ID de la classe
	_IDeleve	int unsigned not null,				# ID de l'�l�ve
	_IDexp		int unsigned not null,				# ID de l'exp�diteur (0 si pr�sentation spontann�e)
	_IPexp		bigint default '0' not null,			# ID de l'IP (station de l'exp�diteur)
	_start		datetime,					# date de d�but de rendu � l'infirmerie
	_ID		int unsigned not null,				# ID de l'auteur
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_end		datetime,					# date de d�part de l'infirmerie
	_IDmotif	int unsigned not null,				# ID du motif
	_text		tinytext not null,				# commentaires				
	primary key (_IDsick)
	) ENGINE = MyISAM COMMENT = "Table des passages � l'infirmerie";

###############################################################################
# table des motifs des passages � l'infirmerie
# ver 1.0

create table absent_motif (
	_IDmotif	int unsigned not null,				# ID du motif
	_text		varchar(40) not null,				# intitul� du motif
	_lang		varchar(2) not null,				# langue utilis�e
	unique key _key(_IDmotif, _lang)
	) ENGINE = MyISAM COMMENT = "Table des motifs des passages � l'infirmerie";

###############################################################################
# table de la gestion du Cahier Hygi�ne et S�curit�
# ver 1.1
#
## ajout champs _warnmodo et _warnuser

create table chs (
	_IDcentre	int unsigned default '1' not null,		# ID du centre
	_IDmod		int unsigned default '0' not null,		# ID du mod�rateur
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_warnmodo	enum('O', 'N') default 'N' not null,		# avertir le mod�rateur des nouveaux posts (O : Oui, N : Non)
	_warnuser	enum('O', 'N') default 'N' not null,		# avertir l'utilisateur d'une r�ponse (O : Oui, N : Non)
	unique key _key(_IDcentre)
	) ENGINE = MyISAM COMMENT = "Table de la gestion du Cahier Hygi�ne et S�curit�";

###############################################################################
# table du Cahier Hygi�ne et S�curit�
# ver 1.0

create table chs_items (
	_IDitems	int unsigned not null auto_increment,		# ID du commentaire
	_IDcentre	int unsigned default '1' not null,		# ID du centre (voir table config_centre)
	_ID1		int unsigned not null,				# ID de l'auteur
	_IP1		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date1		datetime,					# date et heure de l'enregistrement de l'annonce
	_titre		varchar(40) not null,				# titre du commentaire (en principe le lieu, batiment, etc...)
	_note1		tinytext not null,				# observations et suggestions
	_ID2		int unsigned not null,				# ID de l'auteur
	_IP2		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date2		datetime,					# date et heure de l'enregistrement de l'annonce
	_todo		date,						# date de r�alisation pr�vue u effective
	_note2		tinytext not null,				# mesures prises
	_priority	enum('O', 'N') default 'N' not null,		# danger grave et imminent (O : Oui, N : Non)
	primary key (_IDitems)
	) ENGINE = MyISAM COMMENT = "Table du Cahier Hygi�ne et S�curit�";

###############################################################################
# table de la gestion des incidents techniques
# ver 1.0

create table support (
	_IDcentre	int unsigned default '1' not null,		# ID du centre
	_IDmod		int unsigned default '0' not null,		# ID du mod�rateur
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_warnmodo	enum('O', 'N') default 'N' not null,		# avertir le mod�rateur des nouveaux posts (O : Oui, N : Non)
	_warnuser	enum('O', 'N') default 'N' not null,		# avertir l'utilisateur d'une r�ponse (O : Oui, N : Non)
	unique key _key(_IDcentre)
	) ENGINE = MyISAM COMMENT = "Table de la gestion des incidents techniques";

###############################################################################
# table du Cahier des incidents techniques
# ver 1.0

create table support_items (
	_IDitems	int unsigned not null auto_increment,		# ID du commentaire
	_IDcentre	int unsigned default '1' not null,		# ID du centre (voir table config_centre)
	_IDdata	int unsigned default '1' not null,		# ID du type d'indicent (voir table support_data)
	_ID1		int unsigned not null,				# ID de l'auteur
	_IP1		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date1		datetime,					# date et heure de l'enregistrement de l'annonce
	_titre		varchar(40) not null,				# titre du commentaire (en principe le lieu, batiment, etc...)
	_note1		tinytext not null,				# observations et suggestions
	_ID2		int unsigned not null,				# ID de l'auteur
	_IP2		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date2		datetime,					# date et heure de l'enregistrement de l'annonce
	_todo		date,						# date de r�alisation pr�vue u effective
	_note2		tinytext not null,				# mesures prises
	_priority	enum('O', 'N') default 'N' not null,		# danger grave et imminent (O : Oui, N : Non)
	primary key (_IDitems)
	) ENGINE = MyISAM COMMENT = "Table du Cahier des incidents techniques";

###############################################################################
# table des intitul�s des types des incidents techniques
# ver 1.0

create table support_data (
	_IDdata		int unsigned not null,				# ID du type d'incident
	_title		varchar(40) not null,				# intitul� de l'incident
	_lang		varchar(2) not null,				# langue utilis�e
	unique key (_IDdata, _lang)
	) ENGINE = MyISAM COMMENT = "Table des intitul�s des types des incidents techniques";

###############################################################################
# table de la gestion du chat
# ver 1.3
#
## ajout champs _refresh, _maxmsg et _maxsize

create table chat (
	_IDchat		int unsigned not null auto_increment,		# ID du salon du chat
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_start		time not null,					# heure ouverture du salon
	_end		time not null,					# heure fermeture du salon
	_title		varchar(40) not null,				# intitul� du salon
	_refresh	int unsigned default '1' not null,		# temps de rafraichissement en s
	_maxmsg		int unsigned default '15' not null,		# nombre de messages maximum envoy�s
	_maxsize	int unsigned default '10' not null,		# taille maximum du fichier de sauvegarde en ko (un par salle)
	_visible	enum('O', 'N') default 'O' not null,		# chat ouvert (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e pour la base de donn�es
	primary key (_IDchat),
	unique key _key(_title, _lang)
	) ENGINE = MyISAM COMMENT = "Table de la gestion du chat";

###############################################################################
# table des r�sultats aux examens
# ver 1.0

create table exam (
	_IDexam		int unsigned not null auto_increment,		# ID de l'examen
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_IDcentre	int unsigned default '1' not null,		# ID du centre
	_year		int unsigned not null,				# ann�e de promotion
	_title		varchar(40) not null,				# intitul� de l'examen
	_IDclass	int unsigned default '0' not null,		# ID de la classe
	_visible	enum('O', 'N') default 'O' not null,		# r�sultats ouvert (O : Oui, N : Non)
	primary key (_IDexam),
	unique key _key(_year, _title)
	) ENGINE = MyISAM COMMENT = "Table des r�sultats aux examens";

###############################################################################
# table des inscriptions aux examens
# ver 1.0

create table exam_data (
	_IDdata		int unsigned not null auto_increment,		# ID de l'inscription
	_IDexam		int unsigned default '1' not null,		# ID de l'examen
	_IDeleve	int unsigned not null,				# ID de l'�l�ve
	_IDitem		int unsigned not null,				# ID du r�sultat
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table des inscriptions aux examens";

###############################################################################
# table des intitul�s des r�sultats aux examens
# ver 1.2
#
## suppression clef unique

create table exam_items (
	_IDitem		int unsigned not null,				# ID de l'intitul�
	_title		varchar(40) not null,				# intitul� du r�sultat
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDitem, _lang)
	) ENGINE = MyISAM COMMENT = "Table des intitul�s des r�sultats aux examens";

###############################################################################
# table des listes des edt
# ver 1.2
#
## suppression clef unique

create table edt (
	_IDedt		int unsigned not null,				# ID de la liste edt
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_titre		varchar(40) not null,				# intitul� de l'edt
	_IDweek		int unsigned default '0' not null,		# index des jours de la semaine (1 : Lundi, 2 : Mardi, ...)
	_horaire	tinytext not null,				# les horaires (format d�limit� par ;)
	_visible	enum('O', 'N') default 'O' not null,		# r�servation publiable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDedt, _lang)
	) ENGINE = MyISAM COMMENT = "Table des listes des emplois du temps";

###############################################################################
# table des emplois du temps
# ver 1.2
#
## rajout champs _group

create table edt_data (
	_IDdata		int unsigned not null,		# ID de l'edt
	_IDedt		int unsigned not null,				# ID du type de l'edt
	_IDcentre	int unsigned not null,				# ID du centre (voir table config_centre)
	_IDmat		int unsigned not null,				# ID de la mati�re
	_IDclass	int unsigned not null,				# ID de la classe
	_IDitem		int unsigned not null,				# ID de la salle
	_ID		int unsigned not null,				# ID de l'enseignant (voir table connexion)
	_semaine	enum('0', '1', '2') default '0' not null,	# semaine du cours (0 : toutes, 1 : S1, 2 : S2)
	_group		enum('0', '1', '2') default '0' not null,	# groupe (0 : classe enti�re, 1 : G1, 2 : G2)
	_jour		int unsigned default '0' not null,		# jour de la semaine (0 : Lundi, 1 : Mardi, ...)
	_heure		int unsigned default '0' not null,		# plage horairee (0 : 1�re plage, 1 : 2�me plage, ...)
	_delais		time not null,					# dur�e du cours
	_visible	enum('O', 'N') default 'O' not null,		# r�sultats ouvert (O : Oui, N : Non)
	_nosemaine	int unsigned not null,
	_etat		int unsigned not null,
	_IDx		int unsigned not null auto_increment,
	_annee		int unsigned not null,
	primary key (_IDx)
	) ENGINE = MyISAM COMMENT = "Table des emplois du temps";

###############################################################################
# table des intitul�s des salles
# ver 1.2
#
## modification clef unique

create table edt_items (
	_IDitem		int unsigned not null,				# ID de l'intitul�
	_IDcentre	int unsigned default '1' not null,		# ID du centre (voir table config_centre)
	_title		varchar(40) not null,				# intitul� des salles
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDitem, _lang),
	unique key _key(_IDcentre, _title, _lang)
	) ENGINE = MyISAM COMMENT = "Table des intitul�s des salles";

###############################################################################
# table des intitul�s des semaines
# ver 1.2
#
## modification clef unique

create table edt_week (
	_IDweek		int unsigned not null,				# ID de l'intitul�
	_ident		varchar(4) not null,				# intitul� des semaines
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDweek, _lang),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des intitul�s des semaines";

###############################################################################
# table des cahiers de liaison
# ver 1.0

create table liaison (
	_IDclass	int unsigned default '0' not null,		# ID de la classe
	_IDcentre	int unsigned default '1' not null,		# ID du centre
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur du cahier de texte)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_visible	enum('O', 'N') default 'O' not null,		# cahier de liaison ouvert (O : Oui, N : Non)
	_PJ		enum('O', 'N') default 'N' not null,		# autoriser les commentaires en Pi�ces Jointes (O : Oui, N : Non)
	primary key (_IDclass)
	) ENGINE = MyISAM COMMENT = "Table des cahiers de liaison";

###############################################################################
# table des cahiers de liaison �l�ve
# ver 1.0

create table liaison_data (
	_IDdata		int unsigned not null auto_increment,		# ID du cahier de liaison �l�ve
	_IDeleve	int unsigned not null,				# ID de l'�l�ve
	_period		int unsigned default '1' not null,		# n� de trimestre
	_IDclass	int unsigned not null,				# ID de la classe (historique)
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table des cahiers de liaison �l�ve";

###############################################################################
# table des articles des cahiers de liaison
# ver 1.0

create table liaison_items (
	_IDitem		int unsigned not null auto_increment,		# ID de l'article
	_IDdata		int unsigned not null,				# ID du cahier de liaison �l�ve
	_IDparent	int unsigned default '0' not null,		# ID de l'article parent (pour commentaires en PJ)
	_ID		int unsigned not null,				# ID de connexion (posteur de l'article)
	_IDmat		int unsigned default '0' not null,		# ID de la mati�re (voir table campus)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de cr�ation de l'article
	_text1		mediumtext not null,				# texte (comportement)
	_text2		mediumtext not null,				# texte (investissement)
	_text3		mediumtext not null,				# texte (assiduit�)
	_raw		enum('O', 'N') default 'O' not null,		# texte brut avec balises SPIP (O : Oui, N : Non)
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des articles des cahiers de liaison";

###############################################################################
# table du cahier de correspondance num�rique
# ver 1.0

create table ccn (
	_IDcentre	int unsigned not null,				# ID du centre
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur du cahier de texte)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_email		enum('0', '1', '2', '3') default '0' not null,	# avertissement sur envoi message (0 : aucun, 1 : SMS, 2 : Post-it, 3 : Email)
	_rss		enum('O', 'N') default 'N' not null,		# envoi par flux rss (O : Oui, N : Non)
	primary key (_IDcentre)
	) ENGINE = MyISAM COMMENT = "Table du cahier de correspondance num�rique";

###############################################################################
# table des messages du cahier de correspondance num�rique
# ver 1.1
#
## ajout champ _email

create table ccn_items (
	_IDmsg		int unsigned not null auto_increment,		# ID du message
	_ID		int unsigned not null,				# ID utilisateur
	_IP		bigint default '0' not null,			# ID de l'IP (station de l'exp�diteur)
	_date		datetime not null,				# date et heure de l'exp�dition du message
	_ack		datetime not null,				# date et heure de l'acquittement du message
	_IDparent	int unsigned default '0' not null,		# ID du message parent (0 si message racine)
	_IDcentre	int unsigned default '0' not null,		# ID du centre (voir table config_centre)
	_IDdest		int not null,					# ID destinataire (0 : toutes les classes, < 0 : ID de la classe, > 0 : ID �l�ve)
	_title		varchar(80) not null,				# intitul� du message
	_text		mediumtext not null,				# texte du message				
	_email		enum('0', '1', '2', '3') default '0' not null,	# copie sur envoi message (0 : aucun, 1 : SMS, 2 : Post-it, 3 : Email)
	_priority	int unsigned not null,				# priorit� du message
	primary key (_IDmsg)
	) ENGINE = MyISAM COMMENT = "Table des messages du cahier de correspondance num�rique";

###############################################################################
# table de la gestion des consignes
# ver 1.0

create table retenu (
	_IDcentre	int unsigned default '0' not null,		# ID du centre
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_IDflash	int unsigned default '0' not null,		# ID du flash info (0 si aucun)
	_start		varchar(10) default '13h30' not null,		# horaire d�but de consigne
	_template	varchar(20) not null,				# nom du fichier template
	primary key (_IDcentre)
	) ENGINE = MyISAM COMMENT = "Table de la gestion des consignes";

###############################################################################
# table des consignes
# ver 1.1
#
## ajout champ _IDroom

create table retenu_data (
	_IDdata		int unsigned not null auto_increment,		# ID de la consigne
	_IDcentre	int unsigned not null,				# ID du centre
	_IDeleve	int unsigned not null,				# ID de l'�l�ve
	_ID		int unsigned not null,				# ID de l'utilisateur
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date et heure de cr�ation
	_motif		mediumtext not null,				# motif de la consigne
	_devoir		mediumtext not null,				# travail � r�aliser
	_delay		int unsigned default '1' not null,		# dur�e de la consigne
	_IDroom		int unsigned default '0' not null,		# ID de la salle (voir table edt_items)
	_todo		datetime not null,				# date et heure de la consigne
	_IDsalle	int unsigned default '0' not null,		# ID de la salle de consignation
	primary key (_IDdata)
	) ENGINE = MyISAM  COMMENT = "Table des consignes";

###############################################################################
# table des pointages de consigne
# ver 1.0

create table retenu_items (
	_IDitem		int unsigned not null auto_increment,		# ID du pointage
	_IDdata		int unsigned not null,				# ID de la consigne
	_ID		int unsigned not null,				# ID de l'utilisateur
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date et heure r�alisation ou report
	_comment	mediumtext not null,				# commentaires
	_email		datetime not null,				# date envoi par email
	_status		enum('0', '1', '2', '3') default '0' not null,	# statut de la consigne (0 : en attente, 1 : effectu�e, 2 : report�e, 3 : annul�e)
	primary key (_IDitem)
	) ENGINE = MyISAM  COMMENT = "Table des pointages de consigne";

###############################################################################
# table de la gestion du carnet � points
# ver 1.0

create table carnet (
	_IDcentre	int unsigned default '0' not null,		# ID du centre
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	primary key (_IDcentre)
	) ENGINE = MyISAM COMMENT = "Table de la gestion du carnet � points";

###############################################################################
# table du carnet � points
# ver 1.1
#
## rajout champ _IDtype

create table carnet_data (
	_IDdata		int unsigned not null auto_increment,		# ID du carnet
	_IDeleve	int unsigned not null,				# ID de l'�l�ve
	_ID		int unsigned not null,				# ID de l'utilisateur
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date et heure de cr�ation
	_IDmat		int unsigned default '0' not null,		# mati�re concern�e (voir table campus, 0 si hors cours)
	_IDtype		int unsigned not null,				# ID de la cat�gorie des sanctions (voir table carnet_type)
	_IDitem		int unsigned not null,				# ID du bar�me des points (voir table carnet_items)
	_texte		mediumtext not null,				# motif de la sanction
	primary key (_IDdata)
	) ENGINE = MyISAM  COMMENT = "Table du carnet � points";

###############################################################################
# table du bar�me du carnet � points
# ver 1.1
#
## ajout champ _lang
## modification clef primaire

create table carnet_items (
	_IDitem		int unsigned not null,				# ID de la sanction
	_IDtype		int unsigned not null,				# ID de la cat�gorie des sanctions (voir table carnet_type)
	_pts		int not null,					# ID de l'utilisateur
	_texte		tinytext not null,				# motif de la consigne
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDitem, _IDtype, _lang)
	) ENGINE = MyISAM  COMMENT = "Table du bar�me du carnet � points";

###############################################################################
# table des cat�gories de sanctions
# ver 1.1
#
## ajout champ _lang
## modification clef primaire

create table carnet_type (
	_IDtype		int unsigned not null,				# ID de la cat�gorie des sanctions
	_ident		varchar(40) not null,				# intitul� des cat�gories
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDtype, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des cat�gories de sanctions";

###############################################################################
# table des flux rss
# ver 1.0

create table rss (
	_IDflux		int unsigned not null auto_increment,		# ID du channel
	_title		tinytext not null,				# titre du channel
	_url		tinytext not null,				# url du site contenant le channel
	_text		mediumtext not null,				# description du channel
	_admin		varchar(80) not null,				# Mail du webmaster
	_category	varchar(80) not null,				# Cat�gorie � laquelle le channel appartient
	_date		datetime not null,				# Time to live, avant le prochain rafra�chissement
	_ttl		int unsigned not null,				# ID du channel
	_lang		varchar(2) not null,				# langue du channel
	primary key (_IDflux)
	) ENGINE = MyISAM  COMMENT = "Table des flux rss";

###############################################################################
# table des articles des flux rss
# ver 1.0

create table rss_items (
	_IDitem		int unsigned not null auto_increment,		# ID de l'article
	_IDflux		int unsigned not null,				# ID du channel
	_title		tinytext not null,				# titre de l'article
	_url		tinytext not null,				# url vers l'article
	_text		mediumtext not null,				# description de l'article
	_author		varchar(80) not null,				# Mail de l'auteur de l'article
	_category	varchar(80) not null,				# Cat�gorie � laquelle l'item appartient
	_date		datetime not null,				# date et heure de cr�ation
	_lang		varchar(2) not null,				# langue de l'article
	primary key (_IDitem)
	) ENGINE = MyISAM  COMMENT = "Table des articles des flux rss";

###############################################################################
# table des tables � vider
# ver 1.0

create table reset (
	_IDitem		int unsigned not null,				# ID de l'item du service
	_table		mediumtext not null,				# liste des tables � vider (, comme s�parateur)
	unique key _key(_IDitem)
	) ENGINE = MyISAM  COMMENT = "Table des tables � vider";

###############################################################################
# table des logs des tables � vider
# ver 1.0

create table reset_log (
	_IDitem		int unsigned not null,				# ID de l'item du service
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de l'op�ration
	_IDcentre	int unsigned not null,				# ID du centre de formation
	_numrows	int unsigned default '0' not null,		# nombre d'enregistrements affect�s
	unique key _key(_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des logs des tables � vider";

###############################################################################
# cr�ation de la dba des th�mes
###############################################################################
insert into config_theme values('', 'green',     '#009000', '#CCFFCC');
insert into config_theme values('', 'blue',      '#006699', '#CCCCFF');
insert into config_theme values('', 'red',       '#D01C1C', '#FFCCFF');
insert into config_theme values('', 'brown',     '#720A02', '#FFCC66');
insert into config_theme values('', 'pistachio', '#125C65', '#FFFF99');
insert into config_theme values('', 'orange',    '#FF9900', '#FFCC99');
###############################################################################
# cr�ation de la dba des IP
###############################################################################
insert into ip values('','1', '127.0.0.1','localhost','O');
###############################################################################
# cr�ation de la dba de l'encodage des caract�res
###############################################################################
insert into config_charset values('','utf-8');
insert into config_charset values('','utf-16');
insert into config_charset values('','iso-8859-1');
insert into config_charset values('','iso-8859-15');
###############################################################################
# cr�ation de la dba des tables � vider
###############################################################################
insert into reset values('3', 'forum,forum_items,forum_list,forum_pj,forum_vu');
insert into reset values('8', 'agenda_items,agenda_pj,agenda_vu');
insert into reset values('10','reservation_data,reservation_items');
insert into reset values('12','liaison_data,liaison_items');
insert into reset values('13','ctn_data,ctn_items,ctn_pj,ctn_user,ctn_vu');
insert into reset values('15','flash_fil,flash_filpost,flash_filpj,flash_filvu');
insert into reset values('18','motd_items,motd_pj,motd_vu');
insert into reset values('20','flash_data,flash_items');
insert into reset values('62','exam,exam_data');
insert into reset values('63','absent,absent_items');
insert into reset values('64','edt_data');
insert into reset values('66','carnet_data,carnet_items');
insert into reset values('67','retenu_data,retenu_items');
insert into reset values('68','ccn_items');
###############################################################################
# cr�ation de la dba des fuseaux horaires
###############################################################################
insert into config_timezone values('', 'Europe/Amsterdam');
insert into config_timezone values('', 'Europe/Berlin');
insert into config_timezone values('', 'Europe/Chisinau');
insert into config_timezone values('', 'Europe/Helsinki');
insert into config_timezone values('', 'Europe/Kiev');
insert into config_timezone values('', 'Europe/Madrid');
insert into config_timezone values('', 'Europe/Moscow');
insert into config_timezone values('', 'Europe/Prague');
insert into config_timezone values('', 'Europe/Sarajevo');
insert into config_timezone values('', 'Europe/Tallinn');
insert into config_timezone values('', 'Europe/Vatican');
insert into config_timezone values('', 'Europe/Zagreb');
insert into config_timezone values('', 'Europe/Andorra');
insert into config_timezone values('', 'Europe/Bratislava');
insert into config_timezone values('', 'Europe/Copenhagen');
insert into config_timezone values('', 'Europe/Isle_of_Man');
insert into config_timezone values('', 'Europe/Lisbon');
insert into config_timezone values('', 'Europe/Malta');
insert into config_timezone values('', 'Europe/Nicosia');
insert into config_timezone values('', 'Europe/Riga');
insert into config_timezone values('', 'Europe/Simferopol');
insert into config_timezone values('', 'Europe/Tirane');
insert into config_timezone values('', 'Europe/Vienna');
insert into config_timezone values('', 'Europe/Zaporozhye');
insert into config_timezone values('', 'Europe/Athens');
insert into config_timezone values('', 'Europe/Brussels');
insert into config_timezone values('', 'Europe/Dublin');
insert into config_timezone values('', 'Europe/Istanbul');
insert into config_timezone values('', 'Europe/Ljubljana');
insert into config_timezone values('', 'Europe/Mariehamn');
insert into config_timezone values('', 'Europe/Oslo');
insert into config_timezone values('', 'Europe/Rome');
insert into config_timezone values('', 'Europe/Skopje');
insert into config_timezone values('', 'Europe/Tiraspol');
insert into config_timezone values('', 'Europe/Vilnius');
insert into config_timezone values('', 'Europe/Zurich');
insert into config_timezone values('', 'Europe/Belfast');
insert into config_timezone values('', 'Europe/Bucharest');
insert into config_timezone values('', 'Europe/Gibraltar');
insert into config_timezone values('', 'Europe/Jersey');
insert into config_timezone values('', 'Europe/London');
insert into config_timezone values('', 'Europe/Minsk');
insert into config_timezone values('', 'Europe/Paris');
insert into config_timezone values('', 'Europe/Samara');
insert into config_timezone values('', 'Europe/Sofia');
insert into config_timezone values('', 'Europe/Uzhgorod');
insert into config_timezone values('', 'Europe/Volgograd');
insert into config_timezone values('', 'Europe/Belgrade');
insert into config_timezone values('', 'Europe/Budapest');
insert into config_timezone values('', 'Europe/Guernsey');
insert into config_timezone values('', 'Europe/Kaliningrad');
insert into config_timezone values('', 'Europe/Luxembourg');
insert into config_timezone values('', 'Europe/Monaco');
insert into config_timezone values('', 'Europe/Podgorica');
insert into config_timezone values('', 'Europe/San_Marino');
insert into config_timezone values('', 'Europe/Stockholm');
insert into config_timezone values('', 'Europe/Vaduz');
insert into config_timezone values('', 'Europe/Warsaw');
insert into config_timezone values('', 'Africa/Abidjan');
insert into config_timezone values('', 'Africa/Asmera');
insert into config_timezone values('', 'Africa/Blantyre');
insert into config_timezone values('', 'Africa/Ceuta');
insert into config_timezone values('', 'Africa/Douala');
insert into config_timezone values('', 'Africa/Johannesburg');
insert into config_timezone values('', 'Africa/Lagos');
insert into config_timezone values('', 'Africa/Lusaka');
insert into config_timezone values('', 'Africa/Mogadishu');
insert into config_timezone values('', 'Africa/Nouakchott');
insert into config_timezone values('', 'Africa/Tripoli');
insert into config_timezone values('', 'Africa/Accra');
insert into config_timezone values('', 'Africa/Bamako');
insert into config_timezone values('', 'Africa/Brazzaville');
insert into config_timezone values('', 'Africa/Conakry');
insert into config_timezone values('', 'Africa/El_Aaiun');
insert into config_timezone values('', 'Africa/Kampala');
insert into config_timezone values('', 'Africa/Libreville');
insert into config_timezone values('', 'Africa/Malabo');
insert into config_timezone values('', 'Africa/Monrovia');
insert into config_timezone values('', 'Africa/Ouagadougou');
insert into config_timezone values('', 'Africa/Tunis');
insert into config_timezone values('', 'Africa/Addis_Ababa');
insert into config_timezone values('', 'Africa/Bangui');
insert into config_timezone values('', 'Africa/Bujumbura');
insert into config_timezone values('', 'Africa/Dakar');
insert into config_timezone values('', 'Africa/Freetown');
insert into config_timezone values('', 'Africa/Khartoum');
insert into config_timezone values('', 'Africa/Lome');
insert into config_timezone values('', 'Africa/Maputo');
insert into config_timezone values('', 'Africa/Nairobi');
insert into config_timezone values('', 'Africa/Porto-Novo');
insert into config_timezone values('', 'Africa/Windhoek');
insert into config_timezone values('', 'Africa/Algiers');
insert into config_timezone values('', 'Africa/Banjul');
insert into config_timezone values('', 'Africa/Cairo');
insert into config_timezone values('', 'Africa/Dar_es_Salaam');
insert into config_timezone values('', 'Africa/Gaborone');
insert into config_timezone values('', 'Africa/Kigali');
insert into config_timezone values('', 'Africa/Luanda');
insert into config_timezone values('', 'Africa/Maseru');
insert into config_timezone values('', 'Africa/Ndjamena');
insert into config_timezone values('', 'Africa/Sao_Tome');
insert into config_timezone values('', 'Africa/Asmara');
insert into config_timezone values('', 'Africa/Bissau');
insert into config_timezone values('', 'Africa/Casablanca');
insert into config_timezone values('', 'Africa/Djibouti');
insert into config_timezone values('', 'Africa/Harare');
insert into config_timezone values('', 'Africa/Kinshasa');
insert into config_timezone values('', 'Africa/Lubumbashi');
insert into config_timezone values('', 'Africa/Mbabane');
insert into config_timezone values('', 'Africa/Niamey');
insert into config_timezone values('', 'Africa/Timbuktu');
insert into config_timezone values('', 'America/Adak');
insert into config_timezone values('', 'America/Argentina/Buenos_Aires');
insert into config_timezone values('', 'America/Argentina/La_Rioja');
insert into config_timezone values('', 'America/Argentina/San_Luis');
insert into config_timezone values('', 'America/Atikokan');
insert into config_timezone values('', 'America/Belem');
insert into config_timezone values('', 'America/Boise');
insert into config_timezone values('', 'America/Caracas');
insert into config_timezone values('', 'America/Chihuahua');
insert into config_timezone values('', 'America/Curacao');
insert into config_timezone values('', 'America/Detroit');
insert into config_timezone values('', 'America/Ensenada');
insert into config_timezone values('', 'America/Goose_Bay');
insert into config_timezone values('', 'America/Guayaquil');
insert into config_timezone values('', 'America/Indiana/Indianapolis');
insert into config_timezone values('', 'America/Indiana/Vevay');
insert into config_timezone values('', 'America/Iqaluit');
insert into config_timezone values('', 'America/Kentucky/Monticello');
insert into config_timezone values('', 'America/Louisville');
insert into config_timezone values('', 'America/Martinique');
insert into config_timezone values('', 'America/Merida');
insert into config_timezone values('', 'America/Montevideo');
insert into config_timezone values('', 'America/Nipigon');
insert into config_timezone values('', 'America/North_Dakota/New_Salem');
insert into config_timezone values('', 'America/Phoenix');
insert into config_timezone values('', 'America/Puerto_Rico');
insert into config_timezone values('', 'America/Resolute');
insert into config_timezone values('', 'America/Santiago');
insert into config_timezone values('', 'America/St_Barthelemy');
insert into config_timezone values('', 'America/St_Vincent');
insert into config_timezone values('', 'America/Tijuana');
insert into config_timezone values('', 'America/Whitehorse');
insert into config_timezone values('', 'America/Anchorage');
insert into config_timezone values('', 'America/Argentina/Catamarca');
insert into config_timezone values('', 'America/Argentina/Mendoza');
insert into config_timezone values('', 'America/Argentina/Tucuman');
insert into config_timezone values('', 'America/Atka');
insert into config_timezone values('', 'America/Belize');
insert into config_timezone values('', 'America/Buenos_Aires');
insert into config_timezone values('', 'America/Catamarca');
insert into config_timezone values('', 'America/Coral_Harbour');
insert into config_timezone values('', 'America/Danmarkshavn');
insert into config_timezone values('', 'America/Dominica');
insert into config_timezone values('', 'America/Fort_Wayne');
insert into config_timezone values('', 'America/Grand_Turk');
insert into config_timezone values('', 'America/Guyana');
insert into config_timezone values('', 'America/Indiana/Knox');
insert into config_timezone values('', 'America/Indiana/Vincennes');
insert into config_timezone values('', 'America/Jamaica');
insert into config_timezone values('', 'America/Knox_IN');
insert into config_timezone values('', 'America/Maceio');
insert into config_timezone values('', 'America/Matamoros');
insert into config_timezone values('', 'America/Mexico_City');
insert into config_timezone values('', 'America/Montreal');
insert into config_timezone values('', 'America/Nome');
insert into config_timezone values('', 'America/Ojinaga');
insert into config_timezone values('', 'America/Port-au-Prince');
insert into config_timezone values('', 'America/Rainy_River');
insert into config_timezone values('', 'America/Rio_Branco');
insert into config_timezone values('', 'America/Santo_Domingo');
insert into config_timezone values('', 'America/St_Johns');
insert into config_timezone values('', 'America/Swift_Current');
insert into config_timezone values('', 'America/Toronto');
insert into config_timezone values('', 'America/Winnipeg');
insert into config_timezone values('', 'America/Anguilla');
insert into config_timezone values('', 'America/Argentina/ComodRivadavia');
insert into config_timezone values('', 'America/Argentina/Rio_Gallegos');
insert into config_timezone values('', 'America/Argentina/Ushuaia');
insert into config_timezone values('', 'America/Bahia');
insert into config_timezone values('', 'America/Blanc-Sablon');
insert into config_timezone values('', 'America/Cambridge_Bay');
insert into config_timezone values('', 'America/Cayenne');
insert into config_timezone values('', 'America/Cordoba');
insert into config_timezone values('', 'America/Dawson');
insert into config_timezone values('', 'America/Edmonton');
insert into config_timezone values('', 'America/Fortaleza');
insert into config_timezone values('', 'America/Grenada');
insert into config_timezone values('', 'America/Halifax');
insert into config_timezone values('', 'America/Indiana/Marengo');
insert into config_timezone values('', 'America/Indiana/Winamac');
insert into config_timezone values('', 'America/Jujuy');
insert into config_timezone values('', 'America/La_Paz');
insert into config_timezone values('', 'America/Managua');
insert into config_timezone values('', 'America/Mazatlan');
insert into config_timezone values('', 'America/Miquelon');
insert into config_timezone values('', 'America/Montserrat');
insert into config_timezone values('', 'America/Noronha');
insert into config_timezone values('', 'America/Panama');
insert into config_timezone values('', 'America/Port_of_Spain');
insert into config_timezone values('', 'America/Rankin_Inlet');
insert into config_timezone values('', 'America/Rosario');
insert into config_timezone values('', 'America/Sao_Paulo');
insert into config_timezone values('', 'America/St_Kitts');
insert into config_timezone values('', 'America/Tegucigalpa');
insert into config_timezone values('', 'America/Tortola');
insert into config_timezone values('', 'America/Yakutat');
insert into config_timezone values('', 'America/Antigua');
insert into config_timezone values('', 'America/Argentina/Cordoba');
insert into config_timezone values('', 'America/Argentina/Salta');
insert into config_timezone values('', 'America/Aruba');
insert into config_timezone values('', 'America/Bahia_Banderas');
insert into config_timezone values('', 'America/Boa_Vista');
insert into config_timezone values('', 'America/Campo_Grande');
insert into config_timezone values('', 'America/Cayman');
insert into config_timezone values('', 'America/Costa_Rica');
insert into config_timezone values('', 'America/Dawson_Creek');
insert into config_timezone values('', 'America/Eirunepe');
insert into config_timezone values('', 'America/Glace_Bay');
insert into config_timezone values('', 'America/Guadeloupe');
insert into config_timezone values('', 'America/Havana');
insert into config_timezone values('', 'America/Indiana/Petersburg');
insert into config_timezone values('', 'America/Indianapolis');
insert into config_timezone values('', 'America/Juneau');
insert into config_timezone values('', 'America/Lima');
insert into config_timezone values('', 'America/Manaus');
insert into config_timezone values('', 'America/Mendoza');
insert into config_timezone values('', 'America/Moncton');
insert into config_timezone values('', 'America/Nassau');
insert into config_timezone values('', 'America/North_Dakota/Beulah');
insert into config_timezone values('', 'America/Pangnirtung');
insert into config_timezone values('', 'America/Porto_Acre');
insert into config_timezone values('', 'America/Recife');
insert into config_timezone values('', 'America/Santa_Isabel');
insert into config_timezone values('', 'America/Scoresbysund');
insert into config_timezone values('', 'America/St_Lucia');
insert into config_timezone values('', 'America/Thule');
insert into config_timezone values('', 'America/Vancouver');
insert into config_timezone values('', 'America/Yellowknife');
insert into config_timezone values('', 'America/Araguaina');
insert into config_timezone values('', 'America/Argentina/Jujuy');
insert into config_timezone values('', 'America/Argentina/San_Juan');
insert into config_timezone values('', 'America/Asuncion');
insert into config_timezone values('', 'America/Barbados');
insert into config_timezone values('', 'America/Bogota');
insert into config_timezone values('', 'America/Cancun');
insert into config_timezone values('', 'America/Chicago');
insert into config_timezone values('', 'America/Cuiaba');
insert into config_timezone values('', 'America/Denver');
insert into config_timezone values('', 'America/El_Salvador');
insert into config_timezone values('', 'America/Godthab');
insert into config_timezone values('', 'America/Guatemala');
insert into config_timezone values('', 'America/Hermosillo');
insert into config_timezone values('', 'America/Indiana/Tell_City');
insert into config_timezone values('', 'America/Inuvik');
insert into config_timezone values('', 'America/Kentucky/Louisville');
insert into config_timezone values('', 'America/Los_Angeles');
insert into config_timezone values('', 'America/Marigot');
insert into config_timezone values('', 'America/Menominee');
insert into config_timezone values('', 'America/Monterrey');
insert into config_timezone values('', 'America/New_York');
insert into config_timezone values('', 'America/North_Dakota/Center');
insert into config_timezone values('', 'America/Paramaribo');
insert into config_timezone values('', 'America/Porto_Velho');
insert into config_timezone values('', 'America/Regina');
insert into config_timezone values('', 'America/Santarem');
insert into config_timezone values('', 'America/Shiprock');
insert into config_timezone values('', 'America/St_Thomas');
insert into config_timezone values('', 'America/Thunder_Bay');
insert into config_timezone values('', 'America/Virgin');
insert into config_timezone values('', 'Asia/Aden');
insert into config_timezone values('', 'Asia/Aqtobe');
insert into config_timezone values('', 'Asia/Baku');
insert into config_timezone values('', 'Asia/Calcutta');
insert into config_timezone values('', 'Asia/Dacca');
insert into config_timezone values('', 'Asia/Dushanbe');
insert into config_timezone values('', 'Asia/Hovd');
insert into config_timezone values('', 'Asia/Jerusalem');
insert into config_timezone values('', 'Asia/Kathmandu');
insert into config_timezone values('', 'Asia/Kuching');
insert into config_timezone values('', 'Asia/Makassar');
insert into config_timezone values('', 'Asia/Novosibirsk');
insert into config_timezone values('', 'Asia/Pyongyang');
insert into config_timezone values('', 'Asia/Saigon');
insert into config_timezone values('', 'Asia/Singapore');
insert into config_timezone values('', 'Asia/Tel_Aviv');
insert into config_timezone values('', 'Asia/Ulaanbaatar');
insert into config_timezone values('', 'Asia/Yakutsk');
insert into config_timezone values('', 'Asia/Almaty');
insert into config_timezone values('', 'Asia/Ashgabat');
insert into config_timezone values('', 'Asia/Bangkok');
insert into config_timezone values('', 'Asia/Choibalsan');
insert into config_timezone values('', 'Asia/Damascus');
insert into config_timezone values('', 'Asia/Gaza');
insert into config_timezone values('', 'Asia/Irkutsk');
insert into config_timezone values('', 'Asia/Kabul');
insert into config_timezone values('', 'Asia/Katmandu');
insert into config_timezone values('', 'Asia/Kuwait');
insert into config_timezone values('', 'Asia/Manila');
insert into config_timezone values('', 'Asia/Omsk');
insert into config_timezone values('', 'Asia/Qatar');
insert into config_timezone values('', 'Asia/Sakhalin');
insert into config_timezone values('', 'Asia/Taipei');
insert into config_timezone values('', 'Asia/Thimbu');
insert into config_timezone values('', 'Asia/Ulan_Bator');
insert into config_timezone values('', 'Asia/Yekaterinburg');
insert into config_timezone values('', 'Asia/Amman');
insert into config_timezone values('', 'Asia/Ashkhabad');
insert into config_timezone values('', 'Asia/Beirut');
insert into config_timezone values('', 'Asia/Chongqing');
insert into config_timezone values('', 'Asia/Dhaka');
insert into config_timezone values('', 'Asia/Harbin');
insert into config_timezone values('', 'Asia/Istanbul');
insert into config_timezone values('', 'Asia/Kamchatka');
insert into config_timezone values('', 'Asia/Kolkata');
insert into config_timezone values('', 'Asia/Macao');
insert into config_timezone values('', 'Asia/Muscat');
insert into config_timezone values('', 'Asia/Oral');
insert into config_timezone values('', 'Asia/Qyzylorda');
insert into config_timezone values('', 'Asia/Samarkand');
insert into config_timezone values('', 'Asia/Tashkent');
insert into config_timezone values('', 'Asia/Thimphu');
insert into config_timezone values('', 'Asia/Urumqi');
insert into config_timezone values('', 'Asia/Yerevan');
insert into config_timezone values('', 'Asia/Anadyr');
insert into config_timezone values('', 'Asia/Baghdad');
insert into config_timezone values('', 'Asia/Bishkek');
insert into config_timezone values('', 'Asia/Chungking');
insert into config_timezone values('', 'Asia/Dili');
insert into config_timezone values('', 'Asia/Ho_Chi_Minh');
insert into config_timezone values('', 'Asia/Jakarta');
insert into config_timezone values('', 'Asia/Karachi');
insert into config_timezone values('', 'Asia/Krasnoyarsk');
insert into config_timezone values('', 'Asia/Macau');
insert into config_timezone values('', 'Asia/Nicosia');
insert into config_timezone values('', 'Asia/Phnom_Penh');
insert into config_timezone values('', 'Asia/Rangoon');
insert into config_timezone values('', 'Asia/Seoul');
insert into config_timezone values('', 'Asia/Tbilisi');
insert into config_timezone values('', 'Asia/Tokyo');
insert into config_timezone values('', 'Asia/Vientiane');
insert into config_timezone values('', 'Asia/Aqtau');
insert into config_timezone values('', 'Asia/Bahrain');
insert into config_timezone values('', 'Asia/Brunei');
insert into config_timezone values('', 'Asia/Colombo');
insert into config_timezone values('', 'Asia/Dubai');
insert into config_timezone values('', 'Asia/Hong_Kong');
insert into config_timezone values('', 'Asia/Jayapura');
insert into config_timezone values('', 'Asia/Kashgar');
insert into config_timezone values('', 'Asia/Kuala_Lumpur');
insert into config_timezone values('', 'Asia/Magadan');
insert into config_timezone values('', 'Asia/Novokuznetsk');
insert into config_timezone values('', 'Asia/Pontianak');
insert into config_timezone values('', 'Asia/Riyadh');
insert into config_timezone values('', 'Asia/Shanghai');
insert into config_timezone values('', 'Asia/Tehran');
insert into config_timezone values('', 'Asia/Ujung_Pandang');
insert into config_timezone values('', 'Asia/Vladivostok');
insert into config_timezone values('', 'Atlantic/Azores');
insert into config_timezone values('', 'Atlantic/Faroe');
insert into config_timezone values('', 'Atlantic/St_Helena');
insert into config_timezone values('', 'Atlantic/Bermuda');
insert into config_timezone values('', 'Atlantic/Jan_Mayen');
insert into config_timezone values('', 'Atlantic/Stanley');
insert into config_timezone values('', 'Atlantic/Canary');
insert into config_timezone values('', 'Atlantic/Madeira');
insert into config_timezone values('', 'Atlantic/Cape_Verde');
insert into config_timezone values('', 'Atlantic/Reykjavik');
insert into config_timezone values('', 'Atlantic/Faeroe');
insert into config_timezone values('', 'Atlantic/South_Georgia');
insert into config_timezone values('', 'Australia/ACT');
insert into config_timezone values('', 'Australia/Currie');
insert into config_timezone values('', 'Australia/Lindeman');
insert into config_timezone values('', 'Australia/Perth');
insert into config_timezone values('', 'Australia/Victoria');
insert into config_timezone values('', 'Australia/Adelaide');
insert into config_timezone values('', 'Australia/Darwin');
insert into config_timezone values('', 'Australia/Lord_Howe');
insert into config_timezone values('', 'Australia/Queensland');
insert into config_timezone values('', 'Australia/West');
insert into config_timezone values('', 'Australia/Brisbane');
insert into config_timezone values('', 'Australia/Eucla');
insert into config_timezone values('', 'Australia/Melbourne');
insert into config_timezone values('', 'Australia/South');
insert into config_timezone values('', 'Australia/Yancowinna');
insert into config_timezone values('', 'Australia/Broken_Hill');
insert into config_timezone values('', 'Australia/Hobart');
insert into config_timezone values('', 'Australia/North');
insert into config_timezone values('', 'Australia/Sydney');
insert into config_timezone values('', 'Australia/Canberra');
insert into config_timezone values('', 'Australia/LHI');
insert into config_timezone values('', 'Australia/NSW');
insert into config_timezone values('', 'Australia/Tasmania');
insert into config_timezone values('', 'Indian/Antananarivo');
insert into config_timezone values('', 'Indian/Kerguelen');
insert into config_timezone values('', 'Indian/Reunion');
insert into config_timezone values('', 'Indian/Chagos');
insert into config_timezone values('', 'Indian/Mahe');
insert into config_timezone values('', 'Indian/Christmas');
insert into config_timezone values('', 'Indian/Maldives');
insert into config_timezone values('', 'Indian/Cocos');
insert into config_timezone values('', 'Indian/Mauritius');
insert into config_timezone values('', 'Indian/Comoro');
insert into config_timezone values('', 'Indian/Mayotte');
insert into config_timezone values('', 'Pacific/Apia');
insert into config_timezone values('', 'Pacific/Efate');
insert into config_timezone values('', 'Pacific/Galapagos');
insert into config_timezone values('', 'Pacific/Johnston');
insert into config_timezone values('', 'Pacific/Marquesas');
insert into config_timezone values('', 'Pacific/Noumea');
insert into config_timezone values('', 'Pacific/Ponape');
insert into config_timezone values('', 'Pacific/Tahiti');
insert into config_timezone values('', 'Pacific/Wallis');
insert into config_timezone values('', 'Pacific/Auckland');
insert into config_timezone values('', 'Pacific/Enderbury');
insert into config_timezone values('', 'Pacific/Gambier');
insert into config_timezone values('', 'Pacific/Kiritimati');
insert into config_timezone values('', 'Pacific/Midway');
insert into config_timezone values('', 'Pacific/Pago_Pago');
insert into config_timezone values('', 'Pacific/Port_Moresby');
insert into config_timezone values('', 'Pacific/Tarawa');
insert into config_timezone values('', 'Pacific/Yap');
insert into config_timezone values('', 'Pacific/Chatham');
###############################################################################