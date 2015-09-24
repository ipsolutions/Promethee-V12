##############################################################################
#    Copyright (c) 2002-2004 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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


use `##DATABASE##`;

###############################################################################
# table des r�pertoires des flash-infos
# ver 1.0

create table flash_root (
	_IDroot		int unsigned not null auto_increment,		# ID du r�pertoire
	_IDparent	int unsigned not null,				# ID du r�pertoire parent (0 si racine)
	_ID		int unsigned not null,				# ID du propri�taire du r�pertoire
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date et heure de cr�ation
	_ident		varchar(40) not null,				# nom du r�pertoire
	_IDmod		int unsigned not null,				# ID du mod�rateur du r�pertoire
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_private	enum('O', 'N') default 'N' not null,		# r�pertoire priv� (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# r�pertoire accessible (O : Oui, N : Non)
	primary key (_IDroot),
	unique key _key(_IDparent, _ident)
	) ENGINE = MyISAM  COMMENT = "Table des r�pertoires des flash-infos";

###############################################################################
# table des flash-infos
# ver 2.4
#
## modification champ _chrono
## ajout champs _autoval, _poster

create table flash (
	_IDflash	int unsigned not null auto_increment,		# ID du flash info
	_IDroot	int unsigned default '0' not null,			# ID du r�pertoire (0 si racine)
	_IDmod		int default '0' not null,			# ID de connexion (mod�rateur)
	_IDgrp		int unsigned default '0' not null,		# ID du groupe par d�faut (voir table groupe)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_date		datetime not null,				# date de cr�ation du flash info
	_lock		enum('O', 'N') default 'N' not null,		# flash verrouill� en �criture (O : Oui, N : Non)
	_title		varchar(80) not null,				# titre du flash info
	_align		enum('G', 'C', 'D') default 'C' not null,	# alignement du titre (G : Gauche, C : Centr�, D : Droit)
	_texte		tinytext not null,				# description du flash info
	_template	varchar(20) default 'default.htm' not null,	# nom du fichier template
	_type		enum('F', 'P', 'B', 'C') default 'F' not null,	# type d'infos (F : Flash, P : Publication, B : Br�ve, C : Contenu)
	_private	enum('O', 'N') default 'N' not null,		# flash priv� (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# flash publiable (O : Oui, N : Non)
	_autoval	enum('O', 'N') default 'O' not null,		# validation automatique des annonces (O : Oui, N : Non)
	_poster		enum('O', 'N') default 'O' not null,		# affichage du poster (O : Oui, N : Non)
	_PJ		int unsigned default '0' not null,		# nombre de Pi�ces Jointes
	_chrono		enum('O', 'N', 'S') default 'O' not null,	# affichage des articles par ordre chronologique (O : Oui, N : Non, S : s�quentiel)
	_create		enum('O', 'N') default 'O' not null,		# affichage des flash par date de cr�ation (O : Oui, N : Non), sinon par date de modification
	_rss		enum('O', 'N') default 'N' not null,		# utilisation d'un flux rss (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue du flash
	primary key (_IDflash),
	unique key _key(_title, _type, _lang)
	) ENGINE = MyISAM COMMENT = "Table des publications par Internet";

###############################################################################
# table des flash-infos par d�faut
# ver 1.1
#
# rajout champ _lang

create table flash_default (
	_IDcentre	int unsigned default '0' not null,		# ID du centre
	_IDflash	int unsigned not null,		# ID du flash info
	_IDgrp		bigint unsigned default '0' not null,		# ID des lecteurs concern�s (voir table groupe)
	_lang		varchar(2) not null,				# langue du flash
	unique key _key(_IDcentre, _IDflash)
	) ENGINE = MyISAM COMMENT = "Table des flash-infos par d�faut";

###############################################################################
# table des rubriques des flash-infos
# ver 1.5
#
# remarque : - les fichiers image ont pour nom
#              download/spip/img/img<_IDinfos>#<0|1>.<_img> (0 et 1 pour survol)
#            - le fichier musical a pour nom
#              download/spip/snd/snd<_IDinfos>.<_snd>

