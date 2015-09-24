##############################################################################
#    Copyright (c) 2007 by Dominique Laporte (C-E-D@wanadoo.fr)              #
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
# création de la dba des types de e-groupes
###############################################################################
insert into egroup_items values('1','cultural Expression','O', 'en');
insert into egroup_items values('2','Working groups','O','en');
insert into egroup_items values('3','LMS','O','en');
###############################################################################
# création de la dba des e-groupes
###############################################################################
insert into egroup values('1', '1','0','0','0','255','2005-01-01','','Internet','','N','O','en');
insert into egroup values('2', '1','0','0','0','255','2005-01-01','','Computing','','N','O','en');
insert into egroup values('3', '1','0','0','0','255','2005-01-01','','Culture & Art','','N','O','en');
insert into egroup values('4', '1','0','0','0','255','2005-01-01','','Games','','N','O','en');
insert into egroup values('5', '1','0','0','0','255','2005-01-01','','Hobbies & Do-it-yourself','','N','O','en');
insert into egroup values('6', '1','0','0','0','255','2005-01-01','','Music','','N','O','en');
insert into egroup values('7', '1','0','0','0','255','2005-01-01','','Sports','','N','O','en');
insert into egroup values('8', '1','0','0','0','255','2005-01-01','','Education','','N','O','en');
insert into egroup values('9', '1','0','0','0','255','2005-01-01','','Science','','N','O','en');
insert into egroup values('10','2','0','0','0','255','2005-01-01','','Internal Commissions','','N','O','en');
insert into egroup values('11','2','0','0','0','255','2005-01-01','','Extra-curricular','','N','O','en');
insert into egroup values('12','3','0','0','0','255','2005-01-01','','Economy and management','','N','O','en');
insert into egroup values('13','3','0','0','0','255','2005-01-01','','Work and society','','N','O','en');
insert into egroup values('14','3','0','0','0','255','2005-01-01','','Sciences and IT','','N','O','en');
insert into egroup values('15','3','0','0','0','255','2005-01-01','','Sciences and industrial technology','','N','O','en');

