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
insert into pfolio_formation values('1','B2i-C2i','Certificate of Computing and Internet Patent','en');
insert into pfolio_formation values('2','6th',   'College level - 6th','en');
insert into pfolio_formation values('3','5th',   'College level - 5th','en');
insert into pfolio_formation values('4','4th',   'College level - 4th','en');
insert into pfolio_formation values('5','3th',   'College level - 3th','en');
###############################################################################
# création de la dba des modalités d'évaluations des compétences
###############################################################################
insert into pfolio_eval values('1', 'Evaluation 3 levels','en');
insert into pfolio_eval values('2', 'Evaluation All or Nothing','en');
insert into pfolio_eval values('3', 'Evaluation ENFA','en');
insert into pfolio_eval values('4', 'Evaluation color codes','en');
###############################################################################
# création de la dba des niveaux des évaluations des compétences
###############################################################################
insert into pfolio_level values('1',  '1', '#0000FF', 'A',  'acquired competence: I know the concepts perfectly and can carry out the operations alone.','en');
insert into pfolio_level values('2',  '1', '#00FF00', 'B',  'competence to be reinforced: I know the concepts and can carry out the operations with some councils.','en');
insert into pfolio_level values('3',  '1', '#FF0000', 'C',  'acquisition in progress: I can carry out the operations with assitance procedure.','en');
insert into pfolio_level values('4',  '2', '#00FF00', 'OK', 'acquired competence.','en');
insert into pfolio_level values('5',  '2', '#FF0000', 'N/A','not acquired competence.','en');
insert into pfolio_level values('6',  '3', '#0000FF', '5',  'total appropriation, transposable in a new context.','en');
insert into pfolio_level values('7',  '3', '#0000FF', '4',  'control in a known context.','en');
insert into pfolio_level values('8',  '3', '#0000FF', '3',  'appropriation in progress.','en');
insert into pfolio_level values('9',  '3', '#0000FF', '2',  'initiation in progress.','en');
insert into pfolio_level values('10', '3', '#0000FF', '1',  'known competence (the trainee is intended to speak).','en');
insert into pfolio_level values('11', '4', '#0000FF', '5',  'controlled competence.','en');
insert into pfolio_level values('12', '4', '#00FF00', '4',  'quite comparable competence.','en');
insert into pfolio_level values('13', '4', '#FFFF00', '3',  'competence to be reinforced.','en');
insert into pfolio_level values('14', '4', '#FF6400', '2',  'badly controlled competence.','en');
insert into pfolio_level values('15', '4', '#FF0000', '1',  'little developed competence.','en');
###############################################################################
