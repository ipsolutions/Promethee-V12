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
# création de la dba des configurations
###############################################################################
insert into config values('', 'default',     'Prométhée, the « ready to use » VLE open source 100% free', 'Welcome on the intranet', 'Prométhée,intranet,extranet,GNU/GPL,GPL,Free software,open source,CMS,groupware,workflow,e-learning,e-campus,education,VLE,LMS', 'FFFFFF', 'C', '3 accounts are available:\n->{{webmaster}}, no password\n->{{teacher}}, no password\n->{{student}}, no password', 'The site is temporarily inaccessible due to maintenance.\nThank you for coming back later.', '1', 'N', 'blue.gif', 'geometric.gif', 'N', 'streak2.gif', 'your address here', 'zip code', 'city', 'your tel here', 'your fax here', 'your website here', 'your email here', 'O', 'O', 'webmaster\'s email', 'N', 'en','0');
insert into config values('', 'LEGTA Gap',   'Prométhée, the « ready to use » VLE open source 100% free', 'Welcome on the intranet', 'Prométhée,intranet,extranet,GNU/GPL,GPL,Free software,open source,CMS,groupware,workflow,e-learning,e-campus,education,VLE,LMS', 'FFFFFF', 'D', 'Please enter your ID and your password to connect.', 'The site is temporarily inaccessible due to maintenance.\nThank you for coming back later.', '1', 'N', 'red.gif', 'mountain.gif', 'N', 'streak7.gif', '127, route de Valserres', 'F-05000', 'Gap', '+33 (0) 492.51.04.36', '+33 (0) 492.53.57.93', 'www.gap.educagri.fr', 'lpa.gap@educagri.fr', 'O', 'O', 'webmaster\'s email', 'N', 'en','0');
insert into config values('', 'LEGTA Digne', 'Prométhée, the « ready to use » VLE open source 100% free', 'Welcome',                 'Prométhée,intranet,extranet,GNU/GPL,GPL,Free software,open source,CMS,groupware,workflow,e-learning,e-campus,education,VLE,LMS', 'FFFFFF', 'G', 'Please enter your ID and your password to connect.', 'The site is temporarily inaccessible due to maintenance.\nThank you for coming back later.', '2', 'N', 'round.gif',  'hills.gif', 'N', 'streak7.gif', 'Le Chaffaut', 'F-04510', 'Carmejane', '+33 (0) 492.30.35.70', '+33 (0) 492.30.35.79', 'www.digne-carmejane.educagri.fr', 'lpa.digne@educagri.fr', 'O', 'O', 'webmaster\'s email', 'N', 'en','0');
insert into config values('', '',            '',                                                          '',                        'Prométhée,intranet,extranet,GNU/GPL,GPL,Free software,open source,CMS,groupware,workflow,e-learning,e-campus,education,VLE,LMS', 'FFFFFF', 'C', '', 'The site is temporarily inaccessible due to maintenance.\nThank you for coming back later.', '2', 'N', 'dash.gif', 'geometric.gif', 'N', 'blurred.jpg', '', '', '', '', '', '', '', 'O', 'O', '', 'N', 'en','0');
###############################################################################
# création de la dba des centres par établissement
###############################################################################
insert into config_centre values('1',  'agr. school',    '', '', '', '', '', 'O', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('2',  'High school',    '', '', '', '', '', 'N', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('3',  'College',        '', '', '', '', '', 'N', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('4',  'Voc. school',    '', '', '', '', '', 'N', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('5',  'CFA, CFPPA',     '', '', '', '', '', 'N', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('6',  'primary school', '', '', '', '', '', 'N', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('7',  'University',     '', '', '', '', '', 'N', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('8',  'tech. school',   '', '', '', '', '', 'N', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('9',  'Institute',      '', '', '', '', '', 'N', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('10', 'ing. school',    '', '', '', '', '', 'N', 'en','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
###############################################################################
# création de la dba des définitions des mot-clefs
###############################################################################
insert into config_def values('', '1', '_STUDENT', 'pupils', 'en');
insert into config_def values('', '1', '_COURSE',  'course', 'en');
insert into config_def values('', '1', '_CLASS',   'class',  'en');

insert into config_def values('', '2', '_STUDENT', 'pupils', 'en');
insert into config_def values('', '2', '_COURSE',  'course', 'en');
insert into config_def values('', '2', '_CLASS',   'class',  'en');

insert into config_def values('', '3', '_STUDENT', 'pupils', 'en');
insert into config_def values('', '3', '_COURSE',  'course', 'en');
insert into config_def values('', '3', '_CLASS',   'class',  'en');

insert into config_def values('', '4', '_STUDENT', 'pupils', 'en');
insert into config_def values('', '4', '_COURSE',  'course', 'en');
insert into config_def values('', '4', '_CLASS',   'class',  'en');

insert into config_def values('', '5', '_STUDENT', 'apprentice', 'en');
insert into config_def values('', '5', '_COURSE',  'course',     'en');
insert into config_def values('', '5', '_CLASS',   'training',   'en');

insert into config_def values('', '6', '_STUDENT', 'learners',   'en');
insert into config_def values('', '6', '_COURSE',  'module',     'en');
insert into config_def values('', '6', '_CLASS',   'training',   'en');

insert into config_def values('', '7', '_STUDENT', 'trainees',        'en');
insert into config_def values('', '7', '_COURSE',  'cours',           'en');
insert into config_def values('', '7', '_CLASS',   'course of study', 'en');

insert into config_def values('', '8', '_STUDENT', 'students',  'en');
insert into config_def values('', '8', '_COURSE',  'CU',        'en');
insert into config_def values('', '8', '_CLASS',   'education', 'en');

insert into config_def values('', '9', '_STUDENT', 'students',  'en');
insert into config_def values('', '9', '_COURSE',  'course',    'en');
insert into config_def values('', '9', '_CLASS',   'education', 'en');

insert into config_def values('', '10', '_STUDENT', 'listeners', 'en');
insert into config_def values('', '10', '_COURSE',  'CU',        'en');
insert into config_def values('', '10', '_CLASS',   'education', 'en');

insert into config_def values('', '11', '_STUDENT', 'pupils',          'en');
insert into config_def values('', '11', '_COURSE',  'course',          'en');
insert into config_def values('', '11', '_CLASS',   'course of study', 'en');

insert into config_def values('', '12', '_STUDENT', 'trainees', 'en');
insert into config_def values('', '12', '_COURSE',  'CU',       'en');
insert into config_def values('', '12', '_CLASS',   'training', 'en');

insert into config_def values('', '13', '_STUDENT', 'schoolchild', 'en');
insert into config_def values('', '13', '_COURSE',  'course',      'en');
insert into config_def values('', '13', '_CLASS',   'stream',      'en');
###############################################################################
# création de la dba des groupes
###############################################################################
insert into user_group values('1',  'Pupils',           '', '1024', '1', 'O', 'en');
insert into user_group values('2',  'Teacher',          '', '1024', '2', 'O', 'en');
insert into user_group values('3',  'Tech. employee',   '', '1024', '2', 'O', 'en');
insert into user_group values('4',  'Administration',   '', '1024', '2', 'O', 'en');
insert into user_group values('5',  'Farm',             '', '1024', '2', 'O', 'en');
insert into user_group values('6',  'Training officer', '', '1024', '2', 'N', 'en');
insert into user_group values('7',  'Professor',        '', '1024', '2', 'O', 'en');
insert into user_group values('8',  'PhD',              '', '1024', '2', 'N', 'en');
insert into user_group values('9',  'Speaker',          '', '1024', '3', 'N', 'en');
insert into user_group values('10', 'Company',          '', '1024', '3', 'O', 'en');
insert into user_group values('11', 'Parent',           '', '1024', '3', 'O', 'en');
insert into user_group values('12', 'Visitor',          '', '1024', '3', 'O', 'en');
###############################################################################
# création de la dba des droits
###############################################################################
insert into user_admin values('0',   'Bannished',   'en');
insert into user_admin values('1',   'User',        'en');
insert into user_admin values('2',   'Member',      'en');
insert into user_admin values('4',   'Moderator',   'en');
insert into user_admin values('8',   'Manager',     'en');
insert into user_admin values('255', 'Big Brother', 'en');
###############################################################################
# création de la dba des catégories d'utilisateurs
###############################################################################
insert into user_category values('1', 'Student', 'en');
insert into user_category values('2', 'Staff',   'en');
insert into user_category values('3', 'Outside', 'en');
###############################################################################
# création de la dba des identifiants
###############################################################################
insert into user_id values('','2', '1','0','','2002-09-01','2002-09-01','2002-09-01','255','webmaster','',       'Webmaster','', 'H','Administrator from this intranet','I am Big Brother','','','','','','','','','','Hi John! What\'s your name?','0','0','0','0','0','O','N','E','N','N','O','','0','','en','0','0');
insert into user_id values('','2', '1','0','','2002-09-01','2002-09-01','2002-09-01','1',  'teacher',  '',       'Teacher',  '', 'H','Teacher of this school',          '','','','','','','','','','','My name is Bond, James Bond.', '0','0','0','0','0','O','N','E','N','N','O','','0','','en','0','0');
insert into user_id values('','1', '1','0','','2002-09-01','2002-09-01','2002-09-01','1',  'student',  '',       'Student',  '', 'H','Pupil of this school',            '','','','','','','','','','','','0','0','0','0','0','O','N','E','N','N','O','','0','','en','0','0');
insert into user_id values('','12','1','0','','2002-09-01','2002-09-01','2002-09-01','1',  'visitor',  'visitor','Visitor',  '', 'A','Anonymous Connection',            '','','','','','','','','','','','0','0','0','0','0','N','N','E','N','N','O','','0','','en','0','0');
###############################################################################
# création de la dba des fichiers mime
###############################################################################
insert into config_mime values('', 'htm',  'htm web page',                        'O', 'en');
insert into config_mime values('', 'html', 'html web page',                       'O', 'en');
insert into config_mime values('', 'pdf',  'Acrobat Reader document',             'O', 'en');
insert into config_mime values('', 'xls',  'Micro$oft Excel',                     'O', 'en');
insert into config_mime values('', 'doc',  'Micro$oft Word',                      'O', 'en');
insert into config_mime values('', 'ppt',  'Micro$oft PowerPoint',                'O', 'en');
insert into config_mime values('', 'pps',  'Micro$oft PowerPoint',                'O', 'en');
insert into config_mime values('', 'pub',  'Micro$oft Publisher',                 'O', 'en');
insert into config_mime values('', 'mdb',  'Micro$oft Access',                    'O', 'en');
insert into config_mime values('', 'jpg',  'picture jpeg format',                 'O', 'en');
insert into config_mime values('', 'png',  'picture png format',                  'O', 'en');
insert into config_mime values('', 'gif',  'picture gif format',                  'O', 'en');
insert into config_mime values('', 'bmp',  'picture bitmap format',               'O', 'en');
insert into config_mime values('', '7z',   '7-zip compressed document',           'O', 'en');
insert into config_mime values('', 'zip',  'zip compressed document',             'O', 'en');
insert into config_mime values('', 'rar',  'rar compressed document',             'O', 'en');
insert into config_mime values('', 'mp3',  'audio file mp3 format',               'O', 'en');
insert into config_mime values('', 'wav',  'audio file wav format',               'O', 'en');
insert into config_mime values('', 'mpg',  'audio file mpeg format',              'O', 'en');
insert into config_mime values('', 'ogg',  'audio file ogg vorbis format',        'O', 'en');
insert into config_mime values('', 'txt',  'raw text document',                   'O', 'en');
insert into config_mime values('', 'sxw',  'OpenOffice word processor',           'O', 'en');
insert into config_mime values('', 'sxc',  'OpenOffice spreadsheet',              'O', 'en');
insert into config_mime values('', 'sxd',  'OpenOffice draw',                     'O', 'en');
insert into config_mime values('', 'sxi',  'OpenOffice impress',                  'O', 'en');
insert into config_mime values('', 'sxm',  'OpenOffice formulas',                 'O', 'en');
insert into config_mime values('', 'swf',  'Flash document',                      'O', 'en');
insert into config_mime values('', 'ods',  'open document spreadsheet',           'O', 'en');
insert into config_mime values('', 'odt',  'open document word processor',        'O', 'en');
insert into config_mime values('', 'odp',  'open document impress',               'O', 'en');
insert into config_mime values('', 'odb',  'open document database',              'O', 'en');
insert into config_mime values('', 'rtf',  'Rich Text Format document',           'O', 'en');
insert into config_mime values('', 'hlp',  'help file',                           'O', 'en');
insert into config_mime values('', 'php',  'PHP file',                            'O', 'en');
insert into config_mime values('', 'c++',  'C++ file',                            'O', 'en');
insert into config_mime values('', 'wmv',  'video file wmv format',               'O', 'en');
insert into config_mime values('', 'avi',  'vidéo file avi format',               'O', 'en');
insert into config_mime values('', 'tgz',  'tar.gz compressed document',          'O', 'en');
insert into config_mime values('', 'sql',  'sql script',                          'O', 'en');
insert into config_mime values('', 'cer',  'digital certificate',                 'O', 'en');
###############################################################################
# création de la dba des menus de la page d'accueil
###############################################################################
insert into config_menu values('1', 'MENU',             '', '1', 'N', 'home.png', '255', 'O', '', 'N', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_submenu values('', '1', 'Home',           'item=0',                         'O', '1',  '255', 'O', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Who\'s who?',    'item=1',                         'O', '2',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Directories',    'item=11&cmde=lidi',              'O', '3',  '255', 'N', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Post-it',        'item=4',                         'O', '4',  '254', 'N', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Mailbox',        'http://www.horde.org/imp/',      'O', '5',  '254', 'N', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Reservations',   'item=10',                        'O', '6',  '254', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Diaries',        'item=8',                         'O', '7',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Forums',         'item=3',                         'O', '8',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Chat',           'item=14',                        'O', '9',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Galleries',      'item=5',                         'O', '10', '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Publications',   'item=6',                         'O', '11', '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Absences',       'item=63&cmde=visu',              'O', '12', '255', 'N', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Timetable',      'item=64',                        'O', '13', '255', 'N', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'e-groups',       'item=17',                        'O', '14', '255', 'N', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Statistics',     'item=7',                         'O', '15', '255', 'O', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '1', 'Logout',         'item=-1',                        'O', '16', '255', 'O', 'N', '', 'O', '0', 'en');
insert into config_menu values('2', 'INFOS',            '', '4', 'N', 'infos.png', '255', 'O', 'item=20&cmde=gestion','O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_submenu values('', '2', 'Message of the day', 'item=18',                    'O', '1', '0',   'N', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '2', 'Live news',          'item=15',                    'O', '2', '255', 'O', 'N', '', 'O', '0', 'en');
insert into config_menu values('3', 'DOCUMENTS',        '', '5', 'N', 'doc.png',   '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_submenu values('', '3', 'Reference frames ', 'item=35',                     'O', '1',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '3', 'Administration',    'item=31&IDres=1',             'O', '2',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '3', 'Pedagogy',          'item=31&IDres=2',             'O', '3',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '3', 'On line ',          'item=31&IDres=3&cmde=online', 'O', '4',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '3', 'Collaboratifs',     'item=34',                     'O', '5',  '254', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '3', 'Weblogs',           'item=36',                     'O', '6',  '254', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '3', 'Resources',         'item=32',                     'O', '7',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '3', 'HS Register',       'item=37',                     'O', '8',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '3', 'Virtual spaces',    'item=45',                     'O', '9',  '255', 'N', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '3', 'Library',           'http://www.sigb.net/',        'O', '10', '255', 'N', 'N', '', 'O', '0', 'en');
insert into config_menu values('4', 'COMPANIES',      '', '7',  'N', 'company.png', '255', 'O', 'item=40&cmde=gestion&IDmenu=1', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_submenu values('', '4', 'Update',         'item=40&cmde=lieu',              'O', '1', '254', 'N', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '4', 'Visits',         'item=40&cmde=visit',             'O', '2', '254', 'N', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '4', 'Feedback',       'item=38',                        'O', '3', '254', 'N', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '4', 'Research',       'item=40&cmde=search',            'O', '4', '255', 'N', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '4', 'CV Repository',  'item=40&cmde=cv',                'O', '5', '255', 'N', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '4', 'pro. workspace', 'item=40&cmde=pro',               'O', '6', '255', 'N', 'N', '', 'O', '0', 'en');
insert into config_menu values('5', 'HELP',            '', '-9', 'N', 'support.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_submenu values('', '5', 'Installation',   'http://promethee.eu.org/download/ftp/docs/english documents/installation guide.pdf',     'O', '1', '255', 'O', 'N', '', 'O', '0', 'en');
insert into config_menu values('6', 'LINKS',           '', '8',  'N', 'url.png', '255', 'O', 'item=22&IDgroup=0', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_menu values('7', 'SURVEY',          '', '9',  'N', 'poll.png', '255', 'O', 'item=99&IDdata=0&cmde=gestion', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_menu values('8', 'ADMINISTRATOR',   '', '-7', 'N', 'admin.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '1', 'en');
insert into config_submenu values('', '8', 'Access',              'item=21&cmde=access',            'O', '1', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'Configuration',       'item=21',                        'O', '2', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'Identification',      'item=23',                        'O', '3', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'Logs of connection',  'item=92',                        'O', '4', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'Logs IP',             'item=24',                        'O', '5', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'Webmail',             'item=25',                        'O', '6', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'phpMyAdmin',          'http://www.phpmyadmin.net/',     'O', '7', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'Inventory Management','http://glpi-project.org/',       'O', '8', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'Backup',              'item=27&cmde=backup',            'O', '9', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'Import',              'item=27&cmde=import',            'O','10', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_submenu values('', '8', 'Reset tables',        'item=27&cmde=reset',             'O','11', '255', 'N', 'N', '', 'O', '1', 'en');
insert into config_menu values('9', 'NAME DAY',     '', '-4', 'N', 'today.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_submenu values('', '9', 'Joke of the day', '#', 'O', '1', '255', 'N', 'N', 'N', 'N', '0', 'en');
insert into config_submenu values('', '9', 'Quotation',       '#', 'O', '2', '255', 'N', 'N', 'N', 'O', '0', 'en');
insert into config_submenu values('', '9', 'Howler',          '#', 'O', '3', '255', 'N', 'N', 'N', 'O', '0', 'en');
insert into config_menu values('10', 'SEARCH',       '', '-6', 'N', 'search.png',  '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_menu values('11', '_STUDENT',     '', '6',  'N', 'student.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_submenu values('', '11', 'Absences',         'item=63&cmde=show',               'O', '1',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Former _STUDENT',  'item=38&visu=N',                  'O', '2',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', '_STUDENT list',    'item=38',                         'O', '3',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Representative',   'item=38&delegue=O',               'O', '4',  '255', 'O', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '11', '_CLASS list',      'item=9&cmde=class',               'O', '5',  '255', 'O', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'e-Portfolio',      'item=16&cmde=visu',               'O', '6',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'B2i-C2i',          'item=16&ident=B2i-C2i&cmde=visu', 'O', '7',  '255', 'O', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Bulletins mark',   'item=60',                         'O', '8',  '255', 'N', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Bulletins CCF',    'item=61',                         'O', '9',  '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Exams',            'item=62',                         'O', '10', '255', 'O', 'N', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Homework Notebook','item=13',                         'O', '11', '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Corres. Notebook', 'item=68',                         'O', '12', '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Link Notebook',    'item=12',                         'O', '13', '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Class Register',   'item=66',                         'O', '14', '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Detentions',       'item=67',                         'O', '15', '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'LMS',              'item=17&IDitem=3',                'O', '16', '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Sick room',        'item=63&cmde=sick',               'O', '17', '255', 'O', 'O', '', 'O', '0', 'en');
insert into config_submenu values('', '11', 'Parents list',     'item=38&cmde=parent',             'O', '18', '128', 'N', 'N', '', 'O', '0', 'en');
insert into config_menu values('12', 'WHO IS?',     '', '-8', 'N', 'who.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_menu values('13', 'STATS',       '', '-10', 'N', 'stats.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_menu values('14', 'FREE SOFTWARE', 'Sign the <a href="http://petition.eurolinux.org">petition</a> for an Europe without software patents.', '-11', 'N', 'gnu.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_submenu values('', '14', 'GNU/Linux',        'http://www.linux.org',      'O', '1', '255', 'O', 'N', 'linuxpow.jpg',  'O', '0', 'en');
insert into config_submenu values('', '14', 'Apache',           'http://www.apache.org',     'O', '2', '255', 'O', 'N', 'apache.gif',    'O', '0', 'en');
insert into config_submenu values('', '14', 'MySQL',            'http://www.mysql.com',      'O', '3', '255', 'O', 'N', 'mysql.gif',     'O', '0', 'en');
insert into config_submenu values('', '14', 'PHP',              'http://www.php.net',        'O', '4', '255', 'O', 'N', 'php.gif',       'O', '0', 'en');
insert into config_submenu values('', '14', 'HORDE',            'http://www.horde.org/imp/', 'O', '5', '255', 'O', 'N', 'horde.png',     'O', '0', 'en');
insert into config_submenu values('', '14', 'fckEditor',        'http://www.fckeditor.net',  'O', '6', '255', 'O', 'N', 'fckeditor.gif', 'O', '0', 'en');
insert into config_submenu values('', '14', 'Free software',    'http://www.linuxfr.org',    'O', '7', '255', 'O', 'N', 'LL.png',        'O', '0', 'en');
insert into config_menu values('15', 'WHAT\'S NEW?',   '', '3',  'O', 'news.png',     '255', 'O', 'item=30&cmde=gestion', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_menu values('16', 'CALENDAR',       '', '-3', 'N', 'calendar.png', '255', 'O', 'item=15&cmde=post&IDflash=0', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_menu values('17', 'e-CAMPUS',       '', '-1', 'N', 'campus.png',   '255', 'O', 'item=9&IDres=2&cmde=gestion', 'O', 'O', 'O', 'campus_menu', '0', 'en');
insert into config_menu values('18', 'SUGGESTION BOX', '', '-5', 'N', 'box.png',      '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_menu values('19', 'e-GROUPS',       '', '-2', 'N', 'egroup.png',   '255', 'O', 'item=17&cmde=gestion', 'O', 'O', 'O', 'egroup_menu', '0', 'en');
insert into config_menu values('20', 'MY VLE',         '', '2',  'N', 'manager.png',  '255', 'O', '', 'N', 'O', 'O', 'config_submenu', '0', 'en');
insert into config_submenu values('', '20', 'My account',         'item=1&cmde=account&show=0', 'O', '1',  '254', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'My workspace ',      'item=45&cmde=visu',          'O', '2',  '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'My diary',           'item=8&cmde=mvc',            'O', '3',  '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'My blog',            'item=36&cmde=visu',          'O', '4',  '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'My directory',       'item=11&cmde=address',       'O', '5',  '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'My e-portfolio',     'item=16&cmde=mvc',           'O', '6',  '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'My trainig courses', 'item=40&cmde=mvc',           'O', '7',  '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'My absences',        'item=63&cmde=mvc',           'O', '8',  '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'Homework Notebook',  'item=13&cmde=mvc',           'O', '9',  '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'Link Notebook',      'item=12&cmde=mvc',           'O', '10', '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'Class Register',     'item=66&cmde=mvc',           'O', '11', '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'Correspondence',     'item=68&cmde=mvc',           'O', '12', '255', 'N', 'N', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'Hitch report',       'item=39',                    'O', '13', '255', 'N', 'O', '', 'O', '2', 'en');
insert into config_submenu values('', '20', 'My preferences',     'item=1&cmde=skin',           'O', '14', '255', 'N', 'N', '', 'O', '0', 'en');
insert into config_menu values('21', 'DONATION',       '', '-12', 'N', 'money.png',   '255', 'O', '', 'O', 'O', 'N', 'config_submenu', '0', 'en');
###############################################################################
# création de la dba des types de messages
###############################################################################
insert into postit_type values('0', 'Message system',     'N', 'en');
insert into postit_type values('1', 'Message',            'O', 'en');
insert into postit_type values('2', 'Detailed telephone', 'O', 'en');
###############################################################################
# création de la dba des liens
###############################################################################
insert into link values('', '0', '0', '255', 'www Research',       'http://www.google.com',                        'A very popular search engine.', 'uk.png', 'O', '0', 'en');
insert into link values('', '0', '0', '255', 'Prométhée',          'http://promethee.eu.org',                     'The « ready to use » Virtual Learning Environment open source 100% free.', 'uk.png', 'O', '0', 'en');
insert into link_data values('6', '0', '0', '0', 'Culture', '', 'O', 'en');
insert into link values('', '6', '0', '255', 'Wikipedia, the free encyclopedia', 'http://www.wikipedia.org/',     '', 'uk.png', 'O', '0', 'en');
insert into link values('', '6', '0', '255', 'satellite maps',                   'http://maps.google.com/',                       '', 'uk.png', 'O', '0', 'en');
insert into link_data values('7', '0', '0', '0', 'Free sofware', '', 'O', 'en');
insert into link values('', '7', '0', '255', 'The GNU project',                  'http://www.gnu.org/',         'Where all began!', 'uk.png', 'O', '0', 'en');
insert into link values('', '7', '0', '255', 'Free Software Foundation',         'http://www.fsfeurope.org/', '', 'uk.png', 'O', '0', 'en');
insert into link values('', '7', '0', '255', 'MySQL',                            'http://www.mysql.com/',         'The world\'s most popular open source database.', 'uk.png', 'O', '0', 'en');
insert into link values('', '7', '0', '255', 'OpenOffice',                       'http://www.openoffice.org',     'OpenOffice.org is a multiplatform and multilingual office suite and an open-source project.', 'uk.png', 'O', '0', 'en');
insert into link values('', '7', '0', '255', 'FireFox',                          'http://www.mozilla.org/',       'The web rediscovery.', 'uk.png', 'O', '0', 'en');
insert into link values('', '7', '0', '255', 'Scribus',                          'http://www.scribus.net/',       'Scribus is an open-source program that brings award-winning professional page layout with a combination of "press-ready" output and new approaches to page layout.', 'uk.png', 'O', '0', 'en');
insert into link values('', '7', '0', '255', 'Pidgin',                            'http://www.pidgin.im/',       'Pidgin is a multi-protocol Instant Messaging client that allows you to use all of your IM accounts at once.', 'uk.png', 'O', '0', 'en');
insert into link values('', '7', '0', '255', 'Nvu',                              'http://www.nvu.com/',           'Makes managing a web site a snap.', 'uk.png', 'O', '0', 'en');
insert into link values('', '7', '0', '255', 'VideoLAN',                         'http://www.videolan.org/',      'VideoLAN is a software project, which produces free software for video (ogg, mp3, divx, dvd, ...).', 'uk.png', 'O', '0', 'en');
###############################################################################
# création de la dba ftp
###############################################################################
insert into ftp values('1', '0', '30', '31', 'Intranet server', 'download/ftp/serveur', 'Various Documents for download.', '', '', 'C', '1', 'O', 'en');
###############################################################################
# création de la dba des ressources
###############################################################################
insert into resource values('1','0','0','0','Administrator','Administrative documents for users.',       '11', 'N', 'N', 'O', 'en');
insert into resource values('2','0','0','0','Pedagogy',     'Teaching documents for the use of pupils.', '11', 'N', 'N', 'O', 'en');
insert into resource values('3','0','0','0','On line',      'Teaching online resources.',                '11', 'N', 'O', 'O', 'en');
insert into resource values('4','0','0','0','e-group',      'Resources of virtual groups.',              '11', 'N', 'O', 'O', 'en');
###############################################################################
# création de la dba des catégories de ressources
###############################################################################
insert into resource_data values('','1','0','8','255','Standard documents (model)','','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','1','0','8','255','Memorandums',               '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','1','0','8','255','Reports',                   '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','1','0','8','255','Projects PUS, PAE, etc',    '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','1','0','8','255','Structures teaching',       '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','1','0','8','255','Others',                    '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Agronomy',                  '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','English',                   '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','German',                    '','0', '1', 'N', '1', 'O', 'N', 'en');
insert into resource_data values('','2','0','2','255','Biology',                   '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Economy',                   '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Sport',                     '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Socio culture',             '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Spanish',                   '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','French',                    '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Hist-Geo',                  '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Computing',                 '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Italian',                   '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Mechanization',             '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Mathematics',               '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Philosophy',                '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Phytotechny',               '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','physics',                   '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','2','0','2','255','Zootechny',                 '','0', '1', 'N', '1', 'O', 'O', 'en');
insert into resource_data values('','3','0','2','255','On line',                   '','0', '1', 'N', '1', 'O', 'O', 'en');
###############################################################################
# création de la dba des licences des ressources
###############################################################################
insert into resource_license values('1', '??',         'unknown type of licence','O','en');
insert into resource_license values('2', 'GPL',        'GNU General Public License','O','en');
insert into resource_license values('3', 'LGPL',       'GNU Lesser General Public License','O','en');
insert into resource_license values('4', 'FDL',        'licence by default for the personal documents','O','en');
insert into resource_license values('5', 'Free Art',   'Free Licence Art','O','en');
insert into resource_license values('6', 'DP',         'document of the public domain','O','en');
insert into resource_license values('7', 'CC-by',      'licence Creative Commons (by)','O','en');
insert into resource_license values('8', 'CC-by-nd',   'licence Creative Commons (by-nd)','O','en');
insert into resource_license values('9', 'CC-by-nc-nd','licence Creative Commons (by-nc-nd)','O','en');
insert into resource_license values('10','CC-by-nc',   'licence Creative Commons (by-nc)','O','en');
insert into resource_license values('11','CC-by-nc-sa','licence Creative Commons (by-nc-sa)','O','en');
insert into resource_license values('12','CC-by-sa',   'licence Creative Commons (by-sa)','O','en');
insert into resource_license values('13','(C)',        'document under copyright','O','en');
###############################################################################
# création de la dba des types des ressources
###############################################################################
insert into resource_type values('1', 'Teaching scenarios','O','en');
insert into resource_type values('2', 'Reference frames','O','en');
insert into resource_type values('3', 'Evaluations','O','en');
insert into resource_type values('4', 'Teaching sites','O','en');
insert into resource_type values('5', 'Site for children','O','en');
insert into resource_type values('6', 'Timetables','O','en');
insert into resource_type values('7', 'Other sites','O','en');
insert into resource_type values('8', 'Software','O','en');
insert into resource_type values('9', 'Pictures','O','en');
insert into resource_type values('10','Videos','O','en');
insert into resource_type values('11','Sounds','O','en');
insert into resource_type values('12','Tricks and easy ways','O','en');
insert into resource_type values('13','Encyclopaedias/Dictionaries','O','en');
###############################################################################
# création de la dba des fonctions associées aux ressources
###############################################################################
insert into resource_function values('1','To prepare the class','O','en');
insert into resource_function values('2','To manage a school ','O','en');
insert into resource_function values('3','To be formed and get information','O','en');
insert into resource_function values('4','For the accompaniment and the school support','O','en');
###############################################################################
# création de la dba des absences
###############################################################################
insert into absent_data values('1',  'Absence', 'O','en');
insert into absent_data values('2',  'Delay', 'O','en');
insert into absent_data values('3',  'Infirmary', 'O','en');
insert into absent_data values('4',  'exit', 'O','en');
insert into absent_data values('5',  'Farm', 'O','en');
insert into absent_data values('6',  'External convocation', 'O','en');
insert into absent_data values('7',  'Internal convocation', 'O','en');
insert into absent_data values('8',  'Exempt workshop', 'O','en');
insert into absent_data values('9',  'Exempt Sport', 'O','en');
insert into absent_data values('10', 'Exclusion', 'O','en');
insert into absent_data values('11', 'Problem of transport', 'O','en');
insert into absent_data values('12', 'Make medical', 'O','en');
insert into absent_data values('13', 'Erased', 'O','en');
insert into absent_data values('14', 'Probationary', 'O','en');
insert into absent_data values('15', 'Disease', 'O','en');
insert into absent_data values('16', 'Other', 'O','en');
###############################################################################
# création de la dba des pages des documents collaboratifs
###############################################################################
insert into wiki_page values('', '0', '0', 'root directory', '2002-09-01',  '2002-09-01', '0', '254', '254', 'O', '0', 'O', 'en');
###############################################################################
# création de la dba des intitulés des résultats aux examens
###############################################################################
insert into exam_items values('1', '-', 'en');
insert into exam_items values('2', 'Receipt ', 'en');
insert into exam_items values('3', 'Deferred', 'en');
insert into exam_items values('4', 'Correction', 'en');
insert into exam_items values('5', 'Oral examination', 'en');
insert into exam_items values('6', 'Absent', 'en');
###############################################################################
# création de la dba des intitulés des edt
###############################################################################
insert into edt values('1', '0', '0', '255', 'rooms',  '255', '8:00;8:30;9:00;9:30;10:00;10:30;11:00;11:30;12:00;12:30;13:00;13:30;14:00;14:30;15:00;15:30;16:00;16:30;17:00;17:30;18:00;18:30;19:00', 'O', 'en');
insert into edt values('2', '0', '0', '255', 'staff',  '255', '8:00;8:30;9:00;9:30;10:00;10:30;11:00;11:30;12:00;12:30;13:00;13:30;14:00;14:30;15:00;15:30;16:00;16:30;17:00;17:30;18:00;18:30;19:00', 'O', 'en');
insert into edt values('3', '0', '0', '255', 'pupils', '255', '8:00;8:30;9:00;9:30;10:00;10:30;11:00;11:30;12:00;12:30;13:00;13:30;14:00;14:30;15:00;15:30;16:00;16:30;17:00;17:30;18:00;18:30;19:00', 'O', 'en');
###############################################################################
# création de la dba des intitulés des salles
###############################################################################
insert into edt_items values('1', '1', 'Physics laboratory', 'en');
insert into edt_items values('2', '1', 'Biology laboratory', 'en');
insert into edt_items values('3', '1', 'Computing laboratory', 'en');
insert into edt_items values('4', '1', 'video room', 'en');
insert into edt_items values('5', '1', 'examinations room', 'en');
insert into edt_items values('6', '1', 'amphitheatre', 'en');
insert into edt_items values('7', '1', 'IDC', 'en');
###############################################################################
# création de la dba des semaines des edt
###############################################################################
insert into edt_week values('1', 'W1', 'en');
insert into edt_week values('2', 'W2', 'en');
###############################################################################
# création de la dba des type d'incidents techniques
###############################################################################
insert into support_data values('1', 'Computing (hardware)', 'en');
insert into support_data values('2', 'Computing (software)', 'en');
insert into support_data values('3', 'Use of the VLE',       'en');
insert into support_data values('4', 'Other',                'en');
###############################################################################
# création de la dba des catégories de sanctions du carnet à points
###############################################################################
insert into carnet_type values('1', 'Behavior', 'en');
insert into carnet_type values('2', 'Boarding school', 'en');
insert into carnet_type values('3', 'Work', 'en');
###############################################################################
# création de la dba du barême du carnet à points
###############################################################################
insert into carnet_items values('1',  '1', '-2',  'punctuality (delays repeated not justified)', 'en');
insert into carnet_items values('2',  '1', '-2',  'Repeated chatterings', 'en');
insert into carnet_items values('3',  '1', '-2',  'Noisy attitude', 'en');
insert into carnet_items values('4',  '1', '-2',  'Vestimentary behaviour and/or attitude considered to be provocative or disturbing', 'en');
insert into carnet_items values('5',  '1', '-3',  'Not respect of cleanliness in the establishment and the neighbourhoods (papers, cigarette butt...)', 'en');
insert into carnet_items values('6',  '1', '-3',  'Use of mobile phone or during courses or obligatory studies.', 'en');
insert into carnet_items values('7',  '1', '-3',  'Absenteism/ unjustified absence', 'en');
insert into carnet_items values('8',  '1', '-3',  'Not respect of rules of procedure (ie: « smoking » zone)', 'en');
insert into carnet_items values('9',  '1', '-3',  'Agitation/exclusion of course', 'en');
insert into carnet_items values('10', '1', '-4',  'insolent remark/disrespectful matter', 'en');
insert into carnet_items values('11', '1', '-5',  'Degradation (buildings / material)', 'en');
insert into carnet_items values('12', '1', '-12', 'volunteer Release of an alarm sets fire', 'en');
insert into carnet_items values('13', '1', '-5',  'Possession of dangerous objects (cutters, knife, etc... except for school or professional use)', 'en');
insert into carnet_items values('14', '1', '-6',  'Exit without authorization', 'en');
insert into carnet_items values('15', '1', '-6',  'Falsification of signature or of documents', 'en');
insert into carnet_items values('16', '1', '-12', 'Verbal violence, physical aggression, discriminatory remarks', 'en');
insert into carnet_items values('17', '1', '-12', 'Introduction and /or consumption of illicit products in the establishment', 'en');
insert into carnet_items values('18', '1', '-12', 'Thieving/complicity of thieving/racket', 'en');

insert into carnet_items values('1',  '2', '-2',  'Not respect of schedules', 'en');
insert into carnet_items values('2',  '2', '-2',  'Room disordered', 'en');
insert into carnet_items values('3',  '2', '-2',  'Noisy attitude', 'en');
insert into carnet_items values('4',  '2', '-5',  'Degradation of furniture (+ repair and/or invoicing)', 'en');
insert into carnet_items values('5',  '2', '-1',  'Unauthorized exit', 'en');
insert into carnet_items values('6',  '2', '-1',  'Hazing (application of the law)', 'en');

insert into carnet_items values('1',  '3', '-1',  'material fergotten', 'en');
insert into carnet_items values('2',  '3', '-1',  'Work given late', 'en');
insert into carnet_items values('3',  '3', '-2',  'Work not made', 'en');
insert into carnet_items values('4',  '3', '-4',  'course Not taken', 'en');
insert into carnet_items values('5',  '3', '-6',  'Refusal to obey', 'en');
insert into carnet_items values('6',  '3', '-6',  'Defraud/cheating', 'en');

insert into carnet_items values('7',  '3', '1',   'motivation and regularity in work during several consecutive weeks.', 'en');
insert into carnet_items values('8',  '3', '1',   'irreproachable attitude during several consecutive weeks.', 'en');
insert into carnet_items values('9',  '3', '1',   'participation in community life during several consecutive weeks.', 'en');
insert into carnet_items values('10', '3', '1',   'catch of social or cultural initiative during several consecutive weeks.', 'en');
###############################################################################
insert into absent_motif values('1 ', 'care',           'en');
insert into absent_motif values('2 ', 'Rest nursing',   'en');
insert into absent_motif values('3 ', 'Back at home',   'en');
insert into absent_motif values('4 ', 'improper visit', 'en');
insert into absent_motif values('5 ', 'No show',        'en');
###############################################################################