insert into egroup values('','1','1','0','0','255','2005-01-01','','Networks','','N','O','en');
insert into egroup values('','1','1','0','0','255','2005-01-01','','Cyberculture','','N','O','en');
insert into egroup values('','1','1','0','0','255','2005-01-01','','Education','','N','O','en');
insert into egroup values('','1','1','0','0','255','2005-01-01','','Internet','','N','O','en');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Projects','','N','O','en');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Multimedia','','N','O','en');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Software','','N','O','en');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Programming languages','','N','O','en');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Security','','N','O','en');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Hardware','','N','O','en');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Actors and Actresses','','N','O','en');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Painting','','N','O','en');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Cinema','','N','O','en');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Arts of cooking','','N','O','en');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Mythology and Folklore','','N','O','en');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Names','','N','O','en');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Radio','','N','O','en');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Television','','N','O','en');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Boardgames','','N','O','en');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Card decks','','N','O','en');
insert into egroup values('','1','4','0','0','255','2005-01-01','','videos games','','N','O','en');
insert into egroup values('','1','4','0','0','255','2005-01-01','','pbem','','N','O','en');
insert into egroup values('','1','4','0','0','255','2005-01-01','','roleplaying','','N','O','en');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Wargames','','N','O','en');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Collections','','N','O','en');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Do-it-yourself','','N','O','en');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Hobbies','','N','O','en');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Model making','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Blues','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Celtic','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Classic','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Country','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Electronic','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Experimental','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Jazz','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Reggae','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Rock and Pop','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Disco','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Funk','','N','O','en');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Opera','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Basketball','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Boxe','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Cycling','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Sports extreme','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Golf','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Gymnastics','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Handball','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Hockey','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Martial arts','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Olympic Games','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Rugby','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Ski','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Snowboarding','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Football (European)','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Table tennis','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Tennis','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Triathlon','','N','O','en');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Volleyball','','N','O','en');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Biology','','N','O','en');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Chemistry','','N','O','en');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Sciences of the Earth','','N','O','en');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Geography','','N','O','en');
insert into egroup values('','1','8','0','0','255','2005-01-01','','History','','N','O','en');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Mathematics','','N','O','en');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Languages','','N','O','en');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Physics','','N','O','en');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Economy','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Astronomy','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Biology','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Chemistry','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Sciences of the Earth','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Ecology','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Engineering','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Mathematics','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Nanotechnology','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Physics','','N','O','en');
insert into egroup values('','1','9','0','0','255','2005-01-01','','space Exploration','','N','O','en');
insert into egroup values('','2','10','0','0','255','2005-01-01','','IT Commission','','N','O','en');
insert into egroup values('','2','10','0','0','255','2005-01-01','','Followed Work','','N','O','en');
insert into egroup values('','2','11','0','0','255','2005-01-01','','Pupils Association','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Insurance, banks, finance','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Logistics - Transport - Tourism','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Town planning - Installation - Management of local communities','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Accounts Department, control','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Trade, marketing, sale, purchase','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Management and health development','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Management','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Economy and international trading','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','History of the technics','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Innovation, futurology, technosciences and society','','N','O','en');
insert into egroup values('','3','12','0','0','255','2005-01-01','','general Trainings in EG','','N','O','en');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Ergonomics - Handicap','','N','O','en');
insert into egroup values('','3','13','0','0','255','2005-01-01','','social Right - Human relations - Organization','','N','O','en');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Occupational psychology - Psychoanalysis and orientation','','N','O','en');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Communication - Languages','','N','O','en');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Sociology - social Work - social Protection','','N','O','en');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Electronics - Automatic','','N','O','en');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Information and scientific paper and technical','','N','O','en');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Computing','','N','O','en');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Mathematics','','N','O','en');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Chemistry - Food - Health and Environment','','N','O','en');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Matérials','','N','O','en');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Energetics - Electrical engineering','','N','O','en');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Mechanics, Accoustics, Aerodynamics','','N','O','en');
insert into egroup values('','3','15','0','0','255','2005-01-01','','civil Engineering - Building - Geotechnics','','N','O','en');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Sciences and technology of measure analysis','','N','O','en');
###############################################################################
# création de la dba des intitulés des menus des egroups des utilisateurs
###############################################################################
insert into egroup_menu values('1', '1','Forums',        'discuss with the other users through subjects of interest.',       'item=3',           'O','255','O','N','O','en');
insert into egroup_menu values('2', '1','Files',         'store and share documents.',                                       'item=31',          'O','255','O','N','O','en');
insert into egroup_menu values('3', '1','Diaries',       'organize a shared diary by seizing the events which composes it.', 'item=8',           'O','255','O','N','O','en');
insert into egroup_menu values('4', '1','Pictures',      'deposit and publish pictures easily.',                             'item=5',           'O','255','O','N','O','en');
insert into egroup_menu values('5', '1','Surveys',       'throw surveys to ask the opinion of the members.',                 'item=99&cmde=visu','O','255','O','N','O','en');
insert into egroup_menu values('6', '1','Weblog',        'write and publish articles',                                       'item=36&cmde=visu','O','255','O','N','O','en');
insert into egroup_menu values('7', '1','Wiki',          'create and share documents',                                       'item=34',          'O','255','O','N','O','en');
insert into egroup_menu values('8', '1','Chat',          'discuss on line with the other members.',                          'item=14&cmde=chat','O','255','O','N','O','en');
insert into egroup_menu values('9', '1','Liens',         'divide useful addresses of sites.',                                'item=22',          'O','255','O','N','O','en');
insert into egroup_menu values('10','1','Membres',       'know the members of this group.',                                  'item=17&cmde=user','O','255','O','N','O','en');
insert into egroup_menu values('11','1','Post-it',       'send a message to the members of this e-group.',                   'item=4&cmde=post', 'O','255','O','N','O','en');
insert into egroup_menu values('12','1','Advertisements','visualize and share advertisements',                               'item=15',          'O','255','O','N','O','en');

