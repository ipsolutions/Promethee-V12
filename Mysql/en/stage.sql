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
# création de la dba des types de qualifications
###############################################################################
insert into cv_level values('', '< 1 year', 'en');
insert into cv_level values('', '1 to 2 years', 'en');
insert into cv_level values('', '2 to 5 years', 'en');
insert into cv_level values('', '5 to 10 years', 'en');
insert into cv_level values('', '> 10 years', 'en');
###############################################################################
# création de la dba des diplômes
###############################################################################
insert into cv_degree values('', 'B.Sc.', 'en');
insert into cv_degree values('', 'M.Sc.', 'en');
insert into cv_degree values('', 'Ph.D.', 'en');
###############################################################################
# création de la dba des langues connues
###############################################################################
insert into cv_langtype values('', 'German', 'en');
insert into cv_langtype values('', 'English', 'en');
insert into cv_langtype values('', 'Arab', 'en');
insert into cv_langtype values('', 'Chinese', 'en');
insert into cv_langtype values('', 'Corse', 'en');
insert into cv_langtype values('', 'Danish', 'en');
insert into cv_langtype values('', 'Spanish', 'en');
insert into cv_langtype values('', 'Esperanto', 'en');
insert into cv_langtype values('', 'Finnish', 'en');
insert into cv_langtype values('', 'French', 'en');
insert into cv_langtype values('', 'Greek', 'en');
insert into cv_langtype values('', 'Hungarian', 'en');
insert into cv_langtype values('', 'Icelander', 'en');
insert into cv_langtype values('', 'Italian', 'en');
insert into cv_langtype values('', 'Japanese', 'en');
insert into cv_langtype values('', 'Laotian', 'en');
insert into cv_langtype values('', 'Netherlander', 'en');
insert into cv_langtype values('', 'Norwegian', 'en');
insert into cv_langtype values('', 'Pole', 'en');
insert into cv_langtype values('', 'Portuguese', 'en');
insert into cv_langtype values('', 'Roumanian', 'en');
insert into cv_langtype values('', 'Russian', 'en');
insert into cv_langtype values('', 'Swede', 'en');
insert into cv_langtype values('', 'Czechs', 'en');
insert into cv_langtype values('', 'Thailandais', 'en');
insert into cv_langtype values('', 'Turkish', 'en');
insert into cv_langtype values('', 'Vietnamese', 'en');
insert into cv_langtype values('', 'Yugoslavian', 'en');
###############################################################################
# création de la dba des pays
###############################################################################
insert into cv_country values('', 'Algeria', 'en');
insert into cv_country values('', 'Germany', 'en');
insert into cv_country values('', 'Argentina', 'en');
insert into cv_country values('', 'Australia', 'en');
insert into cv_country values('', 'Belgium', 'en');
insert into cv_country values('', 'Brazil', 'en');
insert into cv_country values('', 'Cameroun', 'en');
insert into cv_country values('', 'Canada', 'en');
insert into cv_country values('', 'China', 'en');
insert into cv_country values('', 'Ivory Coast', 'en');
insert into cv_country values('', 'Spain', 'en');
insert into cv_country values('', 'the United States', 'en');
insert into cv_country values('', 'Finland', 'en');
insert into cv_country values('', 'France', 'en');
insert into cv_country values('', 'Gabon', 'en');
insert into cv_country values('', 'Hungary', 'en');
insert into cv_country values('', 'Ireland', 'en');
insert into cv_country values('', 'Italy', 'en');
insert into cv_country values('', 'Japan', 'en');
insert into cv_country values('', 'Luxembourg', 'en');
insert into cv_country values('', 'Mali', 'en');
insert into cv_country values('', 'Morocco', 'en');
insert into cv_country values('', 'Norway', 'en');
insert into cv_country values('', 'the Netherlands', 'en');
insert into cv_country values('', 'Poland', 'en');
insert into cv_country values('', 'Romania', 'en');
insert into cv_country values('', 'United Kingdom', 'en');
insert into cv_country values('', 'Russia', 'en');
insert into cv_country values('', 'Senegal', 'en');
insert into cv_country values('', 'Sweden', 'en');
insert into cv_country values('', 'Switzerland', 'en');
insert into cv_country values('', 'Togo', 'en');
insert into cv_country values('', 'Tunisia', 'en');
###############################################################################
# création de la dba de maîtrise des langues
###############################################################################
insert into cv_langlevel values('', 'Basic', 'en');
insert into cv_langlevel values('', 'Read', 'en');
insert into cv_langlevel values('', 'Read, spoken', 'en');
insert into cv_langlevel values('', 'Read, spoken, written', 'en');
insert into cv_langlevel values('', 'Native', 'en');
insert into cv_langlevel values('', 'Fluently', 'en');
###############################################################################
# création de la dba des type de contrats
###############################################################################
insert into cv_contrat values('', 'Apprenticeship', 'en');
insert into cv_contrat values('', 'Full-time job', 'en');
insert into cv_contrat values('', 'Part-time job', 'en');
insert into cv_contrat values('', 'Freelance', 'en');
insert into cv_contrat values('', 'Practice teaching', 'en');
###############################################################################
# création de la dba des type de postes
###############################################################################
insert into cv_poste values('10000', 'Agriculture', 'en');
insert into cv_poste values('10100', '- Manager', 'en');
insert into cv_poste values('10200', '- Farm labourer', 'en');
insert into cv_poste values('20000', 'Engineering department', 'en');
insert into cv_poste values('20100', '- project Leader', 'en');
insert into cv_poste values('20101', '-- Leader junior project', 'en');
insert into cv_poste values('20102', '-- Leader senior project', 'en');
insert into cv_poste values('20400', '- Engineer study', 'en');
insert into cv_poste values('20500', '- Engineer support', 'en');
insert into cv_poste values('20800', '- Webmaster', 'en');
insert into cv_poste values('30000', 'Sales department', 'en');
insert into cv_poste values('30200', '- Sales manager', 'en');
insert into cv_poste values('60000', 'Trainer', 'en');
insert into cv_poste values('70000', 'Journalist', 'en');
insert into cv_poste values('80000', 'Trainee', 'en');
insert into cv_poste values('90000', 'Translator', 'en');
###############################################################################
# création de la dba des régions
###############################################################################
insert into cv_region values('10000', 'France', 'en');
insert into cv_region values('20000', 'Foreign', 'en');
###############################################################################
# création de la dba des secteurs de production
###############################################################################
insert into stage_secteur values('', '1', 'Tourism',    'N', 'O', 'en');
insert into stage_secteur values('', '2', 'Social',      'N', 'O', 'en');
insert into stage_secteur values('', '3', 'Agriculture', 'O', 'O', 'en');
insert into stage_secteur values('', '4', 'Installation', 'N', 'O', 'en');
insert into stage_secteur values('', '5', 'Service',     'N', 'O', 'en');
insert into stage_secteur values('', '6', 'Trade',    'N', 'O', 'en');
insert into stage_secteur values('', '7', 'Other',       'N', 'O', 'en');
###############################################################################
# création de la dba des catégories de production
###############################################################################
insert into prod_categorie values('1',  'A', 'bovine milk', 'en');
insert into prod_categorie values('2',  'A', 'bovine meat', 'en');
insert into prod_categorie values('3',  'A', 'ovine meat', 'en');
insert into prod_categorie values('4',  'A', 'ovine milk', 'en');
insert into prod_categorie values('5',  'A', 'caprine milk', 'en');
insert into prod_categorie values('6',  'A', 'caprine teases', 'en');
insert into prod_categorie values('7',  'A', 'porcine', 'en');
insert into prod_categorie values('8',  'A', 'equine', 'en');
insert into prod_categorie values('9',  'A', 'layers', 'en');
insert into prod_categorie values('10', 'A', 'poultries of flesh', 'en');
insert into prod_categorie values('11', 'V', 'corn', 'en');
insert into prod_categorie values('12', 'V', 'corn ensilage', 'en');
insert into prod_categorie values('13', 'V', 'wheat', 'en');
insert into prod_categorie values('14', 'V', 'barley', 'en');
insert into prod_categorie values('15', 'V', 'tritical', 'en');
insert into prod_categorie values('16', 'V', 'oats', 'en');
insert into prod_categorie values('17', 'V', 'rye', 'en');
insert into prod_categorie values('18', 'V', 'sunflower', 'en');
insert into prod_categorie values('19', 'V', 'colza', 'en');
insert into prod_categorie values('20', 'V', 'soya', 'en');
insert into prod_categorie values('21', 'V', 'pos', 'en');
insert into prod_categorie values('22', 'V', 'beet', 'en');
insert into prod_categorie values('23', 'V', 'vine', 'en');
insert into prod_categorie values('24', 'V', 'orchard', 'en');
insert into prod_categorie values('25', 'V', 'maraichage', 'en');
insert into prod_categorie values('26', 'V', 'flowers', 'en');
insert into prod_categorie values('27', 'V', 'natural meadows', 'en');
insert into prod_categorie values('28', 'V', 'temporary meadows', 'en');
insert into prod_categorie values('29', 'V', 'cereals with straw', 'en');
insert into prod_categorie values('30', 'C', 'reception at the farm', 'en');
insert into prod_categorie values('31', 'C', 'craft industry', 'en');
insert into prod_categorie values('32', 'C', 'transformation at the farm', 'en');
insert into prod_categorie values('33', 'C', 'seasonal employment', 'en');
insert into prod_categorie values('34', 'C', 'culture of small fruits', 'en');
insert into prod_categorie values('35', 'C', 'hives', 'en');
insert into prod_categorie values('36', 'C', 'breeding of poultries', 'en');
###############################################################################
# création de la dba des races animales
###############################################################################
insert into prod_race values('', '1', 'Abundance');
insert into prod_race values('', '1', 'Browe');
insert into prod_race values('', '1', 'Montbéliarde');
insert into prod_race values('', '1', 'Norman');
insert into prod_race values('', '1', 'Pie Rouge des Plaines');
insert into prod_race values('', '1', 'Prim\'Holstein');
insert into prod_race values('', '1', 'Simmental');
insert into prod_race values('', '1', 'Tarentaise');
insert into prod_race values('', '1', 'Other');
insert into prod_race values('', '1', 'Crossed');
insert into prod_race values('', '2', 'Aubrac');
insert into prod_race values('', '2', 'Blonde d\'Aquitaine');
insert into prod_race values('', '2', 'Charolaise');
insert into prod_race values('', '2', 'Gasconne');
insert into prod_race values('', '2', 'Limousine');
insert into prod_race values('', '2', 'Salers');
insert into prod_race values('', '2', 'Other');
insert into prod_race values('', '2', 'Crossed');
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
insert into prod_race values('', '3', 'Charolais');
insert into prod_race values('', '3', 'Corse');
insert into prod_race values('', '3', 'Préalpes du Sud');
insert into prod_race values('', '3', 'Romanov');
insert into prod_race values('', '3', 'Rouge de l\'Ouest');
insert into prod_race values('', '3', 'Texel');
insert into prod_race values('', '3', 'Other');
insert into prod_race values('', '3', 'Crossed');
insert into prod_race values('', '4', 'Basco-Béarnaise');
insert into prod_race values('', '4', 'Corse');
insert into prod_race values('', '4', 'Lacaune-lait');
insert into prod_race values('', '4', 'Other');
insert into prod_race values('', '4', 'Crossed');
insert into prod_race values('', '5', 'Alpine-Chamoisée');
insert into prod_race values('', '5', 'Poitevine');
insert into prod_race values('', '5', 'Saanen');
insert into prod_race values('', '5', 'Rove');
insert into prod_race values('', '5', 'Other');
insert into prod_race values('', '5', 'Crossed');
insert into prod_race values('', '6', 'Angora');
insert into prod_race values('', '6', 'Mohair');
insert into prod_race values('', '6', 'Other');
insert into prod_race values('', '6', 'Crossed');
insert into prod_race values('', '7', 'Cul Noir Limousin');
insert into prod_race values('', '7', 'Landrace');
insert into prod_race values('', '7', 'Large White');
insert into prod_race values('', '7', 'Piétrain');
insert into prod_race values('', '7', 'Pig Basque');
insert into prod_race values('', '7', 'Pig of Bayeux');
insert into prod_race values('', '7', 'Other');
insert into prod_race values('', '7', 'Crossed');
insert into prod_race values('', '8', 'Arabe');
insert into prod_race values('', '8', 'Anglo-arabe');
insert into prod_race values('', '8', 'Camargue');
insert into prod_race values('', '8', 'French Saddle');
insert into prod_race values('', '8', 'thoroughbred');
insert into prod_race values('', '8', 'Trotter');
insert into prod_race values('', '8', 'Ardennais');
insert into prod_race values('', '8', 'Boulonnais');
insert into prod_race values('', '8', 'Breton');
insert into prod_race values('', '8', 'Cob normand');
insert into prod_race values('', '8', 'Comtois');
insert into prod_race values('', '8', 'Poitevin');
insert into prod_race values('', '8', 'Percheron');
insert into prod_race values('', '8', 'Other');
insert into prod_race values('', '8', 'Crossed');
insert into prod_race values('', '9', '-');
insert into prod_race values('', '10', '-');
###############################################################################