##############################################################################
#    Copyright (c) 2002-2006 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# table des uv des domaines de compétences
# ver 1.2
#
## modification clef primaire et unique

create table pfolio_formation  (
	_IDform		int unsigned not null auto_increment,		# ID des formations
	_ident		varchar(255) not null,				# intitulé de la formation
	_texte		mediumtext not null,				# description de la formation
	_lang		varchar(2) not null,				# code langue
	primary key (_IDform, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des formations";

###############################################################################
# table des uv des domaines de compétences
# ver 1.3
#
## ajout champ _min

create table pfolio_uv  (
	_IDuv		int unsigned not null auto_increment,		# ID des uv des domaines de compétences
	_IDform		int unsigned default '0' not null,		# ID des formations
	_IDmat		int unsigned default '0' not null,		# ID de la matière (voir table campus)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur du répertoire)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_ident		varchar(255) not null,				# intitulé de l'uv
	_texte		mediumtext not null,				# description de l'uv
	_IDgrp		text not null,					# ID des classes concernées (voir table campus_class)
	_IDeval		int unsigned default '1' not null,		# ID des évaluations (voir table pfolio_eval)
	_color		enum('O', 'N') default 'N' not null,		# code couleur pour l'évaluation (O : Oui, N : ou Non)
	_scale		enum('O', 'N') default 'N' not null,		# évaluation échelonnée (O : Oui, N : ou Non)
	_autoeval	enum('O', 'N') default 'N' not null,		# mode positionnement (O : Oui, N : ou Non)
	_min		int unsigned default '50' not null,		# % minimum des items à valider pour obtenir l'UV
	_lang		varchar(2) not null,				# code langue
	primary key (_IDuv),
	unique key (_IDform, _ident)
	) ENGINE = MyISAM COMMENT = "Table des Unités de Valeur";

###############################################################################
# table des domaines de compétences
# ver 1.2
#
## ajout champ _order

create table pfolio (
	_IDskill	int unsigned not null auto_increment,		# ID des domaines de compétences
	_IDuv		int unsigned not null,				# ID des uv des domaines de compétences
	_order	int unsigned not null,				# n° d'ordre des domaines
	_ident		varchar(255) not null,				# intitulé du domaine
	_min		int unsigned default '50' not null,		# % minimum des items à obtenir pour valider le domaine
	_visible	enum('O', 'N') default 'O' not null,		# affichage du domaine (O : Oui, N : ou Non)
	primary key (_IDskill),
	unique key (_IDuv, _ident)
	) ENGINE = MyISAM COMMENT = "Table des domaines de compétences";

###############################################################################
# table des compétences
# ver 1.2
#
## ajout champ _order

create table pfolio_data (
	_IDdata		int unsigned not null auto_increment,		# ID des compétences
	_IDskill	int unsigned not null,				# ID des domaines de compétences
	_order	int unsigned not null,				# n° d'ordre des compétences
	_texte		mediumtext not null,				# description des compétences
	_option		enum('O', 'N') default 'N' not null,		# compétence optionelle (O : Oui, N : ou Non)
	_visible	enum('O', 'N') default 'O' not null,		# affichage de la compétence (O : Oui, N : ou Non)
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table des intitulés des compétences";

###############################################################################
# table du portefeuille de compétences
# ver 1.0

create table pfolio_items (
	_IDitem		int unsigned not null auto_increment,		# ID des compétences acquises
	_IDdata		int unsigned not null,				# ID des compétences
	_ID		int unsigned not null,				# ID de l'élève à valider
	_IDlevel	int unsigned default '0' not null,		# niveau validé (voir table pfolio_level)
	_date		datetime not null,				# date de validation de la compétence
	_IDmod		int unsigned not null,				# ID de l'utilisateur qui valide
	_IDmat		int unsigned not null,				# ID de la matière
	_IP		int unsigned default '0' not null,		# station de travail
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table du portefeuille de compétences";

###############################################################################
# table des modalités d'évaluations des compétences
# ver 1.2
#
## modification clef primaire et unique

create table pfolio_eval (
	_IDeval		int unsigned not null auto_increment,		# ID des évaluations
	_ident		varchar(80) not null,				# intitulé de l'évaluation
	_lang		varchar(2) not null,				# code langue
	primary key (_IDeval, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des modalités de positionnement";

###############################################################################
# table des niveaux des évaluations des compétences
# ver 1.1
#
## ajout champ _lang
## modification clef primaire et unique

create table pfolio_level (
	_IDlevel	int unsigned not null auto_increment,		# ID des niveaux
	_IDeval		int unsigned default '0' not null,		# ID des modalité d'évaluations
	_color		varchar(7) not null,				# code couleur
	_ident		varchar(10) not null,				# intitulé du niveau
	_texte		varchar(255) not null,				# description du niveau
	_lang		varchar(2) not null,				# code langue
	primary key (_IDlevel, _lang),
	unique key (_IDlevel, _ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des niveaux de positionnement des compétences";

###############################################################################