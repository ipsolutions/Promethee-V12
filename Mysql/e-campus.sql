##############################################################################
#    Copyright (c) 2002-2003 by Dominique Laporte (C-E-D@wanadoo.fr)         #
#                                                                            #
#    This file is part of Prométhée.                                         #
#                                                                            #
#    Prométhée is free software: you can redistribute it and/or modify       #
#    it under the terms of the GNU General Public License as published by    #
#    the Free Software Foundation, either version 3 of the License, or       #
#    (at your option) any later version.                                     #
#                                                                            #
#    Prométhée is distributed in the hope that it will be useful,            #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of          #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           #
#    GNU General Public License for more details.                            #
#                                                                            #
#    You should have received a copy of the GNU General Public License       #
#    along with Prométhée.  If not, see <http://www.gnu.org/licenses/>.      #
##############################################################################


use `##DATABASE##`;

###############################################################################
# table des e-campus
# ver 1.0

create table campus (
	_IDcampus	int unsigned not null auto_increment,		# ID du e-campus
	_ident		varchar(40) not null,				# intitulé du e-campus
	_table		varchar(40) not null,				# nom de la table (campus_data ou campus_classe)
	_visible	enum('O', 'N') default 'O' not null,		# item sélectionné (O : Oui, N : Non)
	_lang		varchar(2) not null,				# code langue
	primary key (_IDcampus),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des e-campus";

###############################################################################
# table des matières enseignées
# ver 1.6
#
# remarque : le n° _IDmat correspond au fichier image de la matière : download/campus/<_IDmat>.gif
#
## ajout champs : _ident, _seuil

create table campus_data (
	_IDmat		int unsigned not null,				# ID de la matière
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_ident		varchar(5) not null,				# identifiant des matières
	_titre		varchar(40) not null,				# intitulé des matières
	_texte		tinytext not null,				# description des matières
	_seuil		int unsigned default '10' not null,		# seuil de validation
	_private	enum('O', 'N') default 'N' not null,		# accès réservé aux personnes figurant dans la liste des inscrits (voir table campus_user)
	_auto		enum('O', 'N') default 'O' not null,		# inscription/désinscription automatique (O : Oui, N : Non)
	_valid		datetime not null,				# date de limite de validité du e-campus (illimité si '')
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (visible dans la liste)
	_lang		varchar(2) not null,				# code langue
	_color		int unsigned default '0' not null,
	primary key (_IDmat, _lang),
	unique key _key(_titre, _lang)
	) ENGINE = MyISAM COMMENT = "Table des matières enseignées";

###############################################################################
# table des liens affichés dans le menu du campus
# ver 1.2
#
## modification clef unique (ajout _IDcentre)

create table campus_items (
	_IDmat		int not null,					# ID de la matière (> 0) ou de la formation (< 0)
	_IDmenu		int unsigned not null,				# ID du menu (voir ci-dessous)
	_IDcentre	int unsigned not null,				# ID du centre
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (visible dans la liste du menu)
	unique key _key(_IDmat, _IDmenu, _IDcentre)
	) ENGINE = MyISAM COMMENT = "Table des liens affichés dans le campus";

###############################################################################
# table du menu des modules du e-campus
# ver 1.5
#
## modification taille champs _titre, _link : 30 -> 40
## ajout champs : _anonyme, _backoffice, _visible, _IDgrprd, _url
## changement nom des champs : _titre -> _ident, _texte -> text

create table campus_menu (
	_IDmenu		int unsigned not null auto_increment,		# ID du menu
	_ident		varchar(40) not null,				# intitulé du menu
	_text		varchar(80) not null,				# description du menu
	_link		varchar(40) not null,				# lien concernant le menu
	_url		enum('O', 'N') default 'O' not null,		# url (O : Oui, N : Non) ou contenu
	_IDgrprd	int unsigned default '255' not null,		# ID des lecteurs (voir table groupe)
	_anonyme	enum('O', 'N') default 'O' not null,		# accès en mode anonyme (O : Oui, N : Non)
	_backoffice	enum('O', 'N') default 'N' not null,		# accès au backoffice (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# sous menu visible (O : Oui, N : Non)
	_hit		int unsigned default '0' not null,		# nombre de hit par menu
	_lang		varchar(2) not null,				# code langue
	primary key (_IDmenu),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table du menu des modules du e-campus";

###############################################################################
# table des répertoires des travaux téléchargés
# ver 1.0

create table campus_root (
	_IDroot		int unsigned not null auto_increment,		# ID du répertoire
	_IDparent	int unsigned not null,				# ID du répertoire parent (0 si racine)
	_IDmat		int unsigned not null,				# ID de la matière
	_titre		varchar(40) not null,				# nom du répertoire
	_IDmod		int unsigned not null,				# ID du propriétaire du répertoire
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_private	enum('O', 'N') default 'N' not null,		# répertoire privé (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# répertoire accessible (O : Oui, N : Non)
	primary key (_IDroot),
	unique key _key(_IDparent, _IDmat, _titre)
	) ENGINE = MyISAM  COMMENT = "Table des répertoires des travaux téléchargés";

###############################################################################
# table de la gestion des téléchargements des travaux dans les campus
# ver 1.5
#
## modification champ _texte: tinytext -> text

create table campus_download (
	_IDwork		int unsigned not null auto_increment,		# ID du travail à télécharger
	_IDmat		int unsigned not null,				# ID de la matière
	_IDroot		int unsigned default '0' not null,		# ID du répertoire
	_date		datetime not null,				# date et heure du dépôt du travail
	_ID		int unsigned default '0' not null,		# ID du poster
	_IDgrpwr	text not null,					# ID des classes pour post de fichiers (voir table campus_classe
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs des fichiers déposés (voir table groupe)
	_IP		bigint default '0' not null,			# IP du poster
	_titre		varchar(80) not null,				# intitulé du travail
	_texte		text not null,					# description du travail
	_open		datetime not null,				# date et heure de début de téléchargement
	_close		datetime not null,				# date et heure de fin de téléchargement
	_start		datetime not null,				# date et heure de début de dépôt
	_end		datetime not null,				# date et heure de fin de dépôt
	unique key _key(_IDwork)
	) ENGINE = MyISAM COMMENT = "Table de la gestion des téléchargements des travaux dans le campus";

###############################################################################
# table de dépôt des travaux dans les campus
# ver 1.1
#
## ajout champs : _text, _type

create table campus_upload (
	_IDupload	int unsigned not null auto_increment,		# ID du dépôt de travail
	_IDwork		int unsigned not null,				# ID du travail téléchargé
	_date		datetime not null,				# date et heure de dépôt de travail
	_ID		int unsigned default '0' not null,		# ID du poster
	_IP		bigint default '0' not null,			# IP du poster
	_file		varchar(80) not null,				# nom du fichier de dépôt
	_text		varchar(80) not null,				# description du fichier
	_size		int unsigned not null,				# taille du fichier travail
	_type		enum('E', 'C', 'R') default 'R' not null,	# type de fichier (E : énoncé, C : correction, R : rendu)
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (visible dans la liste du menu)
	unique key _key(_IDupload)
	) ENGINE = MyISAM COMMENT = "Table de dépôt des travaux dans le campus";

###############################################################################
# table des classes
# ver 1.6
#
# remarque : le n° _IDclass correspond au fichier image de la matière : download/campus/<_IDmat>.gif
#
## ajout champs _IDmod, _IDgrprd, _IDgrpwr, _ident, _private, _auto, _valid

create table campus_classe (
	_IDclass	int unsigned not null auto_increment,		# ID de la classe
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_IDcentre	int unsigned not null,				# ID du type d'établissement (voir table config_centre)
	_ident		varchar(40) not null,				# identification de la classe/formation
	_text		tinytext not null,				# description de la formation
	_IDpp		int unsigned default '0' not null,		# ID du professeur principal
	_IDcoordo	int unsigned default '0' not null,		# ID du professeur coordinateur
	_private	enum('O', 'N') default 'N' not null,		# e-campus privé (O : Oui, N : Non)
	_auto		enum('O', 'N') default 'O' not null,		# inscription/désinscription automatique (O : Oui, N : Non)
	_valid		datetime not null,				# date de limite de validité du e-campus (illimité si '')
	_visible	enum('O', 'N') default 'O' not null,		# classe visible (O : Oui, N : Non)
	primary key (_IDclass),
	unique key _key(_IDcentre, _ident)
	) ENGINE = MyISAM COMMENT = "Table des classes du campus";

###############################################################################
# table des liens
# ver 1.5
#
## modification taille champ _url : 128 -> 255

create table campus_link (
	_IDlink		int unsigned not null auto_increment,		# ID du lien
	_IDmat		int not null,					# ID de la matière (> 0) ou de la formation (< 0)
	_IDdata		int unsigned default '0' not null,		# ID du dossier (0 si dossier racine)
	_ID		int unsigned default '0' not null,		# ID de connexion
	_titre		varchar(80) not null,				# titre du site
	_url		varchar(255) not null,				# URL
	_texte		tinytext not null,				# description du lien
	_flag		varchar(6) not null,				# langue du site
	_IDlicense	int unsigned default '0' not null,		# type de licence
	_lang		varchar(2) not null,				# code langue
	primary key (_IDlink)
	) ENGINE = MyISAM COMMENT = "Table des liens du campus";

###############################################################################
# table des répertoires des liens
# ver 1.2
#
## modification champ _IDmat : unsigned int -> int

create table campus_link_data (
	_IDdata		int unsigned not null auto_increment,		# ID des répertoires
	_IDparent	int unsigned default '0' not null,		# ID du répertoire parent
	_IDmat		int not null,					# ID de la matière (> 0) ou de la formation (< 0)
	_IDmod		int unsigned default '0' not null,		# ID du modérateur
	_titre		varchar(80) not null,				# intitulé du répertoire
	_texte		tinytext not null,				# description du répertoire
	_visible	enum('O', 'N') default 'O' not null,		# répertoire ouvert (O : Oui, N : Non)
	primary key (_IDdata),
	unique key (_IDparent, _IDmat, _titre)
	) ENGINE = MyISAM COMMENT = "Table des répertoires des liens";

###############################################################################
# table des utilisateurs inscrits à un cours
# ver 1.0

create table campus_user (
	_IDuser		int unsigned not null auto_increment,		# ID de la table
	_IDmat		int not null,					# ID de la matière
	_ID		int unsigned not null,				# ID de l'utilisateur
	_access		int default '-1' not null,			# droits d'accès (-1 : attente validation, 0 : bannis, 1 : lecteur, 2 : rédacteur, 4 : modérateur)
	_date		datetime not null,				# date et heure de création
	_valid		datetime not null,				# date de limite de validité (illimité si '')
	_lastcnx	datetime not null,				# date et heure de dernier accès
	_cnx		int unsigned default '0' not null,		# nbr de connexions (mesure d'activité)
	primary key (_IDuser),
	unique key (_IDmat, _ID)
	) ENGINE = MyISAM COMMENT = "Table des utilisateurs du campus";

###############################################################################
# table des droits d'accès des utilisateurs pour les e-campus
# ver 1.0

create table campus_access (
	_IDaccess	int not null,					# niveau d'accès
	_ident		varchar(20) not null,				# intitulé du niveau d'accès
	_lang		varchar(2) not null,				# code langue
	primary key (_IDaccess, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM COMMENT = "table des droits d'accès des utilisateurs pour les e-campus";

###############################################################################
# table des niveaux scolaire
# ver 1.2
#
## modification clef unique

create table campus_level (
	_IDlevel	int unsigned not null,				# ID du niveau
	_ident		varchar(40) not null,				# intitulé du niveau
	_visible	enum('O', 'N') default 'O' not null,		# intitulé visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# code langue
	primary key (_IDlevel, _lang),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des niveaux scolaire";

###############################################################################
# table des cursus
# ver 1.2
#
## modification clef unique

create table cursus (
	_IDcursus	int unsigned not null,				# ID du cursus
	_titre		varchar(30) not null,				# intitulé du cursus
	_texte		tinytext not null,				# description du cursus
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (cursus publiable)
	_lang		varchar(2) not null,				# code langue
	primary key (_IDcursus, _lang),
	unique key _key(_titre, _lang)
	) ENGINE = MyISAM COMMENT = "Table des cursus";

###############################################################################
# table des modules des cursus
# ver 1.0

create table cursus_data (
	_IDdata		int unsigned not null auto_increment,		# ID du module
	_IDcursus	int unsigned not null,				# ID du cursus
	_IDmat		int unsigned not null,				# ID de la matière pédagogique
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (module visible dans la liste)
	primary key (_IDdata),
	unique key _key(_IDcursus, _IDmat)
	) ENGINE = MyISAM COMMENT = "Table des modules des cursus";

###############################################################################
# table des descriptions des modules des cursus
# ver 1.2
#
## modification champ _IDgrprd : bigint => text

create table cursus_items (
	_IDitem		int unsigned not null auto_increment,		# ID de la description
	_IDdata		int unsigned not null,				# ID du module
	_date		datetime not null,				# date de création de la description
	_ID		int unsigned not null,				# ID de connexion (qui a créé la description)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDgrprd	text not null,					# destinataires du module (voir table groupe ou classe)
	_titre		varchar(80) not null,				# titre de la description
	_texte		mediumtext not null,				# texte de la description
	_file		varchar(80) not null,				# nom du fichier du référentiel
	_size		int unsigned not null,				# taille du fichier du référentiel
	primary key (_IDitem),
	unique key _key(_IDdata, _titre)
	) ENGINE = MyISAM COMMENT = "Table des descriptions des modules des cursus";

###############################################################################
# table des quizz
# ver 1.4
#
## ajout index unique

create table quizz (
	_IDquizz	int unsigned not null auto_increment,		# ID du quizz
	_IDmat		int unsigned not null,				# ID de la matière
	_IDroot		int unsigned default '0' not null,		# ID ru répertoire racine
	_date		datetime not null,				# date de création du quizz
	_ID		int unsigned not null,				# ID de connexion (qui a créé le quizz)
	_IDgrprd	text not null,					# destinataires du quizz (voir table groupe ou classe)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_titre		varchar(80) not null,				# intitulé du quizz
	_texte		tinytext not null,				# description du quizz
	_level		int unsigned default '0' not null,		# niveau de difficulté du quizz
	_anonyme	enum('O', 'N') default 'O' not null,		# Oui ou Non (tri par poste ou utilisateur)
	_result		enum('O', 'N') default 'N' not null,		# Oui ou Non (afficher les réponses au fur et à mesure)
	_back		enum('O', 'N') default 'O' not null,		# Oui ou Non (retour arrière sur réponse)
	_page		enum('O', 'N') default 'N' not null,		# Oui ou Non (afficher le quizz sur une seule page)
	_mandatory	enum('O', 'N') default 'N' not null,		# Oui ou Non (saisie obligatoire sur réponse)
	_random		varchar(2) not null,				# nombre de questions à tirer dans la liste
	_delay	varchar(2) not null,					# durée du quizz (minutes)
	_visible	enum('O', 'N') default 'N' not null,		# Oui ou Non (quizz ouvert)
	primary key (_IDquizz),
	unique key _key(_IDroot, _titre)
	) ENGINE = MyISAM COMMENT = "Table des quizz";

###############################################################################
# table des questions des quizz
# ver 1.2
#
## modification champ _image : varchar(3) -> _tinytext

create table quizz_data (
	_IDdata		int unsigned not null auto_increment,		# ID de la question du quizz
	_IDquizz	int unsigned not null,				# ID du quizz
	_texte		mediumtext not null,				# description du quizz
	_image		tinytext not null,				# image associée à la question (permalien autorisé)
	_type		enum('0', '1', '2', '3') default '0' not null,	# type question (0 : réponse unique, 1 : réponses multiples, 2 : liste, 3 : zone de texte)
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table des questions des quizz";

###############################################################################
# table des réponses proposées
# ver 1.0

create table quizz_items (
	_IDitem		int unsigned not null,				# ID de la réponse
	_IDdata		int unsigned not null,				# ID de la question du quizz
	_texte		tinytext not null,				# texte de la réponse
	_pts		int unsigned default '0' not null,		# points associés à la question
	unique key (_IDitem, _IDdata)
	) ENGINE = MyISAM COMMENT = "Table des réponses proposées par un quizz";

###############################################################################
# table des réponses données
# ver 1.2
#
## suppression champ _IDvote
## ajout champs _text et _index
## ajout index unique

create table quizz_vote (
	_IDquizz	int unsigned not null,				# ID du quizz
	_IDdata		int unsigned not null,				# ID de la question du quizz
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_index		int unsigned default '0' not null,		# index des réponses (si plusieurs réponses à donner sur la même question)
	_Iditem		int unsigned default '0' not null,		# ID de la réponse
	_text		varchar(40) not null,				# texte de la réponse
	_date		datetime not null,				# date de la réponse
	_hit		int unsigned default '0' not null,		# nbr de passage sur la question
	unique key (_IDquizz, _IDdata, _ID, _IP, _index)
	) ENGINE = MyISAM COMMENT = "Table des réponses données à un quizz";

###############################################################################
# table des répertoires des quizz
# ver 1.0

create table quizz_root (
	_IDroot		int unsigned not null auto_increment,		# ID du répertoire
	_IDparent	int unsigned not null,				# ID du répertoire parent (0 si racine)
	_IDgroup	int default '0' not null,			# sélecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDcat		int unsigned not null,				# ID de la matière
	_ID		int unsigned not null,				# ID du propriétaire du répertoire
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date et heure de création
	_titre		varchar(40) not null,				# nom du répertoire
	_IDmod		int unsigned not null,				# ID du modérateur du répertoire
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_private	enum('O', 'N') default 'N' not null,		# répertoire privé (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# répertoire accessible (O : Oui, N : Non)
	primary key (_IDroot),
	unique key _key(_IDparent, _IDcat, _IDgroup, _titre)
	) ENGINE = MyISAM  COMMENT = "Table des répertoires des quizz";

###############################################################################
# table des profils des quizz
# ver 1.0

create table quizz_user (
	_IDquizz	int unsigned not null,				# ID du quizz
	_IDuser		int unsigned not null,				# ID de l'utilisateur
	_date		datetime not null,				# date de début du quizz
	_random		mediumtext not null,				# les questions aléatoires
	unique key _key(_IDquizz, _IDuser)
	) ENGINE = MyISAM COMMENT = "Table des profils des quizz";

###############################################################################
# table des cours en ligne
# ver 1.5
#
## ajout champ _sort

create table cours (
	_IDcours	int unsigned not null auto_increment,		# ID des cours en ligne
	_IDmat		int unsigned not null,				# ID de la matière
	_IDmod		int unsigned default '0' not null,		# ID du modérateur
	_IP		bigint default '0' not null,			# station de travail
	_date		datetime not null,				# date de création du cours
	_titre		varchar(60) not null,				# intitulé du cours
	_texte		tinytext not null,				# description du cours
	_IDgrp		text not null,					# destinataires des cours (voir table campus_class)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '255' not null,		# ID des lecteurs (voir table groupe)
	_private	enum('O', 'N') default 'N' not null,		# cours privé (O : Oui, N : Non)
	_PJ		int unsigned default '1' not null,		# nombre de Pièces Jointes autorisées
	_sort		int unsigned default '0' not null,		# tri (0 : n° d'ordre, 1 : nom de fichier, 2 : intitulé)
	_visible	enum('O', 'N') default 'O' not null,		# cours ouvert (O : Oui, N : Non)
	primary key (_IDcours),
	unique key (_IDmat, _titre)
	) ENGINE = MyISAM COMMENT = "Table des cours en ligne";

###############################################################################
# table des répertoires des items
# ver 1.3
#
## rajout champs _order et _usability

create table cours_data (
	_IDdata		int unsigned not null auto_increment,		# ID du répertoire
	_IDparent	int unsigned not null,				# ID du répertoire parent
	_IDcours	int unsigned not null,				# ID du cours
	_ID		int unsigned default '0' not null,		# ID de connexion (qui a créé l'item)
	_IP		bigint default '0' not null,			# station de travail
	_date		datetime not null,				# date de création du répertoire
	_titre		varchar(40) not null,				# intitulé du répertoire
	_texte		tinytext not null,				# annonce du module
	_info		datetime not null,				# date de l'annonce
	_open		datetime not null,				# date d'accessibilité du répertoire
	_max		enum('O', 'N') default 'N' not null,		# déployer le répertoire (O : Oui, N : Non)
	_usability	int unsigned default '0' not null,		# niveau d'utilisabilité (0 : indéfini, 1 : Visuel, 2 : Auditif, 4 : Kinesthésique))
	_order		int unsigned default '0' not null,		# ordre dans la liste
	_visible	enum('O', 'N') default 'O' not null,		# répertoire ouvert (O : Oui, N : Non)
	primary key (_IDdata),
	unique key (_IDparent, _IDcours, _titre)
	) ENGINE = MyISAM COMMENT = "Table des répertoires des items des cours";

###############################################################################
# table des items par cours
# ver 1.3
#
## rajout champs _time et _order

create table cours_items (
	_IDitem		int unsigned not null auto_increment,		# ID de l'item
	_IDdata		int unsigned not null,				# ID du répertoire
	_IDcours	int unsigned not null,				# ID du cours
	_ID		int unsigned default '0' not null,		# ID de connexion (qui a créé l'item)
	_IP		bigint default '0' not null,			# station de travail
	_date		datetime not null,				# date de création du cours
	_titre		varchar(40) not null,				# intitulé de l'item
	_texte		tinytext not null,				# description de l'item
	_open		datetime not null,				# date d'accessibilité de l'item
	_file		varchar(80) not null,				# nom du fichier de l'item
	_size		int unsigned not null,				# taille du fichier de l'item
	_ver		varchar(10) default '1.0' not null,		# version du fichier de l'item
	_usability	int unsigned default '0' not null,		# niveau d'utilisabilité (0 : indéfini, 1 : Visuel, 2 : Auditif, 4 : Kinesthésique))
	_note		mediumtext not null,				# note associée au document
	_time		time not null,					# durée associée à la ressource
	_order		int unsigned default '0' not null,		# ordre dans la liste
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (item publiable)
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des items par cours";

###############################################################################
# table des cahiers de texte numériques
# ver 1.9
#
## rajout champ : _sndmail

create table ctn (
	_IDctn		int unsigned not null auto_increment,		# ID du cahier de texte numérique
	_IDclass	int unsigned default '0' not null,		# ID de la classe
	_IDgroup	int unsigned default '0' not null,		# ID du e-groupe
	_IDcentre	int unsigned default '1' not null,		# ID du centre
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur du cahier de texte)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_month		tinyint unsigned default '0' not null,		# début année scolaire (0 : janvier, 1 : février, ...)
	_visible	enum('O', 'N') default 'O' not null,		# cahier de texte ouvert (O : Oui, N : Non)
	_PJ		enum('O', 'N') default 'N' not null,		# autoriser les Pièces Jointes (O : Oui, N : Non)
	_diary		enum('O', 'N') default 'N' not null,		# copier dans les agendas (O : Oui, N : Non)
	_currdate	enum('O', 'N') default 'O' not null,		# utiliser la date en cours (O : Oui, N : Non)
	_display	enum('D', 'W', 'M') default 'D' not null,	# affichage par défaut (D : jour, W : semaine, M : mois)
	_limited	enum('O', 'N') default 'N' not null,		# accès limité à la classe concernée (O : Oui, N : Non)
	_common		enum('O', 'N') default 'N' not null,		# CTN commun aux rédacteurs (O : Oui, N : Non)
	_horaire	tinytext not null,				# plages horaires (séparateur ,)
	_font		int unsigned default '10' not null,		# taille police pour impression CTN
	_rss		enum('O', 'N') default 'N' not null,		# flux rss (O : Oui, N : Non)
	_sndmail	enum('O', 'N') default 'N' not null,		# envoi copie à l'enseignant (O : Oui, N : Non)
	primary key (_IDctn),
	unique key (_IDclass, _IDgroup)
	) ENGINE = MyISAM COMMENT = "Table des cahiers de texte numériques";

###############################################################################
# table des articles des cahiers de texte numériques
# ver 1.4
#
## suppression champs : _type, _todo, _comment

create table ctn_items (
	_IDitem		int unsigned not null auto_increment,		# ID de l'article
	_IDctn		int unsigned not null,				# ID de cahier de texte numérique
	_IDmat		int unsigned default '0' not null,		# ID de la matière (voir table campus)
	_ID		int unsigned not null,				# ID de connexion (posteur de l'article)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de création de l'article
	_delay		varchar(20) not null,				# durée de l'activité
	_title		varchar(80) not null,				# intitulé du cours
	_texte		mediumtext not null,				# texte de l'article
	_raw		enum('O', 'N') default 'O' not null,		# texte brut avec balises SPIP (O : Oui, N : Non)
	_note		mediumtext not null,				# note attachée à l'article
	_visible	enum('O', 'N') default 'O' not null,		# article publiable (O : Oui, N : Non)
	_type		int unsigned default '0' not null,
	_IDcours	int unsigned default '0' not null,
	_nosemaine	int unsigned default '0' not null,
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des articles des cahiers de texte numériques";

###############################################################################
# table des commentaires des Pièces Jointes du cahier de texte numérique
# ver 1.0

create table ctn_data (
	_IDdata		int unsigned not null auto_increment,		# ID de la PJ
	_IDitem		int unsigned not null,				# ID de l'article du cahier de texte numérique
	_type		int unsigned default '0' not null,		# type de la PJ (0 : article, 1 : devoir, 2 : controle)
	_todo		datetime not null,				# date du rendu
	_text		mediumtext not null,				# commentaire sur rendu
	primary key (_IDdata),
	unique key _key(_IDitem, _type)
	) ENGINE = MyISAM COMMENT = "Table des commentaires des PJ du cahier de texte";

###############################################################################
# table des Pièces Jointes du cahier de texte numérique
# ver 1.1
#
# remarques : les PJ sont placées dans le répertoire download/ctn/<_IDpj>.<_ext>

create table ctn_pj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_IDitem		int unsigned not null,				# ID de l'article du cahier de texte numérique
	_title		varchar(80) not null,				# titre de la PJ
	_ext		varchar(5) not null,				# extension du fichier en PJ
	_size		int unsigned not null,				# taille du fichier
	_type		int unsigned default '0' not null,		# type de la PJ (0 : article, 1 : devoir, 2 : controle)
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ du cahier de texte";

###############################################################################
# table des articles lus dans les cahiers de texte numériques
# ver 1.0

create table ctn_vu (
	_IDitem		int unsigned not null auto_increment,		# ID de l'article
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# IP de la station
	_date		datetime not null,				# date et heure de lecture
	unique key _key(_IDitem, _ID)
	) ENGINE = MyISAM COMMENT = "Table de log des articles lus";

###############################################################################
# table des cahiers de texte numériques personnels
# ver 1.0
#
# remarques : les progressions sont placées dans le répertoire download/ctn/files/<_year>-<_file>

create table ctn_user (
	_IDuser		int unsigned not null auto_increment,		# ID du cahier de texte
	_IDclass	int unsigned not null,				# ID de cahier de texte numérique
	_IDmat		int unsigned default '0' not null,		# ID de la matière (voir table campus)
	_ID		int unsigned not null,				# ID de connexion (posteur de l'article)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de création du cahier de texte
	_year		int unsigned not null,				# année scolaire
	_file		varchar(80) not null,				# fichier de la progression
	primary key (_IDuser),
	unique key _key(_IDclass, _IDmat, _year)
	) ENGINE = MyISAM COMMENT = "Table des cahiers de texte numériques personnels";

###############################################################################
