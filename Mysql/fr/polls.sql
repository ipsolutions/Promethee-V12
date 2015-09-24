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
insert into sondage_data values('1', '0', '0', '255', '255', '2002-09-01', '', 'Comment trouvez-vous cet intranet ?', 'O', 'O', 'N', 'O', 'fr');
insert into sondage_items values('1', '1', 'minable',          '0');
insert into sondage_items values('1', '2', 'peut mieux faire', '0');
insert into sondage_items values('1', '3', 'moyen',            '0');
insert into sondage_items values('1', '4', 'pas trop mal',     '0');
insert into sondage_items values('1', '5', 'terrible !',       '0');
###############################################################################