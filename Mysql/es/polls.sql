##############################################################################
#    Copyright (c) 2002-2007 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# cr�ation de la dba des sondages
###############################################################################
insert into sondage_data values('3', '0', '0', '255', '255', '2002-09-01', '', 'Que piensa usted de este intranet ?', 'O', 'O', 'N', 'O', 'es');
insert into sondage_items values('3', '1', 'un desastre',          '0');
insert into sondage_items values('3', '2', 'se puede mejorar', '0');
insert into sondage_items values('3', '3', 'aceptable',            '0');
insert into sondage_items values('3', '4', 'bien',     '0');
insert into sondage_items values('3', '5', 'sobresaliente !',       '0');
###############################################################################