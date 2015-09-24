##############################################################################
#    Copyright (c) 2002-2005 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# création de la dba des types de qualifications
###############################################################################
insert into cv_level values('', '< 1 año', 'es');
insert into cv_level values('', '1 a 2 años', 'es');
insert into cv_level values('', '2 a 5 años', 'es');
insert into cv_level values('', '5 a 10 años', 'es');
insert into cv_level values('', '> 10 años', 'es');
###############################################################################
# création de la dba des diplômes
###############################################################################
insert into cv_degree values('', 'B.Sc.', 'es');
insert into cv_degree values('', 'M.Sc.', 'es');
insert into cv_degree values('', 'Ph.D.', 'es');
###############################################################################
# création de la dba des langues connues
###############################################################################
insert into cv_langtype values('', 'Alemán', 'es');
insert into cv_langtype values('', 'Ingleses', 'es');
insert into cv_langtype values('', 'Arabe', 'es');
insert into cv_langtype values('', 'Chinos', 'es');
insert into cv_langtype values('', 'Corse', 'es');
insert into cv_langtype values('', 'Danés', 'es');
insert into cv_langtype values('', 'Españoles', 'es');
insert into cv_langtype values('', 'Esperanto', 'es');
insert into cv_langtype values('', 'Finlandés', 'es');
insert into cv_langtype values('', 'Franceses', 'es');
insert into cv_langtype values('', 'Griego', 'es');
insert into cv_langtype values('', 'Húngaro', 'es');
insert into cv_langtype values('', 'Icelander', 'es');
insert into cv_langtype values('', 'Italiano', 'es');
insert into cv_langtype values('', 'Japaneses', 'es');
insert into cv_langtype values('', 'Laosiano', 'es');
insert into cv_langtype values('', 'Netherlander', 'es');
insert into cv_langtype values('', 'Noruego', 'es');
insert into cv_langtype values('', 'Poste', 'es');
insert into cv_langtype values('', 'Portugueses', 'es');
insert into cv_langtype values('', 'Rumano', 'es');
insert into cv_langtype values('', 'Ruso', 'es');
insert into cv_langtype values('', 'Sueco', 'es');
insert into cv_langtype values('', 'Checos', 'es');
insert into cv_langtype values('', 'Thailandais', 'es');
insert into cv_langtype values('', 'Turco', 'es');
insert into cv_langtype values('', 'Vietnamitas', 'es');
insert into cv_langtype values('', 'Yugoslavo', 'es');
###############################################################################
# création de la dba des pays
###############################################################################
insert into cv_country values('', 'Argelia', 'es');
insert into cv_country values('', 'Alemania', 'es');
insert into cv_country values('', 'Argentina', 'es');
insert into cv_country values('', 'Australia', 'es');
insert into cv_country values('', 'Bélgica', 'es');
insert into cv_country values('', 'Brasil', 'es');
insert into cv_country values('', 'Camerún', 'es');
insert into cv_country values('', 'Canadá', 'es');
insert into cv_country values('', 'China', 'es');
insert into cv_country values('', 'Costa de Marfil', 'es');
insert into cv_country values('', 'España', 'es');
insert into cv_country values('', 'los Estados Unidos', 'es');
insert into cv_country values('', 'Finlandia', 'es');
insert into cv_country values('', 'Francia', 'es');
insert into cv_country values('', 'Gabón', 'es');
insert into cv_country values('', 'Hungría', 'es');
insert into cv_country values('', 'Irlanda', 'es');
insert into cv_country values('', 'Italia', 'es');
insert into cv_country values('', 'Japón', 'es');
insert into cv_country values('', 'Luxemburgo', 'es');
insert into cv_country values('', 'Malí', 'es');
insert into cv_country values('', 'Marruecos', 'es');
insert into cv_country values('', 'Noruega', 'es');
insert into cv_country values('', 'los Países Bajos', 'es');
insert into cv_country values('', 'Polonia', 'es');
insert into cv_country values('', 'Rumania', 'es');
insert into cv_country values('', 'Reino Unido', 'es');
insert into cv_country values('', 'Rusia', 'es');
insert into cv_country values('', 'Senegal', 'es');
insert into cv_country values('', 'Suecia', 'es');
insert into cv_country values('', 'Suiza', 'es');
insert into cv_country values('', 'Togo', 'es');
insert into cv_country values('', 'Túnez', 'es');
###############################################################################
# création de la dba de maîtrise des langues
###############################################################################
insert into cv_langlevel values('', 'Básico', 'es');
insert into cv_langlevel values('', 'Leído', 'es');
insert into cv_langlevel values('', 'Leído, hablado', 'es');
insert into cv_langlevel values('', 'Leído, hablado, escrito', 'es');
insert into cv_langlevel values('', 'Natural', 'es');
insert into cv_langlevel values('', 'Fluido', 'es');
###############################################################################
# création de la dba des type de contrats
###############################################################################
insert into cv_contrat values('', 'Aprendizaje', 'es');
insert into cv_contrat values('', 'Tiempo completo', 'es');
insert into cv_contrat values('', 'Trabajo por horas', 'es');
insert into cv_contrat values('', 'Freelance', 'es');
insert into cv_contrat values('', 'Práctica enseñando', 'es');
###############################################################################
# création de la dba des type de postes
###############################################################################
insert into cv_poste values('10000', 'Agricultura', 'es');
insert into cv_poste values('10100', '- Encargado', 'es');
insert into cv_poste values('10200', '- Trabajador de granja', 'es');
insert into cv_poste values('20000', 'Departamento de ingeniería', 'es');
insert into cv_poste values('20100', '- Líder de proyecto', 'es');
insert into cv_poste values('20101', '-- Proyecto menor', 'es');
insert into cv_poste values('20102', '-- Proyecto mayor', 'es');
insert into cv_poste values('20400', '- Dirigir el estudio', 'es');
insert into cv_poste values('20500', '- Dirigir la ayuda', 'es');
insert into cv_poste values('20800', '- Webmaster', 'es');
insert into cv_poste values('30000', 'Departamento de las ventas', 'es');
insert into cv_poste values('30200', '- Encargado de ventas', 'es');
insert into cv_poste values('60000', 'Amaestrador', 'es');
insert into cv_poste values('70000', 'Periodista', 'es');
insert into cv_poste values('80000', 'Aprendiz', 'es');
insert into cv_poste values('90000', 'Traductor', 'es');
###############################################################################
# création de la dba des régions
###############################################################################
insert into cv_region values('10000', 'Francia', 'es');
insert into cv_region values('20000', 'Extranjero', 'es');
###############################################################################
# création de la dba des secteurs de production
###############################################################################
insert into stage_secteur values('', '1', 'Turismo',    'N', 'O', 'es');
insert into stage_secteur values('', '2', 'Social',      'N', 'O', 'es');
insert into stage_secteur values('', '3', 'Agricultura', 'O', 'O', 'es');
insert into stage_secteur values('', '4', 'Acondicionamiento', 'N', 'O', 'es');
insert into stage_secteur values('', '5', 'Servicio',     'N', 'O', 'es');
insert into stage_secteur values('', '6', 'Comercio',    'N', 'O', 'es');
insert into stage_secteur values('', '7', 'Otros',       'N', 'O', 'es');
###############################################################################
# création de la dba des catégories de production
###############################################################################
insert into prod_categorie values('1',  'A', 'bovino de leche', 'es');
insert into prod_categorie values('2',  'A', 'bovino de carne', 'es');
insert into prod_categorie values('3',  'A', 'ovino de carne', 'es');
insert into prod_categorie values('4',  'A', 'ovino de leche', 'es');
insert into prod_categorie values('5',  'A', 'caprino de leche', 'es');
insert into prod_categorie values('6',  'A', 'caprino de lana', 'es');
insert into prod_categorie values('7',  'A', 'porcino', 'es');
insert into prod_categorie values('8',  'A', 'equinos', 'es');
insert into prod_categorie values('9',  'A', 'gallinas ponedoras', 'es');
insert into prod_categorie values('10', 'A', 'ave de carne', 'es');
insert into prod_categorie values('11', 'V', 'maiz', 'es');
insert into prod_categorie values('12', 'V', 'maiz de ensilado', 'es');
insert into prod_categorie values('13', 'V', 'trigo', 'es');
insert into prod_categorie values('14', 'V', 'cebada', 'es');
insert into prod_categorie values('15', 'V', 'tritical', 'es');
insert into prod_categorie values('16', 'V', 'avena', 'es');
insert into prod_categorie values('17', 'V', 'centeno', 'es');
insert into prod_categorie values('18', 'V', 'girasol', 'es');
insert into prod_categorie values('19', 'V', 'colza', 'es');
insert into prod_categorie values('20', 'V', 'soja', 'es');
insert into prod_categorie values('21', 'V', 'pos', 'es');
insert into prod_categorie values('22', 'V', 'remolacha', 'es');
insert into prod_categorie values('23', 'V', 'viña', 'es');
insert into prod_categorie values('24', 'V', 'vivero', 'es');
insert into prod_categorie values('25', 'V', 'huerta', 'es');
insert into prod_categorie values('26', 'V', 'flores', 'es');
insert into prod_categorie values('27', 'V', 'prados naturales', 'es');
insert into prod_categorie values('28', 'V', 'prados temporales', 'es');
insert into prod_categorie values('29', 'V', 'cereales y paya', 'es');
insert into prod_categorie values('30', 'C', 'recepcion en granja', 'es');
insert into prod_categorie values('31', 'C', 'artesanado', 'es');
insert into prod_categorie values('32', 'C', 'transformacion en granja', 'es');
insert into prod_categorie values('33', 'C', 'empleos temporales', 'es');
insert into prod_categorie values('34', 'C', 'cultivo de fruta', 'es');
insert into prod_categorie values('35', 'C', 'almenas', 'es');
insert into prod_categorie values('36', 'C', 'cria de aves', 'es');
###############################################################################
# création de la dba des races animales
###############################################################################
insert into prod_race values('', '1', 'Abundancia');
insert into prod_race values('', '1', 'Morena');
insert into prod_race values('', '1', 'Montbéliarde');
insert into prod_race values('', '1', 'Normanda');
insert into prod_race values('', '1', 'cotorra roja del llano');
insert into prod_race values('', '1', 'Prim\'Holstein');
insert into prod_race values('', '1', 'Simmental');
insert into prod_race values('', '1', 'Tarentaise');
insert into prod_race values('', '1', 'Otro');
insert into prod_race values('', '1', 'Cruzada');
insert into prod_race values('', '2', 'Aubrac');
insert into prod_race values('', '2', 'Rubia de Aquitaine');
insert into prod_race values('', '2', 'Charolesa');
insert into prod_race values('', '2', 'Gascona');
insert into prod_race values('', '2', 'Limusina');
insert into prod_race values('', '2', 'Salers');
insert into prod_race values('', '2', 'Otro');
insert into prod_race values('', '2', 'Cruzada');
insert into prod_race values('', '3', 'Berrichon du Cher');
insert into prod_race values('', '3', 'Bizet');
insert into prod_race values('', '3', 'Causse du Lot');
insert into prod_race values('', '3', 'Hampshire');
insert into prod_race values('', '3', 'Ile de France');
insert into prod_race values('', '3', 'Lacaune-viande');
insert into prod_race values('', '3', 'Limousine');
insert into prod_race values('', '3', 'Manech');
insert into prod_race values('', '3', 'Mérinos');
insert into prod_race values('', '3', 'Mourerous');
insert into prod_race values('', '3', 'Charolesa');
insert into prod_race values('', '3', 'Corcega');
insert into prod_race values('', '3', 'Préalpes du Sud');
insert into prod_race values('', '3', 'Romanov');
insert into prod_race values('', '3', 'Roja del oeste');
insert into prod_race values('', '3', 'Texel');
insert into prod_race values('', '3', 'Otro');
insert into prod_race values('', '3', 'Cruzada');
insert into prod_race values('', '4', 'Vasco-Bernesa');
insert into prod_race values('', '4', 'Corse');
insert into prod_race values('', '4', 'Laucune-leche');
insert into prod_race values('', '4', 'Otro');
insert into prod_race values('', '4', 'Cruzada');
insert into prod_race values('', '5', 'Alpina-gamuza');
insert into prod_race values('', '5', 'Poitevine');
insert into prod_race values('', '5', 'Saanen');
insert into prod_race values('', '5', 'Rove');
insert into prod_race values('', '5', 'Otro');
insert into prod_race values('', '5', 'Cruzada');
insert into prod_race values('', '6', 'Angora');
insert into prod_race values('', '6', 'Mohair');
insert into prod_race values('', '6', 'Autre');
insert into prod_race values('', '6', 'Cruzada');
insert into prod_race values('', '7', 'Culo negro Limusino');
insert into prod_race values('', '7', 'Landrace');
insert into prod_race values('', '7', 'Large White');
insert into prod_race values('', '7', 'Piétrain');
insert into prod_race values('', '7', 'Cerdo vasco');
insert into prod_race values('', '7', 'Cerdo de Bayeux');
insert into prod_race values('', '7', 'Otro');
insert into prod_race values('', '7', 'Cruzada');
insert into prod_race values('', '8', 'Arabe');
insert into prod_race values('', '8', 'Anglo-arabe');
insert into prod_race values('', '8', 'Camargue');
insert into prod_race values('', '8', 'Selle français');
insert into prod_race values('', '8', 'Pura sangre');
insert into prod_race values('', '8', 'Trotteur');
insert into prod_race values('', '8', 'Andador');
insert into prod_race values('', '8', 'Boulonnais');
insert into prod_race values('', '8', 'Breton');
insert into prod_race values('', '8', 'Cob normand');
insert into prod_race values('', '8', 'Comtois');
insert into prod_race values('', '8', 'Poitevin');
insert into prod_race values('', '8', 'Percheron');
insert into prod_race values('', '8', 'Otro');
insert into prod_race values('', '8', 'Cruzada');
insert into prod_race values('', '9', '-');
insert into prod_race values('', '10', '-');
###############################################################################