create table flash_data (
	_IDinfos	int unsigned not null auto_increment,		# ID de l'information
	_IDflash	int unsigned not null,				# ID du flash info
	_date		datetime not null,				# date de cr�ation de l'info
	_modif		datetime,					# date de modification de l'info
	_ID		int unsigned not null,				# ID de connexion (qui a cr�� l'info)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_title		varchar(80) not null,				# titre de l'info
	_align		enum('G', 'C', 'D') default 'C' not null,	# alignement du titre (G : Gauche, C : Centr�, D : Droit)
	_color		varchar(7) default '#FFFFFF' not null,		# code couleur du fond du titre
	_img		varchar(5),					# extension du fichier image
	_snd		varchar(5),					# extension du fichier musical
	_repeat		enum('O', 'N') default 'O' not null,		# boucle sur fichier musical (O : Oui, N : Non)
	_hit		int unsigned default '0' not null,		# nombre de clicks sur l'info
	_visible	enum('O', 'N') default 'O' not null,		# info publiable (O : Oui, N : Non)
	primary key (_IDinfos),
	unique key _key(_IDflash, _title)
	) ENGINE = MyISAM COMMENT = "Table des rubriques des publications par Internet";

###############################################################################
# table des articles des flash-infos
# ver 1.9
#
# remarque : le fichier image pour le fond du texte est
#            download/spip/img/img<_IDitem>.<_img>
#
## ajout champ _order

