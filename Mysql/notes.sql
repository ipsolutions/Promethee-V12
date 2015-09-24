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
# table des bulletins
# ver 1.1
#
## modification champ _period : enum('0', '1') -> enum('0', '1', '2')
## ajout champs : _max, _display et _font

create table notes (
	_IDcentre	int unsigned not null,				# ID du centre
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_period		enum('0', '1', '2') default '0' not null,	# périodes (0 : trimestres, 1 : semestres, 2 : année)
	_month		int unsigned default '8' not null,		# début année scolaire (défaut septembre)
	_email		enum('-', 'P', 'E') default '-' not null,	# email pour avertissement (- : aucun, P : Post-it, E : Email)
	_text		tinytext not null,				# pour la notation anglo saxonne (A;B;C;D;E)
	_decimal	int unsigned default '1' not null,		# décimale après la virgule
	_separator	varchar(1) default '.' not null,		# séparateur de décimale
	_max		int unsigned default '10' not null,		# nombre de notes max à saisir par matière
	_display	varchar(5) default '11000' not null,		# affichage (0|1|2 : aucun trimestre, trimestre en cours, tous les trimestres ; 0|1 : moyenne classe ; 0|1 : moyenne année ; 0|1 : seuil ; 0|1 : détail des notes)
	_font		int unsigned default '10' not null,		# taille police pour impression bulletin
	unique key _key(_IDcentre)
	) ENGINE = MyISAM COMMENT = "Table des bulletins";

###############################################################################
# table des bulletins élèves
# ver 1.0

create table notes_data (
	_IDdata		int unsigned not null auto_increment,		# ID du bulletin classe
	_year		int unsigned not null,				# année scolaire
	_IDclass	int unsigned not null,				# ID de la classe
	_IDmat		int unsigned not null,				# ID de la matière
	_period		int unsigned default '1' not null,		# n° trimestre ou semestre
	_type		tinytext not null,				# type des controles (voir table notes_type, tableau séparateur ;)
	_total		tinytext not null,				# total de chaque note (tableau séparateur ;)
	_coef		tinytext not null,				# coefficient de chaque note (tableau séparateur ;)
	_visible	tinytext not null,				# prendre en compte les notes (O : Oui, N : Non, tableau séparateur ;)
	_lock		enum('O', 'N') default 'N' not null,		# verrouiller le bulletin (O : Oui, N : Non)
	_ID		int unsigned default '0' not null,		# ID de connexion de celui qui a verrouillé
	_IP		bigint default '0' not null,			# ID de l'IP (station de celui qui a verrouillé)
	_date		datetime,					# date de verrouillage
	primary key (_IDdata),
	unique key _key(_year, _IDclass, _IDmat, _period)
	) ENGINE = MyISAM COMMENT = "Table des bulletins élèves";

###############################################################################
# table des notes
# ver 1.0

create table notes_items (
	_IDitems	int unsigned not null auto_increment,		# ID de la note
	_IDdata		int unsigned not null,				# ID du bulletin classe
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_create		datetime,					# date saisie
	_update		datetime,					# date modification
	_IDeleve	int unsigned not null,				# ID de l'élève
	_index		int unsigned default '0' not null,		# n° du controle
	_value		varchar(6) not null,				# la note
	primary key (_IDitems),
	unique key _key(_IDdata, _IDeleve, _index)
	) ENGINE = MyISAM COMMENT = "Table des notes";

###############################################################################
# table des types de controle
# ver 1.0

create table notes_type (
	_IDtype		int unsigned not null,				# ID du type de controle
	_ident		varchar(6) not null,				# le type du controle (DS : Devoir Surveillé, TP : Travail Pratique, DM : Devoir Maison, ...)
	_text		varchar(40) not null,				# description du type du controle
	_lang		varchar(2) not null,				# langue utilisée pour la base de données
	unique key _key(_IDtype, _lang)
	) ENGINE = MyISAM COMMENT = "Table des types de controle";

###############################################################################
# table des appréciations
# ver 1.0

create table notes_text (
	_IDeleve	int unsigned not null,				# ID de l'élève
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date saisie
	_IDclass	int unsigned not null,				# ID de la classe
	_IDmat		int unsigned default '0' not null,		# ID de la matière (0 pour appréciation conseil de classe)
	_year		int unsigned not null,				# année scolaire
	_period		int unsigned default '1' not null,		# n° trimestre ou semestre
	_text		tinytext not null,				# texte de l'appréciation
	_lock		enum('O', 'N') default 'N' not null,		# verrouiller les appréciations (O : Oui, N : Non)
	unique key _key(_IDeleve, _IDclass, _IDmat, _year, _period)
	) ENGINE = MyISAM COMMENT = "Table des appréciations";

###############################################################################
# table des verroux sur les bulletins
# ver 1.0

create table notes_lock (
	_IDlock		int unsigned not null auto_increment,		# ID du verrou
	_year		int unsigned not null,				# année scolaire
	_IDclass	int unsigned not null,				# ID de la classe
	_period		int unsigned default '1' not null,		# n° trimestre ou semestre
	_coef		tinytext not null,				# coefficient de chaque note (tableau séparateur ;)
	_visible	tinytext not null,				# prendre en compte les notes (O : Oui, N : Non, tableau séparateur ;)
	_lock		enum('O', 'N') default 'N' not null,		# verrouiller les bulletins (O : Oui, N : Non)
	primary key (_IDlock),
	unique key _key(_year, _IDclass, _period)
	) ENGINE = MyISAM COMMENT = "Table des verroux";

###############################################################################