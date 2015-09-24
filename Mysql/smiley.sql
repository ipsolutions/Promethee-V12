##############################################################################
#    Copyright (c) 2002-2003 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# table des smileys
# ver 1.0
#
# remarque : les fichiers images des smileys sont plac�s dans le r�pertoire images/smiley/forum/<_ident>.gif

create table smileys (
	_IDsmile	int unsigned not null auto_increment,		# ID du smiley
	_type       	enum ('H', 'T') not null,			# type du smiley(H : humeur, T : texte)
	_ident		varchar(20) not null, 				# fichier du smiley
	_code		varchar(10) not null, 				# code du smiley
	primary key (_IDsmile),
	unique key _key(_ident)
	) ENGINE = MyISAM COMMENT = "Table des smileys";

###############################################################################