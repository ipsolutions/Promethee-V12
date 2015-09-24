##############################################################################
#    Copyright (c) 2007 by Dominique Laporte (C-E-D@wanadoo.fr)              #
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
# table des e-groupes
# ver 1.#
#
## modification clef primaire

create table egroup (
	_IDgroup	int unsigned not null auto_increment,		# ID du groupe
	_IDitem		int unsigned default '1' not null,		# ID du type de groupe (voir table egroup_items)
	_IDparent	int unsigned default '0' not null,		# ID du groupe parent
	_IDmod		int unsigned default '0' not null,		# modérateur (ID utilisateur)
	_IDgrpwr	int unsigned default '0' not null,		# groupes des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '255' not null,		# groupes des lecteurs (voir table groupe)
	_date		datetime not null,				# date et heure de création
	_valid		datetime not null,				# date de limite de validité du egroup (illimité si '')
	_ident		varchar(60) not null,				# identité du groupe
	_comment	mediumtext not null,				# commentaires sur le groupe
	_private	enum('O', 'N') default 'N' not null,		# egroup privé (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# egroup ouvert (O : Oui, N : Non)
	_lang		varchar(2) not null,				# code langue
	primary key (_IDgroup, _lang),
	unique key (_lang, _IDparent, _ident)
	) ENGINE = MyISAM COMMENT = "liste des e-groupes";

###############################################################################
# table des e-groupes des utilisateurs
# ver 1.0

create table egroup_data (
	_IDdata		int unsigned not null auto_increment,		# ID de l'egroup utilisateur
	_IDgroup	int unsigned not null,				# ID du e-groupe
	_IDmod		int unsigned default '0' not null,		# modérateur (ID utilisateur)
	_IDgrpwr	int unsigned default '0' not null,		# groupes des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '255' not null,		# groupes des lecteurs (voir table groupe)
	_date		datetime not null,				# date et heure de création
	_IP		bigint default '0' not null,			# IP de connexion (station du posteur)
	_valid		datetime not null,				# date de limite de validité du egroup (illimité si '')
	_lastcnx	datetime not null,				# date et heure du dernier accès
	_ident		varchar(60) not null,				# identité du groupe
	_comment	mediumtext not null,				# description du groupe
	_email		varchar(40) not null,				# webmail du groupe
	_lang		varchar(2) not null,				# langue du groupe (fr, gb, de, jp, ...)
	_space		int unsigned default '0' not null,		# espace disque utilisé
	_cnx		int unsigned default '0' not null,		# nbr de connexions (mesure d'activité)
	_private	enum('O', 'N') default 'N' not null,		# egroup privé (O : Oui, N : Non)
	_auto		enum('O', 'N') default 'O' not null,		# inscription/désinscription automatique (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# egroup ouvert (O : Oui, N : Non)
	_IDmenu		bigint default '0' not null,			# ID des modules accessibles aux utilisateurs
	primary key (_IDdata),
	unique key (_lang, _IDdata)
	) ENGINE = MyISAM COMMENT = "Les e-groupes des utilisateurs";

###############################################################################
# table des type de e-groupes
# ver 1.2
#
## modification clef unique

create table egroup_items (
	_IDitem		int unsigned not null,				# ID du type
	_ident		varchar(40) not null,				# intitulé du type
	_visible	enum('O', 'N') default 'O' not null,		# type ouvert (O : Oui, N : Non)
	_lang		varchar(2) not null,				# code langue
	primary key (_IDitem, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Les type de e-groupes";

###############################################################################
# table des utilisateurs des e-groupes
# ver 1.1
#
## ajout champ _invite

create table egroup_user (
	_IDuser		int unsigned not null auto_increment,		# ID de la table
	_IDdata		int unsigned not null,				# ID de l'egroup utilisateur
	_ID		int unsigned not null,				# ID de l'utilisateur
	_access		int default '-1' not null,			# droits d'accès (-1 : attente validation, 0 : bannis, 1 : lecteur, 2 : rédacteur, 4 : modérateur)
	_date		datetime not null,				# date et heure de création
	_valid		datetime not null,				# date de limite de validité (illimité si '')
	_lastcnx	datetime not null,				# date et heure de dernier accès
	_invite		datetime not null,				# date et heure de dernier envoie d'une invitation
	_cnx		int unsigned default '0' not null,		# nbr de connexions (mesure d'activité)
	primary key (_IDuser),
	unique key (_IDdata, _ID)
	) ENGINE = MyISAM COMMENT = "Les utilisateurs des e-groupes";

###############################################################################
# table des intitulés des modules des e-groupes
# ver 1.3
#
## ajout champs : _anonyme, _visible, _Idgrprd, _url
## taille champ _link : 20 -> 40

create table egroup_menu (
	_IDmenu		int unsigned not null auto_increment,		# ID du menu
	_IDitem		int unsigned default '1' not null,		# ID du type de groupe (voir table egroup_items)
	_ident		varchar(20) not null,				# intitulé du module
	_text		tinytext not null,				# description du module
	_link		varchar(40) not null,				# page PHP appelée
	_url		enum('O', 'N') default 'O' not null,		# url (O : Oui, N : Non) ou contenu
	_IDgrprd	int unsigned default '255' not null,		# ID des lecteurs (voir table groupe)
	_anonyme	enum('O', 'N') default 'O' not null,		# accès en mode anonyme (O : Oui, N : Non)
	_backoffice	enum('O', 'N') default 'N' not null,		# accès au backoffice (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# sous menu visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# code langue
	primary key (_IDmenu, _IDitem, _lang)
	) ENGINE = MyISAM COMMENT = "Les intitulés des modules des e-groupes";

###############################################################################
# table des droits d'accès des utilisateurs pour les e-groupes
# ver 1.1
#
## modification clef unique

create table egroup_access (
	_IDaccess	int not null,					# niveau d'accès
	_ident		varchar(20) not null,				# intitulé du niveau d'accès
	_lang		varchar(2) not null,				# code langue
	primary key (_IDaccess, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM COMMENT = "table des droits d'accès des utilisateurs pour les e-groupes";

###############################################################################