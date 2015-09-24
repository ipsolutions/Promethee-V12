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
insert into campus values('', 'temas', 'campus_data', 'O', 'es');
insert into campus values('', 'clases', 'campus_classe', 'N', 'es');
###############################################################################
# création de la dba du menu du campus virtuel
###############################################################################
insert into campus_menu values('','Documentos',           'acceder a documentos pedagogicos',        'item=31',             'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Foros',                'enviar mensajes a un foro',               'item=3&cmde=visu',    'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Galerias',             'visualizar galerias de imágenes',         'item=5',              'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Trabajo para devolver','depositar trabajos o examenes hechos',    'item=9&cmde=work',    'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Ejercicios',           'efectuar ejercicios en linea',            'item=50',             'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Cursos',               'telecargar soportes de cursos o apuntes', 'item=33',             'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Referencias',          'telecargar las referencias de formacion', 'item=35&cmde=cursus', 'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Anuncios',             'imaginar anuncios',                       'item=9&cmde=breve',   'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Agenda',               'consultar agendas de cursos o apuntes',   'item=8',              'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Sondeos ',             'responder a sondeos',                     'item=99&cmde=visu',   'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Vínculos',             'consultar vínculos',                      'item=9&cmde=link',    'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','e-Portafolio',         'dirigir las competencias escolares',      'item=16&cmde=visu',   'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Chateo',               'dialogo en directo',                      'item=14&cmde=chat',   'O', '255', 'O', 'N', 'O', '0','es');
insert into campus_menu values('','Cuaderno de textos',   'consultar el cuaderno numerico',          'item=13',             'O', '255', 'O', 'N', 'O', '0','es');
###############################################################################
# création de la dba des matières du campus virtuel
###############################################################################
insert into campus_data values('1', '0','2','255','','Agronomia',           'Bienvenida a la pagina de Agronomia.',                 '10','N','N','','O','es','');
insert into campus_data values('2', '0','2','255','','Ingles',              'Bienvenida a la pagina de Ingles.',                    '10','N','N','','O','es','');
insert into campus_data values('3', '0','2','255','','Aleman',              'Bienvenida a la pagina de Aleman.',                    '10','N','N','','O','es','');
insert into campus_data values('4', '0','2','255','','Biologia',            'Bienvenida a la pagina de Biologia.',                  '10','N','N','','O','es','');
insert into campus_data values('5', '0','2','255','','Economia',            'Bienvenida a la pagina de Economia.',                  '10','N','N','','O','es','');
insert into campus_data values('6', '0','2','255','','EFD',                 'Bienvenida a la pagina de Educacion Fisica y Deporte.','10','N','N','','O','es','');
insert into campus_data values('7', '0','2','255','','ESC',                 'Bienvenida a la pagina de Educacion Socio-Cultural.',  '10','N','N','','O','es','');
insert into campus_data values('8', '0','2','255','','Frances',             'Bienvenida a la pagina de Frances.',                   '10','N','N','','O','es','');
insert into campus_data values('9', '0','2','255','','Historia y Geografia','Bienvenida a la pagina de Historia y Geografia.',      '10','N','N','','O','es','');
insert into campus_data values('10','0','2','255','','Informatica',         'Bienvenida a la pagina de Informatica.',               '10','N','N','','O','es','');
insert into campus_data values('11','0','2','255','','Italiano',            'Bienvenida a la pagina de Italiano.',                  '10','N','N','','O','es','');
insert into campus_data values('12','0','2','255','','Maquinismo',          'Bienvenida a la pagina de Maquinismo.',                '10','N','N','','O','es','');
insert into campus_data values('13','0','2','255','','Matematicas',         'Bienvenida a la pagina de Matematicas.',               '10','N','N','','O','es','');
insert into campus_data values('14','0','2','255','','Filosofia',           'Bienvenida a la pagina de Filosofia.',                 '10','N','N','','O','es','');
insert into campus_data values('15','0','2','255','','Fitotecnia',          'Bienvenida a la pagina de Fitotecnia.',                '10','N','N','','O','es','');
insert into campus_data values('16','0','2','255','','Ciencias Fisicas',    'Bienvenida a la pagina de Ciencias Fisicas.',          '10','N','N','','O','es','');
insert into campus_data values('17','0','2','255','','Zootecnia',           'Bienvenida a la pagina de Zootecnia.',                 '10','N','N','','O','es','');
insert into campus_data values('18','0','2','255','','educacion civica',    'Bienvenida a la pagina de educacion civica.',          '10','N','N','','O','es','');
insert into campus_data values('19','0','2','255','','Dibujo',              'Bienvenida a la pagina de Dibujo.',                    '10','N','N','','O','es','');
insert into campus_data values('20','0','2','255','','Musica',              'Bienvenida a la pagina de Musica.',                    '10','N','N','','O','es','');
insert into campus_data values('21','0','2','255','','Artes plasticas',     'Bienvenida a la pagina de Artes plasticas.',           '10','N','N','','O','es','');
insert into campus_data values('22','0','2','255','','Español',             'Bienvenida a la pagina de Español.',                   '10','N','N','','O','es','');
###############################################################################
# création de la dba des niveaux scolaire
###############################################################################
insert into campus_level values('1', 'Preescolar : PS',     'O','es');
insert into campus_level values('2', 'Preescolar : MS',     'O','es');
insert into campus_level values('3', 'Preescolar : GS',     'O','es');
insert into campus_level values('4', 'Primaria : CP',       'O','es');
insert into campus_level values('5', 'Primaria : CE1',      'O','es');
insert into campus_level values('6', 'Primaria : CE2',      'O','es');
insert into campus_level values('7', 'Primaria : CM1',      'O','es');
insert into campus_level values('8', 'Primaria : CM2',      'O','es');
insert into campus_level values('9', 'Secundaria : 6ème',   'O','es');
insert into campus_level values('10','Secundaria : 5ème',   'O','es');
insert into campus_level values('11','Secundaria : 4ème',   'O','es');
insert into campus_level values('12','Secundaria : 3ème',   'O','es');
insert into campus_level values('13','Secundaria : BEP',    'O','es');
insert into campus_level values('14','Secundaria : Bac Pro','O','es');
insert into campus_level values('15','Secundaria : 2GT',    'O','es');
insert into campus_level values('16','Secundaria : 1ère',   'O','es');
insert into campus_level values('17','Secundaria : Term',   'O','es');
insert into campus_level values('18','Superior : BTS-DUT',  'O','es');
insert into campus_level values('19','Superior : Licence',  'O','es');
insert into campus_level values('20','Superior : Master',   'O','es');
insert into campus_level values('21','Superior : Doctorat', 'O','es');
###############################################################################
# création de la dba des des droits d'accès des utilisateurs pour les e-campus
###############################################################################
insert into campus_access values('-1', 'En espera', 'es');
insert into campus_access values('0',  'Proscritos','es');
insert into campus_access values('1',  'Lector',    'es');
insert into campus_access values('3',  'Miembros',  'es');
insert into campus_access values('7',  'Moderador', 'es');
###############################################################################
# création de la dba des cursus
###############################################################################
insert into cursus values('1', 'Formacion inicial',         '', 'O', 'es');
insert into cursus values('2', 'Formacion continua',        '', 'N', 'es');
insert into cursus values('3', 'Formacion por alternancia', '', 'N', 'es');
###############################################################################