create table flash_items (
	_IDitem	int unsigned not null auto_increment,			# ID de l'article
	_IDinfos	int unsigned not null,				# ID de l'info � laquelle appartient l'article
	_date		datetime not null,				# date de cr�ation de l'article (utile pour moteur de recherche)
	_modif		datetime,					# date de modification de l'article
	_ID		int unsigned not null,				# ID de connexion (contributeur de l'article)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_title		varchar(80) not null,				# titre de l'article
	_texte		mediumtext not null,				# texte de l'article
	_raw		enum('O', 'N') default 'O' not null,		# texte brut avec balises SPIP (O : Oui, N : Non)
	_c		varchar(2) default 'ON',			# texte centr�
	_e		varchar(2) default 'ON',			# texte encadr�
	_r		varchar(2) default 'ON',			# texte en rouge
	_color		varchar(7) default '#FFFFFF' not null,		# code couleur pour le fond du texte
	_img		varchar(5) not null,				# extension du fichier image pour le fond du texte
	_order		int unsigned default '0' not null,		# ID de l'info � laquelle appartient l'article
	_visible	enum('O', 'N') default 'O' not null,		# article publiable (O : Oui, N : Non)
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des articles par rubriques des publications par Internet";

###############################################################################
# table des br�ves des flash-infos
# ver 1.2
#
# remarque : le fichier image pour l'image associ�e � la d�p�che est
#            download/spip/img/annonces/_img
#
## modification champ _IDgrp : bigint => text

create table flash_breve (
	_IDbreve	int unsigned not null auto_increment,		# ID de la d�p�che
	_IDflash	int unsigned not null,				# ID du flash � laquelle appartient la d�p�che
	_date		datetime not null,				# date de cr�ation de la d�p�che
	_ID		int unsigned not null,				# ID de connexion (contributeur de la d�p�che)
	_IDgrp		text not null,					# ID des lecteurs concern�s (voir table groupe)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_title		varchar(80) not null,				# titre de la d�p�che
	_texte		mediumtext not null,				# texte de la d�p�che
	_color		varchar(7) default '#FFFFFF' not null,		# code couleur pour le fond du texte
	_img		varchar(20) default 'defaut.png' not null,	# nom du fichier associ� � la d�p�che
	_hit		int unsigned default '0' not null,		# nombre de clicks sur la d�p�che
	_visible	enum('O', 'N') default 'O' not null,		# article publiable (O : Oui, N : Non)
	primary key (_IDbreve)
	) ENGINE = MyISAM COMMENT = "Table des br�ves des publications par Internet";

###############################################################################
# table des votes des flash-infos
# ver 1.0

create table flash_vote (
	_IDvote		int unsigned not null auto_increment,		# ID du vote
	_IDbreve	int unsigned not null,				# ID de la d�p�che
	_ID		int unsigned not null,				# ID de connexion (votant)
	_vote		int unsigned default '0' not null,		# vote concernant la d�p�che
	primary key (_IDvote)
	) ENGINE = MyISAM COMMENT = "Table des votes concernant les br�ves des publications par Internet";

###############################################################################
# table des liens des flash-infos
# ver 1.0
#
# remarque : les images du code pays _lang sont stock�es dans le r�pertoire images/spip/langues/<_lang>

create table flash_link (
	_IDlink		int unsigned not null auto_increment,		# ID du lien
	_IDbreve	int unsigned not null,				# ID de la d�p�che
	_titre		varchar(80) not null,				# titre du site
	_url		varchar(128) not null,				# URL
	_texte		tinytext not null,				# description du lien
	_lang		varchar(6) not null,				# code pays de la langue du site
	_IDlicense	int unsigned default '0' not null,		# type de licence
	primary key (_IDlink)
	) ENGINE = MyISAM COMMENT = "Table des liens concernant les br�ves des publications par Internet";

###############################################################################
# table des Pi�ces Jointes des flash-infos
# ver 1.0
#
# remarques : les PJ peuvent �tre - des documents (texte, dessin, vid�o, ...) attach�s � la fin de l'article
#                                 - des images illustrant l'article
#                                 - un fichier son accompagnant l'article
# elles sont respectivement plac�es dans les r�pertoires : doc, img et snd de download/spip
# elles ont comme nom : <_IDitem>-<_IDpj>.<_ext>

create table flash_pj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_IDitem		int unsigned not null,				# ID de l'article
	_title		varchar(40) not null,				# titre de la PJ
	_texte		varchar(80) not null,				# description de la PJ
	_ext		varchar(5) not null,				# extension du fichier en PJ
	_size		int unsigned not null,				# taille du fichier
	_res		varchar(20) not null,				# r�solution d'un fichier image
	_attach		enum('O', 'N') default 'O' not null,		# PJ attach�e � un article (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# PJ publiable (O : Oui, N : Non)
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ par rubrique des publications par Internet";

###############################################################################
# table des FIL d'information
# ver 1.4
#
## ajout des champs : _IDgroup
## modification champs : _IDflash unsigned int -> int

create table flash_fil (
	_IDfil		int unsigned not null auto_increment,		# ID du FIL
	_IDflash	int default '0' not null,				# ID du flash info (cat�gorie des annonces => 0 : agenda, > 0 : FIL info, <  0 : egroupe)
	_IDgroup	int default '0' not null,				# autorisation de visualisation (0 : egroup uniquement, > 0 : th�me, < 0 : rubrique)
	_date		datetime not null,				# date de cr�ation de l'annonce
	_start		datetime not null,				# date de publication de l'annonce
	_end		datetime not null,				# date de fin de publication de l'annonce
	_ID		int unsigned not null,				# ID de connexion (contributeur de l'article)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDgrp		bigint unsigned default '255' not null,		# ID des lecteurs concern�s (voir table groupe)
	_title		varchar(80) not null,				# titre de l'article
	_texte		mediumtext not null,				# texte de l'article
	_img		varchar(20) default 'defaut.png' not null,	# nom du fichier associ� � la d�p�che
	_hit		int unsigned default '0' not null,		# nombre de lecture de l'annonce
	_post		enum('O', 'N') default 'N' not null,		# authoriser les commentaires (O : Oui, N : Non)
	_persistent	enum('O', 'N') default 'N' not null,		# texte persistant (O : Oui, N : Non)
	primary key (_IDfil)
	) ENGINE = MyISAM COMMENT = "Table des FIL d'information";

###############################################################################
# table des commentaires des FIL
# ver 1.0

create table flash_filpost (
	_IDmsg		int unsigned not null auto_increment,		# ID de l'article
	_IDfil		int unsigned not null,				# ID du FIL
	_ID		int unsigned not null,				# ID de connexion (posteur du message)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de cr�ation du message
	_texte		mediumtext not null,				# texte du message
	primary key (_IDmsg)
	) ENGINE = MyISAM COMMENT = "Table des commentaires des FIL";

###############################################################################
# table des Pi�ces Jointes des FIL d'information
# ver 1.0
#
# elles sont plac�es dans le r�pertoire download/fil
# elles ont comme nom : <_IDpj>.<extension du fichier>

create table flash_filpj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_IDfil		int unsigned not null,				# ID du FIL
	_file		varchar(80) not null,				# nom du fichier
	_size		int unsigned not null,				# taille du fichier
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ des FIL d'information";

###############################################################################
# table des messages lus dans les FIL d'information
# ver 1.0

create table flash_filvu (
	_IDmsg		int unsigned not null auto_increment,		# ID du message
	_IDfil		int unsigned not null,				# ID du FIL
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# IP de la station
	_date		datetime not null,				# date et heure de lecture
	primary key (_IDmsg),
	unique key _key(_IDfil, _ID)
	) ENGINE = MyISAM COMMENT = "Table de log des articles lus";

###############################################################################
# table de gestion des messages du jour
# ver 1.1
#
## ajout champ _PJ

create table motd (
	_IDcentre	int unsigned default '0' not null,		# ID du centre
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_IDgrppj	int unsigned default '0' not null,		# ID pour autorisation des pi�ces jointes (voir table groupe)
	_PJ		int unsigned default '0' not null,		# nombre de PJ autoris�es
	unique key _key(_IDcentre)
	) ENGINE = MyISAM COMMENT = "Table de gestion des messages du jour";

###############################################################################
# table des messages du jour
# ver 1.2
#
## ajout champ _persistent

create table motd_items (
	_IDitem		int unsigned not null auto_increment,		# ID du message du jour
	_IDcentre	int unsigned default '0' not null,		# ID du centre
	_date		datetime not null,				# date de cr�ation de l'annonce
	_start		datetime not null,				# date de publication de l'annonce
	_end		datetime not null,				# date de fin de publication de l'annonce
	_ID		int unsigned not null,				# ID de connexion (contributeur de l'article)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDgrp		bigint unsigned default '255' not null,		# ID des lecteurs concern�s (voir table groupe)
	_title		varchar(80) not null,				# titre de l'article
	_texte		mediumtext not null,				# texte de l'article
	_raw		enum('O', 'N') default 'O' not null,		# texte brut avec balises SPIP (O : Oui, N : Non)
	_img		varchar(20) default 'defaut.png' not null,	# nom du fichier associ� � la d�p�che
	_hit		int unsigned default '0' not null,		# nombre de lecture de l'annonce
	_persistent	enum('0', '1', '2') default '0' not null,		# message persistant (0 : Non, 1 : oui, 2 : avec acquittement)
	_lang		varchar(2) not null,				# code pays de la langue du site
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des messages du jour";

###############################################################################
# table des Pi�ces Jointes des messages du jour
# ver 1.2
#
# remarques : les PJ sont plac�es dans le r�pertoire download/motd/<_IDpj>.<_ext>
#
## ajout champ _text

create table motd_pj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_IDitem		int unsigned not null,				# ID du message
	_file		varchar(80) not null,				# nom du fichier en PJ
	_size		int unsigned not null,				# taille du fichier
	_text		tinytext not null,				# description du fichier en PJ
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ des messages du jour";

###############################################################################
# table des messages du jour lus
# ver 1.0

create table motd_vu (
	_IDitem		int unsigned not null,				# ID du message
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# IP de la station
	_date		datetime not null,				# date et heure de lecture
	_visible	enum('O', 'N') default 'O' not null,		# message visible (O : Oui, N : Non)
	unique key _key(_IDitem, _ID)
	) ENGINE = MyISAM COMMENT = "Table de log des messages du jour lus";

###############################################################################
# table des annonces d�filantes
# ver 1.0

create table marquee (
	_IDitem		int unsigned not null auto_increment,		# ID du service
	_ident		varchar(10) not null,				# identifiant du service
	_text		varchar(40) not null,				# texte du service
	_item		int unsigned default '2' not null,		# nombre d'items visibles
	_visible	enum('O', 'N') default 'O' not null,		# service visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# code pays de la langue du site
	primary key (_IDitem),
	unique key _key(_text, _lang)
	) ENGINE = MyISAM COMMENT = "Table des annonces d�filantes";

###############################################################################