insert into egroup_menu values('1', '2','Forums',        'discuss with the other users through subjects of interest.',       'item=3',           'O','255','O','N','O','en');
insert into egroup_menu values('2', '2','Files',         'store and share documents.',                                       'item=31',          'O','255','O','N','O','en');
insert into egroup_menu values('3', '2','Diaries',       'organize a shared diary by seizing the events which composes it.', 'item=8',           'O','255','O','N','O','en');
insert into egroup_menu values('4', '2','Pictures',      'deposit and publish pictures easily.',                             'item=5',           'O','255','O','N','O','en');
insert into egroup_menu values('5', '2','Weblog',        'write and publish articles',                                       'item=36&cmde=visu','O','255','O','N','O','en');
insert into egroup_menu values('6', '2','Wiki',          'create and share documents',                                       'item=34',          'O','255','O','N','O','en');
insert into egroup_menu values('7', '2','Liens',         'divide useful addresses of sites.',                                'item=22',          'O','255','O','N','O','en');
insert into egroup_menu values('8', '2','Membres',       'know the members of this group.',                                  'item=17&cmde=user','O','255','O','N','O','en');
insert into egroup_menu values('9', '2','Advertisements','visualize and share advertisements',                               'item=15',          'O','255','O','N','O','en');

insert into egroup_menu values('1', '3','Documents',          'reach teaching documents',                   'item=31',                'O','255','O','N','O','en');
insert into egroup_menu values('2', '3','Forums',             'send messages in a forum',                   'item=3',                 'O','255','O','N','O','en');
insert into egroup_menu values('3', '3','Pictures',           'visualize pictures',                         'item=5',                 'O','255','O','N','O','en');
insert into egroup_menu values('4', '3','Work to be returned','deposit work or duties house',               'item=9&cmde=work',       'O','255','O','N','O','en');
insert into egroup_menu values('5', '3','Exercices',          'carry out online exercises',                 'item=50',                'O','255','O','N','O','en');
insert into egroup_menu values('6', '3','Course',             'download supports of course',                'item=33',                'O','255','O','N','O','en');
insert into egroup_menu values('7', '3','Frames',             'download frames of formation',               'item=35&cmde=cursus',    'O','255','O','N','O','en');
insert into egroup_menu values('8', '3','Advertisements',     'visualize advertisements',                   'item=9&cmde=breve',      'O','255','O','N','O','en');
insert into egroup_menu values('9', '3','Diary',              'consult diaries of courses and examinations','item=8',                 'O','255','O','N','O','en');
insert into egroup_menu values('10','3','Surveys',            'answer surveys',                             'item=99&cmde=visu',      'O','255','O','N','O','en');
insert into egroup_menu values('11','3','B2i-C2i',            'consult your electronic B2i-C2i notebook',   'item=1&visu=1&cmde=show','O','255','O','N','O','en');
insert into egroup_menu values('12','3','Links',              'consult links',                              'item=9&cmde=link',       'O','255','O','N','O','en');
insert into egroup_menu values('13','3','e-Portfolio',        'manage school competences',                  'item=1&visu=1&cmde=show','O','255','O','N','O','en');
insert into egroup_menu values('14','3','Chat',               'Online dialog',                              'item=14&cmde=chat',      'O','255','O','N','O','en');
insert into egroup_menu values('15','3','Homework diary',     'consult the numerical homework diary',       'item=13',                'O','255','O','N','O','en');
insert into egroup_menu values('16','3','Members',            'know the members of this group.',            'item=17&cmde=user',      'O','255','O','N','O','en');
###############################################################################
# création de la dba des des droits d'accès des utilisateurs pour les e-groupes
###############################################################################
insert into egroup_access values('-1', 'On standby','en');
insert into egroup_access values('0',  'Banished','en');
insert into egroup_access values('1',  'Reader','en');
insert into egroup_access values('3',  'Member','en');
insert into egroup_access values('7',  'Moderator','en');
###############################################################################