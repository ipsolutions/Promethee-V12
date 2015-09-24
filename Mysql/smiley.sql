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
# table des smileys
# ver 1.0
#
# remarque : les fichiers images des smileys sont placés dans le répertoire images/smiley/forum/<_ident>.gif

create table smileys (
	_IDsmile	int unsigned not null auto_increment,		# ID du smiley
	_type       	enum ('H', 'T') not null,			# type du smiley(H : humeur, T : texte)
	_ident		varchar(20) not null, 				# fichier du smiley
	_code		varchar(10) not null, 				# code du smiley
	primary key (_IDsmile),
	unique key _key(_ident)
	) ENGINE = MyISAM COMMENT = "Table des smileys";

###############################################################################