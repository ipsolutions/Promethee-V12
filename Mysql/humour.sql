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
# table du trait d'humour
# ver 1.1
#
## ajout champ _lang

create table humour_data (
	_IDdata		int unsigned not null auto_increment,		# ID du trait d'humour
	_ident		varchar(20) not null,				# identification du trait d'humour
	_visible	enum('O', 'N') default 'O' not null,		# trait d'humour visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue du trait d'humour
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table du trait d'humour";

###############################################################################
# table de la blague du jour
# ver 2.0
#
## renommage table humour -> humour_items
## renommage champ _IDtext -> _IDitem
## ajout champ _IDdata

create table humour_items (
	_IDitem		int unsigned not null auto_increment,		# ID de la blague ou citation
	_IDdata		int unsigned not null,				# ID du trait d'humour
	_text		mediumtext not null,				# texte de la blague ou citation
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des blagues ou citations";

###############################################################################