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
# table des bulletins
# ver 1.1
#
## modification champ _period : enum('0', '1') -> enum('0', '1', '2')
## ajout champs : _max, _display et _font

create table notes (
	_IDcentre	int unsigned not null,				# ID du centre
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_period		enum('0', '1', '2') default '0' not null,	# p�riodes (0 : trimestres, 1 : semestres, 2 : ann�e)
	_month		int unsigned default '8' not null,		# d�but ann�e scolaire (d�faut septembre)
	_email		enum('-', 'P', 'E') default '-' not null,	# email pour avertissement (- : aucun, P : Post-it, E : Email)
	_text		tinytext not null,				# pour la notation anglo saxonne (A;B;C;D;E)
	_decimal	int unsigned default '1' not null,		# d�cimale apr�s la virgule
	_separator	varchar(1) default '.' not null,		# s�parateur de d�cimale
	_max		int unsigned default '10' not null,		# nombre de notes max � saisir par mati�re
	_display	varchar(5) default '11000' not null,		# affichage (0|1|2 : aucun trimestre, trimestre en cours, tous les trimestres ; 0|1 : moyenne classe ; 0|1 : moyenne ann�e ; 0|1 : seuil ; 0|1 : d�tail des notes)
	_font		int unsigned default '10' not null,		# taille police pour impression bulletin
	unique key _key(_IDcentre)
	) ENGINE = MyISAM COMMENT = "Table des bulletins";

###############################################################################
# table des bulletins �l�ves
# ver 1.0

create table notes_data (
	_IDdata		int unsigned not null auto_increment,		# ID du bulletin classe
	_year		int unsigned not null,				# ann�e scolaire
	_IDclass	int unsigned not null,				# ID de la classe
	_IDmat		int unsigned not null,				# ID de la mati�re
	_period		int unsigned default '1' not null,		# n� trimestre ou semestre
	_type		tinytext not null,				# type des controles (voir table notes_type, tableau s�parateur ;)
	_total		tinytext not null,				# total de chaque note (tableau s�parateur ;)
	_coef		tinytext not null,				# coefficient de chaque note (tableau s�parateur ;)
	_visible	tinytext not null,				# prendre en compte les notes (O : Oui, N : Non, tableau s�parateur ;)
	_lock		enum('O', 'N') default 'N' not null,		# verrouiller le bulletin (O : Oui, N : Non)
	_ID		int unsigned default '0' not null,		# ID de connexion de celui qui a verrouill�
	_IP		bigint default '0' not null,			# ID de l'IP (station de celui qui a verrouill�)
	_date		datetime,					# date de verrouillage
	primary key (_IDdata),
	unique key _key(_year, _IDclass, _IDmat, _period)
	) ENGINE = MyISAM COMMENT = "Table des bulletins �l�ves";

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
	_IDeleve	int unsigned not null,				# ID de l'�l�ve
	_index		int unsigned default '0' not null,		# n� du controle
	_value		varchar(6) not null,				# la note
	primary key (_IDitems),
	unique key _key(_IDdata, _IDeleve, _index)
	) ENGINE = MyISAM COMMENT = "Table des notes";

###############################################################################
# table des types de controle
# ver 1.0

create table notes_type (
	_IDtype		int unsigned not null,				# ID du type de controle
	_ident		varchar(6) not null,				# le type du controle (DS : Devoir Surveill�, TP : Travail Pratique, DM : Devoir Maison, ...)
	_text		varchar(40) not null,				# description du type du controle
	_lang		varchar(2) not null,				# langue utilis�e pour la base de donn�es
	unique key _key(_IDtype, _lang)
	) ENGINE = MyISAM COMMENT = "Table des types de controle";

###############################################################################
# table des appr�ciations
# ver 1.0

create table notes_text (
	_IDeleve	int unsigned not null,				# ID de l'�l�ve
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date saisie
	_IDclass	int unsigned not null,				# ID de la classe
	_IDmat		int unsigned default '0' not null,		# ID de la mati�re (0 pour appr�ciation conseil de classe)
	_year		int unsigned not null,				# ann�e scolaire
	_period		int unsigned default '1' not null,		# n� trimestre ou semestre
	_text		tinytext not null,				# texte de l'appr�ciation
	_lock		enum('O', 'N') default 'N' not null,		# verrouiller les appr�ciations (O : Oui, N : Non)
	unique key _key(_IDeleve, _IDclass, _IDmat, _year, _period)
	) ENGINE = MyISAM COMMENT = "Table des appr�ciations";

###############################################################################
# table des verroux sur les bulletins
# ver 1.0

create table notes_lock (
	_IDlock		int unsigned not null auto_increment,		# ID du verrou
	_year		int unsigned not null,				# ann�e scolaire
	_IDclass	int unsigned not null,				# ID de la classe
	_period		int unsigned default '1' not null,		# n� trimestre ou semestre
	_coef		tinytext not null,				# coefficient de chaque note (tableau s�parateur ;)
	_visible	tinytext not null,				# prendre en compte les notes (O : Oui, N : Non, tableau s�parateur ;)
	_lock		enum('O', 'N') default 'N' not null,		# verrouiller les bulletins (O : Oui, N : Non)
	primary key (_IDlock),
	unique key _key(_year, _IDclass, _period)
	) ENGINE = MyISAM COMMENT = "Table des verroux";

###############################################################################