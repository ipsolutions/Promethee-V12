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
# création de la dba des campus virtuel
###############################################################################
insert into campus values('', 'subjects', 'campus_data', 'O', 'en');
insert into campus values('', 'classes', 'campus_classe', 'N', 'en');
###############################################################################
# création de la dba du menu du campus virtuel
###############################################################################
insert into campus_menu values('','Documents',           'reach teaching documents',                               'item=31',            'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Forums',              'send messages in a forum',                               'item=3&cmde=visu',   'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Galleries',           'visualize pictures',                                     'item=5',             'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Work to be returned', 'deposit work or duties house',                           'item=9&cmde=work',   'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Exercices',           'carry out exercises on line',                            'item=50',            'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Course',              'download supports of course',                            'item=33',            'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Reference frames',    'download the reference frames of formation',             'item=35&cmde=cursus','O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Advertisements',      'visualize advertisements',                               'item=9&cmde=breve',  'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Diary',               'consult the diaries of the courses and the examinations','item=8',             'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Surveys',             'answer surveys',                                         'item=99&cmde=visu',  'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Links',               'consult links',                                          'item=9&cmde=link',   'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','e-Portfolio',         'manage school competences',                              'item=16&cmde=visu',  'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','chat',                'dialogue on line',                                       'item=14&cmde=chat',  'O', '255', 'O', 'N', 'O', '0','en');
insert into campus_menu values('','Homework diary',      'consult the numerical homework diary',                   'item=13',            'O', '255', 'O', 'N', 'O', '0','en');
###############################################################################
# création de la dba des matières du campus virtuel
###############################################################################
insert into campus_data values('1',  '0','2','255','','Agronomy',     'Welcome on the Agronomy homepage.',             '10','N','N','','O','en','');
insert into campus_data values('2',  '0','2','255','','English',      'Welcome on the English homepage.',              '10','N','N','','O','en','');
insert into campus_data values('3',  '0','2','255','','German',       'Welcome on the German homepage.',               '10','N','N','','O','en','');
insert into campus_data values('4',  '0','2','255','','Biology',      'Welcome on the Biology homepage.',              '10','N','N','','O','en','');
insert into campus_data values('5',  '0','2','255','','Economy',      'Welcome on the Economy homepage.',              '10','N','N','','O','en','');
insert into campus_data values('6',  '0','2','255','','Sport',        'Welcome on the Sport homepage.',                '10','N','N','','O','en','');
insert into campus_data values('7',  '0','2','255','','Sociocultural','Welcome on the Sociocultural homepage.',        '10','N','N','','O','en','');
insert into campus_data values('8',  '0','2','255','','French',       'Welcome on the French homepage.',               '10','N','N','','O','en','');
insert into campus_data values('9',  '0','2','255','','Hist-Geo',     'Welcome on the History and Geography homepage.','10','N','N','','O','en','');
insert into campus_data values('10', '0','2','255','','Computing',    'Welcome on the Computing homepage.',            '10','N','N','','O','en','');
insert into campus_data values('11', '0','2','255','','Italian',      'Welcome on the Italian homepage.',              '10','N','N','','O','en','');
insert into campus_data values('12', '0','2','255','','Mechanization','Welcome on the Mechanization homepage.',        '10','N','N','','O','en','');
insert into campus_data values('13', '0','2','255','','Maths',        'Welcome on the Mathematics homepage.',          '10','N','N','','O','en','');
insert into campus_data values('14', '0','2','255','','Philosophy',   'Welcome on the Philosophy homepage.',           '10','N','N','','O','en','');
insert into campus_data values('15', '0','2','255','','Phytotechny',  'Welcome on the Phytotechny homepage.',          '10','N','N','','O','en','');
insert into campus_data values('16', '0','2','255','','Physical sc.', 'Welcome on the Physical sciences homepage.',    '10','N','N','','O','en','');
insert into campus_data values('17', '0','2','255','','Zootechny',    'Welcome on the Zootechny homepage.',            '10','N','N','','O','en','');
insert into campus_data values('18', '0','2','255','','Civic Ed.',    'Welcome on the Civic Education.',               '10','N','N','','O','en','');
insert into campus_data values('19', '0','2','255','','Design',       'Welcome on the Graphic arts homepage.',         '10','N','N','','O','en','');
insert into campus_data values('20', '0','2','255','','Music',        'Welcome on the musical Education homepage.',    '10','N','N','','O','en','');
insert into campus_data values('21', '0','2','255','','Visual arts',  'Welcome on the Visual arts homepage.',          '10','N','N','','O','en','');
insert into campus_data values('22', '0','2','255','','Spanish',      'Welcome on the Spanish homepage.',              '10','N','N','','O','en','');
###############################################################################
# création de la dba des niveaux scolaire
###############################################################################
insert into campus_level values('1', 'Primary: PS',         'O','en');
insert into campus_level values('2', 'Primary: MS',         'O','en');
insert into campus_level values('3', 'Primary: GS',         'O','en');
insert into campus_level values('4', 'Secondary: CP',       'O','en');
insert into campus_level values('5', 'Secondary: CE1',      'O','en');
insert into campus_level values('6', 'Secondary: CE2',      'O','en');
insert into campus_level values('7', 'Secondary: CM1',      'O','en');
insert into campus_level values('8', 'Secondary: CM2',      'O','en');
insert into campus_level values('9', 'High School: 6ème',   'O','en');
insert into campus_level values('10','High School: 5ème',   'O','en');
insert into campus_level values('11','High School: 4ème',   'O','en');
insert into campus_level values('12','High School: 3ème',   'O','en');
insert into campus_level values('13','High School: BEP',    'O','en');
insert into campus_level values('14','High School: Bac Pro','O','en');
insert into campus_level values('15','High School: 2GT',    'O','en');
insert into campus_level values('16','High School: 1ère',   'O','en');
insert into campus_level values('17','High School: Term',   'O','en');
insert into campus_level values('18','University: BTS-DUT', 'O','en');
insert into campus_level values('19','University: Licence', 'O','en');
insert into campus_level values('20','University: Master',  'O','en');
insert into campus_level values('21','University: Doctorat','O','en');
###############################################################################
# création de la dba des des droits d'accès des utilisateurs pour les e-campus
###############################################################################
insert into campus_access values('-1', 'On standby','en');
insert into campus_access values('0',  'Banished',  'en');
insert into campus_access values('1',  'Reader',    'en');
insert into campus_access values('3',  'Member',    'en');
insert into campus_access values('7',  'Moderator', 'en');
###############################################################################
# création de la dba des cursus
###############################################################################
insert into cursus values('1', 'Initial training',         '', 'O', 'en');
insert into cursus values('2', 'Continuous training',      '', 'N', 'en');
insert into cursus values('3', 'Formation by Alternation', '', 'N', 'en');
###############################################################################
