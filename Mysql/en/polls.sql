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
# création de la dba des sondages
###############################################################################
insert into sondage_data values('2', '0', '0', '255', '255', '2002-09-01', '', 'How do you find this Intranet?', 'O', 'O', 'N', 'O', 'en');
insert into sondage_items values('2', '1', 'dead loss',          '0');
insert into sondage_items values('2', '2', 'can better do', '0');
insert into sondage_items values('2', '3', 'means',            '0');
insert into sondage_items values('2', '4', 'not too badly',     '0');
insert into sondage_items values('2', '5', 'great!',       '0');
###############################################################################