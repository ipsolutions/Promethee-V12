##############################################################################
#    Copyright (c) 2002-2004 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# table des weblogs
# ver 1.0
#
## les images de présentations pour les weblogs sont classées dans "download/weblog/img/<_IDlog>.png"

create table weblog (
	_IDlog		int unsigned not null auto_increment,		# ID de weblog
	_IDgroup	int default '0' not null,			# sélecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_ID		int unsigned default '0' not null,		# ID de connexion (propriétaire du weblog, 0 pour droits par groupes d'utilisateurs)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_date		datetime not null,				# date et heure de création du weblog
	_text		tinytext not null,				# description du weblog
	_private	enum('O', 'N') default 'N' not null,		# weblog privé (O : Oui, N : Non)
	_comment	enum('O', 'N') default 'O' not null,		# autoriser les commentaires (O : Oui, N : Non)
	_PJ		enum('O', 'N') default 'N' not null,		# autoriser les Pièces Jointes (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# weblog ouvert (O : Oui, N : Non)
	primary key (_IDlog),
	unique key _key(_ID, _IDgroup)
	) ENGINE = MyISAM COMMENT = "Table des weblogs";

###############################################################################
# table des thèmes des weblogs
# ver 1.0

create table weblog_data (
	_IDdata		int unsigned not null auto_increment,		# ID de la catégorie
	_IDlog		int unsigned not null,				# ID de weblog
	_ID		int unsigned not null,				# ID de connexion (posteur du message)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de création du message
	_title		varchar(80) not null,				# titre de la catégorie
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table des thèmes des weblogs";

###############################################################################
# table des articles des weblogs
# ver 1.0

create table weblog_items (
	_IDitem		int unsigned not null auto_increment,		# ID du message
	_IDdata		int unsigned not null,				# ID de la catégorie
	_ID		int unsigned not null,				# ID de connexion (posteur du message)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de création du message
	_update		datetime not null,				# date de modification du message
	_parent		int unsigned default '0' not null,		# ID de l'article parent
	_title		varchar(80) not null,				# titre du message
	_text		mediumtext not null,				# texte du message
	_raw		enum('O', 'N') default 'O' not null,		# texte brut avec balises SPIP (O : Oui, N : Non)
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des articles des weblogs";

###############################################################################
# table des commentaires des weblogs
# ver 1.0

create table weblog_note (
	_IDnote		int unsigned not null auto_increment,		# ID du commentaire
	_IDitem		int unsigned not null,				# ID du message
	_ID		int unsigned not null,				# ID de connexion (posteur du message)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de création du message
	_title		varchar(80) not null,				# titre du commentaire
	_text		mediumtext not null,				# texte du commentaire
	_parent		int unsigned default '0' not null,		# ID du commentaire parent
	primary key (_IDnote)
	) ENGINE = MyISAM COMMENT = "Table des articles des weblogs";

###############################################################################
# table des Pièces Jointes des weblogs
# ver 1.0
#
# remarques : les PJ sont placées dans le répertoire download/weblog

create table weblog_pj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_IDitem		int unsigned not null,				# ID du message
	_file		varchar(80) not null,				# nom du fichier
	_size		int unsigned not null,				# taille du fichier
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ des weblogs";

###############################################################################
# table des messages lus dans les weblogs
# ver 1.1

create table weblog_vu (
	_IDitem		int unsigned not null auto_increment,		# ID du message
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# IP de la station
	_date		datetime not null,				# date et heure de lecture
	unique key _key(_IDitem, _ID)
	) ENGINE = MyISAM COMMENT = "Table des messages lus des weblogs";

###############################################################################
# table des liens dans les weblogs
# ver 1.0

create table weblog_link (
	_IDlink		int unsigned not null auto_increment,		# ID du lien
	_IDlog		int unsigned not null,				# ID de weblog
	_title		varchar(80) not null,				# titre du site
	_url		varchar(128) not null,				# URL
	_lang		varchar(2) not null,				# langue des liens
	primary key (_IDlink)
	) ENGINE = MyISAM COMMENT = "Table des liens";

###############################################################################