##############################################################################
#    Copyright (c) 2002-2006 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# table des uv des domaines de comp�tences
# ver 1.2
#
## modification clef primaire et unique

create table pfolio_formation  (
	_IDform		int unsigned not null auto_increment,		# ID des formations
	_ident		varchar(255) not null,				# intitul� de la formation
	_texte		mediumtext not null,				# description de la formation
	_lang		varchar(2) not null,				# code langue
	primary key (_IDform, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des formations";

###############################################################################
# table des uv des domaines de comp�tences
# ver 1.3
#
## ajout champ _min

create table pfolio_uv  (
	_IDuv		int unsigned not null auto_increment,		# ID des uv des domaines de comp�tences
	_IDform		int unsigned default '0' not null,		# ID des formations
	_IDmat		int unsigned default '0' not null,		# ID de la mati�re (voir table campus)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur du r�pertoire)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_ident		varchar(255) not null,				# intitul� de l'uv
	_texte		mediumtext not null,				# description de l'uv
	_IDgrp		text not null,					# ID des classes concern�es (voir table campus_class)
	_IDeval		int unsigned default '1' not null,		# ID des �valuations (voir table pfolio_eval)
	_color		enum('O', 'N') default 'N' not null,		# code couleur pour l'�valuation (O : Oui, N : ou Non)
	_scale		enum('O', 'N') default 'N' not null,		# �valuation �chelonn�e (O : Oui, N : ou Non)
	_autoeval	enum('O', 'N') default 'N' not null,		# mode positionnement (O : Oui, N : ou Non)
	_min		int unsigned default '50' not null,		# % minimum des items � valider pour obtenir l'UV
	_lang		varchar(2) not null,				# code langue
	primary key (_IDuv),
	unique key (_IDform, _ident)
	) ENGINE = MyISAM COMMENT = "Table des Unit�s de Valeur";

###############################################################################
# table des domaines de comp�tences
# ver 1.2
#
## ajout champ _order

create table pfolio (
	_IDskill	int unsigned not null auto_increment,		# ID des domaines de comp�tences
	_IDuv		int unsigned not null,				# ID des uv des domaines de comp�tences
	_order	int unsigned not null,				# n� d'ordre des domaines
	_ident		varchar(255) not null,				# intitul� du domaine
	_min		int unsigned default '50' not null,		# % minimum des items � obtenir pour valider le domaine
	_visible	enum('O', 'N') default 'O' not null,		# affichage du domaine (O : Oui, N : ou Non)
	primary key (_IDskill),
	unique key (_IDuv, _ident)
	) ENGINE = MyISAM COMMENT = "Table des domaines de comp�tences";

###############################################################################
# table des comp�tences
# ver 1.2
#
## ajout champ _order

create table pfolio_data (
	_IDdata		int unsigned not null auto_increment,		# ID des comp�tences
	_IDskill	int unsigned not null,				# ID des domaines de comp�tences
	_order	int unsigned not null,				# n� d'ordre des comp�tences
	_texte		mediumtext not null,				# description des comp�tences
	_option		enum('O', 'N') default 'N' not null,		# comp�tence optionelle (O : Oui, N : ou Non)
	_visible	enum('O', 'N') default 'O' not null,		# affichage de la comp�tence (O : Oui, N : ou Non)
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table des intitul�s des comp�tences";

###############################################################################
# table du portefeuille de comp�tences
# ver 1.0

create table pfolio_items (
	_IDitem		int unsigned not null auto_increment,		# ID des comp�tences acquises
	_IDdata		int unsigned not null,				# ID des comp�tences
	_ID		int unsigned not null,				# ID de l'�l�ve � valider
	_IDlevel	int unsigned default '0' not null,		# niveau valid� (voir table pfolio_level)
	_date		datetime not null,				# date de validation de la comp�tence
	_IDmod		int unsigned not null,				# ID de l'utilisateur qui valide
	_IDmat		int unsigned not null,				# ID de la mati�re
	_IP		int unsigned default '0' not null,		# station de travail
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table du portefeuille de comp�tences";

###############################################################################
# table des modalit�s d'�valuations des comp�tences
# ver 1.2
#
## modification clef primaire et unique

create table pfolio_eval (
	_IDeval		int unsigned not null auto_increment,		# ID des �valuations
	_ident		varchar(80) not null,				# intitul� de l'�valuation
	_lang		varchar(2) not null,				# code langue
	primary key (_IDeval, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des modalit�s de positionnement";

###############################################################################
# table des niveaux des �valuations des comp�tences
# ver 1.1
#
## ajout champ _lang
## modification clef primaire et unique

create table pfolio_level (
	_IDlevel	int unsigned not null auto_increment,		# ID des niveaux
	_IDeval		int unsigned default '0' not null,		# ID des modalit� d'�valuations
	_color		varchar(7) not null,				# code couleur
	_ident		varchar(10) not null,				# intitul� du niveau
	_texte		varchar(255) not null,				# description du niveau
	_lang		varchar(2) not null,				# code langue
	primary key (_IDlevel, _lang),
	unique key (_IDlevel, _ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des niveaux de positionnement des comp�tences";

###############################################################################