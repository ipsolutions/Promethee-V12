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
# cr�ation de la dba des forums
###############################################################################
insert into forum_data values('', '0', '0', '0', '254', '254', '2002-09-01', '', 'Interno', 'Se reserva este espacio para el personal del establecimiento. Se destina a recibir sus comentarios, notas, reflexiones, preguntas o anuncios.', 'O', 'O', 'N', 'N', 'N', '-', 'F', 'N', 'N', 'N', 'N', 'N', 'http://www.imageshack.us/', 'es');
insert into forum_data values('', '0', '0', '0', '255', '255', '2002-09-01', '', '_STUDENT',  'Este espacio publico le permite expresion se destina a recibir sus comentarios, notas, reflexiones, preguntas o anuncios.', 'O', 'N', 'N', 'N', 'N', '-', 'F', 'N', 'N', 'N', 'N', 'N', '', 'es');
###############################################################################