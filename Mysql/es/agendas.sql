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
# créacion de la dba de las agendas publicas
###############################################################################
insert into agenda values('1', '0', '0', '254', '254', '0', '2002-09-01', 'Interno',   'Esta agenda esta reservada al personal del establecimiento.', 'O', 'O', 'N', 'N', 'N', 'O', 'N', 'es');
insert into agenda values('2', '0', '0', '254', '255', '0', '2002-09-01', 'Publico',   'Esta agenda es accessible para todos y contiene los acontecimientos importantes.', 'O', 'N', 'N', 'N', 'N', 'O', 'N', 'es');
insert into agenda values('3', '0', '0',   '2', '255', '0', '2002-09-01', 'CCF',       'Esta agenda contiene todas las fechas de CCF.', 'O', 'O', 'N', 'N', 'N', 'O', 'N', 'es');
insert into agenda values('4', '0', '0',   '2', '255', '0', '2002-09-01', 'Formatifs', 'Formativos esta agenda contiene los deberes escritos.', 'O', 'N', 'N', 'N', 'N', 'O', 'N', 'es');
###############################################################################