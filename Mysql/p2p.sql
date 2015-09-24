##############################################################################
#    Copyright (c) 2002-2007 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# table des serveurs P2P
# ver 1.0

create table p2p (
	_IDp2p		int unsigned not null auto_increment,		# ID de l'utilisateur
	_server		varchar(80) not null,				# url du serveur
	_key		varchar(40) not null,				# clef d'identification de l'utilisateur (md5)
	_visible	enum('O', 'N') default 'O' not null,		# serveur sélectionné (O : Oui, N : Non)
	primary key (_IDp2p),
	unique key _key(_server)
	) ENGINE = MyISAM COMMENT = "Table des serveurs P2P";

###############################################################################
# table des plate-formes de confiance
# ver 1.2
#
## ajout champs : _zip, _city, _public

create table p2p_data (
	_IDdata		int unsigned not null auto_increment,		# ID de l'utilisateur
	_key		varchar(40) not null,				# clef d'identification de l'utilisateur (md5)
	_ident		varchar(60) not null,				# identification de l'établissement
	_adresse	varchar(60) not null,				# adresse de l'établissement
	_zip		varchar(6) not null,				# code postal de l'établissement
	_city		varchar(20) not null,				# ville de l'établissement
	_tel		varchar(20) not null,				# téléphone de l'établissement
	_fax		varchar(20) not null,				# fax de l'établissement
	_url		varchar(40) not null,				# url de la plate-forme
	_basedir	varchar(40) not null,				# répertoire d'installation de la plate-forme
	_webmaster	varchar(40) not null,				# email du webmaster
	_create		datetime not null,				# date de création
	_update		datetime not null,				# date de mise à jour
	_visible	enum('O', 'N') default 'O' not null,		# plate-forme valide (O : Oui, N : Non)
	_public		enum('O', 'N') default 'O' not null,		# plate-forme publique (O : Oui, N : Non)
	primary key (_IDdata),
	unique key _key(_ident, _tel)
	) ENGINE = MyISAM COMMENT = "Table des plate-formes de confiance";

###############################################################################
# table des ressources p2p
# ver 1.2
#
## ajout champ _usability

create table p2p_items (
	_IDitem		int unsigned not null auto_increment,		# ID de ressource
	_IDdata		int unsigned not null,				# ID de l'utilisateur (voir table p2p_data)
	_type		varchar(40) not null,				# type de la ressource
	_cat		varchar(40) not null,				# catégorie de la ressource
	_url		varchar(255) not null,				# url de la ressource
	_title		varchar(80) not null,				# titre de la ressource
	_text		tinytext not null,				# description du fichier ressource
	_format		varchar(3) not null,				# format de la ressource
	_size		int unsigned not null,				# taille du fichier ressource
	_lang		varchar(2) not null,				# langue de l'utilisateur
	_IDlicense	int unsigned default '1' not null,		# ID du type de licence (voir table resource_license)
	_usability	int unsigned default '0' not null,		# niveau d'utilisabilité (0 : indéfini, 1 : Visuel, 2 : Auditif, 4 : Kinesthésique))
	_level		tinytext not null,				# niveau enseignement
	_author		varchar(40) not null,				# nom de la personne connectée
	_date		datetime not null,				# date de création de la ressource
	primary key (_IDitem),
	unique key _key(_url)
	) ENGINE = MyISAM COMMENT = "Table des ressources p2p";

###############################################################################
# table des annuaires p2p
# ver 1.0

create table p2p_directory (
	_IDitem		int unsigned not null auto_increment,		# ID de l'annuaire
	_IDdata		int unsigned not null,				# ID de l'utilisateur (voir table p2p_data)
	_center	varchar(80) not null,				# centre de l'utilisateur
	_group	varchar(20) not null,				# groupe utilisateur
	_name		varchar(40) not null,				# nom de l'utilisateur
	_fname		varchar(40) not null,				# prénom de l'utilisateur
	_sex		enum('H', 'F') not null,				# sexe (H : Homme, F : Femme)
	_title		varchar(40) not null,				# titre de l'utilisateur
	_function		tinytext not null,				# fonction de l'utilisateur
	_email		varchar(40) not null,				# email de l'utilisateur
	_tel		varchar(20) not null,				# téléphone de l'utilisateur
	_adr		tinytext not null,				# adresse de l'utilisateur
	_cp		varchar(10) not null,				# code postal de l'utilisateur
	_city		varchar(40) not null,				# ville de l'utilisateur
	_lang		varchar(2) not null,				# langue de l'utilisateur
	_date		datetime not null,				# date de création de la fiche
	primary key (_IDitem),
	unique key _key(_IDdata, _name, _fname, _email)
	) ENGINE = MyISAM COMMENT = "Table des annuaires p2p";

###############################################################################
# table du partage des ressources autorisées
# ver 1.0

create table p2p_share (
	_IDshare	int unsigned not null auto_increment,		# ID du partage
	_IDres		int unsigned not null,				# ID de ressource
	_IDcat		int unsigned not null,				# ID de la catégorie de la ressource
	primary key (_IDshare),
	unique key _key(_IDres, _IDcat)
	) ENGINE = MyISAM COMMENT = "Table du partage des ressources autorisées";

###############################################################################
# création de la dba des serveurs P2P
###############################################################################
insert into p2p values('','http://promethee.eu.org','', 'O');
###############################################################################