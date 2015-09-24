##############################################################################
#    Copyright (c) 2002-2006 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# création de la dba des formations
###############################################################################
insert into pfolio_formation values('','B2i-C2i','Atestac del diploma informatico e Internet','es');
insert into pfolio_formation values('','6',   'Niveles de colegio - 6','es');
insert into pfolio_formation values('','1 ESO',   'Niveles de colegio - 1 ESO','es');
insert into pfolio_formation values('','2 ESO',   'Niveles de colegio - 2 ESO','es');
insert into pfolio_formation values('','3 ESO',   'Niveles de colegio - 3 ESO','es');
###############################################################################
# création de la dba des modalités d'évaluations des compétences
###############################################################################
insert into pfolio_eval values('', 'Evaluacion 3 niveles','es');
insert into pfolio_eval values('', 'Evaluacion todo o nada','es');
insert into pfolio_eval values('', 'Evaluacion ENFA','es');
insert into pfolio_eval values('', 'Evaluacion codigo color','es');
###############################################################################
# création de la dba des niveaux des évaluations des compétences
###############################################################################
insert into pfolio_level values('1', '1', '#0000FF', 'A',  'competencio adquirida : conozco perfectamente las nociones y se efectuar las operaciones solo.', 'es');
insert into pfolio_level values('2', '1', '#00FF00', 'B',  'competencio que se debe reforzar : conozco las nociones y se efectuar las operaciones con unos consejos.', 'es');
insert into pfolio_level values('3', '1', '#FF0000', 'C',  'competencio pendiente : se efectuar las operaciones con unos consejos.', 'es');
insert into pfolio_level values('4', '2', '#00FF00', 'OK', 'competencio adquirida.', 'es');
insert into pfolio_level values('5', '2', '#FF0000', 'N/A','competencio no adquirida.', 'es');
insert into pfolio_level values('6', '3', '#0000FF', '5',  'apropriacion total, que se puede llevar transposable con nuevo contexto.', 'es');
insert into pfolio_level values('7', '3', '#0000FF', '4',  'dominio en un contexto conocido.', 'es');
insert into pfolio_level values('8', '3', '#0000FF', '3',  'apropriacion pendiente.', 'es');
insert into pfolio_level values('9', '3', '#0000FF', '2',  'iniciacion pendiente.', 'es');
insert into pfolio_level values('10', '3', '#0000FF', '1',  'competencio conocida (el cursillista se ha enterado).', 'es');
insert into pfolio_level values('11', '4', '#0000FF', '5',  'competencio dominida.', 'es');
insert into pfolio_level values('12', '4', '#00FF00', '4',  'competencio bien comprendida.', 'es');
insert into pfolio_level values('13', '4', '#FFFF00', '3',  'competencio que se delse reforzar.', 'es');
insert into pfolio_level values('14', '4', '#FF6400', '2',  'competencio mal dominida.', 'es');
insert into pfolio_level values('15', '4', '#FF0000', '1',  'competencio poco desarrollada.', 'es');
###############################################################################
